<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $fillable = ['sender_id','account_number','account_title','bank_name','branch','status','created_at','updated_at'];
    
    public function sender_details()
    {
        return $this->belongsTo('\App\SenderInfo','sender_id');
    }
}