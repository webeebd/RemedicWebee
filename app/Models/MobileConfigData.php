<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MobileConfigData extends Model
{
    use HasFactory;
    protected $table = 'mobile_config_data';
    protected $fillable = [
        'idSection', 'idProduct', 'backgorund', 'imageUrl', 'actionName', 'actionLink'
    ];
    protected $casts = [
        'updated_at' => 'datetime:d-m-Y',
    ];
    protected $hidden = [
        'created_at',
    ];
}
