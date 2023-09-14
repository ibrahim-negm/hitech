<?php

namespace App\Models\Front;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'payment_type',
        'paymob_order_id',
        'subtotal',
        'shipping',
        'vat',
        'wallet',
        'total',
        'status',
        'return_order',
        'notes',
        'month',
        'date',
        'year',
    ];


    public function user(){
        return $this->belongsTo(User::class,'user_id','id');

    }

    public function guarantee(){
        return $this->hasOne(Guarantee::class,'order_id','id');
    }

    public function shipping(){
        return $this->hasOne(Shipping::class,'order_id','id');
    }


}//end of model
