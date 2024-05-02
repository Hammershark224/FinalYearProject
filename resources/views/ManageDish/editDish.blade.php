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
                                <p class="mb-0">Edit Dish Info</p>
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
                                        <!-- Initially, show one dropdown and one input field for weight -->
                                    </div>
                                    <div class="form-group">
                                        <!-- Buttons to add or remove ingredients -->
                                        <button type="button" class="btn btn-primary" id="addButton">+</button>
                                        <button type="button" class="btn btn-danger" id="removeButton" style="display: none;">-</button>
                                    </div>
                                </div>
                            </div>
                            <input class="form-control" type="number" name="dish_cost" id="dish_cost" readonly>
                            <input class="form-control" type="hidden" name="dish_status" id="dish_status" value="off">
                        </div>
                        <script>
                            document.getElementById('addButton').addEventListener('click', function() {
                                var dropdownLists = document.getElementById('dropdownLists');
                                var newDropdown = document.createElement('div');
                                newDropdown.classList.add('form-group', 'ingredient-dropdown');
                                newDropdown.innerHTML = `
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <select class="form-control mt-2 ingredient" name="ingredients[]">
                                                <option value="" data-price='0.00'>Select Ingredient</option>
                                                @foreach($suppliers as $supplier)
                                                <option value="{{ $supplier->ingredient->ingredient_ID }}" data-price="{{ $supplier->ingredient_price }}">
                                                    <span style="font-weight: bold;">{{ $supplier->company->company_name }}</span> -
                                                    <span style="color: blue;">{{ $supplier->ingredient->ingredient_name }}</span> -
                                                    <span style="font-style: italic;">RM {{$supplier->ingredient_price}}</span>
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <input class="form-control mt-2 weight" type="number" step="0.01" min="0.01" max="1" name="recipe_weight[]" placeholder="Weight(kg) / (ml)">
                                        </div>
                                    </div>
                                    <hr class="horizontal dark">
                                `;
                                dropdownLists.appendChild(newDropdown);
                                calculateCost();
                                showRemoveButton();
                            });

                            document.getElementById('removeButton').addEventListener('click', function() {
                                var dropdownLists = document.getElementById('dropdownLists');
                                var dropdowns = dropdownLists.getElementsByClassName('ingredient-dropdown');
                                if (dropdowns.length > 1) {
                                    dropdowns[dropdowns.length - 1].remove();
                                    calculateCost();
                                    showRemoveButton();
                                }
                            });

                            function showRemoveButton() {
                                var dropdownLists = document.getElementById('dropdownLists');
                                var dropdowns = dropdownLists.getElementsByClassName('ingredient-dropdown');
                                if (dropdowns.length > 1) {
                                    document.getElementById('removeButton').style.display = 'inline-block';
                                } else {
                                    document.getElementById('removeButton').style.display = 'none';
                                }
                            }

                            function calculateCost() {
                                var ingredientSelects = document.querySelectorAll('.ingredient');
                                var totalCost = 0;
                                ingredientSelects.forEach(function(select, index) {
                                    var selectedOption = select.options[select.selectedIndex];
                                    var price = parseFloat(selectedOption.getAttribute('data-price'));
                                    var weight = parseFloat(document.querySelectorAll('.weight')[index].value);
                                    totalCost += price * weight;
                                });
                                totalCost = totalCost.toFixed(2);
                                document.getElementById('dish_cost').value = totalCost;
                            }

                            document.addEventListener('change', function(event) {
                                if (event.target.classList.contains('ingredient') || event.target.classList.contains('weight')) {
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
