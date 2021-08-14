<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = ['id','name','details','status','slug','cause_id'];

    public function media()
    {
        return $this->morphMany(Media::class, 'mediable');
    }

    public function cause()
    {
        return $this->belongsTo(Cause::class,'cause_id');
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
