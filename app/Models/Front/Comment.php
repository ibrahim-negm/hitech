<?php

namespace App\Models\Front;

use App\Models\Admin\Comment_reply;
use App\Models\Admin\Post;
use App\Models\admin\Review_reply;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    protected $table='comments';

    protected $fillable = [
        'user_id',
        'post_id',
        'description',
        'status'


    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function post(){
        return $this->belongsTo(Post::class,'post_id','id');
    }

    public function comment_replies(){
        return $this->hasMany(Comment_reply::class,'comment_id','id');
    }

} //end of model

