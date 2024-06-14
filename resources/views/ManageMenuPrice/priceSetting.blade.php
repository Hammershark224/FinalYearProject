@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Calculate Menu Price'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-8 col-md-10 col-sm-12 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Calculate Menu Price</h5>
                    </div>
                    <div class="card-body">
                        @if(session('menu_price'))
                            <div class="alert alert-success">
                                The menu price for {{ session('dish') }} is {{ session('menu_price') }}
                            </div>
                        @endif
                        <form action="{{ route('price.store') }}" method="POST" id="calculate-price-form">
                            @csrf
                            <div class="form-group">
                                <label for="dish">Select a Dish:</label>
                                <select class="form-control mt-2" name="dish" id="dish">
                                    <option value="" data-price="0.00">Select Dish</option>
                                    @foreach($dishes as $dish)
                                        <option value="{{ $dish->dish_ID }}" data-price="{{ $dish->dish_cost }}">{{ $dish->dish_name }}</option>
                                    @endforeach
                                </select>
                                <input id="dish_ID" class="form-control" type="hidden" name="dish_ID">
                            </div>

                            @foreach ($costSetting as $cost)
                                <div class="form-group form-check col-auto">
                                    <input type="checkbox" class="form-check-input cost-checkbox" id="{{ $cost->Cost_ID }}_cost" name="value[{{ $cost->Cost_ID }}]" value="{{ $cost->value }}">
                                    <label class="form-check-label" for="{{ $cost->id }}_cost">Include {{ $cost->cost_type }}&nbsp;&nbsp;&nbsp;<span style="color: blue;">{{ $cost->value }} %</span></label>
                                    <input type="hidden" class="form-control mt-2 cost-input" id="priceDetail_{{ $cost->cost_type }}" name="priceDetail[{{ $cost->cost_type }}]" step="0.01" min="0" value="0">                         
                                </div>
                            @endforeach
                            
                            <hr class="horizontal dark">
                            <p class="text-uppercase text-sm">Menu Price</p>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input class="form-control" type="number" name="menu_price" id="menu_price" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Set as Menu Price</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @include('layouts.footers.auth.footer')
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const dishSelect = document.getElementById('dish');
            const dishIDInput = document.getElementById('dish_ID');
            const menuPriceInput = document.getElementById('menu_price');
            const costCheckboxes = document.querySelectorAll('.cost-checkbox');
            const costInputs = document.querySelectorAll('.cost-input');
    
            function calculateMenuPrice() {
                let selectedDish = dishSelect.options[dishSelect.selectedIndex];
                let basePrice = parseFloat(selectedDish.getAttribute('data-price'));
    
                if (selectedDish.value) { // Only calculate if a dish is selected
                    let totalPercentage = 0;
    
                    costCheckboxes.forEach((checkbox, index) => {
                        let costInput = costInputs[index];
                        let costValue = parseFloat(checkbox.value);
                        if (checkbox.checked) {
                            totalPercentage += costValue;
                            costInput.value = (basePrice * costValue / 100).toFixed(2);
                        } else {
                            costInput.value = 0;
                        }
                    });
    
                    let menuPrice = basePrice * (1 + totalPercentage / 100);
                    menuPriceInput.value = menuPrice.toFixed(2);
    
                    // Set the dish ID input value
                    dishIDInput.value = selectedDish.value;
                } else {
                    menuPriceInput.value = '';
                    dishIDInput.value = '';
    
                    // Reset cost inputs to 0
                    costInputs.forEach(input => input.value = 0);
                }
            }
    
            // Initial calculation if there's a selected dish
            if (dishSelect.value) {
                calculateMenuPrice();
            }
    
            dishSelect.addEventListener('change', function () {
                calculateMenuPrice();
            });
    
            costCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function () {
                    calculateMenuPrice();
                });
            });
        });
    </script>
    
@endsection
