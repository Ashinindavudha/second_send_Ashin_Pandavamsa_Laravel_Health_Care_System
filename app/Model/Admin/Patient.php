<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
     const GENDER_SELECT = [
        'Male'   => 'Male',
        'Female' => 'Female',
    ];
     protected $fillable = [
        'name',
        'disease_id',
        'age',
        'gender',
        'phone',
        'address',
        'remark',
        'created_at',
        'updated_at',
        'deleted_at',
    ];


    // public function disease()
    // {
    //     return $this->belongsTo(Disease::class, 'disease_id');
    // }
    public function diseases()
    {
        return $this->belongsToMany(Disease::class);

    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->width(50)->height(50);

    }

    public function patientTreatments()
    {
        return $this->hasMany(Treatment::class, 'patient_id', 'id');

    }

    public function getAppointmentDateAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;

    }

    public function setAppointmentDateAttribute($value)
    {
        $this->attributes['appointment_date'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;

    }

    // public function diseases()
    // {
    //     return $this->belongsToMany(Disease::class);

    // }
}
