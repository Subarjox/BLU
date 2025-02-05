<?php
header('Access-Control-Allow-Origin: *'); // Izinkan semua domain
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

// Include koneksi database
include 'koneksi.php';

// Mulai session
session_start();

// Ambil id_user dari session
$idUser = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : '';

// Pastikan id_user tidak kosong
if (empty($idUser)) {
    echo "<script>alert('ID User tidak ditemukan. Silakan login terlebih dahulu.'); window.history.back();</script>";
    exit;
}

// Cek apakah user dengan id_user ada di database
$query = "SELECT id_device FROM users WHERE id_user = ?";
$stmt = mysqli_prepare($koneksi, $query);
mysqli_stmt_bind_param($stmt, "s", $idUser);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_assoc($result);

// Jika user ditemukan
if ($data) {
    // Hapus id_device dari user
    $updateQuery = "UPDATE users SET id_device = NULL WHERE id_user = ?";
    $updateStmt = mysqli_prepare($koneksi, $updateQuery);
    mysqli_stmt_bind_param($updateStmt, "s", $idUser);
    
    if (mysqli_stmt_execute($updateStmt)) {
        echo "<script>alert('ID Device berhasil dihapus dari user.'); window.history.back();</script>";
    } else {
        echo "<script>alert('Gagal menghapus ID Device. Silakan coba lagi.'); window.history.back();</script>";
    }

    // Tutup prepared statement untuk update
    mysqli_stmt_close($updateStmt);
} else {
    // Jika user tidak ditemukan
    echo "<script>alert('User tidak ditemukan.'); window.history.back();</script>";
}

// Tutup prepared statement untuk select
mysqli_stmt_close($stmt);

// Tutup koneksi database
mysqli_close($koneksi);
?>
