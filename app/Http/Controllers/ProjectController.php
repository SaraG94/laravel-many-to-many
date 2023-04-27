<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Type;
use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $trashed = $request->input('trashed');

        if ($trashed) {
            $projects = Project::onlyTrashed()->get();
        } else {
            $projects = Project::all();
        }

        $num_of_trashed = Project::onlyTrashed()->count();

        return view('projects.index', compact('projects', 'num_of_trashed'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::orderBy('nome', 'asc')->get();
        $technologies = Technology::orderBy('nome', 'asc')->get();

        return view('projects.create', compact('types','technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        $data = $request->validated();

        $data['slug'] = Str::slug($data['titolo']);

        $project = Project::create($data);

        if (isset($data['technologies'])) {
            $project->technologies()->attach($data['technologies']);
        }

        return to_route('projects.show', $project);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types = Type::orderBy('nome', 'asc')->get();
        $technologies = Technology::orderBy('nome', 'asc')->get();

        return view('projects.edit', compact('project','types','technologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $data = $request->validated();
        
        if ($data['titolo'] !== $project->titolo) {
            $data['slug'] = Str::slug($data['titolo']);
        }

        $project->update($data);

        if (isset($data['technologies'])) {
            $project->technologies()->sync($data['technologies']);
        }else{
            $project->technologies()->sync([]);
            //alternativa usare detach() cioè $project->technologies()->detach();
        }

        return to_route('projects.show', $project);
    }

    public function restore(Request $request, Project $project)
    {

        if ($project->trashed()) {
            $project->restore();

            $request->session()->flash('message', 'Il progetto è stato ripristinato.');
        }

        return back();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        if ($project->trashed()) {
            $project->forceDelete(); // eliminazione definitiva
        } else {
            $project->delete(); // soft
        }
        return back();
    }

}
