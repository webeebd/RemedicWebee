<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'thumbnail',
        'ribbon',
        'description',
        'active',
    ];
    protected $casts = [
        'updated_at' => 'datetime:d-m-Y',
    ];
    protected $hidden = [
        'created_at',
    ];
}