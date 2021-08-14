<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = ['id','event_id','name','slug','details','status'];

    public function media()
    {
        return $this->morphMany(Media::class, 'mediable');
    }

    public function cause()
    {

        return $this->belongsTo(Cause::class);

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
