<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceStoreRequest;
use App\Http\Requests\ServiceUpdateRequest;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Media;
use Illuminate\Support\Facades\File;

/**
 * Class ServiceController
 * @package App\Http\Controllers
 */
class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::all();
        return view('admin.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){

        $service = new Service();
        $pages = Page::all()->pluck('name', 'id');
        return view('admin.services.create', compact('service', 'pages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceStoreRequest $request)
    {
        $request->validated();

        $service = Service::create($request->all());

        foreach ($request->input('images', []) as $file) {
            $service->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('images', 'services-media');
        }

        flash()->overlay('"'. $service->title . '"' . trans('global.created-succesfully'), trans('global.saved-service'));

        return redirect()->route('services.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service){

        return view('admin.services.show', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service){

        $pages = Page::all()->pluck('name', 'id');
        return view('admin.services.edit', compact('service', 'pages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Service $service
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceUpdateRequest $request, Service $service){

        $request->validated();

        $service->update($request->all());

        if (($service->getMedia('images'))) {
            foreach ($service->getMedia() as $media) {
                if (!in_array($media->file_name, $request->input('images', []))) {
                    $media->delete();
                }
            }
        }
    
        $media = $service->getMedia()->pluck('file_name')->toArray();
    
        foreach ($request->input('images', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $service->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('images','services-media');
            }
        }
    
        
        flash()->overlay('"'. $service->title . '"' . trans('global.updated-succesfully'), trans('global.updated-service'));

        return redirect()->route('services.index');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Service $service){

        $service->delete();

        flash()->overlay('"'. $service->title . '"' . trans('global.deleted-succesfully'), trans('global.deleted-service'));

        return redirect()->route('services.index');
    }



    public function storeMedia(Request $request){
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

    public function deleteMedia(Media $media){

        //Delete on the server         
        File::delete(public_path('media/services/' . $media->model_id . '/' . $media->file_name));

        //Delete on the database
        $media->delete();

        flash()->overlay(trans('global.deleted-succesfully'), trans('global.delete-image'));

        return redirect()->back();
    }
}
