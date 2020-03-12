<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\Disease;
use Gate;
use Symfony\Component\HttpFoundation\Response;


class WesternDiseaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('western_disease_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $diseases = Disease::all();
        return view('admin.western_disease.index', compact('diseases'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.western_disease.create');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $disease = Disease::create($request->all());

        return redirect()->route('westerndiseases.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort_if(Gate::denies('western_disease_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $disease = Disease::find($id);
        return view('admin.western_disease.show', compact('disease'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort_if(Gate::denies('western_medicine_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $disease = Disease::where('id',$id)->first();

        return view('admin.western_disease.edit', compact('disease'));
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
        $disease=Disease::find($id);
        $disease->name = $request->name;
        $disease->save();

        return redirect(route('westerndiseases.index'))->with('success_message', 'western Disease was Updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort_if(Gate::denies('western_medicine_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        Disease::where('id', $id)->delete();
        return redirect()->back()->with('success_message', 'western medicine was Deleted');
    }
}
