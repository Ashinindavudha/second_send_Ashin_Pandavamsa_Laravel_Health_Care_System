<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;


class PatientHistory extends Model
{
    public $table = 'patient_histories';

    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
        'start_treatment_date',
    ];

    protected $fillable = [
        'xray',
        'remark',
        'weight',
        'doctor_id',
        'operation',
        'patient_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'blood_group',
        'temperature',
        'check_patient',
        'blood_pressure',
        'start_treatment_date',
    ];

    const XRAY_SELECT = [
        'ဓာတ်မှန်ရိုက်ရန်လိုအပ်'  => 'ဓာတ်မှန်ရိုက်ရန်လိုအပ်',
        'ဓာတ်မှန်ရိုက်ရန်မလိုအပ်' => 'ဓာတ်မှန်ရိုက်ရန်မလိုအပ်',
        'အမ်ထရာဆောင်ရိုက်ရန်လိုအပ်' => 'အမ်ထရာဆောင်ရိုက်ရန်လိုအပ်',
        'အမ်ထရာဆောင်ရိုက်ရန်မလိုအပ်' => 'အမ်ထရာဆောင်ရိုက်ရန်မလိုအပ်',

    ];

    const OPERATION_SELECT = [
        'ခွဲစိတ်ကုသရန်မလိုအပ်' => 'ခွဲစိတ်ကုသရန်မလိုအပ်',
        'ခွဲစိတ်ကုသရန်လိုအပ်'  => 'ခွဲစိတ်ကုသရန်လိုအပ်',
        'ရိုးရိုးဖျားနာ'       => 'ရိုးရိုးဖျားနာ',
    ];

    const CHECK_PATIENT_RADIO = [
        'Active'                   => 'Active',
        'Treatmented'              => 'Treatmented',
        'Cancel'                   => 'Cancel',
        'Waiting'                  => 'Waiting',
        'First_Time'               => 'First_Time',
        'Second_Time'              => 'Second_Time',
        'Third_Time'               => 'Third_Time',
        'Fourth_Time'              => 'Fourth_Time',
        'Fifth_Time'               => 'Fifth_Time',
        'Sixth_Time'               => 'Sixth_Time',
        'Seventh_Time'             => 'Seventh_Time',
        'Change To Other Hospital' => 'Change To Other Hospital',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');

    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');

    }

    public function medicines()
    {
        return $this->belongsToMany(Medicine::class);

    }
    public function diseases()
    {
        return $this->belongsToMany(Disease::class);

    }
}
