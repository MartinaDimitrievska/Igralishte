<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiftCard extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'value',
        'is_redeemed',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}