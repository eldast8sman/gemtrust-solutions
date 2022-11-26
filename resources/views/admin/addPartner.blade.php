
@section('pageTitle')
    Gemtrust Dashboard || Add Partner
@endsection

@extends('admin.layouts.default')

@section('content')

            <!-- Add Partner -->

            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="bg-light rounded h-100 p-4">
                            <h3 class="mb-4">Add Partner</h3>
                                        
                            <div class="row g-4">
                                <div class="col-sm-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="partnerName"
                                            placeholder="Partner">
                                        <label for='partner'>Partner</label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <select class="form-select" id="bank" >
                                        </select>
                                        <label for="bank">Bank</label>
                                    </div>
                                </div>

                                <div class="col-sm-6 mb-3">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="account_name"
                                            placeholder="Account Name">
                                        <label for='Account Name'>Account Name</label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="account_number"
                                            placeholder="Account Number">
                                        <label for='Account Number'>Account Number</label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-floating mb-3">
                                <textarea class="form-control" placeholder="Leave a description here" id="description" 
                                    style="height: 150px;"></textarea>
                                <label for="description">Description</label>
                            </div>
                            
                            <button type="button" class="btn btn-primary py-3 w-100 mb-4" id="btnFunc" onclick="addPartner()">Add Partner</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- End of Add Partner -->

@endsection