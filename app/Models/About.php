<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;

    protected $fillable = ['id','name','slug','details','status'];

    public function media()
    {
        return $this->morphMany(Media::class, 'mediable');
    }

    public function getCreatedAtAttribute($date)
    {
        return date('j M, Y', strtotime($date));
    }

    /**
     * @param $date
     * @return string
     */
    public function getUpdatedAtAttribute($date)
    {
        return date('j M, Y', strtotime($date));
    }
}
