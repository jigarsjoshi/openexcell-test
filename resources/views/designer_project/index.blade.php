@extends('layouts.app')

@section('title', "Dashboard")

@section('content') 
    <div class="container">
        <div class="row">
            <div class="col-12">
                @if(session('success'))
                    <div class="alert alert-success mt-5">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="card mt-5">
                    <div class="card-header d-flex justify-content-between">
                        <span class="main-title">
                            <h2>Projects Dashboard</h2>
                        </span> 
                        <span>
                            <a href="{{ route('logout') }}" class="btn btn-danger">Logout</a> 
                        </span>
                    </div>
                    <div class="card-body">
                    
                        <table class="table table-bordered table-striped" id="projects-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Due Date</th>
                                    <th>Assigned By</th>
                                    <th>Is complete</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody> 
                                @foreach($projects as $project)
                                    <tr>
                                        <td>{{ $project->title }}</td>
                                        <td>{{ $project->due_date }}</td>
                                        <td>{{ $project->designer->name }}</td>
                                        <td>
                                            @if($project->is_complete == 1) 
                                                {{ "Completed"  }}
                                            @else
                                                {{ "Incomplete" }}
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('designer.project.show', ['project' => $project->id]) }}" class="btn btn-sm btn-primary">Details</a>
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
@endsection


@section('additinal_css') 
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css"> 
@endsection

@section('additinal_script')
    <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(document).ready(function () {
            $("#projects-table").DataTable({
                "aaSorting": []
            });
        })
    </script>
@endsection