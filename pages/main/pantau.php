<!--
=========================================================
* Argon Dashboard 3 - v2.1.0
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard
* Copyright 2024 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->

<?php
include "../../classes/koneksi.php";

session_start(); // Pastikan session dimulai

// Validasi sesi dan role pengguna
if (!isset($_SESSION['id_user']) || $_SESSION['role'] !== 'user') {
    echo "<script>
            alert('Akses ditolak! Hanya akun user yang bisa mengakses halaman ini.');
            window.location.href = '../../index.php';
          </script>";
    exit;
}

// Ambil id_user dari sesi
$id_user = $_SESSION['id_user'];

// Query untuk mendapatkan data user berdasarkan id_user
$query_user = $koneksi->query("SELECT * FROM users WHERE id_user = '$id_user'");
$data_user = $query_user->fetch_assoc();

// Query untuk mendapatkan data device berdasarkan id_device user
$id_device = isset($data_user['id_device']) ? $data_user['id_device'] : null;

$data_device = null; // Default jika id_device tidak ditemukan
if ($id_device) {
    $query_device = $koneksi->query("SELECT * FROM read_data WHERE id_device = '$id_device'");
    $data_device = $query_device->fetch_assoc();
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" type="image/png" href="../../assets/img/bluicon.png">
  <title>
    BLU | Dashboard
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- CSS Files -->
  <link id="pagestyle" href="../../assets/css/argon-dashboard.css?v=2.1.0" rel="stylesheet" />
</head>

<body class="g-sidenav-show  bg-gray-300">
  <div class="min-height-250 bg-gradient-faded-info position-absolute w-100"></div>
  <aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="" target="_blank">
      <img src="../../assets/img/bluicon.png" width="26px" height="26px" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold"> BLU </span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
      <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Halaman </h6>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="dashboard.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-tv-2 text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="petunjuk.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-app text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Petunjuk Penggunaan</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="alat.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-settings-gear-65 text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Pengaturan Alat</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="pantau.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-atom text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1"> Kualitas Air </span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="daftarair.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-book-bookmark text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1"> Daftar Air Tersimpan </span>
          </a>
        </li>
 

        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Akun </h6>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="user.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Profile</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="../../classes/logout.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-button-power text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Log Out</span>
          </a>
        </li>
      </ul>


    </div>
    <div class="sidenav-footer mx-3 ">
      <div class="card card-plain shadow-none" id="sidenavCard">
        <img class="w-50 mx-auto" src="https://cdn-icons-gif.flaticon.com/17576/17576973.gif" alt="Customer Service Logo">
        <div class="card-body text-center p-3 w-100 pt-0">
          <div class="docs-info">
            <h6 class="mb-0">
            <?php echo isset($data_user['nama']) ? $data_user['nama'] : 'Data tidak tersedia'; ?>  
            </h6>
            <p class="text-xs font-weight-bold mb-0">Butuh Bantuan?</p>
          </div>
        </div>
      </div>
      <a href="keluhan.php" target="_blank" class="btn btn-info btn-sm w-100 mb-3">Hubungi Kami</a>
    </div>
 
 
  </aside>
  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Kualitas Air</li>
          </ol>
          <h6 class="font-weight-bolder text-white mb-0"> Kualitas Air</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          
          </div>

          <ul class="navbar-nav  justify-content-end">
            <li class="nav-item d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-white font-weight-bold px-0">
                <i class="fa fa-user me-sm-1"></i>
                <span class="d-sm-inline d-none">
                Halo, <?php echo isset($data_user['nama']) ? $data_user['nama'] : 'Data tidak tersedia'; ?>    
              </span>
                
              </a>
            </li>
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line bg-white"></i>
                  <i class="sidenav-toggler-line bg-white"></i>
                  <i class="sidenav-toggler-line bg-white"></i>
                </div>
              </a>
            </li>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <br>

    <div class="container-fluid py-2">
      <div class="row">
              <!-- Card 3 -->
              <div class="col-lg-6 mb-4 ">
                <a href="alat.php" class="text-decoration-none">
                  <div class="card bg-transparent shadow-xl" >
                    <div class="overflow-hidden position-relative border-radius-xl" style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/card-visa.jpg');">
                      <span class="mask bg-gradient-dark"></span>
                      <div class="card-body position-relative z-index-1 p-3">
                        <i class="fas fa-wifi text-white p-2"></i>
                       
                            <!-- PHP logic untuk menentukan warna teks -->
                            <?php
                            $status = isset($data_device['status']) ? $data_device['status'] : 'Belum Terhubung';
                            $statustext = 'text-white'; // Default warna teks

                            if ($status === 'Ready') {
                                $statustext = 'text-success'; // Hijau
                          // Kuning
                            } elseif ($status === 'Mati') {
                                $statustext = 'text-danger'; // Merah
                            }
                            ?>

                        <h4 class="<?php echo $statustext; ?> text-6xl mb-5 pb-2">
                        <?php echo $status; ?>
                        </h4>
                        <div class="d-flex">
                          <div class="me-4">
                            <h6 class="text-white mb-0">Status Alat</h6>
                          </div>
                          <div class="ms-auto w-20 d-flex align-items-end justify-content-end">
                            <p class="text-white mb-0">🕹️</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </a>
              </div>

                          <!-- Card 3 -->
                          <div class="col-lg-6 mb-4">
                            <a href="alat.php" class="text-decoration-none">
                              <div class="card bg-transparent shadow-xl">
                                <div class="overflow-hidden position-relative border-radius-xl" style="background-image: url('../../assets/esp32.jpg');">
                                  <span class="mask bg-gradient-dark"></span>
                                  <div class="card-body position-relative z-index-1 p-3">
                                    <i class="fas fa-wifi text-white p-2"></i>
                                    <h4 class="text-info text-6xl mb-5 pb-2">ESP - 
                                    <?php echo isset($data_device['id_device']) ? $data_device['id_device'] : 'Belum Terhubung'; ?>
                                    </h4>
                                    <div class="d-flex">
                                      <div class="me-4">
                                        <h6 class="text-white mb-0">ID Alat</h6>
                                      </div>
                                      <div class="ms-auto w-20 d-flex align-items-end justify-content-end">
                                        <p class="text-white mb-0">🆔</p>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </a>
                          </div>

                        </div>
                      </div>


    <!-- Status Card -->
    <div class="container-fluid py-4">
        <div class="row">
          <!-- Card 1 -->
          <div class="col-lg-4 mb-4">
        <a class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#tdsmodal">
          <div class="card bg-transparent shadow-xl">
            <div class="overflow-hidden position-relative border-radius-xl" 
              style="background-image: url('https://www.treehugger.com/thmb/YCwrFQvQm2uE0o1chuPrMmt-x8g=/750x0/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/__opt__aboutcom__coeus__resources__content_migration__mnn__images__2016__04__water-molecule-6ac34a7aece74a68a86926bbcc481263.jpg'); background-size: cover; background-position: center;">
              <span class="mask bg-gradient-dark"></span>
              <div class="card-body position-relative z-index-1 p-3">
                <i class="fas fa-wifi text-white p-2"></i>
                <h4 class="text-white text-6xl mb-5 pb-2">
                  <?php echo isset($data_device['tds']) ? $data_device['tds'] : 'Data tidak tersedia'; ?> PPM
                </h4>
                <div class="d-flex">
                  <div class="me-4">
                    <p class="text-white text-sm opacity-8 mb-0">Total Dissolved Solid (TDS)</p>
                    <h6 class="text-white mb-0">Jumlah Zat Terlarut</h6>
                  </div>
                  <div class="ms-auto w-20 d-flex align-items-end justify-content-end">
                    <p class="text-white mb-0">⚡</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </a>
      </div>

        <div class="modal fade" id="tdsmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail TDS</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <p>Total Dissolved Solid (TDS) menunjukkan jumlah zat terlarut dalam air. Nilai TDS saat ini adalah:</p>
                <h4 class="text-center">
                  <?php echo isset($data_device['tds']) ? $data_device['tds'] : 'Data tidak tersedia'; ?> PPM
                </h4>
                <?php
                            $tds = isset($data_device['tds']) ? $data_device['tds'] : 'Data tidak tersedia';
                            $tdsketerangan = 'Error, Coba untuk deteksi air lagi'; 

                            if ($tds < 350) {
                              $turbidityketerangan = 'Tingkat jumlah zat terlarut dalam air saat ini berada pada range yang ideal untuk dikonsumsi'; // Hijau
                            } elseif ($tds > 350 ) {
                              $turbidityketerangan = 'Tingkat jumlah zat terlarut dalam air berada pada range yang berbahaya untuk dikonsumsi'; // Merah
                            }
                            ?>

                <p><?php echo $turbidityketerangan; ?></p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-info" data-bs-dismiss="modal">Tutup</button>
              </div>
            </div>
          </div>
        </div>
      
          <!-- Card 2 -->
          <div class="col-lg-4 mb-4">
            <a class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#turbiditymodal">
              <div class="card bg-transparent shadow-xl">
                <div class="overflow-hidden position-relative border-radius-xl" style="background-image: url('../../assets/turbidity.jpg');">
                  <span class="mask bg-gradient-dark"></span>
                  <div class="card-body position-relative z-index-1 p-3">
                    <i class="fas fa-wifi text-white p-2"></i>
                    <h4 class="text-white text-6xl mb-5 pb-2">
                      <?php echo isset($data_device['turbidity']) ? $data_device['turbidity'] : 'Data tidak tersedia'; ?> NTU
                    </h4>
                    <div class="d-flex">
                        <div class="me-4">
                          <p class="text-white text-sm opacity-8 mb-0">Turbidity</p>
                          <h6 class="text-white mb-0">Kekeruhan </h6>
                          </div>
                      <div class="ms-auto w-20 d-flex align-items-end justify-content-end">
                        <p class="text-white mb-0">☕</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </a>
          </div>

          <div class="modal fade" id="turbiditymodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Turbidity</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <p>Turbidity adalah suatu nilai indikator yang menunjukkan kekeruhan air. Nilai Turbidity saat ini adalah:</p>
                <h4 class="text-center">
                  <?php echo isset($data_device['turbidity']) ? $data_device['turbidity'] : 'Data tidak tersedia'; ?> PPM
                </h4>

                <?php
                            $turbidity = isset($data_device['turbidity']) ? $data_device['turbidity'] : 'Data tidak tersedia';
                            $turbidityketerangan = 'Error, Coba untuk deteksi air lagi'; 

                            if ($turbidity < 200) {
                              $turbidityketerangan = 'Tingkat kekeruhan air saat ini berada pada range yang ideal untuk dikonsumsi'; // Hijau
                            } elseif ($turbidity > 200 ) {
                              $turbidityketerangan = 'Tingkat kekeruhan air saat ini berada pada range yang berbahaya untuk dikonsumsi'; // Merah
                            }
                            ?>

                <p><?php echo $turbidityketerangan; ?></p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-info" data-bs-dismiss="modal">Tutup</button>
              </div>
            </div>
          </div>
        </div>
      
          <!-- Card 3 -->
          <div class="col-lg-4 mb-4">
          <a class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#phmodal">
              <div class="card bg-transparent shadow-xl">
                <div class="overflow-hidden position-relative border-radius-xl" style="background-image: url('../../assets/ph.jpg');">
                  <span class="mask bg-gradient-dark"></span>
                  <div class="card-body position-relative z-index-1 p-3">
                    <i class="fas fa-wifi text-white p-2"></i>
                    <h4 class="text-white text-6xl mb-5 pb-2">
                    <?php echo isset($data_device['ph']) ? $data_device['ph'] : 'Data tidak tersedia'; ?>
                    </h4>
                    <div class="d-flex">
                      <div class="me-4">
                        <p class="text-white text-sm opacity-8 mb-0">Potential Of Hydrogen</p>
                        <h6 class="text-white mb-0">PH</h6>
                      </div>

                      <div class="ms-auto w-20 d-flex align-items-end justify-content-end">
                        <p class="text-white mb-0">💧</p>
                      </div>
                    </div>          
                  </div>
                </div>
              </div>
            </a>
          </div>
        </div>
      </div>

      <div class="modal fade" id="phmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title " id="exampleModalLabel">Detail PH</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <p>PH adalah asdlkjasdklj, dengan nilai sekarang  : </p>
                <h4 class="text-center">
                  <?php echo isset($data_device['ph']) ? $data_device['ph'] : 'Data tidak tersedia'; ?>
                </h4>
                                          
                            <?php
                            $ph = isset($data_device['ph']) ? $data_device['ph'] : 'Data tidak tersedia';
                            $phketerangan = 'Error, Coba untuk deteksi air lagi';

                            if ($ph >= 6.5 && $ph <= 8) {
                              $phketerangan = 'PH berada pada range yang ideal'; // Hijau
                            } elseif ($ph < 6.5 ) {
                              $phketerangan = 'PH berada pada range terlalu asam'; // Merah
                            } elseif ($ph > 8 ) {
                              $phketerangan = 'PH berada pada range terlalu basa';// Merah
                            }
                            ?>

                <p><?php echo $phketerangan; ?></p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-info" data-bs-dismiss="modal">Tutup</button>
              </div>
            </div>
          </div>
        </div>

      <div class="container-fluid py-2">
    <div class="row">
        <!-- Card AI -->
        <div class="col-lg-12 mb-4">
        <a class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#aimodal">
                <div class="card bg-transparent shadow-xl">
                    <div class="overflow-hidden position-relative border-radius-xl" style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/card-visa.jpg');">
                        <span class="mask bg-gradient-dark"></span>
                        <div class="card-body position-relative z-index-1 p-3">
                            <i class="fas fa-wifi text-white p-2"></i>

                            <!-- PHP logic untuk menentukan warna teks -->
                            <?php
                            $hasil = isset($data_device['hasil']) ? $data_device['hasil'] : 'Data tidak tersedia';
                            $textClass = 'text-white'; // Default warna teks

                            if ($hasil === 'aman') {
                                $textClass = 'text-success'; // Hijau
                            } elseif ($hasil === 'hati-hati') {
                                $textClass = 'text-warning'; // Kuning
                            } elseif ($hasil === 'bahaya') {
                                $textClass = 'text-danger'; // Merah
                            }
                            ?>

                            <h4 class="<?php echo $textClass; ?> text-6xl mb-5 pb-2">
                                <?php echo $hasil; ?>
                            </h4>

                            <div class="d-flex">
                                <div class="me-4">
                                    <h6 class="text-white mb-0">Analisis AI</h6>
                                </div>
                                <div class="ms-auto w-20 d-flex align-items-end justify-content-end">
                                    <p class="text-white mb-0">🤖</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

    <div class="modal fade" id="aimodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Turbidity</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <p>Hasil analisis AI adalah :</p>
                <h4 class="text-center">
                  <?php echo isset($data_device['hasil']) ? $data_device['hasil'] : 'Data tidak tersedia'; ?>
                </h4>
                <p>Dengan nilai WAWQI : </p>
                <p> <?php echo isset($data_device['WAWQI']) ? $data_device['WAWQI'] : 'Data tidak tersedia'; ?></p>
                <p>Dengan nilai IKA : </p>
                <p> <?php echo isset($data_device['IKA']) ? $data_device['IKA'] : 'Data tidak tersedia'; ?></p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-info" data-bs-dismiss="modal">Tutup</button>
              </div>
            </div>
          </div>
        </div>

              <div class="container-fluid py-4">
              <!-- <div class="row text-center">
                <div class="col-lg-12 mb-4">
                <h4 class="text-3xl mb-2 pb-2">

                      </h4>
                </div>
                </div> -->

              <div class="row text-center">

              <div class="col-lg-12 mb-4">
                  <!-- Tombol "Check Air" memenuhi lebar kolom -->
                  <button type="button" class="btn btn-round btn-info btn-lg w-100" onclick="location.reload()" >🔃 Check Kualitas Air 🔃</button>
                </div>
                <!-- Tombol "Simpan Data Air" memenuhi lebar kolom -->
              <div class="col-lg-6 mb-4">
              <form action="simpanair.php" method="GET">
                  <input type="hidden" name="tds" value="<?php echo isset($data_device['tds']) ? $data_device['tds'] : ''; ?>">
                  <input type="hidden" name="turbidity" value="<?php echo isset($data_device['turbidity']) ? $data_device['turbidity'] : ''; ?>">
                  <input type="hidden" name="ph" value="<?php echo isset($data_device['ph']) ? $data_device['ph'] : ''; ?>">
                  <input type="hidden" name="hasil" value="<?php echo isset($data_device['hasil']) ? $data_device['hasil'] : ''; ?>">
                  <button type="submit" class="btn btn-round btn-info btn-lg w-100">📝 Simpan Data Air 📝</button>
              </form>
                </div>

                <!-- Tombol "Detail Data Air" memenuhi lebar kolom -->
                <div class="col-lg-6 mb-4">
                  <button type="submit" class="btn btn-round btn-info btn-lg w-100" onclick="lihatAnalisa()">🤖 Lihat Analisis AI 🤖</button>
                </div>
              </div>
            </div>

      
    <footer class="footer pt-3  ">
      <div class="container-fluid">
        <div class="row align-items-center justify-content-lg-between">
          <div class="col-lg-6 mb-lg-0 mb-4">
            <div class="copyright text-center text-sm text-muted text-lg-start">
              © <script>
                document.write(new Date().getFullYear())
              </script>,
              made with ❤️ by
              <a href="" class="font-weight-bold" target="_blank">BLU®️</a>
              Untuk Kualitas Hidup Yang Lebih Baik
            </div>
          </div>
          
        </div>
      </div>
    </footer>

</main>

  <!--   Core JS Files   -->
  <script>
  function lihatAnalisa() {
    fetch('http://127.0.0.1:5000/analisa')
      .then(response => response.json())
      .then(data => {
        if (data.status === "success") {
          alert(`Kategori: ${data.kategori}\nNilai Crisp: ${data.nilai_crisp}`);
        } else {
          alert(`Error: ${data.message}`);
        }
      })
      .catch(error => {
        alert(`Terjadi kesalahan: ${error}`);
      });
  }
</script>

  <script src="../../assets/js/core/popper.min.js"></script>
  <script src="../../assets/js/core/bootstrap.min.js"></script>
  <script src="../../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../../assets/js/argon-dashboard.min.js?v=2.1.0"></script>
</body>

</html>