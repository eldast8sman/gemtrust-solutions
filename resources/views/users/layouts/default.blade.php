<!DOCTYPE html>
<html lang="en">

<head>
    <title> @yield('pageTitle') </title>
    @include('users.includes.head')

</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
        @include('users.includes.header')
    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">
        @include('users.includes.sidebar')
    </aside><!-- End Sidebar-->


    <!-- main page -->
    @yield('content')
    
    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        @include('users.includes.footer')
    </footer><!-- End Footer -->
    
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src=" {{ asset('js/jquery.min.js') }} "></script>
    <script src=" {{ asset('user/assets/vendor/apexcharts/apexcharts.min.js') }} "></script>
    <script src=" {{ asset('user/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }} "></script>
    <script src=" {{ asset('user/assets/vendor/chart.js/chart.umd.js') }} "></script>
    <script src=" {{ asset('user/assets/vendor/echarts/echarts.min.js') }} "></script>
    <script src=" {{ asset('user/assets/vendor/quill/quill.min.js') }} "></script>
    <script src=" {{ asset('user/assets/vendor/simple-datatables/simple-datatables.js') }} "></script>
    <script src=" {{ asset('user/assets/vendor/tinymce/tinymce.min.js') }} "></script>
    <script src=" {{ asset('user/assets/vendor/php-email-form/validate.js') }} "></script>

    <!-- Template Main JS File -->
    <script src=" {{ asset('user/assets/js/main.js') }} "></script>
    <script src=" {{ asset('user/assets/js/script.js') }} "></script>
    <script src=" {{ asset('dashboard/js/sweetalert.min.js') }}"></script>


</body>

</html>