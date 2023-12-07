@extends('layouts.app')

@section('title', "Create Project")

@section('content') 
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card mt-5">
                    <div class="card-header d-flex justify-content-between">
                        <h2>Create Project</h2>
                        <span> 
                            <a href="{{ route('client.dashboard') }}" class="btn btn-secondary">Back</a>
                        </span>
                    </div>
                    <div class="card-body">
                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif   
  
                        {!! Form::open(['route' => 'client.project.save', 'method' => 'post', 'enctype' => 'multipart/form-data']) !!} 
                            <div class="row">
                                <div class="form-group col-6">
                                    {!! Form::label('title', 'Title') !!}
                                    {!! Form::text('title', null, ['class' => 'form-control']) !!}
                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-6">
                                    {!! Form::label('due_date', 'Due Date') !!}
                                    {!! Form::date('due_date', null, ['class' => 'form-control']) !!}
                                    @error('due_date')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-12">
                                    {!! Form::label('description', 'Description (HTML Editor)') !!}
                                    {!! Form::textarea('description', null, ['class' => 'form-control', 'id' => 'description']) !!}
                                    @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                 
                                <div class="form-group col-6">
                                    {!! Form::label('assign_to', 'Assign project to') !!}
                                    {!! Form::select('assign_to', $users, null, ['class' => 'form-control']) !!}
                                    @error('assign_to')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-6">
                                    {!! Form::label('files', 'Multiple file upload') !!}
                                    {!! Form::file('files[]', ['class' => 'form-control', 'multiple' => 'multiple']) !!}
                                    @error('files.*')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div> 
                            </div> 
                            <button type="submit" class="btn btn-primary">Create Project</button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div> 
    <script>
        // Include the HTML editor script if needed
        
    </script>
@endsection



@section('additinal_script')

    <script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/classic/ckeditor.js"></script>

    <script>
        $(document).ready(function () {
            ClassicEditor
                .create(document.querySelector('#description'))
                .catch(error => {
                    console.error( error );
            });
        })
    </script>
@endsection