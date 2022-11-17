
@extends('layouts.default')
@section('content')

    <!-- BOTTOM NAV -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
        <div class="container">
            <a class="navbar-brand" href="/">Gemtrust<span class="dot">.</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#terms">Terms & Conditions</a>
                    </li>
                </ul>
                <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"
                    class="btn btn-brand ms-lg-3">Login</a>
            </div>
        </div>
    </nav>

    <!-- MILESTONE -->
    <section>
        <div class="container">
            <div class="row text-center justify-content-center gy-4">
                <div class="col-lg-2 col-sm-6">
                    <h1 class="">Terms & Conditions</h1>
                </div>
            </div>
        </div>
    </section>


    <section class="bg-light">
        
        <div class="container">
            <div class="row">
                <div class="col-lg-12">                    
                    <div class="text-container">
                        <h3>Terms And Conditions</h3>
                        <p>Gemtrust Solutions Ltd referred here as company, holds the right to review the terms and conditions for all members when it deems it fit, as long as it is in the best interest of the business and its members.</p>
                    </div> <!-- end of text-container -->

                    <div class="text-container">
                        <h4>Membership</h4>
                        <ul class="list-unstyled li-space-lg indent">
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body">To become a member, each participant must buy a package with a non-refundable fee of the amount specified for that package.</div>
                            </li>
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body">Every package gives member access to the service offering for that package as long as the network circle is still in progress. (See package description).</div>
                            </li>
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body">A member can buy multiple packages of one or more categories and benefit from all packages simultaneously. </div>
                            </li>
                        </ul>
                    </div> <!-- end of text-container -->

                    <div class="text-container">
                        <h4>Termination of Membership</h4>
                        <ul class="list-unstyled li-space-lg indent">
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body">Packages can be terminated only when the registration is pending or within a 48 hours window after registration. The registration amount will be returned on the company’s next payout day.</div>
                            </li>
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body">Upon termination of membership, all charges on transaction (by third party service providers) will be borne by the customer.</div>
                            </li>
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body">Termination must be done in writing from the registered email of the account and addressed to support@gemtrust.com with the subject: TERMINATION.</div>
                            </li>
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body">All old members who apply for termination of membership for whatever reason(s), will forfeit 50% of pending rewards and all other services rendered will be suspended upon approval of the termination request.</div>
                            </li>
                        </ul>
                    </div> <!-- end of text-container -->
                    
                    <div class="text-container">
                        <h4>Rank Advancements</h4>
                        <ul class="list-unstyled li-space-lg indent">
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body">Advancement of a member from one rank to another is solely upon completion of the previous rank.</div>
                            </li>
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body">Benefits attached to a rank is upon completion of the registrations for that rank.</div>
                            </li>
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body">Members with multiple packages will be addressed with the Largest package they bought and the highest rank attained in that package.</div>
                            </li>
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body">The highest rank in the system is the “EXECUTIVE”. Upon completion, members can buy another package to run a fresh circle.</div>
                            </li>
                        </ul>
                    </div> <!-- end of text-container -->
                    
                    <div class="text-container">
                        <h4>Benefits, Rewards & Commissions</h4>
                        <ul class="list-unstyled li-space-lg indent">
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body">All members are entitled to the service offering due the package they have acquired.</div>
                            </li>
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body">Active members earn a commission on all new members registered directly or indirectly in their structure.</div>
                            </li>
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body">Payment of commissions is immediate and is redeemable in the next payout day from registrastion.</div>
                            </li>
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body">Commissions are withdrawals from $20 and above.</div>
                            </li>
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body">All rewards are paid upon completion of the stage(s) they are tied to.</div>
                            </li>
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body">The company reserves the right to withhold benefits of a member who acts or have conducted business contrary to company rules.</div>
                            </li>
                        </ul>
                    </div> <!-- end of text-container -->
                </div>
            </div> <!-- end of row -->
        </div> <!-- end of container -->
        <!-- end of terms content -->
    </section>

@stop