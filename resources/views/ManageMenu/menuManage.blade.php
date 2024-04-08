@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])
<div class="container-fluid py-4">
    <div class="row">
        @foreach ($dishes as $dish)
        <div class="col-md-3 mb-4"> <!-- Use col-md-3 for small screens and above -->
            <div class="card">
                <img src="{{ $photoUrls[$dish->dish_ID] }}" class="mx-auto d-block mt-3" style="width: 100px; height: 100px;" alt="Dish Photo"> <!-- Added mt-3 for margin-top -->
                <div class="card-body pt-0 p-3 text-center">
                    <h5 class="card-title">{{ $dish['dish_name'] }}</h5>
                    <span class="text-xs">RM {{ $dish['dish_cost'] }}</span>
                    <hr class="horizontal dark my-3">
                    <a href="/order-create" class="btn btn-primary">Order</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@include('layouts.footers.auth.footer')
@endsection
