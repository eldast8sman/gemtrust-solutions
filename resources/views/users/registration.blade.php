<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('favicon.png') }}" rel="icon">
    <!-- <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon"> -->

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('user/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('user/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('user/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('user/assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('user/assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('user/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('user/assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('user/assets/css/style.css') }}" rel="stylesheet">

    <script>
        if (sessionStorage.getItem('userToken') !== null) {
            window.location = "/users/";
        }
    </script>

    <title>Registration || User Dashboard || Gemtrust</title>

</head>

<body>

  <main>
      <div class="container">

          <section
              class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
              <div class="container">
                  <div class="row justify-content-center">
                      <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                          <div class="d-flex justify-content-center py-4">
                              <a href="index.html" class="logo d-flex align-items-center w-auto">
                                <img src=" {{ asset('dashboard/img/user.jpg') }}" alt="">
                                <span class="d-none d-lg-block">Gemtrust Solution</span>
                              </a>
                          </div><!-- End Logo -->

                          <div class="card mb-3">

                              <div class="card-body">

                                  <div class="pt-4 pb-2">
                                      <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                                      <p class="text-center small">Enter your personal details to create account</p>
                                  </div>

                                  <form class="row g-3 needs-validation">
                                      <div class="col-12">
                                          <label for="fullName" class="form-label">Your Name</label>
                                          <input type="text" name="name" class="form-control" id="fullName" placeholder="Enter your full name">
                                      </div>

                                      <div class="col-12">
                                          <label for="phoneNumber" class="form-label">Your Phone Number</label>
                                          <input type="number" name="email" class="form-control" id="phoneNumber" placeholder="Enter a valid Phone Number">
                                      </div>

                                      <div class="col-12">
                                          <label for="emailAddress" class="form-label">Your Email</label>
                                          <input type="email" name="email" class="form-control" id="emailAddress" placeholder="Enter a valid Email adddress">
                                      </div>

                                      <div class="col-12">
                                          <label for="password" class="form-label">Password</label>
                                          <input type="password" name="password" class="form-control" id="password" placeholder="Enter your password" >
                                      </div>

                                      <div class="col-12">
                                          <label for="cPassword" class="form-label">Confirm Password</label>
                                          <input type="password" name="password" class="form-control" id="cPassword" placeholder="Confirm your password">
                                      </div>

                                      <div class="col-12">
                                          <button class="btn btn-primary w-100" id="btnFunc" type="button" onclick="registerUser()">Create Account</button>
                                      </div>
                                      <div class="col-12">
                                          <p class="small mb-0">Already have an account? <a
                                                  href="/users/login">Log in</a></p>
                                      </div>
                                  </form>

                              </div>
                          </div>

                          <div class="credits">Developed by <a href="">Prosper JS</a>
                          </div>

                      </div>
                  </div>
              </div>

          </section>

      </div>
  </main><!-- End #main -->

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