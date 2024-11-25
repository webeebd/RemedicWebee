<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderPayments extends Model {

    use HasFactory;

    protected $table = 'order_payments';
    protected $fillable = [
        'idOrder',
        'payment_mode',
        'payment_status',
    ];
    protected $casts = [
        'updated_at' => 'datetime:d-m-Y',
    ];
    protected $hidden = [
        'created_at',
    ];

}
