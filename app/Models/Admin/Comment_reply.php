<?php

namespace App\Models\Admin;

use App\Models\Admin;
use App\Models\Front\Comment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment_reply extends Model
{
    use HasFactory;

    protected $table = 'comment_replies';

    protected $fillable = [
        'admin_id',
        'comment_id',
        'description',
    ];

    public function admin(){
        return $this->belongsTo(Admin::class,'admin_id','id');
    }

    public function comment(){
        return $this->belongsTo(Comment::class,'comment_id','id');
    }
}//end of model
