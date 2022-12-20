
@extends('layouts.default')
@section('content')

    <!-- BOTTOM NAV -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
        <div class="container">
            <a class="navbar-brand" href="/"><img src="{{ asset('img/logo2.png') }}" alt="Website Logo" style="width: 250px; height: auto"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#services">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#partners">partners</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="#reviews">Reviews</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#team">Team</a>
                    </li> -->
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="#blog">Blog</a>
                    </li> -->
                </ul>
                <a href="/user" 
                    class="btn btn-brand ms-lg-3">Login</a>
            </div>
        </div>
    </nav>

    <!-- SLIDER -->
    <div class="owl-carousel owl-theme hero-slider">
        <div class="slide slide1">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center text-white">
                        <h6 class="text-white text-uppercase">Gemtrust Financial Soutions</h6>
                        <h1 class="display-3 my-4">Simple solutions to wealth creation</h1>
                        <a href="#" class="btn btn-brand">Get Started</a>
                        <a href="#" class="btn btn-outline-light ms-3">Our work</a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="slide slide2">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center text-white">
                        <h6 class="text-white text-uppercase">Gemtrust Financial Soutions</h6>
                        <h1 class="display-3 my-4">Join our global community and earn up to 4000% of your package and more</h1>
                        <a href="#" class="btn btn-brand">Get Started</a>
                        <a href="#" class="btn btn-outline-light ms-3">Our work</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="slide slide3">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-10 offset-lg-1 text-white">
                        <h6 class="text-white text-uppercase">Earn From</h6>
                        <h3 class="display-3 my-4">FOREX, CRYPTO, INDICES, STOCKS…</h3>
                        <a href="#" class="btn btn-brand">Get Started</a>
                        <a href="#" class="btn btn-outline-light ms-3">Our work</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="slide slide4">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-10 offset-lg-1 text-white">
                        <h6 class="text-white text-uppercase">GEMTRUST ACADEMY</h6>
                        <h3 class="display-3 my-4">Articles, Videos, Free Signals, PAMM</h3>
                        <a href="#" class="btn btn-brand">Get Started</a>
                        <a href="#" class="btn btn-outline-light ms-3">Our work</a>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- ABOUT -->
    <section id="about">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 py-5">
                    <div class="row">

                        <div class="col-12">
                            <div class="info-box">
                                <img src="{{ asset('img/trust.jpeg') }}" alt="trust" style="border-radius: 50%;" >
                                <div class="ms-4">
                                    <h5>Trust</h5>
                                    <p> We are building the largest thriving community financially, 
                                        on the world’s most valuable asset – TRUST </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-4">
                            <div class="info-box">
                                <img src="{{ asset('img/loyality.png') }}" alt="loyality" style="border-radius: 50%;" >
                                <div class="ms-4">
                                    <h5>Loyality</h5>
                                    <p> Our Goal of providing global financial Literacy if driven by our Loyalty to our community. 
                                        When it comes to decision, you come first, because we value you. </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-4">
                            <div class="info-box">
                                <img src="{{ asset('img/passion.jpeg') }}" alt="passion" style="border-radius: 50%;" >
                                <div class="ms-4">
                                    <h5>Passion</h5>
                                    <p>From leadership, down the ranks, our vision is driven by PASSION to raise 
                                        an army of financially literate people globally </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <img src="img/about.png" alt="">
                </div>
            </div>
        </div>
    </section>

    <!-- MILESTONE -->
    <section id="milestone">
        <div class="container">
            <div class="row text-center justify-content-center gy-4">
                <div class="col-lg-2 col-sm-6">
                    <h1 class="display-4">90K+</h1>
                    <p class="mb-0">Happy Clients</p>
                </div>
                <div class="col-lg-2 col-sm-6">
                    <h1 class="display-4">45M</h1>
                    <p class="mb-0">Lines of code</p>
                </div>
                <div class="col-lg-2 col-sm-6">
                    <h1 class="display-4">190</h1>
                    <p class="mb-0">Total Downloads</p>
                </div>
                <div class="col-lg-2 col-sm-6">
                    <h1 class="display-4">380K</h1>
                    <p class="mb-0">YouTube Subscribers</p>
                </div>
            </div>
        </div>
    </section>

    <section id="services" class="text-center">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="intro">
                        <h6>Our Services</h6>
                        <h1>What We Do?</h1>
                        <!-- <p class="mx-auto">Contrary to popular belief, Lorem Ipsum is not simply random text. It has
                            roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old</p> -->
                    </div>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="service" style="height: 350px;">
                        <img src="{{ asset('img/financial_literacy_pack.png') }}" alt="financial_literacy_pack" style="border-radius: 50%;" >
                        <h5>Financial Literacy Pack</h5>
                        <p>Articles and videos to get you financially literate</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="service" style="height: 350px;">
                        <img src="{{ asset('img/forex_acedemy.png') }}" alt="forex_acedemy" style="border-radius: 50%;" >
                        <h5>Forex Academy</h5>
                        <p>Simplified Videos from Forex Basics to Advanced courses. Learn ICT from our finest traders</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="service" style="height: 350px;">
                        <img src="{{ asset('img/crypto_acedemy.png') }}" alt="crypto_acedemy" style="border-radius: 50%;" >
                        <h5>Crypto Academy</h5>
                        <p>Get abreast with the future of financing. Learn everything you need to know about Cryptocurrency, NFT’s, Metaverse, Web3</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="service" style="height: 350px;">
                        <img src="{{ asset('img/free_forex_signals.png') }}" alt="free_forex_signals" style="border-radius: 50%;" >
                        <h5>Forex Trading Signals</h5>
                        <p>Over 80% accuracy, earn extra profits from our expert signals on Forex and Indices</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="service" style="height: 350px;">
                        <img src="{{ asset('img/pamm.png') }}" alt="pamm" style="border-radius: 50%;" >
                        <h5>Free PAMM Investment Package</h5>
                        <p>We take the first step to getting you a financial investment package for free. Get yours today. Terms and Conditions apply</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="service" style="height: 350px;">
                        <img src="{{ asset('img/the_employee_guide.png') }}" alt="the_employee_guide" style="border-radius: 50%;" >
                        <h5>The Employees Guide</h5>
                        <p>A direct guide to wealth for employees of all job classes</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-light" id="partners">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="intro">
                        <h6>Work</h6>
                        <h1>Partners</h1>
                        <!-- <p class="mx-auto">Contrary to popular belief, Lorem Ipsum is not simply random text. It has
                            roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old</p> -->
                    </div>
                </div>
            </div>
        </div>
        <div id="projects-slider" class="owl-theme owl-carousel">
            <div class="project">
                <div class="overlay"></div>
                <img src="img/project1.jpg" alt="">
                <div class="content">
                    <h2>Consulting Marketing</h2>
                    <h6>Website Design</h6>
                </div>
            </div>
            <div class="project">
                <div class="overlay"></div>
                <img src="img/project2.jpg" alt="">
                <div class="content">
                    <h2>Consulting Marketing</h2>
                    <h6>Website Design</h6>
                </div>
            </div>
            <div class="project">
                <div class="overlay"></div>
                <img src="img/project3.jpg" alt="">
                <div class="content">
                    <h2>Consulting Marketing</h2>
                    <h6>Website Design</h6>
                </div>
            </div>
            <div class="project">
                <div class="overlay"></div>
                <img src="img/project4.jpg" alt="">
                <div class="content">
                    <h2>Consulting Marketing</h2>
                    <h6>Website Design</h6>
                </div>
            </div>
            <div class="project">
                <div class="overlay"></div>
                <img src="img/project5.jpg" alt="">
                <div class="content">
                    <h2>Consulting Marketing</h2>
                    <h6>Website Design</h6>
                </div>
            </div>
        </div>
    </section>

    <!-- <section class="bg-light" id="reviews">

        <div class="owl-theme owl-carousel reviews-slider container">
            <div class="review">
                <div class="person">
                    <img src="img/team_1.jpg" alt="">
                    <h5>Ralph Edwards</h5>
                    <small>Market Development Manager</small>
                </div>
                <h3>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aut quis, rem culpa labore voluptate
                    ullam! In, nostrum. Dicta, vero nihil. Delectus minus vitae rerum voluptatum, excepturi incidunt ut,
                    enim nam exercitationem opti ducimus!</h3>
                <div class="stars">
                    <i class='bx bxs-star'></i>
                    <i class='bx bxs-star'></i>
                    <i class='bx bxs-star'></i>
                    <i class='bx bxs-star'></i>
                    <i class="bx bxs-star-half"></i>
                </div>
                <i class='bx bxs-quote-alt-left'></i>
            </div>
            <div class="review">
                <div class="person">
                    <img src="img/team_2.jpg" alt="">
                    <h5>Ralph Edwards</h5>
                    <small>Market Development Manager</small>
                </div>
                <h3>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aut quis, rem culpa labore voluptate
                    ullam! In, nostrum. Dicta, vero nihil. Delectus minus vitae rerum voluptatum, excepturi incidunt ut,
                    enim nam exercitationem optio ducimus!</h3>
                <div class="stars">
                    <i class='bx bxs-star'></i>
                    <i class='bx bxs-star'></i>
                    <i class='bx bxs-star'></i>
                    <i class='bx bxs-star'></i>
                    <i class="bx bxs-star-half"></i>
                </div>
                <i class='bx bxs-quote-alt-left'></i>
            </div>
            <div class="review">
                <div class="person">
                    <img src="img/team_3.jpg" alt="">
                    <h5>Ralph Edwards</h5>
                    <small>Market Development Manager</small>
                </div>
                <h3>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aut quis, rem culpa labore voluptate
                    ullam! In, nostrum. Dicta, vero nihil. Delectus minus vitae rerum voluptatum, excepturi incidunt ut,
                    enim nam exercitationem optio ducimus!</h3>
                <div class="stars">
                    <i class='bx bxs-star'></i>
                    <i class='bx bxs-star'></i>
                    <i class='bx bxs-star'></i>
                    <i class='bx bxs-star'></i>
                    <i class="bx bxs-star-half"></i>
                </div>
                <i class='bx bxs-quote-alt-left'></i>
            </div>
        </div>
    </section> -->

    <!-- <section id="team">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="intro">
                        <h6>Team</h6>
                        <h1>Team Members</h1>
                        <p class="mx-auto">Contrary to popular belief, Lorem Ipsum is not simply random text. It has
                            roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old</p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-8">
                    <div class="team-member">
                        <div class="image">
                            <img src="img/team_1.jpg" alt="">
                            <div class="social-icons">
                                <a href="#"><i class='bx bxl-facebook'></i></a>
                                <a href="#"><i class='bx bxl-twitter'></i></a>
                                <a href="#"><i class='bx bxl-instagram'></i></a>
                                <a href="#"><i class='bx bxl-pinterest'></i></a>
                            </div>
                            <div class="overlay"></div>
                        </div>

                        <h5>Marvin McKinney</h5>
                        <p>Marketing Coordinator</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-8">
                    <div class="team-member">
                        <div class="image">
                            <img src="img/team_2.jpg" alt="">
                            <div class="social-icons">
                                <a href="#"><i class='bx bxl-facebook'></i></a>
                                <a href="#"><i class='bx bxl-twitter'></i></a>
                                <a href="#"><i class='bx bxl-instagram'></i></a>
                                <a href="#"><i class='bx bxl-pinterest'></i></a>
                            </div>
                            <div class="overlay"></div>
                        </div>

                        <h5>Kathryn Murphy</h5>
                        <p>Ethical Hacker</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-8">
                    <div class="team-member">
                        <div class="image">
                            <img src="img/team_3.jpg" alt="">
                            <div class="social-icons">
                                <a href="#"><i class='bx bxl-facebook'></i></a>
                                <a href="#"><i class='bx bxl-twitter'></i></a>
                                <a href="#"><i class='bx bxl-instagram'></i></a>
                                <a href="#"><i class='bx bxl-pinterest'></i></a>
                            </div>
                            <div class="overlay"></div>
                        </div>

                        <h5>Darrell Steward</h5>
                        <p>Software Developer</p>
                    </div>
                </div>
            </div>
        </div>
    </section> -->

    <!-- <section id="blog">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="intro">
                        <h6>Blog</h6>
                        <h1>Blog Posts</h1>
                        <p class="mx-auto">Contrary to popular belief, Lorem Ipsum is not simply random text. It has
                            roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <article class="blog-post">
                        <img src="img/project5.jpg" alt="">
                        <a href="#" class="tag">Coming Soon</a>
                        <div class="content">
                            <small>01 Dec, 2022</small>
                            <h5>Coming Soon</h5>
                            <p>Coming Soon dolor sit amet consectetur, adipisicing elit. Aut quis, rem culpa labore voluptate
                                ullam! In, nostrum. Dicta,</p>
                        </div>
                    </article>
                </div>
                <div class="col-md-4">
                    <article class="blog-post">
                        <img src="img/project4.jpg" alt="">
                        <a href="#" class="tag">Coming Soon</a>
                        <div class="content">
                            <small>01 Dec, 2022</small>
                            <h5>Coming Soon</h5>
                            <p>Contrary to popular belief, Coming Soon is not simply random text. It has roots in a
                                piece of classical Latin literature from</p>
                        </div>
                    </article>
                </div>
                <div class="col-md-4">
                    <article class="blog-post">
                        <img src="img/project2.jpg" alt="">
                        <a href="#" class="tag">Coming Soon</a>
                        <div class="content">
                            <small>01 Dec, 2022</small>
                            <h5>Coming Soon</h5>
                            <p>Contrary to popular belief, Coming Soon is not simply random text. It has roots in a
                                piece of classical Latin literature from</p>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section> -->

@stop