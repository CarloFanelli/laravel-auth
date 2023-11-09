<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Support\Str;

use App\Models\Project;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::orderByDesc('id')->get();


        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('admin.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $val_data = $request->validated();

        $val_data['slug'] = Str::slug($request->title, '-');

        if ($request->has('cover_image')) {

            $complete_path = Storage::put('placeholders', $request->cover_image);
            $path = strstr($complete_path, '/');
            $val_data['cover_image'] = $path;
        }

        //dd($val_data);
        //dd(Project::create($val_data));
        Project::create($val_data);

        return to_route('admin.dashboard')->with('message', 'new project added');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {

        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        //
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {

        if ($request->has('cover_image')) {
            $complete_path = Storage::put('placeholders', $request->cover_image);
            $path = strstr($complete_path, '/');
            $val_data['cover_image'] = $path;
        }
        if (!Str::is($project->getOriginal('title'), $request->title)) {

            $val_data['slug'] = $project->generateSlug($project->title);
        }

        $project->update($val_data);

        return to_route('admin.dashboard',)->with('message', 'update with success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //dd($project);

        if ($project->cover_image) {
            Storage::delete('placeholders/' . $project->cover_image);
        }

        $project->delete();
        return to_route('admin.projects.index')->with('message', 'post deleted success!');
    }
}
