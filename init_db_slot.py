# === Import Library ===
import pickle
import cv2
import numpy as np
import os
import json
import mysql.connector
from datetime import datetime

# === Konfigurasi Koneksi Database ===
DB_CONFIG = {
    'host': 'yuuka.kawaiihost.net',
    'user': 'irunnlvu',
    'password': '1.26Z:GoEir5Yj',
    'database': 'irunnlvu_parkintime'
}

# === Koneksi ke Kamera (coba kamera 0-2) ===
def connect_camera():
    for camera_index in range(3):
        cap = cv2.VideoCapture(camera_index, cv2.CAP_DSHOW)
        if cap.isOpened():
            ret, frame = cap.read()
            if ret:
                print(f"Successfully connected to camera {camera_index}")
                return cap, frame
            cap.release()
    print("Could not connect to any camera.")
    return None, None

# === Tambah slot parkir ke database ===
def insert_slot_to_db(kode_slot, id_lahan=1):
    conn = mysql.connector.connect(**DB_CONFIG)
    cursor = conn.cursor()
    now = datetime.now().strftime("%Y-%m-%d %H:%M:%S")
    cursor.execute("""
        INSERT INTO spot_parkir (id_lahan, kode_slot, status, waktu)
        VALUES (%s, %s, 'Available', %s)
        ON DUPLICATE KEY UPDATE kode_slot = kode_slot
    """, (id_lahan, kode_slot, now))
    conn.commit()
    conn.close()

# === Hapus slot parkir dari database ===
def delete_slot_from_db(kode_slot):
    conn = mysql.connector.connect(**DB_CONFIG)
    cursor = conn.cursor()
    cursor.execute("DELETE FROM spot_parkir WHERE kode_slot = %s", (kode_slot,))
    conn.commit()
    conn.close()

# === Simpan posisi slot parkir ke file ===
def save_parking_positions(polygons):
    with open('CarParkPost', 'wb') as f:
        pickle.dump(polygons, f)
    print(f"Saved {len(polygons)} parking spaces to file")

# === Load metadata slot parkir dari file JSON ===
def load_metadata():
    try:
        with open('slot_metadata.json', 'r') as f:
            data = json.load(f)
            return data.get('slots', [])
    except FileNotFoundError:
        return []

# === Simpan metadata ke file JSON ===
def save_metadata(metadata):
    with open('slot_metadata.json', 'w') as f:
        json.dump({'slots': metadata}, f, indent=4)

# === Generate kode slot parkir baru otomatis ===
def generate_new_slot_code(metadata):
    existing_codes = [int(slot['kode_slot'][1:]) for slot in metadata]
    next_id = max(existing_codes, default=0) + 1
    return f"A{next_id:04d}"

