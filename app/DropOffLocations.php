<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class DropOffLocations extends Model
{
    protected $fillable = ['receipt_name','phone_code','phone_number','refrence_id','receipt_email','country','city','region','street','address','building_villa','office_apartment','nearest_land_mark','address_type','status','created_at','updated_at'];
}