// Mencoba updatedata.php

<?php
  require 'database.php';
  
  //---------------------------------------- Condition to check that POST value is not empty.
  if (!empty($_POST)) {
  
    echo "Mengirim Data";
    
    $id = $_POST['id_device'];
    $tds = $_POST['tds'];
    $turbidity = $_POST['turbidity'];
    $ph = $_POST['ph'];
    $ika = $_POST['IKA']; // Parameter tambahan untuk IKA
    $wawqi = $_POST['WAWQI']; // Parameter tambahan untuk WAWQI
    
    // Menghubungkan ke database
    require_once 'Database.php'; // Pastikan file koneksi tersedia
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Query untuk meng-update data
    $sql = "UPDATE read_data 
            SET tds = ?, turbidity = ?, ph = ?, IKA = ?, WAWQI = ? 
            WHERE id_device = ?";
    
    $q = $pdo->prepare($sql);
    
    // Menjalankan query dengan data yang diberikan
    $q->execute(array($tds, $turbidity, $ph, $ika, $wawqi, $id));
    
    echo "Data berhasil diperbarui";
    Database::disconnect();

    
  }
  echo"Tidak Mengirim Data";
  //---------------------------------------- 
?>
