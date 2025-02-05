<?php
header('Access-Control-Allow-Origin: *'); // Izinkan semua domain
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

// Memulai session untuk mendapatkan id_user dari session
session_start();

// Include koneksi database
include 'koneksi.php';

// Ambil parameter dari body request (POST)
$namaAir = isset($_POST['nama_air']) ? $_POST['nama_air'] : '';
$deskripsiAir = isset($_POST['deskripsi_air']) ? $_POST['deskripsi_air'] : '';
$kualitas = isset($_POST['kualitas']) ? $_POST['kualitas'] : '';
$phAir = isset($_POST['ph_air']) ? $_POST['ph_air'] : '';
$turbidityAir = isset($_POST['turbidity_air']) ? $_POST['turbidity_air'] : '';
$tdsAir = isset($_POST['tds_air']) ? $_POST['tds_air'] : '';
$idAir = isset($_POST['id_air']) ? $_POST['id_air'] : ''; // Menambahkan id_air

// Ambil id_user dari session
$idUser = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : ''; // Pastikan session id_user ada

// Pastikan semua parameter ada
if (empty($idAir) || empty($namaAir) || empty($deskripsiAir) || empty($kualitas) || empty($phAir) || empty($turbidityAir) || empty($tdsAir) || empty($idUser)) {
    echo "<script>alert('Semua parameter diperlukan'); window.history.back();</script>";
    exit;
}

// Cek apakah data air sudah ada untuk user ini
$query = "SELECT id_air FROM air WHERE id_user = ? AND id_air = ?"; // Memperbaiki query untuk menggunakan id_air
$stmt = mysqli_prepare($koneksi, $query);
mysqli_stmt_bind_param($stmt, "ss", $idUser, $idAir); // Menggunakan id_air sebagai pencarian
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) > 0) {
    // Jika data air ditemukan, lakukan update
    $updateQuery = "UPDATE air SET nama_air = ?, deskripsi_air = ?, kualitas = ?, ph_air = ?, turbidity_air = ?, tds_air = ? 
                    WHERE id_air = ?"; // Menggunakan id_air sebagai identifier
    $updateStmt = mysqli_prepare($koneksi, $updateQuery);
    mysqli_stmt_bind_param($updateStmt, "sssssss", $namaAir, $deskripsiAir, $kualitas, $phAir, $turbidityAir, $tdsAir, $idAir); // Menggunakan id_air

    if (mysqli_stmt_execute($updateStmt)) {
        echo "<script>alert('Data air berhasil diperbarui'); window.location.href = '../pages/main/lihat_air.php?id_air=" . $idAir . "';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data air'); window.history.back();</script>";
    }

    // Tutup prepared statement untuk update
    mysqli_stmt_close($updateStmt);
} else {
    // Jika data air tidak ditemukan, beri respons
    echo "<script>alert('Data air tidak ditemukan untuk diperbarui'); window.history.back();</script>";
}

// Tutup prepared statement untuk cek data
mysqli_stmt_close($stmt);

// Tutup koneksi
mysqli_close($koneksi);
?>
