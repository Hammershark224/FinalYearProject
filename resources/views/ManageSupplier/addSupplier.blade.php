@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Add Supplier'])
    <div id="alert">
        @include('components.alert')
    </div>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form role="form" method="POST" action="{{ route('supplier.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-center">
                                <p class="mb-0">Add New Supplier</p>
                                <button type="submit" class="btn btn-primary btn-sm ms-auto">Submit</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <p class="text-uppercase text-sm">Supplier Info</p>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Supplier Name</label>
                                        <input class="form-control" type="text" name="company_name">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Supplier Address</label>
                                        <textarea class="form-control" name="company_address" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Supplier Photo</label>
                                        <input type="file" name="company_photo" class="form-control" accept="image/*">
                                    </div>
                                </div>
                            </div>
                            <hr class="horizontal dark">
                            <h3 class="text-uppercase text-sm">Ingredients</h3>
                            <p class=" text-sm">Excel file can be get from Ingredient List page</p>
                            <i id="question-mark" class="fas fa-info-circle" style="cursor: pointer; color: #007bff;" data-bs-toggle="modal" data-bs-target="#overheadDescription"></i>
                                <div class="modal fade" id="overheadDescription" tabindex="-1" role="dialog" aria-labelledby="descriptionModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="descriptionModalLabel">Example Excel Content</h5>
                                            </div>
                                            <div class="modal-body">
                                                <img src="{{ asset('img/excel.png') }}" alt="Excel Image" style="width: 470px; height: 400;">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <label for="example-text-input" class="form-control-label" style="color: red;">*Only Excel File is accepted*</label>
                            <input type="file" name="ingredients_list" class="form-control" accept=".xlsx">
                        </div>
                    </form>
                </div>
            </div> 
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection
