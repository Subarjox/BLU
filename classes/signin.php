<?php
session_start();
include "koneksi.php";

// Ambil data dari form
$nama = isset($_POST['nama']) ? mysqli_real_escape_string($koneksi, $_POST['nama']) : '';
$email = isset($_POST['email']) ? mysqli_real_escape_string($koneksi, $_POST['email']) : '';
$password = isset($_POST['password']) ? mysqli_real_escape_string($koneksi, $_POST['password']) : '';

// Validasi data input
if (empty($nama) || empty($email) || empty($password)) {
   echo "<script>
           alert('Semua kolom harus diisi!');
           window.location.href='../pages/sign-up.php'; // Kembali ke halaman sign-up
         </script>";
   exit; // Hentikan eksekusi jika ada kolom kosong
}

// Validasi panjang password
if (strlen($password) < 6) {
   echo "<script>
           alert('Password harus memiliki minimal 6 karakter!');
           window.location.href='../pages/sign-up.php'; // Kembali ke halaman sign-up
         </script>";
   exit;
}

// Validasi format email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
   echo "<script>
           alert('Format email tidak valid!');
           window.location.href='../pages/sign-up.php'; // Kembali ke halaman sign-up
         </script>";
   exit;
}

$query = "INSERT INTO `users` (`id_user`, `nama`, `email`, `password`, `role`) VALUES (NULL, '$nama', '$email', '$password', 'user');";
$insert= mysqli_query($koneksi, $query);

if ($insert){
   echo " <script text='text/javascript'>
   alert('Berhasil daftar, silahkan login');
   window,location.href='../pages/index.php'
   </script>";

} else {
    echo "<script>
            alert('Gagal Menambah Data');

          </script>";
}
?>
