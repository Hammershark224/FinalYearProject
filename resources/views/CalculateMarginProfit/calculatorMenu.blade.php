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
                                <h6>Calculator</h6>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-5 mb-4 mx-auto"> 
                            <a href="{{ route('calculator.menu') }}" class="card d-flex justify-content-center align-items-center" style="background-color: #FFE9AB;">
                                <div>
                                    <h5 class="text-center">Menu Price Calculator</h5>
                                    <img src="img/menu.png" style="height: 300px; width: 300px;">
                                    <h6 class="text-center font-italic">What Should My Menu Price Be?</h6>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-5 mb-4 mx-auto"> 
                            <a href="{{ route('calculator.margin') }}" class="card d-flex justify-content-center align-items-center" style="background-color: #E9FFAB;">
                                <div>
                                    <h5 class="text-center">Cash Margin Calculator</h5>
                                    <img src="img/margin.png" style="height: 300px; width: 300px;">
                                    <h6 class="text-center font-italic">What's My Margin?</h6>
                                </div>
                            </a>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
        
        @include('layouts.footers.auth.footer')
    </div>
@endsection
