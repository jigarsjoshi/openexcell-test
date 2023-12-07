@extends('layouts.app')

@section('title', 'Login')

@section('content') 
    <div class="container">
        <div class="row">
            <div class="col-8 offset-2">
                <div class="card mt-5">
                    <div class="card-header">
                        <h3 class="card-title">
                            Login
                        </h3>
                    </div> 
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8 offset-2"> 
                                <a href="{{ url('/login/google') }}" class="btn btn-danger btn-block">Login with Google</a>
                                <a href="{{ url('/login/facebook') }}" class="btn btn-primary btn-block">Login with Facebook</a> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
@endsection