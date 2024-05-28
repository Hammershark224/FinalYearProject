@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])
<div class="container-fluid py-4">
    @php
    $role = Auth::user() ? Auth::user()->role : null;
@endphp

@if ($role == "owner")
    <div class="row">
        @foreach ($menus as $menu)
        <div class="col-md-3 mb-4"> <!-- Use col-md-3 for small screens and above -->
            <div class="card">
                <img src="{{ $photoUrls[$menu->dish->dish_ID] }}" class="mx-auto d-block mt-3" style="width: 100px; height: 100px;" alt="Dish Photo"> <!-- Added mt-3 for margin-top -->
                <div class="card-body pt-0 p-3 text-center">
                    <h5 class="card-title">{{ $menu->dish->dish_name }}</h5>
                    <span class="text-xs">RM {{ $menu->menu_price }}</span>
                    <hr class="horizontal dark my-3">
                    <form role="form" method="post" action="{{ route('status.update', $menu->dish->dish_ID) }}" enctype="multipart/form-data">
                    @csrf    
                        <div class="align-middle text-center text-sm">
                            <div class="row">
                                <div class="col-md-4">
                                    <select id="dish_status" class="form-control" name="dish_status" required>
                                        <option value="ON" @if($menu->dish->dish_status == 'ON') selected @endif>ON</option>
                                        <option value="OFF" @if($menu->dish->dish_status == 'OFF') selected @endif>OFF</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <button class="btn btn-primary mr-2" type="submit">Update</button>
                                    </div>
                                </div>
                                <div class="col-md-4"> 
                                    <div class="red-column d-flex align-items-center justify-content-center">
                                        <div class="trash-icon">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@else
    <div class="row">
        @foreach ($dishes as $dish)
        <div class="col-md-3 mb-4"> <!-- Use col-md-3 for small screens and above -->
            <div class="card">
                <img src="{{ $photoUrls[$dish->dish_ID] }}" class="mx-auto d-block mt-3" style="width: 100px; height: 100px;" alt="Dish Photo"> <!-- Added mt-3 for margin-top -->
                <div class="card-body pt-0 p-3 text-center">
                    <h5 class="card-title">{{ $dish['dish_name'] }}</h5>
                    <span class="text-xs">RM {{ $dish['dish_cost'] }}</span>
                    <hr class="horizontal dark my-3">
                    <div class="align-middle text-center text-sm">
                        <a href="/order-create" class="btn btn-primary">Order</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endif
</div>
@include('layouts.footers.auth.footer')
@endsection
