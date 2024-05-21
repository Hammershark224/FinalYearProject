@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Calculator'])
    <div id="alert">
        @include('components.alert')
    </div>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form id="calculationForm" role="form" enctype="multipart/form-data" method="POST" action="{{ route('menu.store') }}">
                        @csrf
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-center">
                                <p class="mb-0">Menu Price Calculator</p>
                            </div>
                        </div>
                        <div class="card-body">
                            <p class="text-uppercase text-sm">Input</p>
                            <div class="col-md-6">
                                <label for="dish">Select a Dish:</label>
                                <select class="form-control mt-2" name="dish" id="dish">
                                    <option value="" data-price='0.00'>Select Dish</option>
                                    @foreach($dishes as $dish)
                                        <option value="{{ $dish->dish_ID }}" data-price="{{ $dish->dish_cost }}">{{ $dish->dish_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <input id="dish_ID" class="form-control" type="hidden" name="dish_ID">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="dish_cost" class="col-sm-4 col-form-label text-right">Dish Cost (RM)</label>
                                    <div class="col-sm-8">
                                        <input id="dish_cost" class="form-control" type="number" name="dish_cost" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="target_margin" class="col-sm-4 col-form-label text-right">Target Margin (%)</label>
                                    <div class="col-sm-8">
                                        <input id="target_margin" class="form-control" type="number" name="target_margin">
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <div class="col-sm-12 text-center">
                                            <button type="button" class="btn btn-primary btn-sm" onclick="calculate()">Calculate</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="outputFields" style="display: none;">
                                <hr class="horizontal dark">
                                <p class="text-uppercase text-sm">Output</p>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="cash_margin" class="col-sm-4 col-form-label text-right">Cash Margin (RM)</label>
                                        <div class="col-sm-8">
                                            <input id="cash_margin" class="form-control" type="number" name="cash_margin" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="sell_price" class="col-sm-4 col-form-label text-right">Sell Price (RM)</label>
                                        <div class="col-sm-8">
                                            <input id="sell_price" class="form-control" type="number" name="sell_price" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <div class="col-sm-12 text-center">
                                                <button type="submit" class="btn btn-danger" onclick="">Set as menu price?</button>
                                            </div>
                                        </div>
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

    <script>
        function calculate() {
            var dishCost = parseFloat(document.getElementById('dish_cost').value);
            var targetMargin = parseFloat(document.getElementById('target_margin').value);

            // Calculate sell price and cash margin
            var cashMargin = dishCost * (targetMargin / 100);
            var sellPrice = dishCost + cashMargin;

            // Display the output fields and values
            document.getElementById('cash_margin').value = cashMargin.toFixed(2);
            document.getElementById('sell_price').value = sellPrice.toFixed(2);
            document.getElementById('outputFields').style.display = 'block';
        }

        // Script to update the dish cost when a dish is selected
        document.getElementById('dish').addEventListener('change', function() {
            var selectedDish = this.options[this.selectedIndex];
            var dishId = selectedDish.getAttribute('value');
            var dishCost = selectedDish.getAttribute('data-price');
            document.getElementById('dish_cost').value = dishCost;
            document.getElementById('dish_ID').value = dishId;
        });
    </script>
    
    
@endsection
