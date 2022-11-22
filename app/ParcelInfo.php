<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class ParcelInfo extends Model
{
    protected $fillable = ['item_description','item_value','length','width','height','actual_weight','chargeable_weight','status','created_at','updated_at'];
}