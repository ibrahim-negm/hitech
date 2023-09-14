<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubSubCategory extends Model
{
    use HasFactory;

    Protected $table = 'sub_sub_categories';

    protected $fillable = [
        'category_id',
        'subcategory_id',
        'subsubcategory_name',
    ];

    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public function subcategory(){
        return $this->belongsTo(SubCategory::class,'subcategory_id','id');
    }

    public function products(){
        return $this->hasMany(Product::class,'id','subsubcategory_id');
    }


} // end of model
