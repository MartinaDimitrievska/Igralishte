<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BrandTag extends Pivot
{
    use HasFactory;

    protected $fillable = [
        'brand_id',
        'tag_id',
    ];

    protected $table = 'brand_tag';
}
