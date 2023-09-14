<?php

namespace App\Models\Admin;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $table = 'permissions';

    protected $fillable = [
        'admin_id',
        'service',
        'post',
        'category',
        'subcategory',
        'product',
        'brand',
        'coupon',
        'order',
        'user',
        'report',
        'setting',
        'stock',
        'role',
        'gallery',
        'employee',
        'subscriber',
        'slider',
        'advs',
        'message',
        'comment',
        'review',
        'company',
        'type',
    ];

   public function admin(){
    return $this->belongsTo(Admin::class,'admin_id','id');


   }
}
