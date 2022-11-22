<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class DeliveryBoy extends Model
{
    protected $fillable = ['name','contact','email','password','address','status','created_at','updated_at'];
}
