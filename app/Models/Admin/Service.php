<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $table = 'services';

    protected  $fillable = [
        'service_name',
        'service_image',

    ];

    public function Images(){
        return $this->hasMany(Image::class,'service_id','id');
    }

    public function posts(){
        return $this->hasMany(Post::class,'service_id','id');
    }

    public function products(){
        return $this->hasMany(Product::class,'service_id','id');
    }
}
