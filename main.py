# === Import Library yang Diperlukan ===
import cv2
import pickle
import numpy as np
import json
import time
from datetime import datetime
from db_sync import update_slot_status, insert_or_update_slot, get_slot_data, get_reserved_slots, mark_slot_fulfilled

# === Konstanta dan Warna untuk Status Parkir ===
SENSITIVITY_THRESHOLD = 0.6  # Ambang batas deteksi untuk menentukan apakah slot kosong atau terisi
COLOR_AVAILABLE = (0, 255, 0)  # Hijau
COLOR_BOOKED = (0, 255, 255)  # Kuning
COLOR_OCCUPIED = (0, 0, 255)  # Merah

# Status Parkir
STATUS_AVAILABLE = "Available"
STATUS_BOOKED = "Booked"
STATUS_OCCUPIED = "Occupied"

# === Dictionary untuk Menyimpan Status Parkir ===
parking_status = {}
reserved_slots = {}
last_known_status = {}  # Cache status terakhir untuk sinkronisasi DB

# === Load metadata (kode slot) ===
def load_metadata():
    try:
        with open('slot_metadata.json', 'r') as f:
            data = json.load(f)
            return data.get('slots', [])
    except FileNotFoundError:
        print("[ERROR] slot_metadata.json tidak ditemukan.")
        return []

# === Menyimpan Status Parkir ke File JSON ===
def save_parking_status():
    parking_status["timestamp"] = datetime.now().strftime("%Y-%m-%d %H:%M:%S")
    with open('ParkingStatus.json', 'w') as json_file:
        json.dump(parking_status, json_file, indent=4)

# === Mencoba Koneksi ke Kamera Secara Otomatis ===
def connect_camera():
    for camera_index in range(3):  # Coba 3 port kamera
        cap = cv2.VideoCapture(camera_index, cv2.CAP_DSHOW)
        if cap.isOpened():
            ret, frame = cap.read()
            if ret:
                print(f"Connected to camera {camera_index}")
                return cap
            cap.release()
    return None

# === Membuat Status Bar pada Frame Output ===
def create_status_bar(width, height):
    status_bar = np.zeros((int(height * 0.1), width, 3), dtype=np.uint8)

    # Judul sistem
    cv2.putText(status_bar, "Smart Parking System - DB Sync", (10, int(status_bar.shape[0] * 0.3)),
                cv2.FONT_HERSHEY_SIMPLEX, 0.8, (255, 255, 255), 2)

    # Kotak warna dan label status parkir
    status_width = width // 4
    cv2.rectangle(status_bar, (width - 4 * status_width, int(status_bar.shape[0] * 0.5)),
                  (width - 3 * status_width, int(status_bar.shape[0] * 0.8)), COLOR_AVAILABLE, -1)
    cv2.putText(status_bar, "Available", (width - 4 * status_width + 10, int(status_bar.shape[0] * 0.7)),
                cv2.FONT_HERSHEY_SIMPLEX, 0.6, (255, 255, 255), 1)

    cv2.rectangle(status_bar, (width - 3 * status_width, int(status_bar.shape[0] * 0.5)),
                  (width - 2 * status_width, int(status_bar.shape[0] * 0.8)), COLOR_BOOKED, -1)
    cv2.putText(status_bar, "Booked", (width - 3 * status_width + 10, int(status_bar.shape[0] * 0.7)),
                cv2.FONT_HERSHEY_SIMPLEX, 0.6, (255, 255, 255), 1)

    cv2.rectangle(status_bar, (width - 2 * status_width, int(status_bar.shape[0] * 0.5)),
                  (width - status_width, int(status_bar.shape[0] * 0.8)), COLOR_OCCUPIED, -1)
    cv2.putText(status_bar, "Occupied", (width - 2 * status_width + 10, int(status_bar.shape[0] * 0.7)),
                cv2.FONT_HERSHEY_SIMPLEX, 0.6, (255, 255, 255), 1)

    return status_bar

