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
                                        <label for="photo" class="form-control-label">Dish Photo</label>
                                        <input type="file" name="dish_photo" class="form-control" accept="image/*">
                                    </div>
                                </div>
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
                            <p class="text-uppercase text-sm">Ingredients</p>
                            <div class="row">
                                <div class="col-md-12">       
                                    <div class="form-group" id="dropdownLists">
                                    </div>
                                    <div class="form-group">
                                        <button type="button" class="btn btn-primary" id="addButton">Add Ingredient</button>
                                    </div>
                                </div>
                            </div>
                            <input class="form-control" type="number" name="dish_cost" id="dish_cost" readonly>
                            <input class="form-control" type="hidden" name="dish_status" id="dish_status" value="1">
                        </div>
                        <script>
                            document.getElementById('addButton').addEventListener('click', function() {
                                var dropdownLists = document.getElementById('dropdownLists');
                                var newDropdown = document.createElement('div');
                                newDropdown.classList.add('form-group');
                                newDropdown.innerHTML = `
                                <select class="form-control mt-2 ingredient" name="ingredients[]">
                                    <option value="" data-price='0.00'>Select Ingredient</option>
                                    @foreach($ingredients as $ingredient)
                                        <option value="{{ $ingredient->ingredient_ID }}" data-price="{{ $ingredient->ingredient_price }}">{{ $ingredient->ingredient_name }}</option>
                                    @endforeach
                                </select>
                                `;
                                dropdownLists.appendChild(newDropdown);
                                calculateCost();
                            });

                            function calculateCost() {
                                var ingredientSelects = document.querySelectorAll('.ingredient');
                                var totalCost = 0;
                                ingredientSelects.forEach(function(select) {
                                    var selectedOption = select.options[select.selectedIndex];
                                    var price = parseFloat(selectedOption.getAttribute('data-price'));

                                    totalCost += price;
                                });
                                document.getElementById('dish_cost').value = totalCost;
                            }

                            document.addEventListener('change', function(event) {
                                if (event.target.classList.contains('ingredient')) {
                                    calculateCost();
                                }
                            });
                        </script>
                    </form>
                </div>
            </div> 
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection
