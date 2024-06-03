<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductSize extends Pivot
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'size_id',
    ];

    protected $table = 'product_size';
}
