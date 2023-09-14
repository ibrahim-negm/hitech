<?php

namespace App\Models;

use App\Models\Admin\Post;
use App\Models\Front\Comment;
use App\Models\Front\Order;
use App\Models\Front\Review;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'city',
        'password',
        'social_id',
        'social_type',
        'profile_photo_path',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];



    public function posts(){
        return $this->hasMany(Post::class,'user_id','id');
    }

    public function reviews(){
        return $this->hasMany(Review::class,'user_id','id');
    }

    public function comments(){
        return $this->hasMany(Comment::class,'user_id','id');
    }

    public function orders(){
        return $this->hasMany(Order::class,'id','user_id');
    }


}
