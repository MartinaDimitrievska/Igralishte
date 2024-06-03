<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductOrder extends Pivot
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'order_id',
    ];

    protected $table = 'order_product';
}
