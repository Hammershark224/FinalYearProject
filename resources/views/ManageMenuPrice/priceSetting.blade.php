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
                                    <option value="" data-price='0.00'>Select Dish</option>
                                    @foreach($dishes as $dish)
                                        <option value="{{ $dish->dish_ID }}" data-price="{{ $dish->dish_cost }}">{{ $dish->dish_name }}</option>
                                    @endforeach
                                </select>
                                <input id="dish_ID" class="form-control" type="hidden" name="dish_ID">
                            </div>
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="overhead_cost" name="overhead_cost" value="{{ $costSetting->overhead_cost }}">
                                <label class="form-check-label" for="include_overhead">Include Overhead Cost (%)</label>
                            </div>
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="labor_cost" name="labor_cost" value="{{ $costSetting->labor_cost }}">
                                <label class="form-check-label" for="include_labor">Include Labor Cost (%)</label>
                            </div>
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="margin_cost" name="margin_cost" value="{{ $costSetting->margin_cost }}">
                                <label class="form-check-label" for="include_margin">Include Profit Margin (%)</label>
                            </div>
                            <hr class="horizontal dark">
                            <p class="text-uppercase text-sm">Menu Price</p>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input class="form-control" type="number" name="menu_price" id="menu_price" readonly>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Set as Menu Price</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            function calculatePrice() {
                var dishCost = parseFloat($('#dish').find(':selected').data('price'));
                var menuPrice = dishCost;

                if ($('#overhead_cost').is(':checked')) {
                    var overheadCost = parseFloat($('#overhead_cost').val());
                    menuPrice += (dishCost * overheadCost / 100);
                }
                if ($('#labor_cost').is(':checked')) {
                    var laborCost = parseFloat($('#labor_cost').val());
                    menuPrice += (dishCost * laborCost / 100);
                }
                if ($('#margin_cost').is(':checked')) {
                    var marginCost = parseFloat($('#margin_cost').val());
                    menuPrice += (dishCost * marginCost / 100);
                }

                $('#menu_price').val(menuPrice.toFixed(2));
            }

            $('#dish').change(function() {
                var selectedDishID = $(this).val();
                $('#dish_ID').val(selectedDishID);
                calculatePrice();
            });

            $('#overhead_cost, #labor_cost, #margin_cost').change(function() {
                calculatePrice();
            });
        });
    </script>
@endsection
