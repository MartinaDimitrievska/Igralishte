<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductDiscount extends Pivot
{
    protected $fillable = [
        'product_id',
        'discount_id',
    ];

    protected $table = 'discount_product';
}
