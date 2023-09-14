<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $table='settings';
    protected $fillable = [

        'shop_name',
        'email',
        'phone',
        'address',
        'logo_dark',
        'logo_light',
        'favicon',
        'employees',
        'products',
        'clients',
        'branches',
        'facebook',
        'instagram',
        'twitter',
        'whatsup',
        'youtube',
        'vat',
        'shipping_charge',
        'city_shipping',
        'deal_timer',

    ];
}
