<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class ShipmentSize extends Model
{
    protected $fillable = ['name','measuring_unit','length','width','height','chargeable_weight','status','created_at','updated_at'];
}