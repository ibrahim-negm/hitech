<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected  $fillable = [
        'category_name',

    ];

    public function subcategories(){
        return $this->hasMany(Subcategory::class,'category_id','id');
    }

    public function subsubcategories(){
        return  $this->hasMany(SubSubCategory::class,'category_id','id');
    }

    public function products(){
        return $this->hasMany(Product::class,'category_id','id');
    }

}//end of model
