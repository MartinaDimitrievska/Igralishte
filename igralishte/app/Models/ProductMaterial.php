<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductMaterial extends Pivot
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'material_id',
    ];

    protected $table = 'material_product';
}
