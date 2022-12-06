<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Gemtrust Dashboard || Signal Provider || Account Activation</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href=" {{ asset('dashboard/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href=" {{ asset('dashboard/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href=" {{ asset('dashboard/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href=" {{ asset('dashboard/css/style.css') }}" rel="stylesheet">
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


        <!-- Sign In Start -->
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <a href="" class="">
                                <h3 class="text-primary">Account Activation</h3>
                            </a>
                        </div>

                        <input type="hidden" id="verifyToken" value="{{ $verifyToken }}" disabled>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="sp_password" placeholder="Enter New Password">
                            <label for="sp_password">New Password</label>
                        </div>

                        <div class="form-floating mb-4">
                            <input type="password" class="form-control" id="sp_cPassword" placeholder="Comfirm Your Password">
                            <label for="sp_cPassword">Comfirm Password</label>
                        </div>

                        <button type="button" class="btn btn-primary py-3 w-100 mb-4" id="btnFunc" onclick="activateAccount()">Set Password</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sign In End -->
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

    <!-- Template Javascript -->
    <script src=" {{ asset('dashboard/js/main.js') }}"></script>
    <script src=" {{ asset('dashboard/js/sweetalert.min.js') }}"></script>
    <script src=" {{ asset('dashboard/js/sp_script.js') }}"></script>
</body>

</html>