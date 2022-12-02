
@section('pageTitle')
    Gemtrust Dashboard || View Single Section
@endsection

@extends('admin.layouts.default')

@section('content')

            <!-- View Single Section -->
            
            <input type="hidden" id="section_id" value="{{ $section_id }}" disabled>

            <div class="container-fluid pt-4 px-4">
                <div class="row g-4" id="singleSectionHtml">
                </div>
            </div>
            
            <!-- Edit Section Modal -->
            <div class="modal fade" id="sectionEditModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Section</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-4">
                                <div class="col-sm-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="e_sectionName"
                                            placeholder="Section Name">
                                        <label for='sectionName'>Section Name</label>
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
                            <button type="button" class="btn btn-primary" onclick="updateSection()">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Edit Section Modal -->


            <!-- End of View Single Section -->

@endsection