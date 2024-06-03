<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductColor extends Pivot
{
    protected $fillable = [
        'product_id',
        'color_id',
    ];

    protected $table = 'color_product';
}
