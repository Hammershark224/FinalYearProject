@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
<style>
    .bg-yellow {
        background-color: yellow;
    }

    .bg-red {
        background-color: red;
    }
</style>
@include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6>Company</h6>
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-success" type="button" onclick="window.location='{{ route('supplier.create') }}'">New</button>
                            </div>
                        </div>

                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Company Name</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Company Address</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($companies as $company)
                                    <tr>
                                        <td>
                                            <div class="align-middle text-center text-sm">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $company['company_name'] }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="align-middle text-center text-sm">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $company['company_address'] }}</h6>
                                                </div>
                                            </div>
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
