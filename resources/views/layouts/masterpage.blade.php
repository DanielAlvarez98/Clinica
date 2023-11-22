@include('structure.head')
<body class="g-sidenav-show  bg-gray-200">
@include('structure.aside')
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    @include('structure.navbar')
    <div class="container-fluid py-4">
      <div class="row">
        @yield('content')
      </div>
    </div>
    <footer class="footer py-4  ">
        <div class="container-fluid">
            <div class="row align-items-center justify-content-lg-between">
            <div class="col-12 col-md-6 my-auto">
              <div class="copyright text-center text-sm text-black text-lg-start">
                © <script>
                  document.write(new Date().getFullYear())
                </script>,
               Laura Alvarez Daniel
              </div>
            </div>
            <div class="col-12 col-md-6">
              <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                <li class="nav-item">
                  <a href="https://www.linkedin.com/in/daniel-laura98/" class="nav-link text-black" target="_blank">Linkedin</a>
                </li>
                <li class="nav-item">
                  <a href="https://github.com/DanielAlvarez98/Clinica" class="nav-link text-black" target="_blank">GitHub</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </footer>

</main>
@include('structure.script')