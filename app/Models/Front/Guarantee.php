<?php

namespace App\Models\front;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guarantee extends Model
{
    use HasFactory;


   protected $table = 'guarantees';

   protected $fillable = [
       'order_id',
       'guarantee_name',
       'guarantee_city',
       'guarantee_address',
       'guarantee_phone',
       'guarantee_email',
   ];

    public function order(){
        return $this->belongsTo(Order::class,'order_id','id');
    }


} //end of model

