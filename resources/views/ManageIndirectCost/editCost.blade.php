@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Indirect Cost Setting'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-8 col-md-10 col-sm-12 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Edit Indirect Cost</h5>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form id="priceForm" action="{{ route('cost.update', $cost->cost_ID) }}" method="POST">
                            @csrf
                            <div class="row">
                                <p class="text-uppercase text-sm">Cost Info</p>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cost Type</label>
                                        <input class="form-control" type="text" name="cost_type" value="{{ $cost->cost_type }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Value (%)</label>
                                        <input class="form-control" type="number" name="value"   value="{{ $cost->value }}">
                                    </div>
                                    <div class="form-group d-flex justify-content-center">
                                        <input type="reset" class="btn btn-danger btn-sm me-2" value="Reset">
                                        <input type="submit" class="btn btn-primary btn-sm" value="Save">
                                    </div>                                    
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection
