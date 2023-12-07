@extends('layouts.app')

@section('title', "Project Details")

@section('content') 
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card mt-5">
                    <div class="card-header d-flex justify-content-between">
                        <h2>Project Details</h2>
                        <span> 
                            <a href="{{ route('designer.dashboard') }}" class="btn btn-secondary">Back</a>
                        </span>
                    </div>
                    <div class="card-body">

                        <div class="d-flex justify-content-between"> 
                            <h4><b>Title:</b> {{ $project->title }}</h4>
                            <div class="other-details">
                                <p><b>Due Date:</b>  {{ $project->due_date }}</p>
                                <p><b>Assigned By:</b> {{ $project->client->name }}</p>
                            </div>  
                        </div>
                           
                        <hr> 
                        <div class="description">
                            <p><b>Description:</b></p> 
                            {!! $project->description !!} 
                        </div>
                        <hr>
                         
                        <div class="mt-3">
                            <h4>Files:</h4>
                            @if ($project->files->count() > 0)
                                <ul>
                                    @foreach ($project->files as $file)
                                        <li><a href="{{ asset('storage/project_files/' . $file->name) }}" target="_blank">{{ $file->name }}</a></li>
                                    @endforeach
                                </ul>
                            @else
                                <p>No files attached to this project.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
