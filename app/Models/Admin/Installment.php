<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Installment extends Model
{
    use HasFactory;

    protected $table = 'installments';

    protected $fillable = [
        'product_id',
        'month',
        'deposit',
        'installment',
    ];

    public function product(){
        return $this->belongsTo(Product::class,'product_id','id');
    }



}// end of model
