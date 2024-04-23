@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6>Ingredients</h6>
                            </div>
                        </div>

                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Ingredient</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Weight (kg)</th>
                                        @foreach ($companies as $company)
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Price (RM) <br>
                                            {{ $company['company_name'] }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ingredients as $ingredient)
                                    <tr>
                                        <td>
                                            <div class="align-middle text-center text-sm">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $ingredient->ingredient_name }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="align-middle text-center text-sm">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $ingredient->ingredient_weight }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        @foreach ($companies as $company)
                                        <td>
                                            @foreach ($ingredient->suppliers as $supplier)
                                            @if ($supplier->company_ID === $company->company_ID)
                                            <div class="align-middle text-center text-sm">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm {{ $supplier->ingredient_price == $ingredient->highest_price ? ' text-secondary' : ($supplier->ingredient_price == $ingredient->lowest_price ? ' bg-green' : '') }}">{{ $supplier->ingredient_price }}</h6>
                                                </div>
                                            </div>
                                            @endif
                                            @endforeach
                                        </td>
                                        @endforeach
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        @include('layouts.footers.auth.footer')
    </div>
@endsection
