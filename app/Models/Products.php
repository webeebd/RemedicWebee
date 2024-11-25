<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'title',
        'manufacture',
        'genericName',
        'skuc_code',
        'country_origin',
        'pack_size',
        'pic',
        'slug',
        'brand_id',
        'modelNumber',
        'other_details',
        'warranty',
        'hsn_code',
        'short_description',
        'description',
        'purchase_price',
        'sales_price',
        'max_retail_price',
        'tax_amount',
        'minStock',
        'maxStock',
        'stock',
        'minBuy',
        'maxBuy',
        'active',
        'tax',
        'stockAlert',
        'pre_discount',
        'category_id',
        'tax_amount',
        'amc_id'        
    ];
    
    protected $casts = [
        'updated_at' => 'datetime:d-m-Y',
    ];
    protected $hidden = [
        'created_at',
    ];
}
