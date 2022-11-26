
@section('pageTitle')
    Gemtrust Dashboard || View Single Partner
@endsection

@extends('admin.layouts.default')

@section('content')

            <!-- View Single Partner -->
            
            <input type="hidden" id="partner_id" value="{{ $partner_id }}" disabled>

            <div class="container-fluid pt-4 px-4">
                <div class="row g-4" id="singlePartnerHtml">
                </div>
            </div>
            
            <!-- Edit Package Modal -->
            <div class="modal fade" id="partnerEditModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Partner</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-4">
                                <div class="col-sm-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="e_partner"
                                            placeholder="Partner">
                                        <label for='partner'>Partner</label>
                                    </div>
                                    
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="e_account_number"
                                            placeholder="Account Number">
                                        <label for='Account Number'>Account Number</label>
                                    </div>
                                </div>

                                <div class="col-sm-6 mb-3">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="e_account_name"
                                            placeholder="Account Name">
                                        <label for='Account Name'>Account Name</label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="bank"
                                            placeholder="Bank">
                                        <label for='Bank'>Bank</label>
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
                            <button type="button" class="btn btn-primary" onclick="updatePartner()">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Edit Package Modal -->


            <!-- End of View Single Partner -->

@endsection