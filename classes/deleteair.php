<?php
    header('Access-Control-Allow-Origin: *'); // Izinkan semua domain
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
    header('Access-Control-Allow-Headers: Content-Type, Authorization');

    include 'koneksi.php';

    // Pastikan koneksi ke database berhasil
    if (!$koneksi) {
        echo "<script>alert('Koneksi database gagal');</script>";
        exit();
    }

    // Cek apakah id_air ada dalam POST request
    if (isset($_POST['id_air']) && !empty($_POST['id_air'])) {
        $id_air = $_POST['id_air'];

        // Siapkan query DELETE
        $stmt = $koneksi->prepare("DELETE FROM air WHERE id_air = ?");
        $stmt->bind_param("s", $id_air); // Gunakan $id_air yang benar

        // Eksekusi query
        if ($stmt->execute()) {
            echo "<script>alert('Data berhasil dihapus');</script>";
            echo "<script>window.location.href = '../pages/main/daftarair.php';</script>"; // Redirect ke halaman tujuan
        } else {
            echo "<script>alert('Error: " . $stmt->error . "');</script>";
        }

        // Menutup statement
        $stmt->close();
    } else {
        echo "<script>alert('id_air tidak ditemukan atau kosong');</script>";
    }

    // Menutup koneksi
    $koneksi->close();
?>
