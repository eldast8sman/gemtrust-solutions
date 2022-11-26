
@section('pageTitle')
    Gemtrust Dashboard || View Package
@endsection

@extends('admin.layouts.default')

@section('content')

            <!-- View Single Package -->

            <input type="hidden" id="package_id" value="{{ $package_id }}" disabled>

            <div class="container-fluid pt-4 px-4">
                <div class="row g-4" id="singlePackageHtml">
                </div>
            </div>
            
            <!-- Edit Package Modal -->
            <div class="modal fade" id="packageEditModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Package</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-4">
                                <div class="col-sm-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="e_packageName"
                                            placeholder="Package Name">
                                        <label for="packageName">Package Name</label>
                                    </div>
                            
                                    <!-- <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="e_level"
                                            placeholder="level">
                                        <label for="level">Level</label>
                                    </div> -->
                                </div>

                                <div class="col-sm-6 mb-3">
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="e_amount"
                                            placeholder="Amount">
                                        <label for="amount">Amount</label>
                                    </div>

                                    <!-- <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="e_discount"
                                            placeholder="discount %">
                                        <label for="discount">Discount</label>
                                    </div> -->
                                </div>
                            </div>
                                        
                            <div class="row g-4">
                                <div class="col-sm-6">
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="e_upline1"
                                            placeholder="Upline 1">
                                        <label for="Upline1">Upline1</label>
                                    </div>
                                    
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="e_upline3"
                                            placeholder="Upline 3">
                                        <label for="Upline3">Upline3</label>
                                    </div>
                                </div>

                                <div class="col-sm-6 mb-3">
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="e_upline2"
                                            placeholder="Upline 2">
                                        <label for="Upline2">Upline2</label>
                                    </div>
                                    
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="e_upline4"
                                            placeholder="Upline 4">
                                        <label for="Upline4">Upline4</label>
                                    </div>
                                </div>

                            </div>
                            
                            <div class="form-floating mb-3">
                                <textarea class="form-control" placeholder="Leave a description here" id="e_description" 
                                    style="height: 150px;"></textarea>
                                <label for="description">Description</label>
                            </div>
                        
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="updatePackage()">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Edit Package Modal -->

            <!-- End of View Single Package -->

@endsection