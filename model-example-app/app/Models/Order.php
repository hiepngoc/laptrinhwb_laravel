<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public $timestamps = true;
    //quan hệ 1 nhiều với user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //liên kết tới products
    public function products()
    {
        return $this->belongsToMany(Product::class,"order_product")
            ->withPivot('quantity', 'price')
            ->withTimestamps();
    }
}
