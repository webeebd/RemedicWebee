<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PanelData extends Model
{
    use HasFactory;
    protected $table = 'panel_overview';
    protected $fillable = [
        'value',
    ];
    protected $casts = [
        'updated_at' => 'datetime:d-m-Y',
    ];
    protected $hidden = [
        'created_at',
    ];
}
