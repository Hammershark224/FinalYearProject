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
                                        <input class="form-control" type="text" name="dish_name" value="{{ $dataDish->dish_name }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Dish Description</label>
                                        <textarea class="form-control" name="dish_description" rows="3" readonly>{{ $dataDish->dish_description }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Dish Cost</label>
                                        <input class="form-control" type="number" name="dish_cost" id="dish_cost" value="{{ $dataDish->dish_cost }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <hr class="horizontal dark">
                            <p class="text-uppercase text-sm">Ingredients</p>
                            {{-- @foreach($recipes as $recipe)
                            
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="example-text-input" class="form-control-label">Ingredient</label>
                                        <input class="form-control" type="text" value="{{ $recipe->ingredient->ingredient_name }}" readonly>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="example-text-input" class="form-control-label">Weight</label>
                                        <input class="form-control" type="text" value="{{ $recipe->recipe_weight }}" readonly>
                                    </div>
                                    <div class="col-md-3">
                                        <input class="form-control" type="text" value="{{ ($recipe->ingredient->suppliers->first()->ingredient_price / $recipe->ingredient->ingredient_weight) * $recipe->recipe_weight }}" readonly>
                                    </div>
                                </div>
                            @endforeach
                        </div> --}}
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Ingredient</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Weight</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Cost (RM)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($recipes as $recipe)
                                        <tr>
                                            <td>
                                                <div class="align-middle text-center text-sm">

                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h5 class="mb-0 text-sm">{{ $recipe->ingredient->ingredient_name }}
                                                        </h5>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <h5 class="text-xs font-weight-bold mb-0">{{ $recipe->recipe_weight }}
                                                </h5>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <h5 class="text-xs font-weight-bold mb-0">
                                                    {{ round(($recipe->ingredient->lowestPrice->ingredient_price / $recipe->ingredient->ingredient_weight) * $recipe->recipe_weight,2) }}
                                                </h5>
                                                
                                                </h5>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div> 
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection
