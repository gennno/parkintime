# ========== Import Libraries ==========
import pickle
import cv2
import numpy as np
import os
import json
import mysql.connector
from datetime import datetime

# ========== Konfigurasi Koneksi Database ==========
DB_CONFIG = {
    'host': 'yuuka.kawaiihost.net',
    'user': 'irunnlvu',
    'password': '1.26Z:GoEir5Yj',
    'database': 'irunnlvu_parkintime'
}

# Fungsi koneksi ke database (lazy load)
def get_db_connection():
    return mysql.connector.connect(**DB_CONFIG)


# ========== Fungsi Interaksi Database ==========
# Tambahkan slot parkir baru ke database
def insert_slot_to_db(id_lahan, kode_slot):
    conn = get_db_connection()
    cursor = conn.cursor()
    now = datetime.now().strftime("%Y-%m-%d %H:%M:%S")
    cursor.execute(
        "INSERT INTO slot_parkir (id_lahan, kode_slot, status, created_at, updated_at, jenis) VALUES (%s, %s, %s, %s, %s, %s)",
        (id_lahan, kode_slot, 'kosong', now, now, 'free')  # kamu bisa ubah 'free' sesuai jenis default
    )
    conn.commit()
    conn.close()

# Hapus slot dari database berdasarkan kode slot
def delete_slot_from_db(kode_slot):
    conn = get_db_connection()
    cursor = conn.cursor()
    cursor.execute("DELETE FROM slot_parkir WHERE kode_slot = %s", (kode_slot,))
    conn.commit()
    conn.close()

# Ambil semua kode slot dari database untuk id_lahan tertentu
def fetch_all_slots_from_db(id_lahan=1):
    conn = get_db_connection()
    cursor = conn.cursor()
    cursor.execute("SELECT kode_slot FROM slot_parkir WHERE id_lahan = %s", (id_lahan,))
    rows = cursor.fetchall()
    conn.close()
    return set(r[0] for r in rows)


# ========== File Konfigurasi Lokal (pickle dan JSON) ==========
POS_FILE = 'CarParkPost'
META_FILE = 'slot_metadata.json'

# Simpan posisi polygon slot parkir ke file
def save_parking_positions(polygons):
    with open(POS_FILE, 'wb') as f:
        pickle.dump(polygons, f)
    print(f"Saved {len(polygons)} parking spaces to file")

# Load posisi polygon dari file
def load_parking_positions():
    if os.path.exists(POS_FILE):
        with open(POS_FILE, 'rb') as f:
            return pickle.load(f)
    return []

# Load metadata (kode slot)
def load_metadata():
    try:
        with open(META_FILE, 'r') as f:
            data = json.load(f)
            return data.get('slots', [])
    except FileNotFoundError:
        return []

# Simpan metadata slot
def save_metadata(metadata):
    with open(META_FILE, 'w') as f:
        json.dump({'slots': metadata}, f, indent=4)

# Buat kode slot baru dengan format A0001, A0002, dst
def generate_new_slot_code(metadata):
    existing_ids = sorted(int(s['kode_slot'][1:]) for s in metadata)
    next_id = 1
    for i in existing_ids:
        if i != next_id:
            break
        next_id += 1
    return f"A{next_id:04d}"

# Hitung titik tengah dari polygon
def calculate_centroid(polygon):
    if not polygon:
        return (0, 0)
    x = sum(p[0] for p in polygon) // len(polygon)
    y = sum(p[1] for p in polygon) // len(polygon)
    return (x, y)

# Cek apakah titik berada di dalam polygon (klik kanan hapus)
def is_point_inside_polygon(point, polygon):
    x, y = point
    inside = False
    n = len(polygon)
    if n < 3:
        return False
    x1, y1 = polygon[0]
    for i in range(n + 1):
        x2, y2 = polygon[i % n]
        if min(y1, y2) < y <= max(y1, y2) and x <= max(x1, x2):
            if y1 != y2:
                xinters = (y - y1) * (x2 - x1) / (y2 - y1) + x1
            if x1 == x2 or x <= xinters:
                inside = not inside
        x1, y1 = x2, y2
    return inside

# Sinkronisasi GUI dengan data dari DB
def sync_gui_with_db(polygons, metadata, id_lahan=1):
    db_slots = fetch_all_slots_from_db(id_lahan)
    gui_slots = set([m['kode_slot'] for m in metadata])

    # Hapus slot dari GUI jika tidak ada di DB
    for i in reversed(range(len(metadata))):
        if metadata[i]['kode_slot'] not in db_slots:
            print(f"Slot {metadata[i]['kode_slot']} dihapus dari DB, menghapus dari GUI...")
            del metadata[i]
            del polygons[i]

    # Tambah slot dari DB yang belum ada di GUI
    new_slots = db_slots - gui_slots
    for slot in new_slots:
        print(f"Slot {slot} ada di DB, menambahkan placeholder di GUI...")
        metadata.append({'kode_slot': slot})
        polygons.append([])

    save_parking_positions(polygons)
    save_metadata(metadata)


