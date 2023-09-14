<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Governorate extends Model
{
    use HasFactory;

    protected $table ='governorates';

    protected $fillable = [
        'governorate',
        'shipping_price',
    ];

}
