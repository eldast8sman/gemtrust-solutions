<!DOCTYPE html>
<html lang="en">

<head>
    <title> @yield('pageTitle') </title>
    @include('user.includes.head')
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            @include('user.includes.sidebar')
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">

            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                @include('user.includes.header')
            </nav>
            <!-- Navbar End -->


            <!-- main page -->
            @yield('content')


            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
                @include('user.includes.footer')
            </div>
            <!-- Footer End -->

        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src=" {{ asset('dashboard/lib/jquery/jquery.min.js') }}"></script>
    <script src=" {{ asset('dashboard/js/bootstrap.bundle.min.js') }}"></script>
    <script src=" {{ asset('dashboard/lib/chart/chart.min.js') }}"></script>
    <script src=" {{ asset('dashboard/lib/easing/easing.min.js') }}"></script>
    <script src=" {{ asset('dashboard/lib/waypoints/waypoints.min.js') }}"></script>
    <script src=" {{ asset('dashboard/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src=" {{ asset('dashboard/lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src=" {{ asset('dashboard/lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src=" {{ asset('dashboard/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>

	<!--Data Table js-->
	<script src=" {{ asset('dashboard/lib/datatable/js/jquery.dataTables.min.js') }} "></script>
	<script src=" {{ asset('dashboard/lib/datatable/js/dataTables.bootstrap5.min.js') }} "></script>
    
    <!-- Template Javascript -->
    <script src=" {{ asset('dashboard/js/main.js') }}"></script>
    <script src=" {{ asset('dashboard/js/sweetalert.min.js') }}"></script>
    <script src=" {{ asset('dashboard/js/script.js') }}"></script>
    

</body>

</html>