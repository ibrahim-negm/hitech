<?php

namespace App\Models\Admin;

use App\Models\Admin;
use App\Models\Front\Comment;
use App\Models\Front\Review;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = [
        'service_id',
        'user_id',
        'post_title',
        'post_image',
        'post_short_details',
        'post_details',
        'post_tags',
        'slug',
        'status',
    ];


    /**
     * @param $value
     * @return string
     */
    public function setSlugAttribute($value) {

        if (static::whereSlug($slug = str_slug($value))->exists()) {

            $slug = $this->incrementSlug($slug);
        }

        return  $this->attributes['slug'] = $slug;
    }

    /**
     * @param $slug
     * @return string
     */
    public function incrementSlug($slug) {

        $original = $slug;

        $count = 2;

        while (static::whereSlug($slug)->exists()) {

            $slug = "{$original}-" . $count++;
        }

        return $slug;

    }



    public function service(){
        return $this->belongsTo(Service::class,'service_id','id');
    }

    public function admin(){
        return $this->belongsTo(Admin::class,'user_id','id');
    }

    public function user(){
        return $this->belongsTo(User::class,'post_id','id');
    }


    public function comments(){
        return $this->hasMany(Comment::class,'post_id','id');
    }




} // end of model
