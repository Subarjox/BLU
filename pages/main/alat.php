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
          <a class="nav-link active" href="alat.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-settings-gear-65 text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Pengaturan Alat</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="pantau.php">
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
          <a class="nav-link " href="../pages/profile.html">
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
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Pengaturan Alat</li>
          </ol>
          <h6 class="font-weight-bolder text-white mb-0"> Pengaturan ALat</h6>
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
              <div class="col-lg-12 mb-4 ">
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
                          <div class="col-lg-12 mb-4">
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


              <div class="container-fluid py-6">


              <div class="row text-center justify-content-center">
                
                            <div class="col-lg-4 mb-4">
                    <a class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#loginModal">
                        <div class="card bg-transparent shadow-xl">
                            <div class="overflow-hidden position-relative border-radius-xl" style="background-image: url('../../assets/login-bg.jpg');">
                                <span class="mask bg-info"></span>
                                <div class="card-body position-relative z-index-1 p-3">
                                    <i class="fas fa-user-circle text-white p-2"></i>
                                    <h4 class="text-white text-3xl mb-5 pb-2">Koneksikan Alat</h4>
                                    <div class="d-flex">
                                        <div class="ms-auto w-20 d-flex align-items-end justify-content-end">
                                            <p class="text-white mb-0">🔒</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Modal Login -->
                <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-login" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Login Alat</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <form action="../../classes/register_alat.php" method="POST">
                                <div class="mb-3">
                                    <label for="id_device" class="form-label">ID Alat:</label>
                                    <input type="text" class="form-control" id="id_device" name="id_device" placeholder="Masukkan ID Alat" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password:</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password" required>
                                </div>
                                <button type="submit" class="btn btn-info">Koneksikan Alat</button>
                            </form>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 mb-4">
                    <a class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#hapusModal">
                        <div class="card bg-transparent shadow-xl">
                            <div class="overflow-hidden position-relative border-radius-xl" style="background-image: url('../../assets/login-bg.jpg');">
                                <span class="mask bg-danger"></span>
                                <div class="card-body position-relative z-index-1 p-3">
                                    <i class="fas fa-user-circle text-white p-2"></i>
                                    <h4 class="text-white text-3xl mb-5 pb-2">Hapus Koneksi Alat</h4>
                                    <div class="d-flex">
                                        <div class="ms-auto w-20 d-flex align-items-end justify-content-end">
                                            <p class="text-white mb-0">❌</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Modal Login -->
                <div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-login" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Anda yakin akan menghapus koneksi alat?</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <form action="../../classes/hapus_alat.php" method="POST">
                                <button type="button" class="btn btn-secondary " data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-info " >Hapus Koneksi</button>
                            </form>
                            </div>
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