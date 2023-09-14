<?php

namespace App\Models\Front;

use App\Models\Admin\Post;
use App\Models\Admin\Product;
use App\Models\admin\Review_reply;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table='reviews';

    protected $fillable = [
      'user_id',
      'product_id',
      'description',
      'rate',
      'status',

          ];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function product(){
        return $this->belongsTo(Product::class,'product_id','id');
    }


}

