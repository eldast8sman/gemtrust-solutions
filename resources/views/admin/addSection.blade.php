
@section('pageTitle')
    Gemtrust Dashboard || Add Section
@endsection

@extends('admin.layouts.default')

@section('content')

            <!-- Add Section -->

            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="bg-light rounded h-100 p-4">
                            <h3 class="mb-4">Add Section</h3>

                            <div class="col-sm-12 mb-4">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="sectionName"
                                        placeholder="Section Name">
                                    <label for='sectionName'>Section Name</label>
                                </div>
                            </div>

                            <div class="col-sm-12 mb-4">
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Leave a description here" id="description" 
                                        style="height: 150px;"></textarea>
                                    <label for="description">Description</label>
                                </div>
                            </div>
                            
                            <button type="button" class="btn btn-primary py-3 w-100 mb-4" id="btnFunc" onclick="addSection()">Add Section</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- End of Add Section -->

@endsection