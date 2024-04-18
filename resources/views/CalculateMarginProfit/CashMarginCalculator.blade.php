@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Create'])
    <div id="alert">
        @include('components.alert')
    </div>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form id="calculationForm" role="form" method="POST" action="{{ route('calculation.margin') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-center">
                                <p class="mb-0">Cash Margin Calculator</p>
                            </div>
                        </div>
                        <div class="card-body">
                            <p class="text-uppercase text-sm">Input</p>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="dish_cost" class="col-sm-4 col-form-label text-right">Dish Cost (RM)</label>
                                    <div class="col-sm-8">
                                        <input id="dish_cost" class="form-control" type="number" step="0.01" min="0.01" name="dish_cost">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="sell_price" class="col-sm-4 col-form-label text-right">Sell Price (RM)</label>
                                    <div class="col-sm-8">
                                        <input id="sell_price" class="form-control" type="number" name="sell_price">
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <div class="col-sm-12 text-center">
                                            <button type="button" class="btn btn-primary btn-sm" onclick="calculate()">Calculate</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="outputFields" style="display: none;">
                            <hr class="horizontal dark">
                            <p class="text-uppercase text-sm">Output</p>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="cash_margin" class="col-sm-4 col-form-label text-right">Cash Margin (RM)</label>
                                        <div class="col-sm-8">
                                            <input id="cash_margin" class="form-control" type="number" name="cash_margin" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="target_margin" class="col-sm-4 col-form-label text-right">Target Margin (%)</label>
                                        <div class="col-sm-8">
                                            <input id="target_margin" class="form-control" type="number" name="target_margin" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div> 
        </div>
        @include('layouts.footers.auth.footer')
    </div>

    <script>
        function calculate() {
            // Get input values
            var dishCost = parseFloat(document.getElementById('dish_cost').value);
            var sellPrice = parseFloat(document.getElementById('sell_price').value);
    
            // Make AJAX request to calculateMenuPrice endpoint
            fetch('{{ route("calculation.margin") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    dish_cost: dishCost,
                    sell_price: sellPrice
                })
            })
            .then(response => response.json())
            .then(data => {
                // Format values to two decimal places
                var cashMargin = data.cash_margin.toFixed(2);
                var targetMargin = data.target_margin.toFixed(2);
    
                // Update output fields with formatted values
                document.getElementById('cash_margin').value = cashMargin;
                document.getElementById('target_margin').value = targetMargin;
    
                // Show the output fields
                document.getElementById('outputFields').style.display = 'block';
            })
            .catch(error => {
                console.error('Error:', error);
            });
    
            // Prevent form submission
            return false;
        }
    </script> 
@endsection
