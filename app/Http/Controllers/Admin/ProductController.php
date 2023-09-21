<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Brand;
use App\Models\Admin\Category;
use App\Models\Admin\Installment;
use App\Models\Admin\Product;
use App\Models\Admin\Product_image;
use App\Models\Admin\Service;
use App\Models\Admin\Subcategory;
use App\Models\Admin\SubSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{


    /**
     * NoneApprovedStatusProducts
     * @return \Illuminate\Http\RedirectResponse
     */
    public function NoneApprovedStatusProducts(){

        try{
            if(Auth::user()->permission->company==1){
                $brand_id = Auth::user()->brand->id;
                $products = Product::where('brand_id',$brand_id)
                    ->where('status',0)->where('approved',0)->latest()->get();
                return view('backend.product.product',compact('products'));
            }elseif(Auth::user()->permission->product==1){
                $products = Product::where('status',0)->where('approved',0)->latest()->get();
                return view('backend.product.product',compact('products'));
            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية لدخول هذه المنطقة');
            }
        }catch(\Exception $ex){
            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى');

        }
    }



    /**
     * ApprovedStatusProducts
     * @return \Illuminate\Http\RedirectResponse
     */
    public function ApprovedStatusProducts(){

        try{
            if(Auth::user()->permission->company==1){
            $brand_id = Auth::user()->brand->id;
            $products = Product::where('brand_id',$brand_id)
                    ->where('status',1)->where('approved',1)->latest()->get();
                return view('backend.product.product',compact('products'));
            }elseif(Auth::user()->permission->product==1){
                $products = Product::where('status',1)->where('approved',1)->latest()->get();
                return view('backend.product.product',compact('products'));
            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية لدخول هذه المنطقة');
            }
        }catch(\Exception $ex){
            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى');

        }
    }

    /**
     * ApprovedProducts
     * @return \Illuminate\Http\RedirectResponse
     */
    public function ApprovedProducts(){

        try{
            if(Auth::user()->permission->company==1){
                $brand_id = Auth::user()->brand->id;
                $products = Product::where('brand_id',$brand_id)
                    ->where('status',0)->where('approved',1)->latest()->get();
                return view('backend.product.product',compact('products'));
            }elseif(Auth::user()->permission->product==1){
                $products = Product::where('status',0)->where('approved',1)->latest()->get();
                return view('backend.product.product',compact('products'));
            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية لدخول هذه المنطقة');
            }
        }catch(\Exception $ex){
            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى');

        }
    }


    /**
     * StatusProducts
     * @return \Illuminate\Http\RedirectResponse
     */
    public function StatusProducts(){

        try{
            if(Auth::user()->permission->company==1){
                $brand_id = Auth::user()->brand->id;
                $products = Product::where('brand_id',$brand_id)
                    ->where('status',1)->where('approved',0)->latest()->get();
                return view('backend.product.product',compact('products'));
            }elseif(Auth::user()->permission->product==1){
                $products = Product::where('status',1)->where('approved',0)->latest()->get();
                return view('backend.product.product',compact('products'));
            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية لدخول هذه المنطقة');
            }
        }catch(\Exception $ex){
            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى');

        }
    }

    /**
     * CreateProduct
     * @return \Illuminate\Http\RedirectResponse
     */
    public function CreateProduct(){

        try{
            if(Auth::user()->permission->product==1){
                $services = Service::all();
                $categories = Category::all();
                $brands = Brand::all();
                return view('backend.product.create',compact('services','categories','brands'));
            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية لدخول هذه المنطقة');
            }
        }catch(\Exception $ex){
            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى');

        }
    }

    /**
     * StoreProduct
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function StoreProduct(Request $request){

        $validate = $request->validate([
            'service_id'=>'required',
            'category_id'=>'required',
            'subcategory_id'=>'required',
            'product_name'=>'required|max:155',
            'brand_id'=>'required',
            'product_code'=>'max:55',
            'product_quantity'=>'required|digits_between:1,3',
            'selling_price'=>'required|digits_between:1,5',
            'discount_price'=>'digits_between:0,5',
            'product_short_detail'=>'max:250',
            'manufacture'=>'max:200',
            'main_image'=>'required|mimes:jpg,jpeg,png|max:500',
            'product_tags'=>'required',
            'viewed'=>'digits_between:0,3',
            'product_capacity'=>'max:200',
            'thumbnail_images'=>'max:500',

        ],
            [
                'service_id.required'=>'هذا الحقل مطلوب',
                'category_id.required'=>'هذا الحقل مطلوب',
                'subcategory_id.required'=>'هذا الحقل مطلوب',
                'product_name.required'=>'اسم المنتج مطلوب',
                'product_name.max'=>'عدد الحروف لايتجاوز 155 حرف',
                'brand_id.required'=>'هذا الحقل مطلوب',
                'product_code.max'=>'عدد الحروف لايتجاوز 55 حرف',
                'manufacture.max'=>'هذا الحقل لايتجاوز 200 حرف',
                'product_quantity.required'=>'عدد المنتج مطلوب',
                'product_quantity.digits_between'=>'عدد المنتج لا يتجاوز 999',
                'selling_price.required'=>'سعر المنتج مطلوب',
                'selling_price.digits_between'=> '   سعر المنتج لا يتجاوز 99999',
                'discount_price.digits_between'=>' سعر المنتج لا يتجاوز 99999',
                'product_short_detail.max'=>'تفاصيل المنتج لايزيد عن 250 حرف',
                'main_image.required'=>'صورةالمنتج مطلوبة',
                'main_image.mimes'=>'صورة المنتج  يجب ان تكون jpg,png,jpeg',
                'main_image.max'=>'صورة المنتج  يجب ان لا يتجاوز 500 كيلو ',
                'product_tags.required'=>'الكلمات الاسترشادية مطلوبة',
                'viewed.digits_between'=>'عدد الزيارات لا يتجاوز 999',
                'product_capacity.max'=>'هذا الحقل لايتجاوز 200 حرف',
                'thumbnail_images.max'=>'صورة المنتج  يجب ان لا يتجاوز 500 كيلو ',



            ]);
        try{
            if(Auth::user()->permission->product==1){
                $product = new Product();
                $data = array();
                $data['service_id'] = $request->service_id;
                $data['category_id'] = $request->category_id;
                $data['subcategory_id'] = $request->subcategory_id;
                $data['subsubcategory_id'] = $request->subsubcategory_id;
                $data['brand_id'] = $request->brand_id;
                $data['product_name'] = $request->product_name;
                $data['product_code'] = $request->product_code;
                $data['product_quantity'] = $request->product_quantity;
                $data['product_tags'] = implode(",",$request->product_tags);
                $data['product_material'] = $request->product_material;

                if(empty($request->product_color)){

                }else{
                    $data['product_color'] = implode(",",$request->product_color);
                }
                if(empty($request->product_size)){

                }else{
                    $data['product_size'] = implode(",",$request->product_size);
                }

                $data['selling_price'] = $request->selling_price;
                $data['discount_price'] = $request->discount_price;
                $data['product_capacity'] = $request->product_capacity;
                $data['product_short_detail'] = $request->product_short_detail;
                $data['product_long_detail'] = $request->product_long_detail;
                $data['manufacture'] = $request->manufacture;
                $data['viewed'] = $request->viewed;
                $data['slug'] = $product->setSlugAttribute($request->product_name);
                $data['status'] = 0;
                $data['approved'] = 0;
                $data['return'] = 0;

             
                $main_image = $request->main_image;


                if($main_image){
                    $image_name = hexdec(uniqid()).'.'.$main_image->getClientOriginalExtension();
                    Image::make($main_image)->resize(900,1075)->save(public_path('upload/products/').$image_name);
                    $data['main_image'] = $image_name;
                    $product= Product::create($data);

                    $thumbnail_images = $request->thumbnail_images;
                    if($thumbnail_images){
                        foreach ($thumbnail_images as $image){
                        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
                        Image::make($image)->resize(900,1075)->save(public_path('upload/products/').$name_gen);

                        Product_image::create([
                            'product_id' => $product->id,
                            'image' => $name_gen,
                        ]);

                     }
                    }

                        Installment::create([
                            'product_id' => $product->id,
                            'month' => '6',
                            'deposit' => $request->deposit_6,
                            'installment' => $request->installment_6,
                        ]);

                    Installment::create([
                        'product_id' => $product->id,
                        'month' => '12',
                        'deposit' => $request->deposit_12,
                        'installment' => $request->installment_12,
                    ]);

                    Installment::create([
                        'product_id' => $product->id,
                        'month' => '18',
                        'deposit' => $request->deposit_18,
                        'installment' => $request->installment_18,
                    ]);

                    Installment::create([
                        'product_id' => $product->id,
                        'month' => '24',
                        'deposit' => $request->deposit_24,
                        'installment' => $request->installment_24,
                    ]);

                    return redirect()->route('admin.none.approved.status.products')->with('success','تم اضافة المنتج بنجاح');
                     }
                }else{
                    return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية لدخول هذه المنطقة');
                }

            }catch(\Exception $ex){
             return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى');
            }
    }

    /**
     * GetSubcat
     * @param $category_id
     * @return false|\Illuminate\Http\RedirectResponse|string
     */
    public function GetSubcat($category_id){
        try{
            if(Auth::user()->permission->product==1){
                $subcategory = Subcategory::where('category_id',$category_id)->get();
                return json_encode($subcategory);
            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية لدخول هذه المنطقة');
            }
        }catch(\Exception $ex){
            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى');

        }

    }

    /**
     * GetSubSubcat
     * @param $subcategory_id
     * @return false|\Illuminate\Http\RedirectResponse|string
     */
    public function GetSubSubcat($subcategory_id){
        try{
            if(Auth::user()->permission->product==1){
                $subsubcategory = SubSubcategory::where('subcategory_id',$subcategory_id)->get();
                return json_encode($subsubcategory);
            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية لدخول هذه المنطقة');
            }
        }catch(\Exception $ex){
            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى');

        }

    }



    /**
     * ActiveProduct
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function ActiveProduct($id){
        try{
           if(Auth::user()->permission->product==1){
                $product =Product::find($id);
                $product->update([
                    'status' => 1,

                ]);
                return redirect()->back()->with('success','تم تعديل حالة المنتج الى فعال بنجاح');
            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية لدخول هذه المنطقة');
            }

        }catch (\Exception $ex){

            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى');

        }

    }

    /**
     * InactiveProduct
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function InactiveProduct($id){
        try{
            if(Auth::user()->permission->product==1){
                $product =Product::find($id);
                $product->update([
                    'status' => 0,

                ]);
                return redirect()->back()->with('success','تم تعديل حالة المنتج الى غير فعال بنجاح');

            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية لدخول هذه المنطقة');
            }
        }catch (\Exception $ex){

            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى');

        }

    }

    /**
     * ActiveProduct
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function ApprovedProduct($id){
        try{
            if(Auth::user()->permission->company==1){
                return redirect()->back()->with('success','ليس لك تصريح لتعديل حالة المنتج الى موافق من قبل الادارة ');

            }elseif(Auth::user()->permission->product==1){
                $product =Product::find($id);
                $product->update([
                    'approved' => 1,

                ]);
                return redirect()->back()->with('success','تم الموافقة على المنتج من قبل الادارة بنجاح');
            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية لدخول هذه المنطقة');
            }

        }catch (\Exception $ex){

            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى');

        }

    }

    /**
     * InactiveProduct
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function UnapprovedProduct($id){
        try{
            if(Auth::user()->permission->company==1){
                return redirect()->back()->with('success','ليس لك تصريح لتعديل حالة المنتج الى غير موافق من قبل الادارة ');

            }elseif(Auth::user()->permission->product==1){
                $product =Product::find($id);
                $product->update([
                    'approved' => 0,

                ]);
                return redirect()->back()->with('error','تم عدم الموافقة من الادارة على المنتج ');

            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية لدخول هذه المنطقة');
            }
        }catch (\Exception $ex){

            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى');

        }

    }

    /**
     * ShowProduct
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function ShowProduct($id){

        try{
            if(Auth::user()->permission->product==1){
                $product = Product::find($id);
                $product_images = Product_image::where('product_id',$id)->get();
                $product_installments = Installment::where('product_id',$id)->get();

                return view('backend.product.show',compact('product','product_images','product_installments'));
            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية لدخول هذه المنطقة');
            }
        }catch (\Exception $ex){

            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى');

        }
    }

    /**
     * EditProduct
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function EditProduct($id){
        try{
            if(Auth::user()->permission->product==1){
                $product = Product::find($id);
                $categories = Category::all();
                $brands = Brand::all();
                $subCategories = Subcategory::all();
                $subsubCategories = SubSubCategory::all();
                $services = Service::all();
                $product_images = Product_image::where('product_id',$id)->get();
                $product_installments = Installment::where('product_id',$id)->get();
                 return view('backend.product.edit',compact('product','categories','brands','subCategories','services','subsubCategories','product_images','product_installments'));
            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية لدخول هذه المنطقة');
            }
        }catch (\Exception $ex){
            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى');

        }
    }

    /**
     * UpdateProductData
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function UpdateProductData(Request $request,$id){
        $validate = $request->validate([

            'service_id'=>'required',
            'category_id'=>'required',
            'subcategory_id'=>'required',
            'product_name'=>'required|max:155',
            'product_code'=>'max:55',
            'product_quantity'=>'required|digits_between:1,3',
            'selling_price'=>'required|digits_between:1,5',
            'discount_price'=>'digits_between:0,5',
            'product_short_detail'=>'max:250',
            'manufacture'=>'max:200',
            'product_tags'=>'required',
            'viewed'=>'digits_between:0,3',
            'product_capacity'=>'max:200',

        ],
            [

                'service_id.required'=>'هذا الحقل مطلوب',
                'category_id.required'=>'هذا الحقل مطلوب',
                'subcategory_id.required'=>'هذا الحقل مطلوب',
                'brand_id.required'=>'هذا الحقل مطلوب',
                'product_name.required'=>'اسم المنتج مطلوب',
                'product_name.max'=>'عدد الحروف لايتجاوز 155 حرف',
                'product_code.max'=>'عدد الحروف لايتجاوز 55 حرف',
                'manufacture.max'=>'هذا الحقل لايتجاوز 200 حرف',
                'product_quantity.required'=>'عدد المنتج مطلوب',
                'product_quantity.digits_between'=>'عدد المنتج لا يتجاوز 999',
                'selling_price.required'=>'سعر المنتج مطلوب',
                'selling_price.digits_between'=>'سعر المنتج لا يتجاوز 99999',
                'discount_price.digits_between'=>'سعر المنتج لا يتجاوز 99999',
                'product_short_detail.max'=>'تفاصيل المنتج لايزيد عن 250 حرف',
                'product_tags.required'=>'الكلمات الاسترشادية مطلوبة',
                'viewed.digits_between'=>'عدد الزيارات لا يتجاوز 999',
                'product_capacity.max'=>'هذا الحقل لايتجاوز 200 حرف',

            ]);

        try{
            if(Auth::user()->permission->product==1){
                $product = Product::find($id);
                $data = array();

                $data['service_id'] = $request->service_id;
                $data['category_id'] = $request->category_id;
                $data['subcategory_id'] = $request->subcategory_id;
                $data['subsubcategory_id'] = $request->subsubcategory_id;
                $data['brand_id'] = $request->brand_id;
                $data['product_name'] = $request->product_name;
                $data['product_code'] = $request->product_code;
                $data['product_quantity'] = $request->product_quantity;
                $data['product_tags'] = implode(",",$request->product_tags);
                $data['product_material'] = $request->product_material;
//                $data['slug'] = $product->setSlugAttribute($request->product_name);


                if(empty($request->product_color)){
                    $data['product_color']=null;
                }else{
                    $data['product_color'] = implode(",",$request->product_color);
                }
                if(empty($request->product_size)){
                    $data['product_size']=null;
                }else{
                    $data['product_size'] = implode(",",$request->product_size);
                }

                $data['selling_price'] = $request->selling_price;
                $data['discount_price'] = $request->discount_price;
                $data['product_capacity'] = $request->product_capacity;
                $data['product_short_detail'] = $request->product_short_detail;
                $data['product_long_detail'] = $request->product_long_detail;
                $data['manufacture'] = $request->manufacture;
                $data['viewed'] = $request->viewed;

               Product::find($id)->update($data);
                return redirect()->back()->with('success','تم تعديل بيانات المنتج بنجاح');

            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية لدخول هذه المنطقة');
            }
        }catch (\Exception $ex){

            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى');

        }
    }

    /**
     * UpdateProductImage
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function UpdateProductImage(Request $request,$id){
        $validate = $request->validate([

            'main_image'=>'mimes:jpg,jpeg,png|max:500',
            'add_thumbnail_images'=>'max:500',

        ],
            [


                'main_image.mimes'=>'صورة المنتج  يجب ان تكون jpg,png,jpeg',
                'main_image.max'=>'صورة المنتج  يجب ان لا يتجاوز 500 كيلو ',
                'add_thumbnail_images.max'=>'صورة المنتج  يجب ان لا يتجاوز 500 كيلو ',

            ]);
        try{
            if(Auth::user()->permission->product==1){
                $data = array();

                $main_image = Product::find($id)->main_image;
                $main_image_new = $request->file('main_image');

                if($main_image_new){
                    unlink(public_path('upload/products/').$main_image);
                    $image_name = hexdec(uniqid()).'.'.$main_image_new->getClientOriginalExtension();
                    Image::make($main_image_new)->resize(900,1057)->save(public_path('upload/products/').$image_name);

                    $data['main_image'] = $image_name;
                    Product::find($id)->update($data);
                }

                $imgs= $request->thumbnail_images;
                if($imgs){
                    foreach ($imgs as $id => $img){

                        $imagDel = Product_image::find($id);
                        unlink(public_path('upload/products/').$imagDel->image);

                        $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
                        Image::make($img)->resize(900,1057)->save(public_path('upload/products/').$make_name);
                        Product_image::where('id',$id)->update([
                            'image' =>$make_name,
                        ]);

                    }
                }

                $add_thumbnail_images = $request->add_thumbnail_images;
                if($add_thumbnail_images) {
                    foreach ($add_thumbnail_images as $image){
                        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
                        Image::make($image)->resize(900,1075)->save(public_path('upload/products/').$name_gen);

                        Product_image::create([
                            'product_id' => $id,
                            'image' => $name_gen,
                        ]);
                    }
                }


                    return redirect()->back()->with('success', 'تم تحديث صورالمنتج بنجاح');



            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية لدخول هذه المنطقة');
            }
        }catch(\Exception $ex){

            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى');

        }


    }

    /**
     * DeleteProductImage
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function DeleteProductImage($id){
        try{
            if(Auth::user()->permission->product==1){
                $old_image = Product_image::find($id);
                unlink(public_path('upload/products/'.$old_image->image));
                Product_image::find($id)->delete();

                return redirect()->back()->with('success','تم حذف الصورة الصغيرة للمنتج بنجاح');


            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية لدخول هذه المنطقة');

            }
        }catch (\Exception $ex){
            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى');
        }
    }

    /**
     * updateProductInstallment
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProductInstallment(Request $request,$id){

        try{
            if(Auth::user()->permission->product==1){

                $installments= $request->installments;

                if($installments){
                    foreach ($installments as $id => $row){
                        $installment = Installment::find($id);
                        if($installment->month == '6'){
                            Installment::find($id)->update([
                                'deposit' => $request->deposit_6,
                            'installment' => $request->installment_6,
                        ]);
                        }elseif ($installment->month == '12'){
                            Installment::find($id)->update([
                                'deposit' => $request->deposit_12,
                                'installment' => $request->installment_12,
                            ]);
                        }elseif ($installment->month == '18'){
                            Installment::find($id)->update([
                                'deposit' => $request->deposit_18,
                                'installment' => $request->installment_18,
                            ]);
                        }else{
                            Installment::find($id)->update([
                                'deposit' => $request->deposit_24,
                                'installment' => $request->installment_24,
                            ]);
                        }

                    }
                }
                return redirect()->back()->with('success', 'تم تحديث أقساط المنتج بنجاح');

            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية لدخول هذه المنطقة');
            }
        }catch(\Exception $ex){

            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى');

        }


    }



    /**
     * DeleteProduct
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function DeleteProduct($id){

        try{
            if(Auth::user()->permission->product==1){
                $product = Product::find($id);

                $main_image = $product->main_image;
                unlink(public_path('upload/products/').$main_image);
                Product::find($id)->delete();

                $product_images = Product_image::where('product_id',$id)->get();
                foreach($product_images as $image){
                    unlink(public_path('upload/products/'.$image->image));

                }
                Product_image::where('product_id',$id)->delete();
                Installment::where('product_id',$id)->delete();
               // Review::where('product_id',$id)->delete();

                return redirect()->back()->with('success','تم حذف المنتج بنجاح');

            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية لدخول هذه المنطقة');
            }
        }catch(\Exception $ex){

            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى');

        }
    }



}//end of controller
