<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MobileConfig extends Model
{
    use HasFactory;
    protected $table = 'mobile_config';
    protected $fillable = [
        'section', 'type', 'title', 'subtitle', 'body', 'actionName', 'actionLink', 'colspan', 'layout','position'
    ];
    protected $casts = [
        'updated_at' => 'datetime:d-m-Y',
    ];
    protected $hidden = [
        'created_at','id'
    ];
}
