<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    const GENDER_SELECT = [
        'Male'   => 'Male',
        'Female' => 'Female',
    ];
    protected $fillable = [
        'name',
        'disease_id',
        'duty_day',
        'duty_time',
        'gender',
        'phone',
        'email',
        'description',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    const DUTY_DAY_SELECT = [
        'Sunday To Monday'      => 'Sunday To Monday',
        'Sunday To Tuesday'     => 'Sunday To Tuesday',
        'Sunday To Wednesday'   => 'Sunday To Wednesday',
        'Sunday To Thursday'    => 'Sunday To Thursday',
        'Sunday To Friday'      => 'Sunday To Friday',
        'Sunday To Saturday'    => 'Sunday To Saturday',
        'Saturday To Sunday'    => 'Saturday To Sunday',
        'Saturday To Monday'    => 'Saturday To Monday',
        'Saturday To Tuesday'   => 'Saturday To Tuesday',
        'Saturday To Wednesday' => 'Saturday To Wednesday',
        'Saturday To Tursday'   => 'Saturday To Tursday',
        'Saturday To Friday'    => 'Saturday To Friday',
        'Friday To Monday'      => 'Friday To Monday',
        'Friday To Tuesday'     => 'Friday To Tuesday',
        'Friday To Wednesday'   => 'Friday To Wednesday',
        'Friday To Tursday'     => 'Friday To Thursday',
        'Friday To Saturday'    => 'Friday To Saturday',
        'Friday To Sunday'      => 'Friday To Sunday',
        'Tursday To Sunday'     => 'Tursday To Sunday',
        'Thursday To Saturday'  => 'Thursday To Saturday',
        'Thursday To Friday'    => 'Thursday To Friday',
        'Thursday To Tuesday'   => 'Thursday To Tuesday',
        'Thursday To Monday'    => 'Thursday To Monday',
        'Monday To Sunday'      => 'Monday To Sunday',
        'Monday To Tuesday'     => 'Monday To Tuesday',
        'Monday To Wednesday'   => 'Monday To Wednesday',
        'Monday To Thursday'    => 'Monday To Thursday',
        'Monday To Friday'      => 'Monday To Friday',
        'Monday To Saturday'    => 'Monday To Saturday',
        'Tuesday To Sunday'     => 'Tuesday To Sunday',
        'Tuesday To Saturday'   => 'Tuesday To Saturday',
        'Tuesday To Friday'     => 'Tuesday To Friday',
        'Tuesday To Thursday'   => 'Tuesday To Thursday',
        'Tuesday To Wednesday'  => 'Tuesday To Wednesday',
        'Tuesday To Monday'     => 'Tuesday To Monday',
        'Wednesday To Thursday' => 'Wednesday To Thursday',
        'Wednesday To Friday'   => 'Wednesday To Friday',
        'Wednesday To Saturday' => 'Wednesday To Saturday',
        'Wednesday To Sunday'   => 'Wednesday To Sunday',
        'Sunday'                => 'Sunday',
        'Monday'                => 'Monday',
        'Tuesday'               => 'Tuesday',
        'Wednesday'             => 'Wednesday',
        'Thursday'              => 'Thursday',
        'Friday'                => 'Friday',
        'Saturday'              => 'Saturday',
    ];


    // public function disease()
    // {
    //     return $this->belongsTo(Disease::class, 'disease_id');
    // }
     public function diseases()
    {
        return $this->belongsToMany(Disease::class);

    }
     public function doctorTreatments()
    {
        return $this->hasMany(Treatment::class, 'doctor_id', 'id');

    }
}
