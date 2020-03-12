<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class WesternDoctor extends Model
{
    protected $fillable = [
        'name',
        'disease_id',
        'duty_day',
        'gender',
        'phone',
        'email',
        'description',
        'created_at',
        'updated_at',
        'deleted_at',
    ];


    public function disease()
    {
        return $this->belongsTo(Disease::class, 'disease_id');
    }
}
