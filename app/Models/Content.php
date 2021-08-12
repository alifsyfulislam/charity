<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    protected $fillable = ['link_id','content_body'];

//    public function service()
//    {
//
//        return $this->belongsTo(Service::class,'id');
//
//    }

    public function event()
    {

        return $this->belongsTo(Service::class,'id');

    }

    public function cause()
    {

        return $this->belongsTo(Cause::class,'id');

    }

    public function faq()
    {

        return $this->belongsTo(Faq::class,'id');

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
