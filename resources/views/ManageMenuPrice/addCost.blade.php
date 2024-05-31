@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Indirect Cost Setting'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-8 col-md-10 col-sm-12 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Indirect Cost Setting</h5>
                    </div>
                    {{-- <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form id="priceForm" action="{{ route('cost.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="overhead">Overhead Cost(%)</label>
                                <i id="question-mark" class="fas fa-info-circle" style="cursor: pointer; color: #007bff;" data-bs-toggle="modal" data-bs-target="#overheadDescription"></i>
                                <div class="modal fade" id="overheadDescription" tabindex="-1" role="dialog" aria-labelledby="descriptionModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="descriptionModalLabel">Overhead Cost Description</h5>
                                            </div>
                                            <div class="modal-body">
                                                Overhead costs are those ongoing expenses that are not directly tied to a specific product or service but are necessary for running the business.
                                                <ul>
                                                    <li>Rent</li>
                                                    <li>Utilities</li>
                                                    <li>Depreciation of assets</li>
                                                    <li>Government licenses</li>
                                                </ul>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="number" step="0.01" class="form-control" id="overhead_cost" name="overhead_cost" value="{{ old('overhead_cost', $costSetting->overhead_cost) }}" required>
                            </div>
                            <div class="form-group">
                                <label for="labor">Labor Cost (%)</label>
                                <i id="question-mark" class="fas fa-info-circle" style="cursor: pointer; color: #007bff;" data-bs-toggle="modal" data-bs-target="#laborDescription"></i>
                                <div class="modal fade" id="laborDescription" tabindex="-1" role="dialog" aria-labelledby="descriptionModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="descriptionModalLabel">Labor Cost Description</h5>
                                            </div>
                                            <div class="modal-body">
                                                Labor costs are the amount that you spend on an employee.
                                                <ul>
                                                    <li>Wages</li>
                                                    <li>Taxes</li>
                                                    <li>Benefits</li>
                                                </ul>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="number" step="0.01" class="form-control" id="labor_cost" name="labor_cost" value="{{ old('labor_cost', $costSetting->labor_cost) }}" required>
                            </div>
                            <div class="form-group">
                                <label for="profit_margin">Desired Profit Margin (%)</label>
                                <i id="question-mark" class="fas fa-info-circle" style="cursor: pointer; color: #007bff;" data-bs-toggle="modal" data-bs-target="#marginDescription"></i>
                                <div class="modal fade" id="marginDescription" tabindex="-1" role="dialog" aria-labelledby="descriptionModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="descriptionModalLabel">Profit Margin Description</h5>
                                            </div>
                                            <div class="modal-body">
                                                The desired profit margin is the percentage of profit you aim to achieve on the sale of your products or services.
                                                <ul>
                                                    <li>Market demand</li>
                                                    <li>Competition</li>
                                                    <li>Cost of goods sold</li>
                                                    <li>Operational efficiency</li>
                                                </ul>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="number" step="0.01" class="form-control" id="margin_cost" name="margin_cost" value="{{ old('margin_cost', $costSetting->margin_cost) }}" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div> --}}
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form id="priceForm" action="{{ route('cost.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <p class="text-uppercase text-sm">Dish Info</p>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cost Type</label>
                                        <input class="form-control" type="text" name="cost_type">
                                    </div>
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Value (%)</label>
                                        <input class="form-control" type="number" name="value">
                                    </div>
                                    <div class="form-group d-flex justify-content-center">
                                        <input type="reset" class="btn btn-danger btn-sm me-2" value="Reset">
                                        <input type="submit" class="btn btn-primary btn-sm" value="Submit">
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
