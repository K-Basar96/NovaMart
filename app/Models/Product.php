<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'price', 'stock', 'category_id', 'brand_id', 'image'];

    // Many-to-One: A Product belongs to a Category

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Many-to-One: A Product optionally belongs to a Brand

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    // Many-to-Many: A Product can be part of many Orders
    public function orders()
    {
        return $this->belongsToMany(Order::class)
                    ->withPivot('quantity', 'price');
    }
}
