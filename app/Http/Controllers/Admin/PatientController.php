<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\Disease;
use App\Model\Admin\Patient;
use App\Model\Admin\PatientHistory;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('patient_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $patients = Patient::all();
        $patient_histories = PatientHistory::all();

        return view('admin.patient.index', compact('patients', 'patient_histories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('patient_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $diseases = Disease::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.patient.create', compact('diseases'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        // $doctor = Patient::create($request->all());
        $doctor = Patient::create($request->all());
        $doctor->diseases()->sync($request->input('diseases', []));

        return redirect()->route('patients.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort_if(Gate::denies('patient_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $patient = Patient::find($id);
        //$patient_history = PatientHistory::find($id);
        //$patient_history->load('patient', 'doctor', 'medicines', 'diseases');

        return view('admin.patient.show', compact('patient'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient)
    {
        // abort_if(Gate::denies('patient_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // $patient = Patient::where('id',$id)->first();
        // $doctors = Disease::all()->pluck('name', 'id');
        // return view('admin.patient.edit', compact('doctors','patient'));
        $diseases = Disease::all()->pluck('name', 'id');

        $patient->load('diseases');

        return view('admin.patient.edit', compact('diseases', 'patient'));
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
        $doctor=Patient::find($id);
        $doctor->name = $request->name;
        $doctor->disease_id = $request->disease_id;
        $doctor->age = $request->age;
        $doctor->phone = $request->phone;
        $doctor->address = $request->address;
        $doctor->remark = $request->remark;
        $doctor->save();

        return redirect(route('patients.index'))->with('success_message', 'western Doctor was Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort_if(Gate::denies('patient_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        Patient::where('id', $id)->delete();
        return redirect()->back()->with('success_message', 'Patient was Deleted');

    }
}
