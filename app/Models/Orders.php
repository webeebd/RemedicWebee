<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    
    protected $table = 'orders';
    protected $fillable = [
        'idUser',
        'discount',
        'tax',
        'subtotal',
        'delivery_charges',
        'cod_charges',
        'discount_coupon',
        'total',
        'order_date',
        'label',
        'billNumber'
        
    ];
    protected $casts = [
        'updated_at' => 'datetime:d-m-Y',
    ];
    protected $hidden = [
        'created_at',
    ];
}
