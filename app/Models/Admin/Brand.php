<?php

namespace App\Models\Admin;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $table ='brands';

    protected $fillable = [

        'admin_id',
        'brand_name',
        'brand_logo',
        ];

    public function products(){
        return $this->hasMany(Product::class,'brand_id','id');
    }


    public function admin(){
        return $this->belongsTo(Admin::class,'admin_id','id');
    }





}//end of model
