<?php

namespace App\Models;

use App\Models\Cart;
use App\Models\Wishlist;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {
    use HasFactory, Notifiable;

    protected $fillable = [ 'name', 'email', 'phone', 'password', 'image', ];
    protected $hidden = [ 'password', 'remember_token' ];

    public function wishlists() {
        return $this->hasMany( Wishlist::class );
    }

    public function carts() {
        return $this->hasMany( Cart::class );
    }

    // Relationship to Orders

    public function orders() {
        return $this->hasMany( Order::class );
    }

    public function address() {
        return $this->hasMany( Address::class );
    }

}
