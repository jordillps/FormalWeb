<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\HeaderStoreRequest;
use App\Http\Requests\HeaderUpdateRequest;
use App\Models\Header;
use App\Models\Page;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


/**
 * Class HeaderController
 * @package App\Http\Controllers
 */
class HeaderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $headers = Header::all();

        return view('admin.headers.index', compact('headers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $header = new Header();
        // return view('header.create', compact('header'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(HeaderStoreRequest $request)
    {
        $request->validated();

        $header = Header::create($request->all());

        foreach ($request->input('images', []) as $file) {
            $header->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('images', 'headers-media');
        }

        flash()->overlay('"'. $header->title . '"' . trans('global.created-succesfully'), trans('global.saved-header'));

        return redirect()->route('headers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Header $header)
    {
        return view('admin.headers.show', compact('header'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Header $header)
    {
        $pages = Page::all()->pluck('name', 'id');
        return view('admin.headers.edit', compact('header', 'pages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Header $header
     * @return \Illuminate\Http\Response
     */
    public function update(HeaderUpdateRequest $request, Header $header)
    {
        $request->validated();

        $header->update($request->all());

        if (($header->getMedia('images'))) {
            foreach ($header->getMedia() as $media) {
                if (!in_array($media->file_name, $request->input('images', []))) {
                    $media->delete();
                }
            }
        }
    
        $media = $header->getMedia()->pluck('file_name')->toArray();
    
        foreach ($request->input('images', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $header->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('images','headers-media');
            }
        }
    
        
        flash()->overlay('"'. $header->title . '"' . trans('global.updated-succesfully'), trans('global.updated-header'));

        return redirect()->route('headers.index');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Header $header)
    {
        $header->delete();

        flash()->overlay('"'. $header->title . '"' . trans('global.deleted-succesfully'), trans('global.deleted-header'));

        return redirect()->route('headers.index');
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
        File::delete(public_path('media/headers/' . $media->model_id . '/' . $media->file_name));

        //Delete on the database
        $media->delete();

        flash()->overlay(trans('global.deleted-succesfully'), trans('global.delete-image'));

        return redirect()->route('headers.index');
    }
}
