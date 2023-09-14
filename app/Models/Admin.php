<?php

namespace App\Models;

use App\Models\Admin\Brand;
use App\Models\Admin\Permission;
use App\Models\Admin\Sent;
use App\Models\Admin\Post;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'phone',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',

    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
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

    public function permission(){
    return $this->hasOne(Permission::class,'admin_id','id');

    }

    public function posts(){
        return $this->hasMany(Post::class,'user_id','id');

    }

    public function sents (){
        return $this->hasMany(Sent::class,'admin_id','id');
    }

    public function brand (){
        return $this->hasOne(Brand::class,'admin_id','id');
    }

}
