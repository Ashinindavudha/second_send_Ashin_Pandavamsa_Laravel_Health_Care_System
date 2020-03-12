<?php

namespace App\Http\Controllers\Admin;
use App\Model\Admin\Disease;
use App\Model\Admin\Patient;
use App\Model\Admin\Doctor;
use App\Model\Admin\Medicine;
use App\Model\Admin\PatientHistory;
use Gate;
use Symfony\Component\HttpFoundation\Response;


class HomeController
{
    public function index()
    {
        // $patients = Patient::all();
        // return view('home', compact('patients'));
        $patient_count = Patient::count();
        $doctor_count = Doctor::count();
        $medicine_count = Medicine::count();
        return view('home', compact(['patient_count', 'doctor_count', 'medicine_count']));
    }
}
