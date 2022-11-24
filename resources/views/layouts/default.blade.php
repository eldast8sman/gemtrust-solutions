<!doctype html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="Gemtrust financial solutions is a financial literacy campaign targeted at just any and every class of persons. Gemtrust has put together an academy  of constant increasing content to educate our community on finance.">
    <meta name="author" content="Prosper JS">

    <!-- OG Meta Tags to improve the way the post looks when you share the page on LinkedIn, Facebook, Google+ -->
	<meta property="og:site_name" content="gemtrust" /> <!-- website name -->
	<meta property="og:site" content="https://gemtrust.cfcing.org" /> <!-- website link -->
	<meta property="og:title" content="Gemtrust - Home"/> <!-- title shown in the actual shared post -->
	<meta property="og:description" content="Gemtrust financial solutions is a financial literacy campaign targeted at just any and every class of persons. Gemtrust has put together an academy  of constant increasing content to educate our community on finance." /> <!-- description shown in the actual shared post -->
	<meta property="og:image" content="" /> <!-- image link, make sure it's jpg -->
	<meta property="og:url" content="" /> <!-- where do you want your post to link to -->
	<meta property="og:type" content="article" />
    
    @include("includes.head")

    <!-- Website Title -->
    <title>Gemtrust - Home</title>

</head>

<body data-bs-spy="scroll" data-bs-target=".navbar" data-bs-offset="70">


    <!-- TOP NAV -->
    <div class="top-nav" id="home">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-auto">
                    <p> <i class='bx bxs-envelope'></i> info@gemtrust.cfcing.org</p>
                    <p> <i class='bx bxs-phone-call'></i> 123 456-7890</p>
                </div>
                <div class="col-auto social-icons">
                    <a href="#"><i class='bx bxl-facebook'></i></a>
                    <a href="#"><i class='bx bxl-twitter'></i></a>
                    <a href="#"><i class='bx bxl-instagram'></i></a>
                    <a href="#"><i class='bx bxl-pinterest'></i></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Page -->
    @yield('content')
    <!-- End of main page -->

    <!-- footer and login modal -->
    @include("includes.footer")
    <!-- end of footer and login modal -->

    <script src=" {{ asset('js/jquery.min.js') }} "></script>
    <script src=" {{ asset('js/bootstrap.bundle.min.js') }} "></script>
    <script src=" {{ asset('js/owl.carousel.min.js') }} "></script>
    <script src=" {{ asset('js/app.js') }} "></script>

</body>
</html>