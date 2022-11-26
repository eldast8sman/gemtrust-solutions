
@section('pageTitle')
    Gemtrust Dashboard || Add Packages
@endsection

@extends('admin.layouts.default')

@section('content')

            <!-- Add Package -->

            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="bg-light rounded h-100 p-4">
                            <h3 class="mb-4">Add Package</h3>
                                        
                            <div class="row g-4">
                                <div class="col-sm-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="packageName"
                                            placeholder="Package Name">
                                        <label for="packageName">Package Name</label>
                                    </div>
                            
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="level"
                                            placeholder="level">
                                        <label for="level">Level</label>
                                    </div>
                                </div>

                                <div class="col-sm-6 mb-3">
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="amount"
                                            placeholder="Amount">
                                        <label for="amount">Amount</label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="discount"
                                            placeholder="discount %">
                                        <label for="discount">Discount</label>
                                    </div>
                                </div>
                            </div>
                                        
                            <div class="row g-4">
                                <div class="col-sm-6">
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="Upline1"
                                            placeholder="Upline 1">
                                        <label for="Upline1">Upline1</label>
                                    </div>
                                    
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="Upline3"
                                            placeholder="Upline 3">
                                        <label for="Upline3">Upline3</label>
                                    </div>
                                </div>

                                <div class="col-sm-6 mb-3">
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="Upline2"
                                            placeholder="Upline 2">
                                        <label for="Upline2">Upline2</label>
                                    </div>
                                    
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="Upline4"
                                            placeholder="Upline 4">
                                        <label for="Upline4">Upline4</label>
                                    </div>
                                </div>

                            </div>
                            
                            <div class="form-floating mb-3">
                                <textarea class="form-control" placeholder="Leave a description here"
                                    id="description" style="height: 150px;"></textarea>
                                <label for="description">Description</label>
                            </div>

                            <button type="button" class="btn btn-primary py-3 w-100 mb-4" id="btnFunc" onclick="addPackage()">Add Package</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- End of Add Package -->

@endsection