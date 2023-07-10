<?php

namespace App\Http\Controllers\Admin;

use App\Models\Title;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TitleStoreRequest;
use App\Http\Requests\TitleUpdateRequest;
use App\Models\Page;

/**
 * Class TitleController
 * @package App\Http\Controllers
 */
class TitleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $titles = Title::all();
        return view('admin.titles.index', compact('titles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        
        $title = new Title();
        $pages = Page::all()->pluck('name', 'id');
        return view('admin.titles.create', compact('title', 'pages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(TitleStoreRequest $request)
    {
        $request->validated();

        $title = Title::create($request->all());

        flash()->overlay(trans('global.created-succesfully'), trans('global.saved-title'));

        return redirect()->route('titles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Title $title){
       
        return view('admin.titles.show', compact('title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Title $title){

        $pages = Page::all()->pluck('name', 'id');
        return view('admin.titles.edit', compact('title', 'pages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Title $title
     * @return \Illuminate\Http\Response
     */
    public function update(TitleUpdateRequest $request, Title $title)
    {
        $request->validated();

        $title->update($request->all());

        flash()->overlay(trans('global.updated-succesfully'), trans('global.updated-title'));

        return redirect()->route('titles.index');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Title $title)
    {
        $title->delete();

        flash()->overlay(trans('global.deleted-succesfully'), trans('global.deleted-title'));
        return redirect()->route('titles.index');
    }
}
