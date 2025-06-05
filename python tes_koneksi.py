import mysql.connector

config = {
    'host': 'yuuka.kawaiihost.net',
    'user': 'irunnlvu',
    'password': '1.26Z:GoEir5Yj',
    'database': 'irunnlvu_parkintime'
}

try:
    conn = mysql.connector.connect(**config)
    print("✅ Koneksi berhasil!")
    conn.close()
except Exception as e:
    print("❌ Gagal koneksi:", e)
