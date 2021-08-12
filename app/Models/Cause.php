<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cause extends Model
{
    use HasFactory;

    protected $fillable = ['id','event_id','name','slug','details','status','target_fund','raised_fund'];

    public function media()
    {
        return $this->morphMany(Media::class, 'mediable');
    }

    public function event()
    {

        return $this->belongsTo(Event::class);

    }

    public function contents()
    {
        return $this->hasMany(Content::class,'link_id');
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
