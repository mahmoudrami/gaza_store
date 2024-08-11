<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function category(){
        return $this->belongsTo(Category::class)->withDefault();
    }

    public function imageable(){
        return $this->morphMany(Image::class,'imageable')->where('type', 'gallery');
    }

    public function reviews(){
        return $this->hasMany(Review::class);
    }

    public function carts(){
        return $this->hasMany(Review::class);
    }

    public function order_details(){
        return $this->hasMany(OrderDetail::class);
    }
}
