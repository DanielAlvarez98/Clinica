 
 
 @yield('modals')<!--   Core JS Files   -->

 <script src="{{asset('assets/js/core/bootstrap.min.js')}}"></script> 
 <script src="{{asset('https://code.jquery.com/jquery-3.6.0.min.js')}}"></script>
 @yield('scripts')

 <script  src="{{asset('assets/js/filtros.js')}}"></script>
 <script  type="module" src="{{asset('assets/js/script.js')}}"></script>
 <script src="{{asset('assets/js/core/popper.min.js')}}"></script>
 <script src="{{asset('assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
 <script src="{{asset('assets/js/plugins/smooth-scrollbar.min.js')}}"></script>
 <script src="{{asset('assets/js/plugins/chartjs.min.js')}}"></script>
 
 <script src={{asset('https://code.jquery.com/jquery-3.7.0.js')}}></script>
 <script src={{asset('https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js')}}></script>
 
 <!-- Github buttons -->
 <script async defer src="{{asset('https://buttons.github.io/buttons.js')}}"></script>
 <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
 <script src="{{asset('assets/js/material-dashboard.min.js?v=3.1.0')}}"></script>
</body>

</html>