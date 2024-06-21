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
                            <h6>Ingredient List</h6>
                        </div>
                        <div class="col-auto">
                            <button class="btn btn-info" type="button" onclick="window.location='{{ route('ingredient.export') }}'">
                                <i class="fa fa-download" aria-hidden="true"></i> Export
                            </button>
                            <button class="btn btn-primary mr-2" type="button" onclick="window.location='{{ route('ingredient.create') }}'">Add New Ingredient</button>
                        </div>
                    </div>
      
                    <div class="col-4">
                        <input type="text" id="searchInput" class="form-control border border-dark" placeholder="Search for ingredients...">
                    </div>
                </div>

                @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Ingredient Name</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Ingredient Weight</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody id="TableBody">
                                @foreach ($ingredients as $ingredient)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-center">
                                            @if($ingredient->photo_url)
                                                <img src="{{ $ingredient->photo_url }}" alt="{{ $ingredient->ingredient_name }}" style="width: 50px; height: 50px; margin-right: 10px;">
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-center">
                                            <h6 class="mb-0 text-sm">{{ $ingredient->ingredient_name }}</h6>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="align-middle text-center text-sm">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $ingredient->ingredient_weight }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <a href="{{ route('ingredient.edit', $ingredient->ingredient_name) }}" class="btn btn-primary">EDIT</a>
                                        <a href="{{ route('ingredient.delete', $ingredient->ingredient_ID) }}" class="btn btn-danger" onclick="return confirm('Confirm to delete?')">DELETE</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const tableBody = document.getElementById('TableBody');
    const tableRows = tableBody.getElementsByTagName('tr');

    searchInput.addEventListener('keyup', function() {
        const filter = searchInput.value.toLowerCase();
        Array.from(tableRows).forEach(function(row) {
            const cells = row.getElementsByTagName('td');
            const ingredientName = cells[1].textContent.trim() || cells[1].innerText.trim(); // Adjust to second cell (index 1)
            if (ingredientName.toLowerCase().indexOf(filter) > -1) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
});


</script>
    @include('layouts.footers.auth.footer')
</div>
@endsection
