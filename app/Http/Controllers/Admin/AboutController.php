<?php

namespace App\Http\Controllers\Admin;

use App\Models\About;
use App\Http\Controllers\Controller;
use App\Http\Requests\AboutStoreRequest;
use App\Http\Requests\AboutUpdateRequest;
use App\Models\Page;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

/**
 * Class AboutController
 * @package App\Http\Controllers
 */
class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $abouts = About::all();

        return view('admin.abouts.index', compact('abouts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $about = new About();
        // return view('about.create', compact('about'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(AboutStoreRequest $request)
    {
        $request->validated();

        $about = About::create($request->all());

        foreach ($request->input('images', []) as $file) {
            $about->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('images', 'abouts-media');
        }

        flash()->overlay('"'. $about->name . '"' . trans('global.created-succesfully'), trans('global.saved-about'));

        return redirect()->route('abouts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(About $about)
    {

        return view('admin.abouts.show', compact('about'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(About $about)
    {
        $pages = Page::all()->pluck('name', 'id');

        return view('admin.abouts.edit', compact('about', 'pages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  About $about
     * @return \Illuminate\Http\Response
     */
    public function update(AboutUpdateRequest $request, About $about)
    {
        $request->validated();

        $about->update($request->all());

        if (($about->getMedia('images'))) {
            foreach ($about->getMedia() as $media) {
                if (!in_array($media->file_name, $request->input('images', []))) {
                    $media->delete();
                }
            }
        }
    
        $media = $about->getMedia()->pluck('file_name')->toArray();
    
        foreach ($request->input('images', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $about->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('images','abouts-media');
            }
        }
    
        
        flash()->overlay('"'. $about->name . '"' . trans('global.updated-succesfully'), trans('global.updated-about'));

        return redirect()->route('abouts.index');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(About $about)
    {
        $about->delete();

        flash()->overlay('"'. $about->name . '"' . trans('global.deleted-succesfully'), trans('global.deleted-about'));

        return redirect()->route('abouts.index');
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
        File::delete(public_path('media/abouts/' . $media->model_id . '/' . $media->file_name));

        
        //Borrem de la base de dades
        $media->delete();

        flash()->overlay(trans('global.deleted-succesfully'), trans('global.delete-image'));

        return redirect()->back();
    }
}
