<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function role(){
        return $this->belongsTo(Role::class)->withDefault();
    }

    public function image(){
        return $this->morphOne(Image::class,'imageable')->where('type', 'main');
    }

    public function reviews(){
        return $this->hasMany(Review::class);
    }

    public function carts(){
        return $this->hasMany(Review::class);
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function order_details(){
        return $this->hasMany(OrderDetail::class);
    }

    public function payment(){
        return $this->hasMany(OrderDetail::class);
    }

    public function testionials(){
        return $this->hasMany(Testionial::class);
    }

    public function getImgPathAttribute(){
        // dd($this->image);
        if($this->image){
            return asset('images/'.$this->image->path);
        }else{
            return 'https://ui-avatars.com/api/?background=a0a0a0&name='.$this->name;
        }
    }
}
