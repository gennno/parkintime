import mysql.connector
from datetime import datetime

DB_CONFIG = {
    'host': 'yuuka.kawaiihost.net',
    'user': 'irunnlvu',
    'password': '1.26Z:GoEir5Yj',
    'database': 'irunnlvu_parkintime'
}

def get_db_connection():
    return mysql.connector.connect(**DB_CONFIG)

def insert_or_update_slot(id_lahan, kode_slot, jenis='free'):
    conn = get_db_connection()
    cursor = conn.cursor()
    now = datetime.now().strftime("%Y-%m-%d %H:%M:%S")

    cursor.execute("SELECT id FROM slot_parkir WHERE kode_slot = %s", (kode_slot,))
    result = cursor.fetchone()

    if result:
        cursor.execute("""
            UPDATE slot_parkir
            SET id_lahan = %s, jenis = %s, updated_at = %s
            WHERE kode_slot = %s
        """, (id_lahan, jenis, now, kode_slot))
    else:
        cursor.execute("""
            INSERT INTO slot_parkir (id_lahan, kode_slot, status, jenis, created_at, updated_at)
            VALUES (%s, %s, 'kosong', %s, %s, %s)
        """, (id_lahan, kode_slot, jenis, now, now))

    conn.commit()
    conn.close()

def update_slot_status(kode_slot, status):
    conn = get_db_connection()
    cursor = conn.cursor()
    now = datetime.now().strftime("%Y-%m-%d %H:%M:%S")

    cursor.execute("""
        UPDATE slot_parkir
        SET status = %s, updated_at = %s
        WHERE kode_slot = %s AND status != %s
    """, (status, now, kode_slot, status))

    conn.commit()
    conn.close()

def get_slot_data():
    conn = get_db_connection()
    cursor = conn.cursor(dictionary=True)
    cursor.execute("SELECT * FROM slot_parkir")
    data = cursor.fetchall()
    conn.close()
    return data

def get_reserved_slots():
    conn = get_db_connection()
    cursor = conn.cursor()
    cursor.execute("SELECT kode_slot FROM slot_parkir WHERE status = 'Booked'")
    rows = cursor.fetchall()
    conn.close()
    return {row[0]: False for row in rows}

def mark_slot_fulfilled(kode_slot):
    conn = get_db_connection()
    cursor = conn.cursor()
    now = datetime.now().strftime("%Y-%m-%d %H:%M:%S")
    cursor.execute("""
        UPDATE slot_parkir
        SET status = 'Occupied', updated_at = %s
        WHERE kode_slot = %s
    """, (now, kode_slot))
    conn.commit()
    conn.close()
