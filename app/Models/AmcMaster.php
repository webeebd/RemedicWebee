<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AmcMaster extends Model
{
    use HasFactory;
    protected $table = 'amc_master';
    protected $fillable = [
        'name',
        'description',
        'duration',
        'unit',
        'type',
        'price',
        'offerings',
        'active',
    ];
    protected $casts = [
        'updated_at' => 'datetime:d-m-Y',
    ];
    protected $hidden = [
        'created_at',
    ];
}
