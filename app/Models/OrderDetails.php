<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    use HasFactory;
    protected $table = 'order_details';
    protected $fillable = [
        'status',
        'shipment_partner',
        'shipmentNumber',
        'ship_date',
        'shipment_detail',
        'shipment_link',
        'idProduct',
        'idProduct','idOrder','idAddress','orderNumber','qty','size'
        ,'unit_price','base_price','discount','tax','subtotal','discount_coupon','total',
        'delivery_charges','cod_charges','order_date','warranty_valid','additional_info'
        ,'label','status','return_qty'
    ];
    protected $casts = [
        'order_date' => 'datetime:d-m-Y',
        'ship_date' => 'datetime:d-m-Y',
    ];
    protected $hidden = [
        'created_at',
    ];
}
