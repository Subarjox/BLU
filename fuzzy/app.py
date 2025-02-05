from flask import Flask, request, jsonify
import mysql.connector
import numpy as np
import skfuzzy as fuzz
from skfuzzy import control as ctrl
from flask_cors import CORS

app = Flask(__name__)
CORS(app)

# Definisi fungsi fuzzy
def air_kualitas(WAWQI_input, IKA_input):
    # Definisi variabel fuzzy
    WAWQI = ctrl.Antecedent(np.arange(0, 101, 1), 'WAWQI')
    IKA = ctrl.Antecedent(np.arange(0, 101, 1), 'IKA')
    Hasil = ctrl.Consequent(np.arange(0, 101, 1), 'Hasil')

    # Membership function untuk WAWQI
    WAWQI['excellent'] = fuzz.trapmf(WAWQI.universe, [0, 0, 20, 35])
    WAWQI['good'] = fuzz.trimf(WAWQI.universe, [20, 35, 50])
    WAWQI['poor'] = fuzz.trimf(WAWQI.universe, [45, 60, 75])
    WAWQI['very_poor'] = fuzz.trapmf(WAWQI.universe, [70, 85, 100, 100])

    # Membership function untuk IKA
    IKA['sangat_buruk'] = fuzz.trapmf(IKA.universe, [0, 0, 25, 35])
    IKA['buruk'] = fuzz.trimf(IKA.universe, [25, 50, 65])
    IKA['sedang'] = fuzz.trimf(IKA.universe, [50, 70, 80])
    IKA['baik'] = fuzz.trimf(IKA.universe, [71, 85, 95])
    IKA['sangat_baik'] = fuzz.trapmf(IKA.universe, [90, 95, 100, 100])

    # Membership function untuk Hasil
    Hasil['bahaya'] = fuzz.trimf(Hasil.universe, [0, 25, 50])
    Hasil['hati-hati'] = fuzz.trimf(Hasil.universe, [45, 60, 75])
    Hasil['aman'] = fuzz.trimf(Hasil.universe, [71, 85, 100])

    # Definisi aturan fuzzy secara eksplisit
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

    # Menjalankan sistem fuzzy
    hasil_ctrl = ctrl.ControlSystem(rules)
    hasil_simulasi = ctrl.ControlSystemSimulation(hasil_ctrl)

    # Input ke sistem fuzzy
    hasil_simulasi.input['WAWQI'] = WAWQI_input
    hasil_simulasi.input['IKA'] = IKA_input
    hasil_simulasi.compute()

    return hasil_simulasi.output['Hasil']


@app.route('/analisa', methods=['GET'])
def analisa():
    try:
        # Ambil data dari database
        connection = mysql.connector.connect(
            host="localhost",
            user="root",
            password="",
            database="blu"
        )
        cursor = connection.cursor()
        cursor.execute("SELECT WAWQI, IKA FROM read_data WHERE id_device = 1")
        data = cursor.fetchone()
        if data:
            WAWQI, IKA = data
            hasil_crisp = air_kualitas(WAWQI, IKA)
            kategori = "aman" if hasil_crisp > 70 else "hati-hati" if hasil_crisp > 50 else "bahaya"

            # Update hasil ke database
            update_query = """
                UPDATE read_data 
                SET hasil = %s
                WHERE id_device = 1
            """
            cursor.execute(update_query, (kategori,))
            connection.commit()

            return jsonify({"status": "success", "kategori": kategori})
        return jsonify({"status": "error", "message": "Data tidak ditemukan"})
    except Exception as e:
        return jsonify({"status": "error", "message": str(e)})
    finally:
        if connection.is_connected():
            cursor.close()
            connection.close()



if __name__ == '__main__':
    app.run(debug=True)
