<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model {
    use HasFactory;
    protected $guarded = [];

    protected $casts = [
        'items' => 'array', // Cast the items column to an array
        'address' => 'array',
    ];

    public function user() {
        return $this->belongsTo( User::class );
    }

    // Many-to-Many: An Order can have many Products

    public function products() {
        return $this->belongsToMany( Product::class )
        ->withPivot( 'quantity', 'price' );
    }
}
