import mysql.connector
import numpy as np
import skfuzzy as fuzz
from skfuzzy import control as ctrl

# Definisi fungsi fuzzy menggunakan ctrl
def air_kualitas(WAWQI_input, IKA_input):
    # Definisikan variabel fuzzy
    WAWQI = ctrl.Antecedent(np.arange(0, 101, 1), 'WAWQI')  # Surface Water Quality
    IKA = ctrl.Antecedent(np.arange(0, 101, 1), 'IKA')  # Index Pencemaran
    Hasil = ctrl.Consequent(np.arange(0, 101, 1), 'Hasil')  # Kategori hasil (0-100)

    # Membership Functions untuk WAWQI
    # Definisi Membership Function dengan overlap yang konsisten
    WAWQI['excellent'] = fuzz.trapmf(WAWQI.universe, [0, 0, 20, 35])  # Excellent dengan overlap ke Good
    WAWQI['good'] = fuzz.trimf(WAWQI.universe, [20, 35, 50])          # Good dengan overlap ke Excellent dan Poor
    WAWQI['poor'] = fuzz.trimf(WAWQI.universe, [45, 60, 75])          # Poor dengan overlap ke Good dan Very Poor
    WAWQI['very_poor'] = fuzz.trapmf(WAWQI.universe, [70, 85, 100, 100])  # Very Poor dengan overlap ke Poor


    # Membership Functions untuk IKA
    IKA['sangat_buruk'] = fuzz.trapmf(IKA.universe, [0, 0, 25, 35])
    IKA['buruk'] = fuzz.trimf(IKA.universe, [25, 50, 65])
    IKA['sedang'] = fuzz.trimf(IKA.universe, [50, 70, 80])
    IKA['baik'] = fuzz.trimf(IKA.universe, [71, 85, 95])
    IKA['sangat_baik'] = fuzz.trapmf(IKA.universe, [90, 95, 100, 100])

    # Membership Functions untuk Hasil
    Hasil['bahaya'] = fuzz.trimf(Hasil.universe, [0, 25, 50])  # "Bahaya" berada di rentang 0-50
    Hasil['hati-hati'] = fuzz.trimf(Hasil.universe, [45, 60, 75])  # "Hati-hati" berada di rentang 25-75
    Hasil['aman'] = fuzz.trimf(Hasil.universe, [71, 85, 100])  # "Aman" berada di rentang 50-100


    # Definisikan aturan fuzzy
    rules = [
    ctrl.Rule(WAWQI['excellent'] & IKA['sangat_baik'], Hasil['aman']),
    ctrl.Rule(WAWQI['excellent'] & IKA['baik'], Hasil['aman']),
    ctrl.Rule(WAWQI['excellent'] & IKA['sedang'], Hasil['hati-hati']),
    ctrl.Rule(WAWQI['excellent'] & IKA['buruk'], Hasil['bahaya']),
    ctrl.Rule(WAWQI['excellent'] & IKA['sangat_buruk'], Hasil['bahaya']),

    ctrl.Rule(WAWQI['good'] & IKA['sangat_baik'], Hasil['aman']),
    ctrl.Rule(WAWQI['good'] & IKA['baik'], Hasil['aman']),
    ctrl.Rule(WAWQI['good'] & IKA['sedang'], Hasil['hati-hati']),
    ctrl.Rule(WAWQI['good'] & IKA['buruk'], Hasil['bahaya']),
    ctrl.Rule(WAWQI['good'] & IKA['sangat_buruk'], Hasil['bahaya']),

    ctrl.Rule(WAWQI['poor'] & IKA['sangat_baik'], Hasil['hati-hati']),
    ctrl.Rule(WAWQI['poor'] & IKA['baik'], Hasil['hati-hati']),
    ctrl.Rule(WAWQI['poor'] & IKA['sedang'], Hasil['bahaya']),
    ctrl.Rule(WAWQI['poor'] & IKA['buruk'], Hasil['bahaya']),
    ctrl.Rule(WAWQI['poor'] & IKA['sangat_buruk'], Hasil['bahaya']),

    ctrl.Rule(WAWQI['very_poor'] & IKA['sangat_baik'], Hasil['hati-hati']),
    ctrl.Rule(WAWQI['very_poor'] & IKA['baik'], Hasil['bahaya']),
    ctrl.Rule(WAWQI['very_poor'] & IKA['sedang'], Hasil['bahaya']),
    ctrl.Rule(WAWQI['very_poor'] & IKA['buruk'], Hasil['bahaya']),
    ctrl.Rule(WAWQI['very_poor'] & IKA['sangat_buruk'], Hasil['bahaya']),
    ]

    # Sistem kontrol fuzzy
    hasil_ctrl = ctrl.ControlSystem(rules)
    hasil_simulasi = ctrl.ControlSystemSimulation(hasil_ctrl)

    # Masukkan nilai input
    hasil_simulasi.input['WAWQI'] = WAWQI_input
    hasil_simulasi.input['IKA'] = IKA_input

    # Lakukan komputasi fuzzy
    hasil_simulasi.compute()

    # Cetak nilai crisp yang dihitung
    print(f"Nilai Crisp untuk Hasil: {hasil_simulasi.output['Hasil']}")

    hasil_crisp = hasil_simulasi.output['Hasil']

    return hasil_crisp

def kategori_air(nilai_crisp):
    # Membuat kategori sesuai dengan hasil crisp dalam rentang 1-100
    if nilai_crisp <= 50:
        return "bahaya"
    elif nilai_crisp <= 70:
        return "hati-hati"
    else:
        return "aman"

# Fungsi untuk membaca nilai dari database dan mengupdate kategori
def update_kategori():
    try:
        # Koneksi ke database MySQL
        connection = mysql.connector.connect(
            host="localhost",  # Ganti dengan host Anda
            user="root",  # Ganti dengan username Anda
            password="",  # Ganti dengan password Anda
            database="blu"  # Ganti dengan nama database Anda
        )

        cursor = connection.cursor()

        # Query untuk membaca data WAWQI, IKA, dan ID
        read_query = "SELECT id_device, WAWQI, IKA FROM read_data WHERE id_device = 1"
        cursor.execute(read_query)
        rows = cursor.fetchall()  # Ambil semua baris data

        for row in rows:
            id_device, WAWQI, IKA = row

            # Hitung kategori berdasarkan fuzzy logic
            hasil_crisp = air_kualitas(WAWQI, IKA)
            kategori = kategori_air(hasil_crisp)

            # Query untuk mengupdate kolom kategori
            update_query = "UPDATE read_data SET hasil = %s WHERE id_device = %s"
            values = (kategori, id_device)

            cursor.execute(update_query, values)
            connection.commit()
            print(f"Kategori untuk ID={id_device} berhasil diperbarui menjadi: {kategori}")

    except mysql.connector.Error as err:
        print(f"Terjadi kesalahan: {err}")

    finally:
        # Menutup koneksi ke database
        if connection.is_connected():
            cursor.close()
            connection.close()

# Panggil fungsi untuk mengupdate kategori
update_kategori()