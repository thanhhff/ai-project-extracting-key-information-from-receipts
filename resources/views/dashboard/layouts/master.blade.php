<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    Dashboard
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
  <link href="{{asset('./assets/css/nucleo-icons.css')}}" rel="stylesheet" />
  <link href="{{asset('./assets/css/nucleo-svg.css')}}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js"></script>
  <link href="{{asset('./assets/css/nucleo-svg.css')}}" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="{{asset('./assets/css/soft-ui-dashboard.css')}}" rel="stylesheet" />
  <!--   Core JS Files   -->
  <script src="{{asset('./assets/js/core/popper.min.js')}}"></script>
  <script src="{{asset('./assets/js/core/bootstrap.min.js')}}"></script>
  <script src="{{asset('./assets/js/plugins/smooth-scrollbar.min.js')}}"></script>
  <script src="{{asset('./assets/js/plugins/chartjs.min.js')}}"></script>
  <script src="{{asset('./assets/js/plugins/Chart.extension.js')}}"></script>
  <script src="{{asset('./assets/js/jquery-3.5.1.min.js')}}"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
  
  <link rel="stylesheet" href="{{asset('./assets/css/toastr.min.css')}}">
  <script src="{{asset('./assets/js/sweetalert2.min.js')}}"></script>
  <script src="{{asset('./assets/js/toastr.min.js')}}"></script>

  <script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" />
</head>

<body class="g-sidenav-show  bg-gray-100">
  @include('dashboard.layouts.sidebar')
  <main class="main-content mt-1 border-radius-lg">
    @include('dashboard.layouts.navbar')
    <div class="container-fluid py-4">
      @yield('content')
      @include('dashboard.layouts.footer')
    </div>
  </main>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{asset('./assets/js/soft-ui-dashboard.min.js')}}"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
</body>

</html>