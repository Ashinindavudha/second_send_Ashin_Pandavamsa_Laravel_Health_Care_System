<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
class Post extends Model implements HasMedia
{
    use HasMediaTrait;
    
    public $table = 'posts';
    protected $appends = [
        'file',
    ];

    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
        
    ];

    protected $fillable = [
        'title',
        'doctor_id',
        'description',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }
    public function diseases()
    {
        return $this->belongsToMany(Disease::class);

    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
        ->width(368)
        ->height(232);
        //$this->addMediaConversion('bigthumb')->width(200)->height(200);

    }
    public function getLogoAttribute()
    {
        $file = $this->getMedia('logo')->first();

        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
        }

        return $file;
    }
}
