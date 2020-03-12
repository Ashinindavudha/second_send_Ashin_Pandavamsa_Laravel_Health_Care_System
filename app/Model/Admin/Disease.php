<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Disease extends Model
{
    public $table = 'diseases';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function diseaseDoctors()
    {
        return $this->belongsToMany(Doctor::class);

    }

    public function diseasePatients()
    {
        return $this->belongsToMany(Patient::class);

    }

    public function diseasePatientHistories()
    {
        return $this->belongsToMany(Treatment::class);

    }
    public function diseasePost()
    {
        return $this->hasMany(Post::class, 'post_id', 'id');

    }
    // protected $fillable = [
    //     'name',
    //     'description',
    //     'created_at',
    //     'updated_at',
    //     'deleted_at',
    // ];

    // // public function patients()
    // // {
    // //     return $this->belongsToMany(Patient::class);

    // // }

    // public function diseaseDoctors()
    // {
    //     return $this->belongsToMany(Doctor::class);

    // }

    // public function diseasePatients()
    // {
    //     return $this->belongsToMany(Patient::class);

    // }

    // public function diseaseTreatments()
    // {
    //     return $this->belongsToMany(Treatment::class);

    // }

}
