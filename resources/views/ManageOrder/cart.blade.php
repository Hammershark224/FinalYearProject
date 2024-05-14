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
                                <h2>Cart</h2>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Dish</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $totalPrice = 0;
                                            @endphp
                                            @foreach($cart as $dishId => $dish)
                                                <tr>
                                                    <td>{{ $dish['name'] }}</td>
                                                    <td>{{ $dish['price'] }}</td>
                                                    <td>{{ $dish['quantity'] }}</td>
                                                    <td>{{ $dish['price'] * $dish['quantity'] }}</td>
                                                </tr>
                                                @php
                                                    $totalPrice += $dish['price'] * $dish['quantity'];
                                                @endphp
                                            @endforeach
                                            <tr>
                                                <td colspan="3" class="text-right"><strong>Total:</strong></td>
                                                <td>{{ $totalPrice }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@include('layouts.footers.auth.footer')
@endsection
