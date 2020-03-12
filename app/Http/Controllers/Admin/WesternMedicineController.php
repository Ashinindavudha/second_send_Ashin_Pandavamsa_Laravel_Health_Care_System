<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\Medicine;
use Gate;
use Symfony\Component\HttpFoundation\Response;
class WesternMedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('western_medicine_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $westerns = Medicine::all();
        return view('admin.western_medicine.index', compact('westerns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.western_medicine.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $medicine = Medicine::create($request->all());

        return redirect()->route('westernmedicines.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort_if(Gate::denies('western_medicine_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $western = Medicine::find($id);
        return view('admin.western_medicine.show', compact('western'));
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
        $western = Medicine::where('id',$id)->first();

        return view('admin.western_medicine.edit', compact('western'));
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
        $western=Medicine::find($id);
        $western->name = $request->name;
        $western->save();

        return redirect(route('westernmedicines.index'))->with('success_message', 'western medicine was Updated');

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

        Medicine::where('id', $id)->delete();
        return redirect()->back()->with('success_message', 'western medicine was Deleted');
    }
}
