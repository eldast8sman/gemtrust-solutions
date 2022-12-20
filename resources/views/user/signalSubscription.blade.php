@section('pageTitle')
    Gemtrust Dashboard || Signal Subscription
@endsection

@extends('user.layouts.default')

@section('content')


        <div class="container-fluid pt-4 px-4">
            <div class="row g-4">
                <div class="col-sm-4 col-xl-4">
                    <div class="bg-light rounded h-100 p-4">
                        <div class="mb-4">
                            <h4 class="text-primary">START PACKAGE</h4>
                            <h3 class="value">$20 monthly</h3>
                        </div>
                        
                        <ul class="list-unstyled li-space-lg">
                            <li class="media mb-2">
                                <div class="media-body"><i class="text-success fas fa-check"></i> Financial Literacy package</div>
                            </li>
                            <li class="media mb-2">
                                <div class="media-body"><i class="text-danger fas fa-times"></i> Forex Academy</div>
                            </li>
                             <li class="media mb-2">
                                <div class="media-body"><i class="text-danger fas fa-times"></i> 3 Online Finance Mentorship conference</div>
                            </li>
                            <li class="media mb-2">
                                <div class="media-body"><i class="text-danger fas fa-times"></i> 2 Live Conferences (Domestic)</div>
                            </li>
                            <li class="media mb-2">
                                <div class="media-body"><i class="text-danger fas fa-times"></i> VIP treat for all Live conferences (Domestic)</div>
                            </li>
                            <li class="media mb-2">
                                <div class="media-body"><i class="text-danger fas fa-times"></i> 1 Foreign Trip (All expense paid)</div>
                            </li>
                            <li class="media mb-2">
                                <div class="media-body"><i class="text-danger fas fa-times"></i> VIP treat on Foreign Trips</div>
                            </li>
                        </ul>

                        <button type="button" onclick="subscribeSignal('20')" class="btn btn-primary mt-4">Subscribe</button>

                    </div>
                </div>
                
                <div class="col-sm-4 col-xl-4">
                    <div class="bg-light rounded h-100 p-4">
                        <div class="mb-4">
                            <h4 class="text-primary">BASIC PACKAGE</h4>
                            <h3 class="value">$50 monthly</h3>
                        </div>
                        
                        <ul class="list-unstyled li-space-lg">
                            <li class="media mb-2">
                                <div class="media-body"><i class="text-success fas fa-check"></i> Financial Literacy package</div>
                            </li>
                            <li class="media mb-2">
                                <div class="media-body"><i class="text-success fas fa-check"></i> Forex Academy</div>
                            </li>
                             <li class="media mb-2">
                                <div class="media-body"><i class="text-danger fas fa-times"></i> 3 Online Finance Mentorship conference</div>
                            </li>
                            <li class="media mb-2">
                                <div class="media-body"><i class="text-danger fas fa-times"></i> 2 Live Conferences (Domestic)</div>
                            </li>
                            <li class="media mb-2">
                                <div class="media-body"><i class="text-danger fas fa-times"></i> VIP treat for all Live conferences (Domestic)</div>
                            </li>
                            <li class="media mb-2">
                                <div class="media-body"><i class="text-danger fas fa-times"></i> 1 Foreign Trip (All expense paid)</div>
                            </li>
                            <li class="media mb-2">
                                <div class="media-body"><i class="text-danger fas fa-times"></i> VIP treat on Foreign Trips</div>
                            </li>
                        </ul>

                        <button type="button" onclick="subscribeSignal('50')" class="btn btn-primary mt-4">Subscribe</button>

                    </div>
                </div>
                
                <div class="col-sm-4 col-xl-4">
                    <div class="bg-light rounded h-100 p-4">
                        <div class="mb-4">
                            <h4 class="text-primary">SILVER PACKAGE</h4>
                            <h3 class="value">$100 monthly</h3>
                        </div>
                        
                        <ul class="list-unstyled li-space-lg">
                            <li class="media mb-2">
                                <div class="media-body"><i class="text-success fas fa-check"></i> Financial Literacy package</div>
                            </li>
                            <li class="media mb-2">
                                <div class="media-body"><i class="text-success fas fa-check"></i> Forex Academy</div>
                            </li>
                             <li class="media mb-2">
                                <div class="media-body"><i class="text-success fas fa-check"></i> 3 Online Finance Mentorship conference</div>
                            </li>
                            <li class="media mb-2">
                                <div class="media-body"><i class="text-danger fas fa-times"></i> 2 Live Conferences (Domestic)</div>
                            </li>
                            <li class="media mb-2">
                                <div class="media-body"><i class="text-danger fas fa-times"></i> VIP treat for all Live conferences (Domestic)</div>
                            </li>
                            <li class="media mb-2">
                                <div class="media-body"><i class="text-danger fas fa-times"></i> 1 Foreign Trip (All expense paid)</div>
                            </li>
                            <li class="media mb-2">
                                <div class="media-body"><i class="text-danger fas fa-times"></i> VIP treat on Foreign Trips</div>
                            </li>
                        </ul>

                        <button type="button" onclick="subscribeSignal('100')" class="btn btn-primary mt-4">Subscribe</button>

                    </div>
                </div>
                
                <div class="col-sm-4 col-xl-4">
                    <div class="bg-light rounded h-100 p-4">
                        <div class="mb-4">
                            <h4 class="text-primary">GOLD PACKAGE</h4>
                            <h3 class="value">$200 monthly</h3>
                        </div>
                        
                        <ul class="list-unstyled li-space-lg">
                            <li class="media mb-2">
                                <div class="media-body"><i class="text-success fas fa-check"></i> Financial Literacy package</div>
                            </li>
                            <li class="media mb-2">
                                <div class="media-body"><i class="text-success fas fa-check"></i> Forex Academy</div>
                            </li>
                             <li class="media mb-2">
                                <div class="media-body"><i class="text-success fas fa-check"></i> 3 Online Finance Mentorship conference</div>
                            </li>
                            <li class="media mb-2">
                                <div class="media-body"><i class="text-success fas fa-check"></i> 2 Live Conferences (Domestic)</div>
                            </li>
                            <li class="media mb-2">
                                <div class="media-body"><i class="text-danger fas fa-times"></i> VIP treat for all Live conferences (Domestic)</div>
                            </li>
                            <li class="media mb-2">
                                <div class="media-body"><i class="text-danger fas fa-times"></i> 1 Foreign Trip (All expense paid)</div>
                            </li>
                            <li class="media mb-2">
                                <div class="media-body"><i class="text-danger fas fa-times"></i> VIP treat on Foreign Trips</div>
                            </li>
                        </ul>

                        <button type="button" onclick="subscribeSignal('200')" class="btn btn-primary mt-4">Subscribe</button>

                    </div>
                </div>
                
                <div class="col-sm-4 col-xl-4">
                    <div class="bg-light rounded h-100 p-4">
                        <div class="mb-4">
                            <h4 class="text-primary">PLATINUM PACKAGE</h4>
                            <h3 class="value">$500 monthly</h3>
                        </div>
                        
                        <ul class="list-unstyled li-space-lg">
                            <li class="media mb-2">
                                <div class="media-body"><i class="text-success fas fa-check"></i> Financial Literacy package</div>
                            </li>
                            <li class="media mb-2">
                                <div class="media-body"><i class="text-success fas fa-check"></i> Forex Academy</div>
                            </li>
                             <li class="media mb-2">
                                <div class="media-body"><i class="text-success fas fa-check"></i> 3 Online Finance Mentorship conference</div>
                            </li>
                            <li class="media mb-2">
                                <div class="media-body"><i class="text-success fas fa-check"></i> 2 Live Conferences (Domestic)</div>
                            </li>
                            <li class="media mb-2">
                                <div class="media-body"><i class="text-success fas fa-check"></i> VIP treat for all Live conferences (Domestic)</div>
                            </li>
                            <li class="media mb-2">
                                <div class="media-body"><i class="text-danger fas fa-times"></i> 1 Foreign Trip (All expense paid)</div>
                            </li>
                            <li class="media mb-2">
                                <div class="media-body"><i class="text-danger fas fa-times"></i> VIP treat on Foreign Trips</div>
                            </li>
                        </ul>

                        <button type="button" onclick="subscribeSignal('500')" class="btn btn-primary mt-4">Subscribe</button>

                    </div>
                </div>
                
                <div class="col-sm-4 col-xl-4">
                    <div class="bg-light rounded h-100 p-4">
                        <div class="mb-4">
                            <h4 class="text-primary">EMERALD PACKAGE</h4>
                            <h3 class="value">$1000 monthly</h3>
                        </div>
                        
                        <ul class="list-unstyled li-space-lg">
                            <li class="media mb-2">
                                <div class="media-body"><i class="text-success fas fa-check"></i> Financial Literacy package</div>
                            </li>
                            <li class="media mb-2">
                                <div class="media-body"><i class="text-success fas fa-check"></i> Forex Academy</div>
                            </li>
                             <li class="media mb-2">
                                <div class="media-body"><i class="text-success fas fa-check"></i> 3 Online Finance Mentorship conference</div>
                            </li>
                            <li class="media mb-2">
                                <div class="media-body"><i class="text-success fas fa-check"></i> 2 Live Conferences (Domestic)</div>
                            </li>
                            <li class="media mb-2">
                                <div class="media-body"><i class="text-success fas fa-check"></i> VIP treat for all Live conferences (Domestic)</div>
                            </li>
                            <li class="media mb-2">
                                <div class="media-body"><i class="text-success fas fa-check"></i> 1 Foreign Trip (All expense paid)</div>
                            </li>
                            <li class="media mb-2">
                                <div class="media-body"><i class="text-danger fas fa-times"></i> VIP treat on Foreign Trips</div>
                            </li>
                        </ul>

                        <button type="button" onclick="subscribeSignal('1000')" class="btn btn-primary mt-4">Subscribe</button>

                    </div>
                </div>
                
                <div class="col-sm-4 col-xl-4">
                    <div class="bg-light rounded h-100 p-4">
                        <div class="mb-4">
                            <h4 class="text-primary">DIAMOND PACKAGE</h4>
                            <h3 class="value">$5000 monthly</h3>
                        </div>
                        
                        <ul class="list-unstyled li-space-lg">
                            <li class="media mb-2">
                                <div class="media-body"><i class="text-success fas fa-check"></i> Financial Literacy package</div>
                            </li>
                            <li class="media mb-2">
                                <div class="media-body"><i class="text-success fas fa-check"></i> Forex Academy</div>
                            </li>
                             <li class="media mb-2">
                                <div class="media-body"><i class="text-success fas fa-check"></i> 3 Online Finance Mentorship conference</div>
                            </li>
                            <li class="media mb-2">
                                <div class="media-body"><i class="text-success fas fa-check"></i> 2 Live Conferences (Domestic)</div>
                            </li>
                            <li class="media mb-2">
                                <div class="media-body"><i class="text-success fas fa-check"></i> VIP treat for all Live conferences (Domestic)</div>
                            </li>
                            <li class="media mb-2">
                                <div class="media-body"><i class="text-success fas fa-check"></i> 1 Foreign Trip (All expense paid)</div>
                            </li>
                            <li class="media mb-2">
                                <div class="media-body"><i class="text-success fas fa-check"></i> VIP treat on Foreign Trips</div>
                            </li>
                        </ul>

                        <button type="button" onclick="subscribeSignal('5000')" class="btn btn-primary mt-4">Subscribe</button>

                    </div>
                </div>
                
            </div>
        </div>


@endsection