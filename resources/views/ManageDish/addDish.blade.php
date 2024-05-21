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
                                        <!-- Initially, show one dropdown and one input field for weight -->
                                    </div>
                                    <div class="form-group">
                                        <!-- Buttons to add or remove ingredients -->
                                        <button type="button" class="btn btn-primary" id="addButton">+</button>
                                        <button type="button" class="btn btn-danger" id="removeButton"
                                            style="display: none;">-</button>
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
                                            <select class="form-control mt-2 ingredient" name="ingredients[]" id="int">
                                                <option value="0" data-price='0.00' data-ingredient-weight='1'>Select Ingredient</option>
                                                @foreach ($ingredientList as $ingredientItem)
                                                <option value="{{ $ingredientItem->ingredient_ID }}" data-price="{{ $ingredientItem->lowest_price }}" data-ingredient-weight="{{ $ingredientItem->ingredient_weight }}">
                                                    <span style="color: blue;">{{ $ingredientItem->ingredient_name }}</span>
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <input class="form-control mt-2 weight" name="recipe_weight[]" placeholder="Weight(kg) / (ml)" value="0" onfocus="if(this.value==0)this.value='';" onblur="if(this.value=='')this.value=0;">
                                        </div>
                                    </div>
                                    <hr class="horizontal dark">
                                `;
                                dropdownLists.appendChild(newDropdown);
                                calculateCost();
                                showRemoveButton();
                            });

                            const calculateCost = async () => {
                                const dropdownLists = document.getElementById('dropdownLists');
                                const ingredientDropdowns = dropdownLists.getElementsByClassName('ingredient-dropdown');

                                let totalCost = 0;
                                for (let dropdown of ingredientDropdowns) {
                                    const selectedIngredient = dropdown.querySelector('.ingredient');
                                    const selectedOption = selectedIngredient.options[selectedIngredient.selectedIndex];
                                    const price = parseFloat(selectedOption.getAttribute('data-price'));
                                    const ingredientWeight = parseFloat(selectedOption.getAttribute('data-ingredient-weight'));
                                    const weightInput = dropdown.querySelector('.weight');
                                    const weight = parseFloat(weightInput.value);

                                    console.log('Price:', price);
                                    console.log('Ingredient Weight:', ingredientWeight);
                                    console.log('Weight:', weight);

                                    // Check if price, ingredient weight, or weight is NaN
                                    if (isNaN(price) || isNaN(ingredientWeight) || isNaN(weight)) {
                                        console.error('Invalid price, ingredient weight, or weight:', price, ingredientWeight, weight);
                                        continue; // Skip this iteration if any of these values are NaN
                                    }

                                    // Calculate cost for this ingredient
                                    totalCost += (price / ingredientWeight) * weight;
                                }

                                totalCost = totalCost.toFixed(2);
                                document.getElementById('dish_cost').value = totalCost;
                            }

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
