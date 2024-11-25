<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerAddress extends Model
{
    use HasFactory;
    protected $table = 'customer_address';
    protected $fillable = [
        'idUser',
        'address_house',
        'address_street',
        'area',
        'landmark',
        'city',
        'state',
        'pincode',
        'type',
        'active',
    ];
    protected $casts = [
        'updated_at' => 'datetime:d-m-Y',
    ];
    protected $hidden = [
        'created_at',
    ];
}
