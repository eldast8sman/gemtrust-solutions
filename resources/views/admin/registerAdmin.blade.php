
@section('pageTitle')
    Gemtrust Dashboard || Register Administrators
@endsection

@extends('admin.layouts.default')

@section('content')

            <!-- Table Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="bg-light rounded h-100 p-4">
                            <h3 class="mb-4">Register Administrator</h3>

                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="admin_fullname"
                                    placeholder="name@example.com">
                                <label for="admin_fullname">Full Name</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="admin_emailAddress"
                                    placeholder="name@example.com">
                                <label for="admin_emailAddress">Email address</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="admin_Password"
                                    placeholder="Password">
                                <label for="admin_Password">Password</label>
                            </div>
                            
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="admin_cPassword"
                                    placeholder="Password">
                                <label for="admin_cPassword">Confirm Password</label>
                            </div>
                            
                            <button type="button" class="btn btn-primary py-3 w-100 mb-4" onclick="registerAdmin()">Register Admin</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- End of Table Start -->

@endsection