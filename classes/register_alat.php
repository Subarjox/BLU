<?php
session_start(); // Mulai session

header('Access-Control-Allow-Origin: *'); // Izinkan semua domain
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

// Include koneksi database
include 'koneksi.php';

// Ambil id_user dari session
$userId = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : '';
$idDevice = isset($_POST['id_device']) ? $_POST['id_device'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : ''; // Menambahkan parameter password

// Pastikan id_user, id_device, dan password ada
if (empty($userId) || empty($idDevice) || empty($password)) {
    echo "<script>
            alert('ID User, ID Device, dan Password diperlukan');
            window.history.back();
          </script>";
    exit;
}

// Cek apakah user sudah memiliki device terdaftar
$query = "SELECT id_device FROM users WHERE id_user = ?";
$stmt = mysqli_prepare($koneksi, $query);
mysqli_stmt_bind_param($stmt, "s", $userId);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_assoc($result);

// Jika user belum terdaftar, cek data di read_data untuk id_device dan password
if (!$data || is_null($data['id_device'])) {
    // Verifikasi apakah id_device dan password_device sesuai di tabel read_data
    $readDataQuery = "SELECT * FROM read_data WHERE id_device = ? AND password_device = ?";
    $readDataStmt = mysqli_prepare($koneksi, $readDataQuery);
    mysqli_stmt_bind_param($readDataStmt, "ss", $idDevice, $password);
    mysqli_stmt_execute($readDataStmt);
    $readDataResult = mysqli_stmt_get_result($readDataStmt);
    
    if (mysqli_num_rows($readDataResult) > 0) {
        // Jika id_device dan password_device sesuai, lakukan update pada tabel users
        $updateQuery = "UPDATE users SET id_device = ? WHERE id_user = ?";
        $updateStmt = mysqli_prepare($koneksi, $updateQuery);
        mysqli_stmt_bind_param($updateStmt, "ss", $idDevice, $userId);
        
        if (mysqli_stmt_execute($updateStmt)) {
            echo "<script>
                    alert('ID Device berhasil ditambahkan');
                    window.history.back();
                  </script>";
        } else {
            echo "<script>
                    alert('Gagal menambahkan ID Device');
                    window.history.back();
                  </script>";
        }

        // Tutup prepared statement untuk update
        mysqli_stmt_close($updateStmt);
    } else {
        echo "<script>
                alert('ID Device atau Password Device salah');
                window.history.back();
              </script>";
    }

    // Tutup prepared statement untuk read_data
    mysqli_stmt_close($readDataStmt);
} else {
    // Jika id_device sudah ada pada users, beri respons
    echo "<script>
            alert('Kamu sudah memiliki device terdaftar');
            window.history.back();
          </script>";
}

// Tutup koneksi
mysqli_stmt_close($stmt);
mysqli_close($koneksi);
?>
