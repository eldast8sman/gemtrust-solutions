
@section('pageTitle')
    View Signal || User Dashboard || Gemtrust 
@endsection

@extends('users.layouts.default')

@section('pageActive')
    active
@endsection

@section('content')

    <main id="main" class="main">

    <div class="pagetitle">
        <h1>Signals</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Dashboard</li>
                <li class="breadcrumb-item active">Signals</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- <div class="search-bar">
                <form class="search-form d-flex align-items-center" method="POST" action="#">
                    <input type="text" name="query" placeholder="Search" title="Enter search keyword">
                    <button type="submit" title="Search"><i class="bi bi-search"></i></button>
                </form>
            </div> -->
            <!-- End Search Bar -->

            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row" id="signalCardHtml">

                </div>
            </div><!-- End Left side columns -->

        </div>
    </section>

    </main><!-- End #main -->

@endsection