<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>
    Clinica Shared
  </title>
  <!--     Fonts and icons     -->
  <!-- Nucleo Icons -->
  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <link href="assets/css/style.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="assets/css/material-dashboard.css?v=3.0.0" rel="stylesheet" />
  <!-- Nepcha Analytics (nepcha.com) -->
  <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
</head>

<body class="mat-typography light theme-white menu_light logo-black">
    <div class="auth-container">
        <div class="row auth-main">
            <div class="col-sm-6 px-0 d-none d-sm-block">
            </div>
            <div class="col-sm-6 auth-form-section">
                <div class="form-section">
                    <div class="auth-wrapper">
                        <div class="card z-index-0 fadeIn3 fadeInBottom">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-success shadow-primary border-radius-lg py-3 pe-1">
                                <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Sign in</h4>
                                <div class="row mt-3">
                                    <div class="col-2 text-center ms-auto">
                                    <a  href="https://www.facebook.com/DaniSItotlv/"  target="_blank" class="btn btn-link px-3">
                                        <i class="fa fa-facebook text-white text-lg"></i>
                                    </a>
                                    </div>
                                    <div class="col-2 text-center px-1">
                                    <a class="btn btn-link px-3" target="_blank">
                                        <i class="fa fa-github text-white text-lg"></i>
                                    </a>
                                    </div>
                                    <div class="col-2 text-center me-auto">
                                        <a href="https://www.linkedin.com/in/dany-alvarez-2b403323a/" target="_blank" class="btn btn-link px-3" >
                                            <i class="fa fa-linkedin text-white text-lg"></i>
                                        </a>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <form role="form" class="text-start" method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="input-group input-group-outline mt-4 mb-5 ">
                                        <label class="form-label">USUARIO</label>
                                        <input id="username" type="username"
                                            class="form-control @error('username') is-invalid @enderror" name="username"
                                            value="{{ old('username') }}" required autocomplete="username" autofocus>
                                        @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <span class="form-bar"></span>
                                    </div>
                                    <div class="input-group input-group-outline  mb-3">
                                        <label class="form-label">CONTRASEÑA</label>
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="current-password">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <span class="form-bar"></span>
                                    </div>
                                    <p class="has-text-centered mb-4 mt-3">
                                        <button type="submit" class="btn bg-gradient-success w-100 my-4 mb-3">
                                            {{ __('INICIAR SESION') }}
                                        </button>
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer position-absolute bottom-2 py-2 w-100">
      <div class="container">
        <div class="row align-items-center justify-content-lg-between">
          <div class="col-12 col-md-6 my-auto">
            <div class="copyright text-center text-sm text-black text-lg-start">
              © <script>
                document.write(new Date().getFullYear())
              </script>,
             Laura alvarez Daniel
            </div>
          </div>
          <div class="col-12 col-md-6">
            <ul class="nav nav-footer justify-content-center justify-content-lg-end">
              <li class="nav-item">
                <a href="https://www.linkedin.com/in/dany-alvarez-2b403323a/" class="nav-link text-black" target="_blank">Linkedin</a>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link text-black" target="_blank">GitHub</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </footer>
      <!--   Core JS Files   -->
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
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
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/material-dashboard.min.js?v=3.0.0"></script>
</body>

</html>
