<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'products_categories';

    protected $fillable = [
        'product_category_name',
        'product_category_description'
    ];
}
