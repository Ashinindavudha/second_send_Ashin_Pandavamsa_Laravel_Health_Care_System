<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    public $table = 'medicines';

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

    public function medicineTreatments()
    {
        return $this->belongsToMany(Treatment::class);

    }
    // protected $fillable = [
    //     'name',
    //     'created_at',
    //     'updated_at',
    //     'deleted_at',
    // ];

    // // public function treatments()
    // // {
    // //     return $this->belongsToMany(Treatment::class);

    // // }
    // public function medicineTreatments()
    // {
    //     return $this->belongsToMany(Treatment::class);

    // }
}
