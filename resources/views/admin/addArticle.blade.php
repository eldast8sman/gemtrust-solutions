
@section('pageTitle')
    Gemtrust Dashboard || Add Article
@endsection

@extends('admin.layouts.default')

@section('content')

                <!-- Add Article -->

                <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="bg-light rounded h-100 p-4">
                            <h3 class="mb-4">Add Article</h3>

                            <form id="addArticleForm" method="POST" enctype="multipart/form-data">    
                                <div class="row g-4">
                                    <div class="col-sm-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" name="title" id="title"
                                                placeholder="Article Title">
                                            <label for="title">Title</label>
                                        </div>
                                
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" name="author" id="author" 
                                                placeholder="Article Author">
                                            <label for="author">Author</label>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 mb-3">
                                        <div class="form-floating mb-3">
                                            <input type="file" class="form-control" name="image" id="image" 
                                                placeholder="Image">
                                            <label for="image">Image</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <select class="form-select" name="section_id" id="section_id" >
                                            </select>
                                            <label for="discount">Section</label>
                                        </div>
                                    </div>
                                </div>
                                            
                                <div class="row g-4">
                                    <div class="col-sm-6">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" name="minimum_level" id="minimum_level"
                                                placeholder="Minimum Level">
                                            <label for="minimum_level">Minimum Level</label>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 mb-3">
                                        <div class="form-floating mb-3">
                                            <input type="date" class="form-control" name="release_date" id="release_date" 
                                                placeholder="Upline 2">
                                            <label for="release_date">Release Date</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" placeholder="Article Content" name="content" 
                                        id="content" style="height: 150px;"></textarea>
                                    <label for="content">Content</label>
                                </div>

                                <button type="button" class="btn btn-primary py-3 w-100 mb-4" id="btnFunc" onclick="addArticle()">Add Article</button>

                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- End of Add Package -->

@endsection