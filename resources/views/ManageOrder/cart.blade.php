
<div class="container-fluid py-4">
    <div class="row">
        <h2>Shopping Cart</h2>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cart as $dishId => $dish)
                                <tr>
                                    <td>{{ $dish['name'] }}</td>
                                    <td>{{ $dish['price'] }}</td>
                                    <td>{{ $dish['quantity'] }}</td>
                                    <td>{{ $dish['price'] * $dish['quantity'] }}</td>                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
    </div>
</div>


  
