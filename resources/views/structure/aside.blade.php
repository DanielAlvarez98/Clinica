<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 ps bg-white" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard " target="_blank">
        <img src="{{asset('assets/img/fotos/logo.png')}}" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold text-dark">Clinica Shared</span>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-dark active" href="{{route('home')}}">
            <div class="text-dark text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">dashboard</i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark " href="{{ route('user.index')}}">
            <div class="text-dark text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">person</i>
            </div>
            <span class="nav-link-text ms-1">Usuarios</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark " href="{{ route('employee.index')}}">
            <div class="text-dark text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">assignment_ind</i>
            </div>
            <span class="nav-link-text ms-1">Trabajadores</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark " href="{{ route('area.index')}}">
            <div class="text-dark text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">group_work</i>
            </div>
            <span class="nav-link-text ms-1">Departamentos</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark " href="{{ route('schedule.index')}}">
            <div class="text-dark text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">query_builder</i>
            </div>
            <span class="nav-link-text ms-1">Horarios</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark " href="{{ route('patient.index')}}">
            <div class="text-dark text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">face</i>
            </div>
            <span class="nav-link-text ms-1">Pacientes</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark " href="{{ route('medicine.index')}}">
            <div class="text-dark text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">local_pharmacy</i>
            </div>
            <span class="nav-link-text ms-1">Medicamentos</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark " href="{{ route('quote.index')}}">
            <div class="text-dark text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Citas</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark " href="{{ route('medicalHistory.index')}}">
            <div class="text-dark text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">receipt_long</i>
            </div>
            <span class="nav-link-text ms-1">Historial Médico</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark " href="{{ route('invoice.index')}}">
            <div class="text-dark text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">receipt_long</i>
            </div>
            <span class="nav-link-text ms-1">Facturas</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark " href="{{ route('paypal')}}">
            <div class="text-dark text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">receipt_long</i>
            </div>
            <span class="nav-link-text ms-1">PayPal</span>
          </a>
        </li>
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-8">Account pages</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark " href="">
            <div class="text-dark text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">visibility</i>
            </div>
            <span class="nav-link-text ms-1">Perfil</span>
          </a>
        </li>
      </ul>
    </div>
  </aside>