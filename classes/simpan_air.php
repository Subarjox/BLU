<?php
session_start(); // Mulai session

header('Access-Control-Allow-Origin: *'); // Izinkan semua domain
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

// Include koneksi database
include 'koneksi.php';

// Ambil ID pengguna dari session
$idUser = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : '';

// Pastikan semua parameter ada
$namaAir = isset($_POST['nama_air']) ? $_POST['nama_air'] : '';
$deskripsiAir = isset($_POST['deskripsi_air']) ? $_POST['deskripsi_air'] : '';
$kualitas = isset($_POST['kualitas']) ? $_POST['kualitas'] : '';
$phAir = isset($_POST['ph_air']) ? $_POST['ph_air'] : '';
$turbidityAir = isset($_POST['turbidity_air']) ? $_POST['turbidity_air'] : '';
$tdsAir = isset($_POST['tds_air']) ? $_POST['tds_air'] : '';

// Jika ID pengguna tidak ada dalam session, beri peringatan
if (empty($idUser)) {
    echo "<script>alert('ID pengguna tidak ditemukan. Pastikan Anda sudah login.'); window.location.href = '../login.php';</script>";
    exit;
}

// Pastikan semua parameter ada
if (empty($namaAir) || empty($deskripsiAir) || empty($kualitas) || empty($phAir) || empty($turbidityAir) || empty($tdsAir)) {
    echo "<script>alert('Semua parameter diperlukan'); window.history.back();</script>";
    exit;
}

// Cek apakah data air sudah ada untuk user ini
$query = "SELECT id_user FROM air WHERE id_user = ? AND nama_air = ?";
$stmt = mysqli_prepare($koneksi, $query);
mysqli_stmt_bind_param($stmt, "ss", $idUser, $namaAir);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) > 0) {
    // Jika data air sudah ada, beri respons
    echo "<script>alert('Data air ini sudah ada'); window.history.back();</script>";
} else {
    // Jika data air belum ada, simpan data ke database
    $insertQuery = "INSERT INTO air (nama_air, deskripsi_air, kualitas, ph_air, turbidity_air, tds_air, id_user) 
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
    $insertStmt = mysqli_prepare($koneksi, $insertQuery);
    mysqli_stmt_bind_param($insertStmt, "sssssss", $namaAir, $deskripsiAir, $kualitas, $phAir, $turbidityAir, $tdsAir, $idUser);

    if (mysqli_stmt_execute($insertStmt)) {
        echo "<script>alert('Data air berhasil disimpan'); window.location.href = '../pages/main/pantau.php';</script>";
    } else {
        echo "<script>alert('Gagal menyimpan data air'); window.history.back();</script>";
    }

    // Tutup prepared statement untuk insert
    mysqli_stmt_close($insertStmt);
}

// Tutup prepared statement untuk cek data
mysqli_stmt_close($stmt);

// Tutup koneksi
mysqli_close($koneksi);
?>
