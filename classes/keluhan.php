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
$judulKeluhan = isset($_POST['judul']) ? $_POST['judul'] : '';
$deskripsiKeluhan = isset($_POST['deskripsi']) ? $_POST['deskripsi'] : '';

// Jika ID pengguna tidak ada dalam session, beri peringatan
if (empty($idUser)) {
    echo "<script>alert('ID pengguna tidak ditemukan. Pastikan Anda sudah login.'); window.location.href = '../login.php';</script>";
    exit;
}

// Pastikan semua parameter ada
if (empty($judulKeluhan) || empty($deskripsiKeluhan)) {
    echo "<script>alert('Semua parameter diperlukan'); window.history.back();</script>";
    exit;
}

// Cek apakah keluhan sudah ada untuk user ini
$query = "SELECT id_user FROM keluhan WHERE id_user = ? AND judul = ?";
$stmt = mysqli_prepare($koneksi, $query);
mysqli_stmt_bind_param($stmt, "ss", $idUser, $judulKeluhan);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) > 0) {
    // Jika keluhan sudah ada, beri respons
    echo "<script>alert('Keluhan ini sudah ada'); window.history.back();</script>";
} else {
    // Jika keluhan belum ada, simpan data ke database
    $insertQuery = "INSERT INTO keluhan (judul, deskripsi, id_user) 
                    VALUES (?, ?, ?)";
    $insertStmt = mysqli_prepare($koneksi, $insertQuery);
    mysqli_stmt_bind_param($insertStmt, "sss", $judulKeluhan, $deskripsiKeluhan, $idUser);

    if (mysqli_stmt_execute($insertStmt)) {
        echo "<script>alert('Keluhan berhasil disimpan'); window.location.href = '../pages/main/keluhan.php';</script>";
    } else {
        echo "<script>alert('Gagal menyimpan keluhan'); window.history.back();</script>";
    }

    // Tutup prepared statement untuk insert
    mysqli_stmt_close($insertStmt);
}

// Tutup prepared statement untuk cek keluhan
mysqli_stmt_close($stmt);

// Tutup koneksi
mysqli_close($koneksi);
?>
