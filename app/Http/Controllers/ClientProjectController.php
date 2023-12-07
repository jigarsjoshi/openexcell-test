<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Project;
use App\Models\File;
use Illuminate\Support\Facades\Session;

class ClientProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['projects'] = Project::where('client_id', Auth::id())->orderBy('id', 'desc')->get(); 
 
        return view('client_project.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        $data['users'] = User::where('user_type', 1)->pluck('name', 'id');
        return view('client_project.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'due_date' => 'required|date',
            'description' => 'required|string',
            'assign_to' => 'required|exists:users,id',
            'files.*' => 'file|mimes:jpeg,png,pdf,docx',
        ]);
 
        $project = Project::create([
            'title' => $validatedData['title'],
            'due_date' => $validatedData['due_date'],
            'description' => $validatedData['description'],
            'designer_id' => $validatedData['assign_to'], 
            'client_id' => Auth::id(),
        ]);
 
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $uploadedFile) {   
                $filename = $uploadedFile->storeAs('public/project_files', $uploadedFile->hashName()); 
                $file = new File(['name' => $uploadedFile->hashName()]);
                $project->files()->save($file);
            }
        }
        
        Session::flash('success', 'Project created successfully!');
        return redirect()->route('client.dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $project->load('files');  
        $data['project'] = $project; 
        return view('client_project.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
