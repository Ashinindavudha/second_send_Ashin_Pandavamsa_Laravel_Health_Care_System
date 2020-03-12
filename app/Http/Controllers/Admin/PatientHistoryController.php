<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\Disease;
use App\Model\Admin\Patient;
use App\Model\Admin\Doctor;
use App\Model\Admin\Medicine;
use App\Model\Admin\PatientHistory;
use Gate;
use Symfony\Component\HttpFoundation\Response;


class PatientHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('treatment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $treatments = PatientHistory::all();

        return view('admin.patient_history.index', compact('treatments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $patients = Patient::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $doctors = Doctor::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $medicines = Medicine::all()->pluck('name', 'id');

        $diseases = Disease::all()->pluck('name', 'id');

        return view('admin.patient_history.create', compact('patients', 'doctors', 'diseases', 'medicines'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $treatment = PatientHistory::create($request->all());
        $treatment->medicines()->sync($request->input('medicines', []));
        $treatment->diseases()->sync($request->input('diseases', []));

        // if ($media = $request->input('ck-media', false)) {
        //     Media::whereIn('id', $media)->update(['model_id' => $treatment->id]);
        // }

        return redirect()->route('histories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(PatientHistory $history)
    {
        abort_if(Gate::denies('treatment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $history->load('patient', 'doctor', 'medicines', 'diseases');

        return view('admin.patient_history.show', compact('history'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort_if(Gate::denies('treatment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cure = PatientHistory::where('id',$id)->first();
        
        $patients = Patient::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $doctors = Doctor::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $medicines = Medicine::all()->pluck('name', 'id');

        $diseases = Disease::all()->pluck('name', 'id');

        $cure->load('patient', 'doctor', 'medicines', 'diseases');

        return view('admin.patient_history.edit', compact('patients', 'doctors', 'medicines', 'diseases', 'cure'));
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
        $cure=PatientHistory::find($id);
       
       $cure->update($request->all());
        $cure->medicines()->sync($request->input('medicines', []));
        $cure->diseases()->sync($request->input('diseases', []));

        return redirect()->route('histories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort_if(Gate::denies('treatment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        PatientHistory::where('id', $id)->delete();

        return back();
    }
}
