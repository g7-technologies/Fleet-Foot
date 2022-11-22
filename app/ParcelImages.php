<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class ParcelImages extends Model
{
    protected $fillable = ['order_id','image','created_at','updated_at'];
}
