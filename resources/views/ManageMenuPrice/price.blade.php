@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Menu Pricing'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-8 col-md-10 col-sm-12 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Calculate Menu Price</h5>
                    </div>
                    <div class="card-body">
                        <form id="priceForm">
                            @csrf
                            <div class="col-md-6">
                                <label for="dish">Select a Dish:</label>
                                <select class="form-control mt-2" name="dish" id="dish">
                                    <option value="" data-price='0.00'>Select Dish</option>
                                    @foreach($dishes as $dish)
                                        <option value="{{ $dish->dish_ID }}" data-price="{{ $dish->dish_cost }}">{{ $dish->dish_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="dish_cost">Dish Cost (RM)</label>
                                <input type="number" step="0.01" class="form-control" id="dish_cost" name="dish_cost" readonly>
                            </div>
                            <div class="form-group">
                                <label for="labor_cost_per_hour">Labor Cost per Hour (RM)</label>
                                <input type="number" step="0.01" class="form-control" id="labor_cost_per_hour" name="labor_cost_per_hour" required>
                            </div>
                            <div class="form-group">
                                <label for="labor_time">Time to Prepare (minutes)</label>
                                <input type="number" class="form-control" id="labor_time" name="labor_time" required>
                            </div>
                            <div class="form-group">
                                <label for="overhead_cost">Overhead Cost per Dish (RM)</label>
                                <input type="number" step="0.01" class="form-control" id="overhead_cost" name="overhead_cost" required>
                            </div>
                            <div class="form-group">
                                <label for="profit_margin">Desired Profit Margin (%)</label>
                                <input type="number" step="0.01" class="form-control" id="profit_margin" name="profit_margin" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Calculate</button>
                        </form>
                        <div id="result" class="mt-4" style="display: none;">
                            <h5 class="card-title">Calculated Menu Price</h5>
                            <p>The calculated menu price is: RM <input type="number" step="0.01" class="form-control" id="menu_price" name="menu_price" readonly>
                                {{-- <span id="menu_price"></span></p> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            document.getElementById('dish').addEventListener('change', function() {
                var selectedDish = this.options[this.selectedIndex];
                var dishId = selectedDish.getAttribute('value');
                var dishCost = selectedDish.getAttribute('data-price');
                document.getElementById('dish_cost').value = dishCost;
            });

            $('#priceForm').on('submit', function(event) {
                event.preventDefault();
                $.ajax({
                    url: "{{ route('calculate.price') }}",
                    method: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#menu_price').text(response.menu_price);
                        $('#result').show();
                    },
                    error: function(xhr) {
                        alert('An error occurred. Please try again.');
                    }
                });
            });
        </script>
        @include('layouts.footers.auth.footer')
    </div>
@endsection
