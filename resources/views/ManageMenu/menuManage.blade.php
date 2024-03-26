@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                @foreach ($dishes as $dish)
                <div class="card mb-4">
                    <div class="card" style="width: 18rem;">
                        <img src="{{ $photoUrls[$dish->dish_ID] }}" alt="Dish Photo">
                        <div class="card-body">
                          <h5 class="card-title">{{ $dish['dish_name'] }}</h5>
                          <p class="card-text">{{ $dish['dish_description'] }}</p>
                          <a href="/order-create" class="btn btn-primary">Order</a>
                        </div>
                      </div>
                </div>
                @endforeach
            </div>
        </div>
        
        @include('layouts.footers.auth.footer')
    </div>
@endsection
