
@section('pageTitle')
    Gemtrust Dashboard || Add Signal Provider
@endsection

@extends('admin.layouts.default')

@section('content')

            <!-- Add Partner -->

            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="bg-light rounded h-100 p-4">
                            <h3 class="mb-4">Add Signal Provider</h3>

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="signal_fullname"
                                    placeholder="Full Name">
                                <label for='fullname'>FullName</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="signal_email"
                                    placeholder="Email Address">
                                <label for="signal_email">Email Address</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" id="signal_phoneNumber"
                                    placeholder="Phone Number">
                                <label for="signal_phoneNumber">Phone Number</label>
                            </div>

                            <button type="button" class="btn btn-primary py-3 w-100 mb-4" id="btnFunc" onclick="addSignalProvider()">Add Signal Provider</button>

                        </div>
                    </div>
                </div>
            </div>
            
            <!-- End of Add Partner -->

@endsection