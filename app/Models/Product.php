<?php

namespace App\Models;

use App\Traits\trans;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory,trans;

    protected $guarded = [];


    public function category(){
        return $this->belongsTo(Category::class)->withDefault();
    }

    public function image(){
        return $this->morphOne(Image::class,'imageable')->where('type', 'main');
    }

    public function gallery(){
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

    public function getimgPathAttribute(){
        if($this->image)
            return asset('images/products/'.$this->image->path);
        else
            return asset('images/default.jpg');
    }

}
