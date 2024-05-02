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
                                <h6>Dishes List</h6>
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-success" type="button" onclick="window.location='{{ route('dish.create') }}'">Create New</button>
                            </div>
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
                                            Dish</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Cost (RM)</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Status</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dishes as $dish)
                                        <tr>
                                            <td>
                                                <div class="align-middle text-center text-sm">

                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $dish['dish_name'] }}
                                                        </h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <p class="text-xs font-weight-bold mb-0">{{$dish['dish_cost'] }}
                                                </p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <input type="checkbox" name="status" data-plugin="switchery" data-color="#1bb99a" {{ $dish->status ? 'checked="1"' : 'checked="0"' }} >
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <a href="{{ route('dish.show', $dish['dish_ID']) }}" class="btn btn-info">VIEW</a>
                                                <a href="{{ route('dish.edit', $dish['dish_ID']) }}" class="btn btn-primary">EDIT</a>
                                                <a href="{{ route('dish.delete', $dish['dish_ID']) }}" class="btn btn-danger" onclick="return confirm('Confirm to delete?')">DELETE</a>
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