# === Hitung titik tengah (centroid) dari polygon ===
def calculate_centroid(polygon):
    if len(polygon) == 0:
        return (0, 0)
    return (sum(p[0] for p in polygon) // len(polygon),
            sum(p[1] for p in polygon) // len(polygon))

# === Cek apakah titik berada di dalam polygon (untuk hapus slot) ===
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

# === Fungsi Utama ===
def main():
    layout_path = 'Layout Parkir.png'

    # Load layout jika ada, jika tidak buat canvas kosong
    if os.path.exists(layout_path):
        img = cv2.imread(layout_path)
        if img is not None:
            print(f"Loaded parking layout from {layout_path}")
        else:
            print(f"Could not load image from {layout_path}")
            img = None
    else:
        print(f"Layout file '{layout_path}' not found")
        img = None

    if img is None:
        print("Creating blank canvas for parking layout...")
        img = np.ones((600, 800, 3), dtype=np.uint8) * 255
        cv2.putText(img, "No layout image found - Draw parking spaces on this canvas",
                    (50, 50), cv2.FONT_HERSHEY_SIMPLEX, 0.7, (0, 0, 0), 2)

    # Sesuaikan ukuran gambar dengan kamera jika tersedia
    cap, frame = connect_camera()
    if cap is not None and frame is not None:
        width = int(cap.get(cv2.CAP_PROP_FRAME_WIDTH))
        height = int(cap.get(cv2.CAP_PROP_FRAME_HEIGHT))
        cap.release()
        img = cv2.resize(img, (width, height))
        print(f"Resized layout to match camera: {width}x{height}")

    # Load polygon slot dari file jika ada
    try:
        with open('CarParkPost', 'rb') as f:
            polygons = pickle.load(f)
            if not isinstance(polygons, list):
                raise ValueError("Invalid CarParkPost data")
            print(f"Loaded {len(polygons)} polygons")
    except Exception as e:
        print(f"Starting fresh: {e}")
        polygons = []

    metadata = load_metadata()
    current_polygon = []

    # === Event mouse untuk menggambar & hapus polygon ===
    def mouse_callback(event, x, y, flags, param):
        nonlocal current_polygon, polygons, metadata
        if event == cv2.EVENT_LBUTTONDOWN:
            current_polygon.append((x, y))
        elif event == cv2.EVENT_RBUTTONDOWN:
            for i, polygon in enumerate(polygons):
                if is_point_inside_polygon((x, y), polygon):
                    kode_slot = metadata[i]['kode_slot']
                    del polygons[i]
                    del metadata[i]
                    save_parking_positions(polygons)
                    save_metadata(metadata)
                    delete_slot_from_db(kode_slot)
                    print(f"Deleted slot {kode_slot} from layout and DB")
                    return
            if current_polygon:
                current_polygon.pop()

    # === Petunjuk kontrol ===
    print("""
    Parking Space Picker Controls:
    -----------------------------
    Left Click:    Add point to current polygon
    Right Click:   Undo point or delete polygon
    Enter:         Save current polygon
    R:             Reset all
    Q:             Quit
    H:             Help
    """)

    cv2.namedWindow("Parking Space Picker")
    cv2.setMouseCallback("Parking Space Picker", mouse_callback)

    # === Loop utama program ===
    try:
        while True:
            img_copy = img.copy()

            # Gambar semua polygon yang sudah disimpan
            for i, polygon in enumerate(polygons):
                if not isinstance(polygon, list) or not all(isinstance(pt, tuple) for pt in polygon):
                    continue
                pts = np.array(polygon, np.int32).reshape((-1, 1, 2))
                cv2.polylines(img_copy, [pts], isClosed=True, color=(255, 0, 255), thickness=4)
                cx, cy = calculate_centroid(polygon)
                slot_code = metadata[i]["kode_slot"] if i < len(metadata) else f"A{i+1}"
                cv2.putText(img_copy, slot_code, (cx, cy), cv2.FONT_HERSHEY_SIMPLEX, 0.7, (0, 0, 255), 2)

            # Gambar polygon yang sedang digambar
            if len(current_polygon) > 1:
                pts = np.array(current_polygon, np.int32).reshape((-1, 1, 2))
                cv2.polylines(img_copy, [pts], isClosed=False, color=(0, 255, 0), thickness=4)

            # Teks instruksi di layar
            cv2.putText(img_copy,
                        "Left Click: Add | Right Click: Undo/Delete | Enter: Save | R: Reset | Q: Quit",
                        (10, 20), cv2.FONT_HERSHEY_SIMPLEX, 0.5, (255, 255, 255), 1)
            cv2.putText(img_copy, f"Current slots: {len(polygons)}",
                        (10, 40), cv2.FONT_HERSHEY_SIMPLEX, 0.5, (255, 255, 255), 1)

            cv2.imshow("Parking Space Picker", img_copy)
            key = cv2.waitKey(1) & 0xFF

            # === Tombol keyboard ===
            if key == 13:  # Enter
                if len(current_polygon) > 2:
                    polygons.append(current_polygon.copy())
                    kode_slot = generate_new_slot_code(metadata)
                    metadata.append({"kode_slot": kode_slot})
                    save_parking_positions(polygons)
                    save_metadata(metadata)
                    insert_slot_to_db(kode_slot)
                    print(f"Added slot {kode_slot} and updated DB")
                current_polygon = []
            elif key == ord('r'):
                polygons = []
                metadata = []
                current_polygon = []
                save_parking_positions(polygons)
                save_metadata(metadata)
                print("All slots reset")
            elif key == ord('q'):
                print("Exiting Parking Space Picker")
                break
            elif key == ord('h'):
                print("""
    Controls:
    ---------
    Left Click:    Add point
    Right Click:   Undo/Delete
    Enter:         Save slot
    R:             Reset all
    H:             Help
    Q:             Quit
                """)

    except Exception as e:
        print(f"Error occurred: {e}")
    finally:
        cv2.destroyAllWindows()
        print(f"Saved {len(polygons)} slots. Program finished.")

# === Jalankan Program ===
if __name__ == "__main__":
    main()