# === Fungsi Utama untuk Mengecek Setiap Area Parkir ===
def check_parking_space(frame, polygons, metadata):
    global parking_status, reserved_slots, last_known_status

    height, width = frame.shape[:2]
    gray = cv2.cvtColor(frame, cv2.COLOR_BGR2GRAY)
    blur = cv2.GaussianBlur(gray, (3, 3), 1)
    _, thresh = cv2.threshold(blur, 50, 255, cv2.THRESH_BINARY)

    empty_count = booked_count = occupied_count = 0

    for idx, polygon in enumerate(polygons):
        if not isinstance(polygon, list) or len(polygon) < 3:
            continue

        mask = np.zeros_like(gray, dtype=np.uint8)
        pts = np.array(polygon, np.int32).reshape((-1, 1, 2))
        if pts.shape[0] < 3:
            continue

        cv2.fillPoly(mask, [pts], 255)

        non_zero_count = cv2.countNonZero(cv2.bitwise_and(thresh, thresh, mask=mask))
        total_area = cv2.countNonZero(mask)
        occupancy_ratio = non_zero_count / total_area if total_area > 0 else 0
        is_physically_occupied = occupancy_ratio < SENSITIVITY_THRESHOLD

        M = cv2.moments(pts)
        cx, cy = (int(M["m10"] / M["m00"]), int(M["m01"] / M["m00"])) if M["m00"] != 0 else pts[0][0]

        # Ambil kode_slot dari metadata
        if idx < len(metadata):
            kode_slot = metadata[idx]['kode_slot']
        else:
            kode_slot = f"A{idx+1:04d}"  # fallback

        # Penentuan status berdasarkan kondisi fisik dan DB
        if kode_slot in reserved_slots:
            if is_physically_occupied:
                color, status = COLOR_OCCUPIED, STATUS_OCCUPIED
                occupied_count += 1
                if not reserved_slots[kode_slot]:
                    mark_slot_fulfilled(kode_slot)
                    reserved_slots[kode_slot] = True
            else:
                color, status = COLOR_BOOKED, STATUS_BOOKED
                booked_count += 1
        else:
            if is_physically_occupied:
                color, status = COLOR_OCCUPIED, STATUS_OCCUPIED
                occupied_count += 1
            else:
                color, status = COLOR_AVAILABLE, STATUS_AVAILABLE
                empty_count += 1

        parking_status[f"Slot_{kode_slot}"] = status

        if kode_slot not in last_known_status or last_known_status[kode_slot] != status:
            update_slot_status(kode_slot, status)
            print(f"[SYNC] Updated {kode_slot} -> {status}")
            last_known_status[kode_slot] = status

        cv2.polylines(frame, [pts], True, color, 3)
        cv2.putText(frame, kode_slot, (cx - 10, cy), cv2.FONT_HERSHEY_SIMPLEX, 0.5, (255, 255, 255), 1)
        cv2.putText(frame, status, (cx - 30, cy + 20), cv2.FONT_HERSHEY_SIMPLEX, 0.4, (255, 255, 255), 1)

    summary_text = f"Available: {empty_count} | Booked: {booked_count} | Occupied: {occupied_count}"
    cv2.putText(frame, summary_text, (10, height - 40), cv2.FONT_HERSHEY_SIMPLEX, 0.7, (255, 255, 255), 2)

    parking_status["Summary"] = {
        "Available": empty_count,
        "Booked": booked_count,
        "Occupied": occupied_count,
        "Total": len(polygons)
    }
    save_parking_status()

# === Fungsi Main (Utama) ===
def main():
    global reserved_slots

    try:
        with open('CarParkPost', 'rb') as f:
            polygons = pickle.load(f)
            if not isinstance(polygons, list):
                raise ValueError("CarParkPost contains invalid data.")
        print(f"Loaded {len(polygons)} parking spaces")
    except Exception as e:
        print(f"Failed to load parking space data: {e}")
        return

    metadata = load_metadata()

    cap = connect_camera()
    if cap is None:
        print("Camera not available. Exiting.")
        return

    cap.set(cv2.CAP_PROP_FRAME_WIDTH, 800)
    cap.set(cv2.CAP_PROP_FRAME_HEIGHT, 600)

    last_db_sync_time = 0
    sync_interval = 5  # Sync DB setiap 5 detik

    while True:
        ret, frame = cap.read()
        if not ret:
            print("Camera read failed.")
            break

        if time.time() - last_db_sync_time > sync_interval:
            reserved_slots = get_reserved_slots()
            last_db_sync_time = time.time()

        check_parking_space(frame, polygons, metadata)
        status_bar = create_status_bar(frame.shape[1], frame.shape[0])
        display_frame = np.vstack((frame, status_bar))

        cv2.imshow("Smart Parking - DB Synced", display_frame)

        if cv2.waitKey(1) & 0xFF == ord('q'):
            break

    cap.release()
    cv2.destroyAllWindows()

# === Entry Point Program ===
if __name__ == "__main__":
    main()