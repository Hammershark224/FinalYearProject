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
                                <p class="mb-0">View Dish Info</p>
                                <button type="button" onclick="window.location='{{ route('dish.manage') }}'" class="btn btn-primary btn-sm ms-auto">Back</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <p class="text-uppercase text-sm">Dish Info</p>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Dish Photo</label>
                                        <p><img src="{{ $photoUrl }}" style="width: 300px; height: 300px;" alt="Dish Photo"></p>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Dish Name</label>
                                        <input class="form-control" type="text" name="dish_name" value="{{ $menu->dish->dish_name }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Dish Description</label>
                                        <textarea class="form-control" name="dish_description" rows="3" readonly>{{ $dish->dish_description }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Dish Cost</label>
                                        <input class="form-control" type="number" name="dish_cost" id="dish_cost" value="{{ $dish->dish_cost }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <hr class="horizontal dark">
                            <p class="text-uppercase text-sm">Ingredients</p>
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ingredient</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Weight</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Cost (RM)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $totalCost = 0;
                                        @endphp
                                        @foreach ($recipes as $recipe)
                                            @php
                                                $ingredientCost = round(($recipe->ingredient->lowestPrice->ingredient_price / $recipe->ingredient->ingredient_weight) * $recipe->recipe_weight, 2);
                                                $totalCost += $ingredientCost;
                                            @endphp
                                            <tr>
                                                <td>
                                                    <div class="align-middle text-center text-sm">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h5 class="mb-0 text-sm">{{ $recipe->ingredient->ingredient_name }}</h5>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <h5 class="text-xs font-weight-bold mb-0">{{ $recipe->recipe_weight }}</h5>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <h5 class="text-xs font-weight-bold mb-0">{{ $ingredientCost }}</h5>
                                                </td>
                                            </tr>
                                        @endforeach
                                
                                        <tr>
                                            <td colspan="2" class="text-end text-sm">
                                                <h5 class="mb-0 text-sm">Total Dish Cost</h5>
                                            </td>
                                            <td class="text-center text-sm">
                                                <h5 class="text-xs font-weight-bold mb-0">RM {{ $dish->dish_cost }}</h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-center text-sm" style="font-weight: bold; font-size: 20px;">CALCULATING MENU PRICE</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="text-end text-sm"> <!-- Aligned to right -->
                                                <h5 class="mb-0 text-sm">Overhead Cost Percentage (%)</h5>
                                            </td>
                                            <td class="text-center text-sm">
                                                <h5 class="text-xs font-weight-bold mb-0">{{ $costSetting->overhead_cost }}%</h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="text-end text-sm"> <!-- Aligned to right -->
                                                <h5 class="mb-0 text-sm">Price with Overhead Cost (RM)</h5>
                                            </td>
                                            <td class="text-center text-sm">
                                                <h5 class="text-xs font-weight-bold mb-0">RM {{ $dish->priceDetail->overhead_price }}</h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="text-end text-sm"> <!-- Aligned to right -->
                                                <h5 class="mb-0 text-sm">Labor Cost Percentage (%)</h5>
                                            </td>
                                            <td class="text-center text-sm">
                                                <h5 class="text-xs font-weight-bold mb-0">{{ $costSetting->labor_cost }}%</h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="text-end text-sm"> <!-- Aligned to right -->
                                                <h5 class="mb-0 text-sm">Price with Labor Cost (%)</h5>
                                            </td>
                                            <td class="text-center text-sm">
                                                <h5 class="text-xs font-weight-bold mb-0">
                                                    @if (is_null($dish->priceDetail->labor_price) || $dish->priceDetail->labor_price == 0.00)
                                                        -
                                                    @else
                                                        {{ $dish->priceDetail->labor_price }}
                                                    @endif
                                                </h5>
                                            </td>
                                            
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="text-end text-sm"> <!-- Aligned to right -->
                                                <h5 class="mb-0 text-sm">Profit Margin Percentage (%)</h5>
                                            </td>
                                            <td class="text-center text-sm">
                                                <h5 class="text-xs font-weight-bold mb-0">{{ $costSetting->margin_cost }}%</h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="text-end text-sm"> <!-- Aligned to right -->
                                                <h5 class="mb-0 text-sm">Price with Profit Margin (%)</h5>
                                            </td>
                                            <td class="text-center text-sm">
                                                <h5 class="text-xs font-weight-bold mb-0">{{ $dish->priceDetail->margin_price }}</h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="text-end text-sm"> <!-- Aligned to right -->
                                                <h5 class="mb-0 text-sm">TOTAL ALL COST (RM)</h5>
                                            </td>
                                            <td class="text-center text-sm">
                                                <h5 class="text-xs font-weight-bold mb-0">RM {{ $menu->menu_price }}</h5>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </form>
                </div>
            </div> 
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection
