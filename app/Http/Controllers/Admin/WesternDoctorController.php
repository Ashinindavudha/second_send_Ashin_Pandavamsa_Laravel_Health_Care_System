<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreDoctorRequest;
use App\Http\Requests\UpdateDoctorRequest;
use App\Model\Admin\Disease;
use App\Model\Admin\Doctor;
use Gate;
use Symfony\Component\HttpFoundation\Response;


class WesternDoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('western_doctor_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $doctors = Doctor::all();
        return view('admin.western_doctor.index', compact('doctors'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('western_doctor_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $diseases = Disease::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.western_doctor.create', compact('diseases'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDoctorRequest $request)
    {
        //dd($request);
        // $doctor = Doctor::create($request->all());

        // return redirect()->route('westerndoctors.index');
        $doctor = Doctor::create($request->all());
        $doctor->diseases()->sync($request->input('diseases', []));

        // if ($media = $request->input('ck-media', false)) {
        //     Media::whereIn('id', $media)->update(['model_id' => $doctor->id]);
        // }

        return redirect()->route('westerndoctors.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort_if(Gate::denies('western_doctor_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $surgeon = Doctor::find($id);
        return view('admin.western_doctor.show', compact('surgeon'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // abort_if(Gate::denies('western_medicine_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // $doctor = Doctor::where('id',$id)->first();
        // $doctors = Disease::all()->pluck('name', 'id');
        // return view('admin.western_doctor.edit', compact('doctors','doctor'));
       //dd($doctor);
        //abort_if(Gate::denies('western_doctor_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $physician = Doctor::where('id',$id)->first();
        $diseases = Disease::all()->pluck('name', 'id');

        $physician->load('diseases');

        return view('admin.western_doctor.edit', compact('diseases', 'physician'));

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
        // $doctor=Doctor::find($id);
        // $doctor->name = $request->name;
        // $doctor->disease_id = $request->disease_id;
        // $doctor->duty_day = $request->duty_day;
        // $doctor->phone = $request->phone;
        // $doctor->email = $request->email;
        // $doctor->description = $request->description;
        // $doctor->save();

        // return redirect(route('westerndoctors.index'))->with('success_message', 'western Doctor was Updated');
        $physician=Doctor::find($id);
        $physician->update($request->all());
        $physician->diseases()->sync($request->input('diseases', []));

        return redirect()->route('westerndoctors.index');
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

        Doctor::where('id', $id)->delete();
        return redirect()->back()->with('success_message', 'Western Doctor was Deleted');
    }
}
