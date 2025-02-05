<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/bluicon.png">
  <title>
    Sign Up | Blu
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/argon-dashboard.css?v=2.1.0" rel="stylesheet" />
</head>

<body class="">
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg position-absolute top-0 z-index-3 w-100 shadow-none my-3 navbar-transparent mt-4">
    <div class="container">
      <a class="navbar-brand" href="index.php">
        <h1 class="font-weight-bolder ms-lg-0 ms-3 text-white"> 💧 BLU </h1> 
      </a> 
      <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon mt-2">
          <span class="navbar-toggler-bar bar1"></span>
          <span class="navbar-toggler-bar bar2"></span>
          <span class="navbar-toggler-bar bar3"></span>
        </span>
      </button>
  </nav>
  <!-- End Navbar -->
  <main class="main-content  mt-0">
    <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg" style="background-image: url('../assets/img/headev.jpg'); background-position: top;">
      <span class="mask bg-gradient-info opacity-7"></span>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-5 text-center mx-auto">
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
        <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
          <div class="card z-index-0">
            <div class="card-header text-center pt-4">  
              <div class="mt-2 position-relative text-center">
                <h4 class="font-weight-bolder">Register</h4>
                <p class="mb-0">Masukan Email dan Password</p>
              </div>
            </div>
            <div class="card-body">
              <form role="form" action="../classes/signin.php" method="POST">
                <div class="mb-3">
                  <input type="text" class="form-control" placeholder="Nama" aria-label="Name" name="nama" required>
                </div>
                <div class="mb-3">
                  <input type="email" class="form-control" placeholder="Email" aria-label="Email" name="email" required>
                </div>
                <div class="mb-3">
                  <input type="password" class="form-control" placeholder="Password" aria-label="Password" name="password" required>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn bg-gradient-info w-100 my-4 mb-2">Sign up</button>
                </div>
                <p class="text-sm mt-3 mb-0">Sudah Punya Akun? <a href="sign-in.php" class="text-info font-weight-bolder">Login</a></p>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
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
  <script src="../assets/js/argon-dashboard.min.js?v=2.1.0"></script>
</body>

</html>