@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.guest.sidenav')
<div class="container-fluid py-4">
    <div class="row">
        @foreach ($menus as $menu)
        <div class="col-md-3 mb-45">
            @if($menu->dish->dish_status == 'ON')
            <a href="#" class="card-link" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $menu->menu_ID }}">
                <div class="card">
                    <img src="{{ $photoUrls[$menu->dish->dish_ID] }}" class="mx-auto d-block mt-3" style="width: 100px; height: 100px;" alt="Dish Photo">
                    <div class="card-body pt-0 p-3 text-center">
                        <h5 class="card-title">{{ $menu->dish->dish_name }}</h5>
                        <span class="text-xs">RM {{ $menu->menu_price }}</span>
                    </div>
                </div>
            </a>
            @else
            <div href="/order-create" class="card-link disabled">
                <div class="card">
                    <img src="{{ $photoUrls[$menu->dish->dish_ID] }}" class="mx-auto d-block mt-3" style="width: 100px; height: 100px;" alt="Dish Photo">
                    <div class="card-body pt-0 p-3 text-center">
                        <h5 class="card-title">{{  $menu->dish->dish_name }}</h5>
                        <span class="text-xs">RM {{  $menu->dish->dish_name }}</span>
                    </div>
                </div>
            </div>
            @endif
        </div>
        @endforeach
    </div>
</div>

@foreach ($menus as $menu)
<div class="modal fade" id="exampleModal{{$menu->menu_ID }}" tabindex="-1" aria-labelledby="exampleModalLabel{{$menu->menu_ID }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel{{$menu->dish_ID }}">Order</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="{{ $photoUrls[$menu->dish->dish_ID] }}" class="mx-auto d-block mt-3" style="width: 100px; height: 100px;" alt="Dish Photo">
                <h5>Ingredients</h5>
                @foreach($recipes as $recipe)
                    @if($recipe->dish_ID == $menu->dish_ID)
                        @if($recipe->ingredient)
                            <span class="text-xs">{{ $recipe->ingredient->ingredient_name }}</span><br>
                        @endif
                    @endif
                @endforeach
                <h5 class="card-title">{{ $menu->dish->dish_name }}</h5>
                <span class="text-xs">RM {{ $menu->menu_price }}</span>
                <form action="{{ route('addToCart', ['itemId' =>$menu->dish_ID]) }}" method="GET">
                    <div class="input-group mt-3">
                        <button class="btn btn-outline-secondary" type="button" id="minusBtn{{$menu->dish_ID }}">-</button>
                        <input type="number" class="form-control text-center" name="quantity" id="quantity{{$menu->dish_ID }}" value="1" min="1">
                        <button class="btn btn-outline-secondary" type="button" id="plusBtn{{$menu->dish_ID }}">+</button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        @csrf
                        <button type="submit" class="btn btn-primary">Order</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

<script>
    document.addEventListener("DOMContentLoaded", function() {
        @foreach ($menus as $menu)
        const minusBtn{{ $menu->dish_ID }} = document.getElementById("minusBtn{{ $menu->dish_ID }}");
        const plusBtn{{ $menu->dish_ID }} = document.getElementById("plusBtn{{ $menu->dish_ID }}");
        const quantityInput{{ $menu->dish_ID }} = document.getElementById("quantity{{ $menu->dish_ID }}");

        minusBtn{{ $menu->dish_ID }}.addEventListener("click", function() {
            const currentValue = parseInt(quantityInput{{ $menu->dish_ID }}.value);
            if (currentValue > 1) {
                quantityInput{{ $menu->dish_ID }}.value = currentValue - 1;
            }
        });

        plusBtn{{ $menu->dish_ID }}.addEventListener("click", function() {
            const currentValue = parseInt(quantityInput{{ $menu->dish_ID }}.value);
            quantityInput{{ $menu->dish_ID }}.value = currentValue + 1;
        });
        @endforeach
    });
</script>

@endsection
