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
                    <form role="form" method="POST" action="{{ route('dish.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-center">
                                <p class="mb-0">Dish</p>
                                <button type="submit" class="btn btn-primary btn-sm ms-auto">Submit</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                            <p class="text-uppercase text-sm">Dish Info</p>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Dish Name</label>
                                        <input class="form-control" type="text" name="dish_name">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Dish Description</label>
                                        <textarea class="form-control" name="dish_description" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                            <hr class="horizontal dark">
                            <p class="text-uppercase text-sm">Ingredient</p>
                            <div class="row">
                                <div class="col-md-12">       
                                    <div class="form-group" id="dropdownLists">
                                    </div>
                                    <div class="form-group">
                                        <button type="button" class="btn btn-primary" id="addButton">Add Dropdown</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            document.getElementById('addButton').addEventListener('click', function() {
                                var dropdownLists = document.getElementById('dropdownLists');
                                var newDropdown = document.createElement('div');
                                newDropdown.classList.add('form-group');
                                newDropdown.innerHTML = `
                                <select class="form-control mt-2">
                                    <option value="">Select Ingredient</option>
                                    @foreach($ingredients as $ingredient)
                                        <option value="{{ $ingredient->ingredient_ID }}">{{ $ingredient->ingredient_name }}</option>
                                    @endforeach
                                </select>
                                `;
                                dropdownLists.appendChild(newDropdown);
                            });
                        </script>
                        
                    </form>
                </div>
            </div> 
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection
