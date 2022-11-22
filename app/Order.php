<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['order_id','shipment_method','service_type','cod','description','paid_by','is_fragile','quantity','alternate_phone1','alternate_phone2','not_delivered','delivery_boy_id','drop_off_location_id','parcel_info_id','sender_info_id','shipment_size_id','status','created_at','updated_at'];
    
    public function parcel_info()
    {
        return $this->belongsTo('\App\ParcelInfo','parcel_info_id');
    }
    
    public function sender_info()
    {
        return $this->belongsTo('\App\SenderInfo','sender_info_id');
    }
    
    public function drop_off_location()
    {
        return $this->belongsTo('\App\DropOffLocations','drop_off_location_id');
    }
    
    public function delivery_boy()
    {
        return $this->belongsTo('\App\DeliveryBoy','delivery_boy_id');
    }
    
    public function shipment_size()
    {
        return $this->belongsTo('\App\ShipmentSize','shipment_size_id');
    }
    
}