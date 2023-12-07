@extends('layouts.app')

@section('title', "Complete Your Profile")

@section('content') 
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card mt-5">
                    <div class="card-header">
                        <h2>Complete Your Profile</h2>
                    </div>
                    <div class="card-body">
                        @if($user)
                            @if(session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif 

                            {!! Form::model($user, ['route' => 'save-profile', 'method' => 'post']) !!} 
                                <div class="row">
                                    <div class="form-group col-6">
                                        {!! Form::label('name', 'Name') !!}
                                        {!! Form::text('name', null, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
                                    </div>

                                    <div class="form-group col-6">
                                        {!! Form::label('email', 'Email') !!}
                                        {!! Form::text('email', null, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
                                    </div>

                                    <div class="form-group col-2">
                                        {!! Form::label('dial_code', 'Dial Code') !!}
                                        {!! Form::text('dial_code', null, ['class' => 'form-control']) !!}
                                        @error('dial_code')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-4">
                                        {!! Form::label('phone', 'Phone No.') !!}
                                        {!! Form::text('phone', null, ['class' => 'form-control']) !!}
                                        @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-6">
                                        {!! Form::label('user_type', 'User Type') !!}
                                        {!! Form::select('user_type', ['0' => 'Designer', '1' => 'Client'], null, ['class' => 'form-control']) !!}
                                    </div>

                                    <div class="form-group col-12">
                                        {!! Form::label('profile_pic', 'Profile Pic') !!}
                                        {!! Form::file('profile_pic', ['class' => 'form-control']) !!}
                                        @error('profile_pic')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div> 
                                </div> 
                                <button type="submit" class="btn btn-primary">Save Profile</button>
                            {!! Form::close() !!}
                        @else
                            <p>User not found</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div> 
@endsection