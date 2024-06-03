<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class BrandProductCategory extends Pivot
{
    use HasFactory;

    protected $fillable = [
        'brand_id',
        'product_category_id',
    ];

    protected $table = 'brand_product_category';
}
