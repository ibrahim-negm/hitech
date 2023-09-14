<?php

namespace App\Models\Front;

use App\Models\Admin\Governorate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;

    protected $table = 'shippings';

    protected $fillable = [
        'order_id',
        'ship_name',
        'ship_phone',
        'ship_email',
        'ship_address',
        'ship_city',
        'ship_country',

    ];



    Public function order(){
        return $this->belongsTo(Order::class,'order_id','id');
    }





}//end of model
