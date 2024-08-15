<?php

namespace App\Models;

use App\Traits\trans;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory,trans;

    protected $guarded = [];

    public function products(){
        return $this->belongsTo(Product::class);
    }

    public function image(){
        return $this->morphOne(Image::class,'imageable')->where('type', 'main');
    }

    public function getimgPathAttribute(){
        if($this->image)
            return asset('images/categories/'.$this->image->path);
        else
            return asset('images/default.jpg');
    }


}
