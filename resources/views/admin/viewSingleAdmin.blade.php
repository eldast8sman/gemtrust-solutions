
@section('pageTitle')
    Gemtrust Dashboard || View Single Admin
@endsection

@extends('admin.layouts.default')

@section('content')

            <!-- View Single Section -->
            
            <input type="hidden" id="admin_id" value="{{ $admin_id }}" disabled>

            <div class="container-fluid pt-4 px-4">
                <div class="row g-4" id="singleAdminHtml">
                </div>
            </div>
            
            <!-- Edit Section Modal -->
            <div class="modal fade" id="adminEditModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Administrator</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-4">

                                <div class="col-sm-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="e_currentPassword"
                                            placeholder="Full Name">
                                        <label for=''>Current Password</label>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="e_newPassword"
                                            placeholder="New Password">
                                        <label for=''>New Password</label>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="e_confirmPassword"
                                            placeholder="Confirm New Password">
                                        <label for=''>Confirm Password</label>
                                    </div>
                                </div>

                            </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="updateAdminPassword()">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Edit Section Modal -->


            <!-- End of View Single Section -->

@endsection