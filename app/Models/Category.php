<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'image'];
    public $timestamps = false;

    // One-to-Many: A Category has many Products

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
