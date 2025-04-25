<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'total_amount', 'address'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id'); 
    }
    public function product()
    {
        return $this->belongsTo(Product::class,'order_items');
    }
}