# ========== Fungsi Utama ==========
def main():
    id_lahan = 1  # <- Fix dari error sebelumnya: 'id_lahq 1'

    # Inisialisasi kamera
    cap = cv2.VideoCapture(0)
    if not cap.isOpened():
        print("Webcam tidak ditemukan. Menggunakan ukuran default 800x600.")
        width, height = 800, 600
        cap = None
    else:
        width  = int(cap.get(cv2.CAP_PROP_FRAME_WIDTH))
        height = int(cap.get(cv2.CAP_PROP_FRAME_HEIGHT))
        print(f"Resolusi webcam terdeteksi: {width}x{height}")

    # Load data slot sebelumnya
    polygons = load_parking_positions()
    metadata = load_metadata()
    current_polygon = []

    # Buat jendela tampilan
    cv2.namedWindow("Parking Space Picker")

    # Fungsi untuk menangani klik mouse
    def mouse_callback(event, x, y, flags, param):
        nonlocal current_polygon, polygons, metadata
        if event == cv2.EVENT_LBUTTONDOWN:
            current_polygon.append((x, y))
        elif event == cv2.EVENT_RBUTTONDOWN:
            for i, poly in enumerate(polygons):
                if is_point_inside_polygon((x, y), poly):
                    kode = metadata[i]['kode_slot']
                    delete_slot_from_db(kode)
                    del polygons[i]
                    del metadata[i]
                    save_parking_positions(polygons)
                    save_metadata(metadata)
                    print(f"Deleted slot {kode} dari GUI dan DB")
                    return
            if current_polygon:
                current_polygon.pop()

    # Hubungkan mouse ke jendela
    cv2.setMouseCallback("Parking Space Picker", mouse_callback)
    print("Controls: Left click add point, Right click undo/delete, Enter save, R reset, Q quit")

    # ========== LOOP GUI ==========
    while True:
        sync_gui_with_db(polygons, metadata, id_lahan)

        layout_path = 'Layout Parkir.png'
        if os.path.exists(layout_path):
            layout_img = cv2.imread(layout_path)
            canvas = cv2.resize(layout_img, (width, height))
        else:
            canvas = np.ones((height, width, 3), dtype=np.uint8) * 255
            cv2.putText(canvas, "No layout image - draw slots here", (50, 50),
                        cv2.FONT_HERSHEY_SIMPLEX, 0.7, (0, 0, 0), 2)

        # Gambar semua polygon dan kode slot
        for i, poly in enumerate(polygons):
            if poly:
                pts = np.array(poly, np.int32).reshape((-1, 1, 2))
                cv2.polylines(canvas, [pts], True, (255, 0, 255), 2)
                cx, cy = calculate_centroid(poly)
                cv2.putText(canvas, metadata[i]['kode_slot'], (cx, cy),
                            cv2.FONT_HERSHEY_SIMPLEX, 0.6, (0, 0, 255), 2)

        # Gambar polygon yang sedang dibuat
        if len(current_polygon) > 1:
            pts = np.array(current_polygon, np.int32).reshape((-1, 1, 2))
            cv2.polylines(canvas, [pts], False, (0, 255, 0), 2)

        # Informasi jumlah slot
        cv2.putText(canvas, f"Slots: {len(polygons)}", (10, 30),
                    cv2.FONT_HERSHEY_SIMPLEX, 0.6, (0, 0, 0), 2)

        # Instruksi pengguna
        cv2.putText(canvas,
                    "L: Left Click = Add Point | R: Right Click = Delete/Undo | ENTER = Save | Q = Quit | R = Reset",
                    (10, height - 10), cv2.FONT_HERSHEY_SIMPLEX, 0.4, (50, 50, 50), 1)

        # Tampilkan canvas
        cv2.imshow("Parking Space Picker", canvas)

        # Event keyboard
        key = cv2.waitKey(10) & 0xFF
        if key == 13:  # ENTER
            if len(current_polygon) > 2:
                kode = generate_new_slot_code(metadata)
                polygons.append(current_polygon.copy())
                metadata.append({'kode_slot': kode})
                insert_slot_to_db(id_lahan, kode)
                save_parking_positions(polygons)
                save_metadata(metadata)
                print(f"Added slot {kode} to GUI and DB")
            current_polygon = []
        elif key == ord('r'):
            for s in metadata:
                delete_slot_from_db(s['kode_slot'])
            polygons.clear()
            metadata.clear()
            save_parking_positions(polygons)
            save_metadata(metadata)
            print("All slots reset in GUI and DB")
        elif key == ord('q'):
            break

    # ========== Akhiri Program ==========
    if cap:
        cap.release()
    cv2.destroyAllWindows()
    print("Exiting. Saved state.")


# Jalankan program
if __name__ == "__main__":
    main()
