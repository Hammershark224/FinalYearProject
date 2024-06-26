@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])
<script src="{{ asset('assets/js/core/search.js') }}"></script>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6>Menu List</h6>
                            </div>
                        </div>
                        <div class="row col-4">
                            <input type="text" id="searchInput" class="form-control border border-dark" placeholder="Search for menu...">
                        </div>
                    </div>

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Recipe</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Sell Price (RM)</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Action</th>    
                                    </tr>
                                </thead>
                                <tbody id="TableBody">
                                    @foreach ($menus as $menu)
                                        <tr>
                                            <td>
                                                <div class="align-middle text-center text-sm">

                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $menu->dish->dish_name }}
                                                        </h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <p class="text-xs font-weight-bold mb-0">{{$menu->menu_price }}
                                                </p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <a href="{{ route('menu.show', $menu->menu_ID) }}" class="btn btn-info">VIEW</a>
                                                <a href="{{ route('menu.delete', $menu->menu_ID) }}" class="btn btn-danger" onclick="return confirm('Confirm to delete?')">DELETE</a>
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
        
        @include('layouts.footers.auth.footer')
    </div>
@endsection
