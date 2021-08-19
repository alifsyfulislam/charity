<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cause extends Model
{
    use HasFactory;

    protected $fillable = ['id','featured_status','event_id','name','slug','details','status','target_fund','raised_fund','start_date','end_date'];

    public function media()
    {
        return $this->morphMany(Media::class, 'mediable');
    }


    public function slider()
    {
        return $this->hasOne(Slider::class,'cause_id');
    }

//    public function event()
//    {
//
//        return $this->belongsTo(Event::class);
//
//    }

    public function contents()
    {
        return $this->hasMany(Content::class,'link_id');
    }

    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }

    public function getCreatedAtAttribute($date)
    {

        return date('j M, Y', strtotime($date));

    }

    public function getUpdatedAtAttribute($date)
    {

        return date('j M, Y', strtotime($date));

    }
}
