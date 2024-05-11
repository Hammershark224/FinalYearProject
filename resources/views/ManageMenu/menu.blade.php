@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
<style>
    .disabled {
        pointer-events: none;
        opacity: 0.7;
    }
</style>
@section('content')
@include('layouts.navbars.guest.sidenav')
<div class="container-fluid py-4">
    <div class="row">
        @foreach ($dishes as $dish)
        <div class="col-md-2 mb-4">
            @if($dish->dish_status == 'ON')
            <a href="#" class="card-link" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $dish->dish_ID }}">
                <div class="card">
                    <img src="{{ $photoUrls[$dish->dish_ID] }}" class="mx-auto d-block mt-3" style="width: 100px; height: 100px;" alt="Dish Photo">
                    <div class="card-body pt-0 p-3 text-center">
                        <h5 class="card-title">{{ $dish['dish_name'] }}</h5>
                        <span class="text-xs">RM {{ $dish['dish_cost'] }}</span>
                    </div>
                </div>
            </a>
            @else
            <div href="/order-create" class="card-link disabled">
                <div class="card">
                    <img src="{{ $photoUrls[$dish->dish_ID] }}" class="mx-auto d-block mt-3" style="width: 100px; height: 100px;" alt="Dish Photo">
                    <div class="card-body pt-0 p-3 text-center">
                        <h5 class="card-title">{{ $dish['dish_name'] }}</h5>
                        <span class="text-xs">RM {{ $dish['dish_cost'] }}</span>
                    </div>
                </div>
            </div>
            @endif
        </div>
        @endforeach
    </div>
</div>

@foreach ($dishes as $dish)
<div class="modal fade" id="exampleModal{{ $dish->dish_ID }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $dish->dish_ID }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel{{ $dish->dish_ID }}">Order</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="{{ $photoUrls[$dish->dish_ID] }}" class="mx-auto d-block mt-3" style="width: 100px; height: 100px;" alt="Dish Photo">
                <h5>Ingredients</h5>
                @foreach($recipes as $recipe)
                    @if($recipe->dish_ID == $dish->dish_ID)
                        @if($recipe->ingredient)
                            <span class="text-xs">{{ $recipe->ingredient->ingredient_name }}</span><br>
                        @endif
                    @endif
                @endforeach
                <h5 class="card-title">{{ $dish['dish_name'] }}</h5>
                <span class="text-xs">RM {{ $dish['dish_cost'] }}</span>
                <form action="{{ route('addToCart', ['itemId' => $dish->dish_ID]) }}" method="GET">
                    <div class="input-group mt-3">
                        <button class="btn btn-outline-secondary" type="button" id="minusBtn{{ $dish->dish_ID }}">-</button>
                        <input type="number" class="form-control text-center" name="quantity" id="quantity{{ $dish->dish_ID }}" value="1" min="1">
                        <button class="btn btn-outline-secondary" type="button" id="plusBtn{{ $dish->dish_ID }}">+</button>
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
        @foreach ($dishes as $dish)
        const minusBtn{{ $dish->dish_ID }} = document.getElementById("minusBtn{{ $dish->dish_ID }}");
        const plusBtn{{ $dish->dish_ID }} = document.getElementById("plusBtn{{ $dish->dish_ID }}");
        const quantityInput{{ $dish->dish_ID }} = document.getElementById("quantity{{ $dish->dish_ID }}");

        minusBtn{{ $dish->dish_ID }}.addEventListener("click", function() {
            const currentValue = parseInt(quantityInput{{ $dish->dish_ID }}.value);
            if (currentValue > 1) {
                quantityInput{{ $dish->dish_ID }}.value = currentValue - 1;
            }
        });

        plusBtn{{ $dish->dish_ID }}.addEventListener("click", function() {
            const currentValue = parseInt(quantityInput{{ $dish->dish_ID }}.value);
            quantityInput{{ $dish->dish_ID }}.value = currentValue + 1;
        });
        @endforeach
    });
</script>

@endsection
