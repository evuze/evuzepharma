<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TCG\Voyager\Http\Controllers\VoyagerBreadController;
use TCG\Voyager\Facades\Voyager;

use App\Pharmacy;
use Auth;

class PharmaciesController extends VoyagerBreadController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        parent::index($request);

        $slug = $this->getSlug($request);
        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();
        $get = Pharmacy::where('user_id', Auth::user()->id);
        $dataTypeContent = $get->get();

        $view = 'voyager::bread.browse';

        if (view()->exists("voyager::$slug.browse")) {
            $view = "voyager::$slug.browse";
        }

        // Check if BREAD is Translatable
        $isModelTranslatable = false;

        return view($view, compact('dataType', 'dataTypeContent', 'isModelTranslatable'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return parent::create($request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return parent::store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        if( ! getUserPharmacies()->contains($id) )
            abort(404);

        return parent::show($request, $id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        if( ! getUserPharmacies()->contains($id) )
            abort(404);

        return parent::edit($request, $id);
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
        if( ! getUserPharmacies()->contains($id) )
            abort(404);

        return parent::update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if( ! getUserPharmacies()->contains($id) )
            abort(404);

        return parent::destroy($request, $id);
    }
}
