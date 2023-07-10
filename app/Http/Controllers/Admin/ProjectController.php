<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Category;
use App\Models\Media;
use Illuminate\Http\Request;
use App\Http\Requests\ProjectStoreRequest;
use App\Http\Requests\ProjectUpdateRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\App;
 

/**
 * Class ProjectController
 * @package App\Http\Controllers
 */
class ProjectController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $project = new Project();
        $categories = Category::all()->pluck('name', 'id');
        return view('admin.projects.create', compact('project', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectStoreRequest $request)
    {
        
        $request->validated();

        $project = Project::create($request->all());

        //create Url
        $project->url = Str::slug($project->title);
        $project->save();

        foreach ($request->input('images', []) as $file) {
            $project->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('images', 'projects-media');
        }

        flash()->overlay('"'. $project->title . '"' . trans('global.created-succesfully'), trans('global.saved-project'));

        return redirect()->route('projects.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {

        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $categories = Category::all()->pluck('name', 'id');
        return view('admin.projects.edit', compact('project',  'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Project $project
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectUpdateRequest $request, Project $project)
    {
        $request->validated();

        $project->update($request->all());

        if(!isset($request->isPublished)){
            $project->isPublished = 0;
            $project->published_at = null;
            $project->save();
        }

        if (($project->getMedia('images'))) {
            foreach ($project->getMedia() as $media) {
                if (!in_array($media->file_name, $request->input('images', []))) {
                    $media->delete();
                }
            }
        }
    
        $media = $project->getMedia()->pluck('file_name')->toArray();
    
        foreach ($request->input('images', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $project->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('images','projects-media');
            }
        }
    
        
        flash()->overlay('"'. $project->title . '"' . trans('global.updated-succesfully'), trans('global.updated-project'));

        return redirect()->route('projects.index');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Project $project)
    {
        $project ->delete();

        flash()->overlay('"'. $project->title . '"' . trans('global.deleted-succesfully'), trans('global.deleted-project'));

        return redirect()->route('projects.index');
    }

    public function storeMedia(Request $request)
    {
        $path = storage_path('tmp/uploads');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file('file');

        $name = uniqid() . '_' . trim($file->getClientOriginalName());

        $file->move($path, $name);

        return response()->json([
            'name'          => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }

    public function deleteMedia(Media $media)
    {
        //Delete on the server 
        File::delete(public_path('media/projects/' . $media->model_id . "/" . $media->file_name));
       
        //Delete on the database
        $media->delete();

        flash()->overlay(trans('global.deleted-succesfully'), trans('global.delete-image'));

        return redirect()->route('projects.index');
    }
}
