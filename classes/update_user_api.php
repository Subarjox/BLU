<?php
header('Access-Control-Allow-Origin: *'); // Izinkan semua domain
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS'); // Tambahkan OPTIONS
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Access-Control-Allow-Credentials: true'); // Jika menggunakan sesi

session_start();
include "koneksi.php";

// Validasi sesi pengguna
if (!isset($_SESSION['id_user'])) {
    echo "<script>
            alert('Akses ditolak! Anda harus login terlebih dahulu.');
            window.location.href = 'path/to/login.php'; // Ganti dengan halaman login Anda
          </script>";
    exit();
}

// Ambil id_user dari sesi
$id_user = $_SESSION['id_user'];

// Validasi Input
$nama = isset($_POST['nama']) ? trim($_POST['nama']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$password = isset($_POST['password']) ? trim($_POST['password']) : '';

// Validasi Data Input
if (empty($nama) || empty($email) || empty($password)) {
    echo "<script>
            alert('Semua field harus diisi.');
            window.history.back();
          </script>";
    exit();
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "<script>
            alert('Email tidak valid.');
            window.history.back();
          </script>";
    exit();
}

// Update Data di Database
$query = "UPDATE users SET nama = ?, email = ?, password = ? WHERE id_user = ?";
$stmt = $koneksi->prepare($query);

if ($stmt) {
    $stmt->bind_param("sssi", $nama, $email, $password, $id_user); // Gunakan prepared statement
    $result = $stmt->execute();

    if ($result) {
        if ($stmt->affected_rows > 0) {
            echo "<script>
                    alert('Data user berhasil diperbarui.');
                    window.location.href = '../pages/main/user.php'; // Ganti dengan halaman setelah update
                  </script>";
        } else {
            echo "<script>
                    alert('Tidak ada data yang diperbarui. Pastikan data Anda benar.');
                    window.history.back();
                  </script>";
        }
    } else {
        echo "<script>
                alert('Terjadi kesalahan saat memperbarui data.');
                window.history.back();
              </script>";
    }

    $stmt->close();
} else {
    echo "<script>
            alert('Kesalahan pada server.');
            window.history.back();
          </script>";
}

$koneksi->close();
exit();
?>
