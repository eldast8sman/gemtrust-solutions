
@section('pageTitle')
    Gemtrust Dashboard || View Signal Provider

@endsection

@extends('admin.layouts.default')

@section('content')

            <!-- View Signal Provider -->
            
            <input type="hidden" id="signalProvider_id" value="{{ $signalProvider_id }}" disabled>

            <div class="container-fluid pt-4 px-4">
                <div class="row g-4" id="SignalProviderHtml">
                </div>
            </div>
            
            <!-- Edit Signal Provider Modal -->
            <div class="modal fade" id="SignalProviderEditModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Signal Provider</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="e_name"
                                    placeholder="Full Name">
                                <label for='e_name'>Fullname</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="e_email"
                                    placeholder="Email Address">
                                <label for='e_email'>Email Address</label>
                            </div>
                            
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="e_phone"
                                    placeholder="Phone Number">
                                <label for='e_phone'>Phone Number</label>
                            </div>                        
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="updateSignalProvider()">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Edit Package Modal -->


            <!-- End of View Signal Provider -->

@endsection