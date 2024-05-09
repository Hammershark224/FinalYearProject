@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
<style>
    .disabled {
        pointer-events: none; /* Disables mouse events */
        opacity: 0.7; /* Makes the element semi-transparent to indicate it's disabled */
    }
</style>
@section('content')
@include('layouts.navbars.guest.sidenav')
<div class="container-fluid py-4">
    <div class="row">
        @foreach ($dishes as $dish)
        <div class="col-md-2 mb-4"> <!-- Use col-md-3 for small screens and above -->
            @if($dish->dish_status == 'ON')
            <a href="#" class="card-link" data-bs-toggle="modal" data-bs-target="#exampleModal"> <!-- Add the link to the card -->
                <div class="card">
                    <img src="{{ $photoUrls[$dish->dish_ID] }}" class="mx-auto d-block mt-3" style="width: 100px; height: 100px;" alt="Dish Photo"> <!-- Added mt-3 for margin-top -->
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

<form action="{{ route('addToCart', ['itemId' => $dish->dish_ID]) }}" method="GET">
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Order</h1>
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
                <div class="input-group mt-3">
                    <button class="btn btn-outline-secondary" type="button" id="minusBtn">-</button>
                    <input type="number" class="form-control text-center" name="quantity" id="quantity" value="1" min="1">
                    <button class="btn btn-outline-secondary" type="button" id="plusBtn">+</button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    @csrf
                    <button type="submit" class="btn btn-primary">Order</button>
                </form>
            </div>
        </div>
    </div>
</div>


  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const minusBtn = document.getElementById("minusBtn");
      const plusBtn = document.getElementById("plusBtn");
      const quantityInput = document.getElementById("quantity");
  
      minusBtn.addEventListener("click", function() {
        const currentValue = parseInt(quantityInput.value);
        if (currentValue > 1) {
          quantityInput.value = currentValue - 1;
        }
      });
  
      plusBtn.addEventListener("click", function() {
        const currentValue = parseInt(quantityInput.value);
        quantityInput.value = currentValue + 1;
      });
    });
  </script>
  
@endsection


                    {{-- <div class="align-middle text-center text-sm">
                        <a href="/order-create" class="btn btn-primary">Order</a>
                    </div> --}}