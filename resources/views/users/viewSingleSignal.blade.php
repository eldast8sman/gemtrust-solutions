
@section('pageTitle')
    View Single Signal || User Dashboard || Gemtrust 
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
                <li class="breadcrumb-item">Signals</li>
                <li class="breadcrumb-item active">Signal</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <input type="hidden" id="signal_id" value="{{ $signal_id }}" disabled>
            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row" id="singleSignalCardHtml">

                </div>
            </div><!-- End Left side columns -->

        </div>
    </section>

    </main><!-- End #main -->

@endsection