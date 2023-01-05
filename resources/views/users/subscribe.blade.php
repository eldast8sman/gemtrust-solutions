
@section('pageTitle')
    Signal Subscription || User Dashboard || Gemtrust
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
                <li class="breadcrumb-item active">Subscription</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        
    <div class="container-fluid pt-4 px-4">
            <div class="row g-4">
                
                <div class="col-xxl-4 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title text-primary">START PACKAGE</h3>
                            <h4 class="">$20</h4>
                            
                            <ul class="list-unstyled li-space-lg">
                                <li class="mb-2">
                                    <div ><i class="text-success bi bi-check2-circle"></i> Financial Literacy package</div>
                                </li>
                                <li class="mb-2">
                                    <div ><i class="text-success bi bi-check2-circle"></i> Free Forex Signal</div>
                                </li>
                                <li class="mb-2">
                                    <div ><i class="text-danger bi bi-check2-circle"></i> Forex Academy</div>
                                </li>
                                <li class="mb-2">
                                    <div ><i class="text-danger bi bi-check2-circle"></i> 3 Online Finance Mentorship conference</div>
                                </li>
                                <li class="mb-2">
                                    <div ><i class="text-danger bi bi-check2-circle"></i> 2 Live Conferences (Domestic)</div>
                                </li>
                                <li class="mb-2">
                                    <div ><i class="text-danger bi bi-check2-circle"></i> VIP treat for all Live conferences (Domestic)</div>
                                </li>
                                <li class="mb-2">
                                    <div ><i class="text-danger bi bi-check2-circle"></i> 1 Foreign Trip (All expense paid)</div>
                                </li>
                                <li class="mb-2">
                                    <div ><i class="text-danger bi bi-check2-circle"></i> VIP treat on Foreign Trips</div>
                                </li>
                            </ul>

                            <button type="button" id="btnFunc" onclick="signal_subscription('20')" class="btn btn-primary mt-4 w-100">Subscribe</button>

                        </div>
                    </div>
                </div>
                
                <div class="col-xxl-4 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title text-primary">BASIC PACKAGE</h3>
                            <h4 class="">$50 </h4>
                        
                            <ul class="list-unstyled li-space-lg">
                                <li class="mb-2">
                                    <div ><i class="text-success bi bi-check2-circle"></i> Financial Literacy package</div>
                                </li>
                                <li class="mb-2">
                                    <div ><i class="text-success bi bi-check2-circle"></i> Free Forex Signal</div>
                                </li>
                                <li class="mb-2">
                                    <div ><i class="text-success bi bi-check2-circle"></i> Forex Academy</div>
                                </li>
                                <li class="mb-2">
                                    <div ><i class="text-danger bi bi-check2-circle"></i> 3 Online Finance Mentorship conference</div>
                                </li>
                                <li class="mb-2">
                                    <div ><i class="text-danger bi bi-check2-circle"></i> 2 Live Conferences (Domestic)</div>
                                </li>
                                <li class="mb-2">
                                    <div ><i class="text-danger bi bi-check2-circle"></i> VIP treat for all Live conferences (Domestic)</div>
                                </li>
                                <li class="mb-2">
                                    <div ><i class="text-danger bi bi-check2-circle"></i> 1 Foreign Trip (All expense paid)</div>
                                </li>
                                <li class="mb-2">
                                    <div ><i class="text-danger bi bi-check2-circle"></i> VIP treat on Foreign Trips</div>
                                </li>
                            </ul>

                            <button type="button" id="btnFunc" onclick="signal_subscription('50')" class="btn btn-primary mt-4 w-100">Subscribe</button>

                        </div>
                    </div>
                </div>
                
                <div class="col-xxl-4 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title text-primary">SILVER PACKAGE</h3>
                            <h4 class="">$100</h4>
                        
                            <ul class="list-unstyled li-space-lg">
                                <li class="mb-2">
                                    <div ><i class="text-success bi bi-check2-circle"></i> Financial Literacy package</div>
                                </li>
                                <li class="mb-2">
                                    <div ><i class="text-success bi bi-check2-circle"></i> Free Forex Signal</div>
                                </li>
                                <li class="mb-2">
                                    <div ><i class="text-success bi bi-check2-circle"></i> Forex Academy</div>
                                </li>
                                <li class="mb-2">
                                    <div ><i class="text-success bi bi-check2-circle"></i> 3 Online Finance Mentorship conference</div>
                                </li>
                                <li class="mb-2">
                                    <div ><i class="text-danger bi bi-check2-circle"></i> 2 Live Conferences (Domestic)</div>
                                </li>
                                <li class="mb-2">
                                    <div ><i class="text-danger bi bi-check2-circle"></i> VIP treat for all Live conferences (Domestic)</div>
                                </li>
                                <li class="mb-2">
                                    <div ><i class="text-danger bi bi-check2-circle"></i> 1 Foreign Trip (All expense paid)</div>
                                </li>
                                <li class="mb-2">
                                    <div ><i class="text-danger bi bi-check2-circle"></i> VIP treat on Foreign Trips</div>
                                </li>
                            </ul>

                            <button type="button" id="btnFunc" onclick="signal_subscription('100')" class="btn btn-primary mt-4 w-100">Subscribe</button>

                        </div>
                    </div>
                </div>
                
                <div class="col-xxl-4 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title text-primary">GOLD PACKAGE</h3>
                            <h4 class="value">$200</h4>
                        
                            <ul class="list-unstyled li-space-lg">
                                <li class="mb-2">
                                    <div ><i class="text-success bi bi-check2-circle"></i> Financial Literacy package</div>
                                </li>
                                <li class="mb-2">
                                    <div ><i class="text-success bi bi-check2-circle"></i> Free Forex Signal</div>
                                </li>
                                <li class="mb-2">
                                    <div ><i class="text-success bi bi-check2-circle"></i> Forex Academy</div>
                                </li>
                                <li class="mb-2">
                                    <div ><i class="text-success bi bi-check2-circle"></i> 3 Online Finance Mentorship conference</div>
                                </li>
                                <li class="mb-2">
                                    <div ><i class="text-success bi bi-check2-circle"></i> 2 Live Conferences (Domestic)</div>
                                </li>
                                <li class="mb-2">
                                    <div ><i class="text-danger bi bi-check2-circle"></i> VIP treat for all Live conferences (Domestic)</div>
                                </li>
                                <li class="mb-2">
                                    <div ><i class="text-danger bi bi-check2-circle"></i> 1 Foreign Trip (All expense paid)</div>
                                </li>
                                <li class="mb-2">
                                    <div ><i class="text-danger bi bi-check2-circle"></i> VIP treat on Foreign Trips</div>
                                </li>
                            </ul>

                            <button type="button" id="btnFunc" onclick="signal_subscription('200')" class="btn btn-primary mt-4 w-100">Subscribe</button>

                        </div>
                    </div>
                </div>
                
                <div class="col-xxl-4 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title text-primary">PLATINUM PACKAGE</h4>
                            <h4 class="value">$500 monthly</h4>
                        
                            <ul class="list-unstyled li-space-lg">
                                <li class="mb-2">
                                    <div ><i class="text-success bi bi-check2-circle"></i> Financial Literacy package</div>
                                </li>
                                <li class="mb-2">
                                    <div ><i class="text-success bi bi-check2-circle"></i> Free Forex Signal</div>
                                </li>
                                <li class="mb-2">
                                    <div ><i class="text-success bi bi-check2-circle"></i> Forex Academy</div>
                                </li>
                                <li class="mb-2">
                                    <div ><i class="text-success bi bi-check2-circle"></i> 3 Online Finance Mentorship conference</div>
                                </li>
                                <li class="mb-2">
                                    <div ><i class="text-success bi bi-check2-circle"></i> 2 Live Conferences (Domestic)</div>
                                </li>
                                <li class="mb-2">
                                    <div ><i class="text-success bi bi-check2-circle"></i> VIP treat for all Live conferences (Domestic)</div>
                                </li>
                                <li class="mb-2">
                                    <div ><i class="text-danger bi bi-check2-circle"></i> 1 Foreign Trip (All expense paid)</div>
                                </li>
                                <li class="mb-2">
                                    <div ><i class="text-danger bi bi-check2-circle"></i> VIP treat on Foreign Trips</div>
                                </li>
                            </ul>

                            <button type="button" id="btnFunc" onclick="signal_subscription('500')" class="btn btn-primary mt-4 w-100">Subscribe</button>

                        </div>
                    </div>
                </div>
                
                <div class="col-xxl-4 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title text-primary">EMERALD PACKAGE</h4>
                            <h4 class="value">$1000 monthly</h4>

                            <ul class="list-unstyled li-space-lg">
                                <li class="mb-2">
                                    <div ><i class="text-success bi bi-check2-circle"></i> Financial Literacy package</div>
                                </li>
                                <li class="mb-2">
                                    <div ><i class="text-success bi bi-check2-circle"></i> Free Forex Signal</div>
                                </li>
                                <li class="mb-2">
                                    <div ><i class="text-success bi bi-check2-circle"></i> Forex Academy</div>
                                </li>
                                <li class="mb-2">
                                    <div ><i class="text-success bi bi-check2-circle"></i> 3 Online Finance Mentorship conference</div>
                                </li>
                                <li class="mb-2">
                                    <div ><i class="text-success bi bi-check2-circle"></i> 2 Live Conferences (Domestic)</div>
                                </li>
                                <li class="mb-2">
                                    <div ><i class="text-success bi bi-check2-circle"></i> VIP treat for all Live conferences (Domestic)</div>
                                </li>
                                <li class="mb-2">
                                    <div ><i class="text-success bi bi-check2-circle"></i> 1 Foreign Trip (All expense paid)</div>
                                </li>
                                <li class="mb-2">
                                    <div ><i class="text-danger bi bi-check2-circle"></i> VIP treat on Foreign Trips</div>
                                </li>
                            </ul>

                            <button type="button" id="btnFunc" onclick="signal_subscription('1000')" class="btn btn-primary mt-4 w-100">Subscribe</button>

                        </div>
                    </div>
                </div>
                
                <div class="col-xxl-4 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title text-primary">DIAMOND PACKAGE</h4>
                            <h4 class="value">$5000 monthly</h4>
                        
                            <ul class="list-unstyled li-space-lg">
                                <li class="mb-2">
                                    <div ><i class="text-success bi bi-check2-circle"></i> Financial Literacy package</div>
                                </li>
                                <li class="mb-2">
                                    <div ><i class="text-success bi bi-check2-circle"></i> Free Forex Signal</div>
                                </li>
                                <li class="mb-2">
                                    <div ><i class="text-success bi bi-check2-circle"></i> Forex Academy</div>
                                </li>
                                <li class="mb-2">
                                    <div ><i class="text-success bi bi-check2-circle"></i> 3 Online Finance Mentorship conference</div>
                                </li>
                                <li class="mb-2">
                                    <div ><i class="text-success bi bi-check2-circle"></i> 2 Live Conferences (Domestic)</div>
                                </li>
                                <li class="mb-2">
                                    <div ><i class="text-success bi bi-check2-circle"></i> VIP treat for all Live conferences (Domestic)</div>
                                </li>
                                <li class="mb-2">
                                    <div ><i class="text-success bi bi-check2-circle"></i> 1 Foreign Trip (All expense paid)</div>
                                </li>
                                <li class="mb-2">
                                    <div ><i class="text-success bi bi-check2-circle"></i> VIP treat on Foreign Trips</div>
                                </li>
                            </ul>

                            <button type="button" id="btnFunc" onclick="signal_subscription('5000')" class="btn btn-primary mt-4 w-100">Subscribe</button>

                        </div>
                    </div>
                </div>
                
            </div>
        </div>

    </section>

    </main><!-- End #main -->

@endsection