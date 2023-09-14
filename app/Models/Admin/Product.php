<?php

namespace App\Models\Admin;

use App\Models\Front\Review;
use App\Models\Front\Wishlist;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'service_id',
        'category_id',
        'subcategory_id',
        'subsubcategory_id',
        'brand_id',
        'product_name',
        'slug',
        'product_code',
        'product_short_detail',
        'product_long_detail',
        'selling_price',
        'discount_price',
        'product_color',
        'product_size',
        'product_quantity',
        'product_tags',
        'product_capacity',
        'product_material',
        'manufacture',
        'viewed',
        'main_image',
        'return',
        'approved',
        'status',

    ];

    /**
     * @param $value
     * @return string
     */
    public function setSlugAttribute($value) {

        if (static::whereSlug($slug = str_slug($value))->exists()) {

            $slug = $this->incrementSlug($slug);
        }

      return  $this->attributes['slug'] = $slug;
    }

    /**
     * @param $slug
     * @return string
     */
    public function incrementSlug($slug) {

        $original = $slug;

        $count = 2;

        while (static::whereSlug($slug)->exists()) {

            $slug = "{$original}-" . $count++;
        }

        return $slug;

    }

    public function service(){
        return $this->belongsTo(Service::class,'service_id','id');
    }

    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public function subcategory(){
        return $this->belongsTo(Subcategory::class,'subcategory_id','id');

    }

    public function subsubcategory(){
        return $this->belongsTo(SubSubCategory::class,'subsubcategory_id','id');

    }

    public function brand(){
        return $this->belongsTo(Brand::class,'brand_id','id');

    }

    public function product_images(){
        return $this->hasMany(Product_image::class,'id','product_id');

    }

    public function installment(){
        return $this->hasOne(Installment::class,'id','product_id');

    }

    public function reviews(){
        return $this->hasMany(Review::class,'product_id','id');

    }

    public function wishlist(){
        return $this->hasOne(Wishlist::class,'product_id','id');

    }
}//end of model
