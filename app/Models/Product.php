<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'product_url',
        'product_description',
        'product_category_id',
        'product_brand_id',
        'product_price'
    ];
    
    public $timestamps = false;
}
