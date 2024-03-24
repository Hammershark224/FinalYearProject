@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'View'])
    <div id="alert">
        @include('components.alert')
    </div>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form role="form" enctype="multipart/form-data">
                        @csrf
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-center">
                                <p class="mb-0">Dish</p>
                                <button type="submit" onclick="{{ route('dish.manage') }}" class="btn btn-primary btn-sm ms-auto">Back</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                            <p class="text-uppercase text-sm">Dish Info</p>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Dish Name</label>
                                        <input class="form-control" type="text" name="dish_name" value="{{ $dataDish->dish_name }}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Dish Description</label>
                                        <textarea class="form-control" name="dish_description" rows="3">{{ $dataDish->dish_description }}</textarea>
                                    </div>
                                </div>
                            </div>
                            
                            <input class="form-control" type="number" name="dish_cost" id="dish_cost" value="{{ $dataDish->dish_cost }}">
                        </div>
                        
                    </form>
                </div>
            </div> 
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection
