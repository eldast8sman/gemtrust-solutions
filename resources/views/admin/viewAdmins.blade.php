
@section('pageTitle')
    Gemtrust Dashboard || Home
@endsection

@extends('admin.layouts.default')

@section('content')

            <!-- Table Start -->
            <div class="container-fluid pt-4 px-4" onload="fetchAdmins()">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Administrators Table</h6>
                            <table class="table" id="resultTable">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Date Created</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- End of Table Start -->

@endsection