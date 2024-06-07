@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Create'])
    <div id="alert">
        @include('components.alert')
    </div>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form role="form" method="POST" action="{{ route('ingredient.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-center">
                                <p class="mb-0">Add New</p>
                                <button type="submit" class="btn btn-primary btn-sm ms-auto">Create New</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <p class="text-uppercase text-sm">Ingredient Info</p>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="example-file-input" class="form-control-label">Ingredient Photo</label>
                                        <input class="form-control" type="file" name="ingredient_photo" accept="image/*">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Ingredient Name</label>
                                        <input class="form-control" type="text" name="ingredient_name">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Ingredient Weight</label>
                                        <p class='text-danger'>(in "kg" according to size available in market)</p>
                                        <input class="form-control" type="number" step="0.01" min="0" name="ingredient_weight">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div> 
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection
