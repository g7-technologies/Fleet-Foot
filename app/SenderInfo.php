<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class SenderInfo extends Authenticatable
{
    protected $fillable = ['name','phone_code','phone_number','email','password','country','city','region','street','address','building_villa','office_apartment','residential_type','nearest_land_mark','status','token','created_at','updated_at'];
    protected $hidden = ['password','token'];
}