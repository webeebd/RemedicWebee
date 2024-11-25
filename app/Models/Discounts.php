<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discounts extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'type',
        'total',
        'expire_date',
        'max_redeem',
        'min_amount',
        'current_redeem',
        'idCategory',
        'active',
    ];
    protected $casts = [
        'updated_at' => 'datetime:d-m-Y',
        'expire_date' => 'datetime:d-m-Y',
    ];
    protected $hidden = [
        'created_at',
    ];
}
