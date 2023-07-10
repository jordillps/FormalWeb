<?php

namespace App\Http\Controllers\Admin;

use App\Models\LegalPage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LegalPagesStoreRequest;
use App\Http\Requests\LegalPagesUpdateRequest;

/**
 * Class LegalPageController
 * @package App\Http\Controllers
 */
class LegalPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $legalPages = LegalPage::all();

        return view('admin.legal-pages.index', compact('legalPages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $legalPage = new LegalPage();
        return view('admin.legal-pages.create', compact('legalPage'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(LegalPagesStoreRequest $request)
    {
        $request->validated();

        $legalPage = LegalPage::create($request->all());

        flash()->overlay('"'. $legalPage->title . '"' . trans('global.created-succesfully'), trans('global.saved-legal-page'));

        return redirect()->route('legal-pages.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(LegalPage $legalPage)
    {
        
        return view('admin.legal-pages.show', compact('legalPage'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(LegalPage $legalPage)
    {
        
        return view('admin.legal-pages.edit', compact('legalPage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  LegalPage $legalPage
     * @return \Illuminate\Http\Response
     */
    public function update(LegalPagesUpdateRequest $request, LegalPage $legalPage)
    {
        $request->validated();

        $legalPage->update($request->all());

        flash()->overlay('"'. $legalPage->title . '"' . trans('global.updated-succesfully'), trans('global.updated-legal-page'));

        return redirect()->route('legal-pages.index');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(LegalPage $legalPage)
    {
        $legalPage->delete();

        flash()->overlay('"'. $legalPage->title . '"' . trans('global.deleted-succesfully'), trans('global.deleted-legal-page'));
        return redirect()->route('legal-pages.index');
    }
}
