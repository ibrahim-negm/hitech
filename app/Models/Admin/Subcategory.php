<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;

    protected $table='subcategories';

    protected $fillable = [
        'category_id',
        'subcategory_name',

    ];

    public function category(){
      return  $this->belongsTo(Category::class,'category_id','id');
    }

    public function subsubcategories(){
        return  $this->hasMany(SubSubCategory::class,'subcategory_id','id');
    }

    public function products(){
        return $this->hasMany(Product::class,'subcategory_id','id');
    }






}// end of class
