<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['id','name','location','slug','details','status'];

    public function media()
    {
        return $this->morphMany(Media::class, 'mediable');
    }

    public function causes()
    {
        return $this->hasMany(Cause::class);
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
