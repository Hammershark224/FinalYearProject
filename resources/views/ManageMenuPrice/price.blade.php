@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Menu Pricing'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-8 col-md-10 col-sm-12 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Calculate Menu Price</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('calculate.price') }}">
                            @csrf
                            <div class="form-group">
                                <label for="ingredient_cost">Cost of Ingredients ($)</label>
                                <input type="number" step="0.01" class="form-control" id="ingredient_cost" name="ingredient_cost" required>
                            </div>
                            <div class="form-group">
                                <label for="labor_cost_per_hour">Labor Cost per Hour ($)</label>
                                <input type="number" step="0.01" class="form-control" id="labor_cost_per_hour" name="labor_cost_per_hour" required>
                            </div>
                            <div class="form-group">
                                <label for="labor_time">Time to Prepare (minutes)</label>
                                <input type="number" class="form-control" id="labor_time" name="labor_time" required>
                            </div>
                            <div class="form-group">
                                <label for="overhead_cost">Overhead Cost per Dish ($)</label>
                                <input type="number" step="0.01" class="form-control" id="overhead_cost" name="overhead_cost" required>
                            </div>
                            <div class="form-group">
                                <label for="profit_margin">Desired Profit Margin (%)</label>
                                <input type="number" step="0.01" class="form-control" id="profit_margin" name="profit_margin" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Calculate</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @if(session('menu_price'))
        <div class="row mt-4">
            <div class="col-lg-8 col-md-10 col-sm-12 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Calculated Menu Price</h5>
                        <p>The calculated menu price is: ${{ session('menu_price') }}</p>
                    </div>
                </div>
            </div>
        </div>
        @endif
        
        @include('layouts.footers.auth.footer')
    </div>
@endsection
