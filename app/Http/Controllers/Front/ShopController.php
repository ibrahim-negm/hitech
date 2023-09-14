<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Mail\ReviewMail;
use App\Models\Admin\Brand;
use App\Models\Admin\Category;
use App\Models\Admin\Color;
use App\Models\Admin\Image;
use App\Models\Admin\Installment;
use App\Models\Admin\Post;
use App\Models\Admin\Product;
use App\Models\Admin\Product_image;
use App\Models\Admin\Service;
use App\Models\Front\Comment;
use App\Models\Front\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Route;


class ShopController extends Controller
{
    /**
     * Show Product
     * @param $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function ShowProduct($slug){


           $product = Product::where('slug',$slug)->first();

           if($product){


            $product_id = $product->id;
            $subsubcategory_id = $product->subsubcategory_id;

            $related_products = Product::where('subsubcategory_id',$subsubcategory_id)->whereNotIn('id',[$product_id])
                ->where('status',1)->where('approved',1)->orderBy('id','desc')->limit(8)->get();

            $reviews = Review::where('product_id',$product_id)->latest()->get();
            if($reviews->sum('rate')==0){
                $rate=0;
            }else{
                $rate=round($reviews->sum('rate')/count($reviews),0);
            }

            $product_installments = Installment::where('product_id',$product_id)->get();

            $product_images = Product_image::where('product_id',$product_id)->get();
            $viewed = $product->viewed;
            $product->update([
               'viewed' => $viewed + 1,
            ]);

            return view('frontend.product_details',compact('product','related_products','reviews' ,'product_images','rate','product_installments'));
           }else{
               return view('errors.404');

           }


    }

     /**
     *  StoreReview
     * @param Request $request
     * @param $id
     * @return \Exception|\Illuminate\Http\RedirectResponse
     */
    public function StoreReview(Request $request ,$id){
        $validate = $request->validate([

            'description'=>'required'
        ],
            [

                'description.required'=>'هذا الحقل مطلوب'
            ]);

        if(Auth::check()){
            $email = Auth::user()->email;
            $username = Auth::user()->name;
            Mail::to($email)->send(new ReviewMail($email,$username));

        try{
            $data = array();
            $data['user_id'] =Auth::id();
            $data['product_id'] = $id;
            $data['description'] = $request->description;
            $data['rate'] = $request->rate;
            $data['status'] = 0;


            Review::create($data);

            $notification = array(
                'message'=>' تقييمك  شىء نعتز به . وسوف يقوم احدى موظفى خدمة العملاء ارسال بريد الكترونى لك  لتبليغك بقيمة الهدية المقدمة لك ',
                'alert-type'=>'success'
            );
            return redirect()->back()->with($notification);

        }catch(\Exception $ex){

            $notification = array(
                'message'=>'حدث شىء ما خطأ ، من فضلك حاول مرة أخرى ',
                'alert-type'=>'error'
            );
            return redirect()->back()->with($notification);
        }
        }else{
            $notification = array(
                'message'=>'من فضلك قم بتسجيل الدخول اولاً',
                'alert-type'=>'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    /**
     *  StoreComment
     * @param Request $request
     * @param $id
     * @return \Exception|\Illuminate\Http\RedirectResponse
     */
    public function StoreComment(Request $request ,$id){
        $validate = $request->validate([

            'description'=>'required'
        ],
            [

                'description.required'=>'هذا الحقل مطلوب'
            ]);

        if(Auth::check()){

            try{
                $data = array();
                $data['user_id'] =Auth::id();
                $data['post_id'] = $id;
                $data['description'] = $request->description;
                $data['status']=0;


                Comment::create($data);

                $notification = array(
                    'message'=>'تم إرسال تعليقك بنجاح',
                    'alert-type'=>'success'
                );
                return redirect()->back()->with($notification);

            }catch(\Exception $ex){

                $notification = array(
                    'message'=>'حدث شىء ما خطأ ، من فضلك حاول مرة أخرى ',
                    'alert-type'=>'error'
                );
                return redirect()->back()->with($notification);
            }
        }else{
            $notification = array(
                'message'=>'قم بالتسجيل الدخول أولاً',
                'alert-type'=>'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    /**
     * Insert Cart
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
   public function InsertCart(Request $request,$id){
        try{
            $product = Product::find($id);

            $data = array();

                $data['id'] = $product->id;
                $data['name'] = $product->product_name;
                $data['qty'] = $request->demo_vertical2;
            if($product->discount_price == NULL) {
                $data['price'] = $product->selling_price;
            }else{
                $data['price'] = $product->discount_price;
            }
                $data['weight'] = 1;
                $data['options']['image'] = $product->main_image;
                Cart::add($data);


                $notification = array(
                    'message'=>'تم اضافة '.$product->product_name.' فى سلة المشتريات الخاصة بك بنجاح , شكرا لك',
                    'alert-type'=>'success'
                );
                return redirect()->route('show.cart')->with($notification);

        }catch(\Exception $ex){

            $notification = array(
                'message'=>'حدث شىء ما خطأ ، من فضلك حاول مرة أخرى ',
                'alert-type'=>'error'
            );
            return redirect()->back()->with($notification);
        }
   }

    /**
     * ProductsSearch
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function ProductsSearch(Request $request){

        $validate = $request->validate([
            'search'=>'required|string|max:300',
        ]);

        try{


            $search = $request->search;

            if($search ){
                $nameOfFather = $search;
                $products = Product::where('product_tags','like',"%$search%")->where('status',1)->
                where('approved',1)->latest()->get();
                $categories = Category::all();


                return view('frontend.products',compact('nameOfFather','products','categories'));
            }


        }catch(\Exception $ex){

            $notification = array(
                'message'=>'حدث شىء ما خطأ ، من فضلك حاول مرة أخرى ',
                'alert-type'=>'error'
            );
            return redirect()->back()->with($notification);
        }

    }



    /**
     * ProductsInService
     * @param $id
     * @param $nameOfFather
     * @return \Illuminate\Http\RedirectResponse
     */
    public function ProductsInService($id,$nameOfFather){
        try{

            $products = Product::where('service_id',$id)->where('status',1)->
                where('approved',1)->latest()->paginate(12);

            $categories = Category::all();

            return view('frontend.products',compact('nameOfFather','products','categories','id'));

        }catch(\Exception $ex){
            $notification = array(
                'message'=>'حدث شىء ما خطأ ، من فضلك حاول مرة أخرى ',
                'alert-type'=>'error'
            );
            return redirect()->back()->with($notification);
        }

    }

    /**
     * Products In Cat
     * @param $id
     * @param $nameOfFather
     * @return \Illuminate\Http\RedirectResponse
     */
    public function ProductsInCat($id,$nameOfFather){
        try{

            $products = Product::where('category_id',$id)->where('status',1)->
            where('approved',1)->latest()->paginate(12);

            $categories = Category::all();


            return view('frontend.category_products',compact('nameOfFather','products','categories','id'));

        }catch(\Exception $ex){
            $notification = array(
                'message'=>'حدث شىء ما خطأ ، من فضلك حاول مرة أخرى ',
                'alert-type'=>'error'
            );
            return redirect()->back()->with($notification);
        }

    }


    /**
     * Products In ProductsInSubCat
     * @param $id
     * @param $nameOfFather
     * @return \Illuminate\Http\RedirectResponse
     */
    public function ProductsInSubCat($id,$nameOfFather){
        try{

            $products = Product::where('subcategory_id',$id)->where('status',1)->
            where('approved',1)->latest()->paginate(12);

            $categories = Category::all();


            return view('frontend.subcategory_products',compact('nameOfFather','products','categories','id'));

        }catch(\Exception $ex){
            $notification = array(
                'message'=>'حدث شىء ما خطأ ، من فضلك حاول مرة أخرى ',
                'alert-type'=>'error'
            );
            return redirect()->back()->with($notification);
        }

    }

    /**
     * Products In ProductsInSubSubCat
     * @param $id
     * @param $nameOfFather
     * @return \Illuminate\Http\RedirectResponse
     */
    public function ProductsInSubSubCat($id,$nameOfFather){
        try{

            $products = Product::where('subsubcategory_id',$id)->where('status',1)->
            where('approved',1)->latest()->paginate(12);

            $categories = Category::all();


            return view('frontend.sub_subcategory_products',compact('nameOfFather','products','categories','id'));

        }catch(\Exception $ex){
            $notification = array(
                'message'=>'حدث شىء ما خطأ ، من فضلك حاول مرة أخرى ',
                'alert-type'=>'error'
            );
            return redirect()->back()->with($notification);
        }

    }


    /**
     * Products In ProductsInBrand
     * @param $id
     * @param $nameOfFather
     * @return \Illuminate\Http\RedirectResponse
     */
    public function ProductsInBrand($id,$nameOfFather){
        try{

            $products = Product::where('brand_id',$id)->where('status',1)->
            where('approved',1)->latest()->paginate(12);

            $categories = Category::all();

            return view('frontend.brand_products',compact('nameOfFather','products','categories','id'));

        }catch(\Exception $ex){
            $notification = array(
                'message'=>'حدث شىء ما خطأ ، من فضلك حاول مرة أخرى ',
                'alert-type'=>'error'
            );
            return redirect()->back()->with($notification);
        }

    }


    /**
     * PriceFilter
     * @param Request $request
     * @param $id
     * @param $nameOfFather
     * @return \Illuminate\Http\RedirectResponse
     */
    public function PriceFilter(Request $request,$id,$nameOfFather){
        try{

                 $categories = Category::all();

                if($request->has('less_1000')){
                    $start_price = 1;
                    $second_price = 1000;

                }elseif($request->has('less_3000')){
                    $start_price = 1000;
                    $second_price = 3000;
                }elseif($request->has('less_6000')){
                    $start_price = 3000;
                    $second_price = 6000;
                }elseif($request->has('less_10000')){
                    $start_price = 6000;
                    $second_price = 10000;
                }else{
                    $start_price = 10000;
                    $second_price = 100000;
                }

                $route = Route::current()->getName();

                if($route == 'price.filter.category'){
                    $products = Product::where('category_id',$id)->whereBetween('discount_price',[$start_price,$second_price])
                        ->orWhere('category_id',$id)->WhereBetween('selling_price',[$start_price,$second_price])
                        ->where('status',1)->where('approved',1)->latest()->get();

                    return view('frontend.category_products',compact('nameOfFather','products','categories','id'));

                }

            if($route == 'price.filter.subcategory'){
                $products = Product::where('subcategory_id',$id)->whereBetween('discount_price',[$start_price,$second_price])
                    ->orWhere('subcategory_id',$id)->WhereBetween('selling_price',[$start_price,$second_price])
                    ->where('status',1)->where('approved',1)->latest()->get();

                return view('frontend.subcategory_products',compact('nameOfFather','products','categories','id'));

            }

            if($route == 'price.filter.sub_subcategory'){
                $products = Product::where('subsubcategory_id',$id)->whereBetween('discount_price',[$start_price,$second_price])
                    ->orWhere('subsubcategory_id',$id)->WhereBetween('selling_price',[$start_price,$second_price])
                    ->where('status',1)->where('approved',1)->latest()->get();

                return view('frontend.sub_subcategory_products',compact('nameOfFather','products','categories','id'));

            }

            if($route == 'price.filter'){
                $products = Product::where('service_id',$id)->whereBetween('discount_price',[$start_price,$second_price])
                    ->orWhere('service_id',$id)->WhereBetween('selling_price',[$start_price,$second_price])
                    ->where('status',1)->where('approved',1)->latest()->get();

                return view('frontend.products',compact('nameOfFather','products','categories','id'));

            }
            if($route == 'price.filter.brand'){
                $products = Product::where('brand_id',$id)->whereBetween('discount_price',[$start_price,$second_price])
                    ->orWhere('brand_id',$id)->WhereBetween('selling_price',[$start_price,$second_price])
                    ->where('status',1)->where('approved',1)->latest()->get();

                return view('frontend.brand_products',compact('nameOfFather','products','categories','id'));

            }

        }catch(\Exception $ex){

            $notification = array(
                'message'=>'حدث شىء ما خطأ ، من فضلك حاول مرة أخرى ',
                'alert-type'=>'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    /**
     * BrandFilter
     * @param Request $request
     * @param $id
     * @param $nameOfFather
     * @return \Illuminate\Http\RedirectResponse
     */
    public function BrandFilter(Request $request,$id,$nameOfFather){
        try{

            $brand_id = $request->brand_id;
            $categories = Category::all();

            $route = Route::current()->getName();

            if($route == 'brand.filter.category'){
                $products = Product::where('category_id',$id)->where('brand_id',$brand_id)
                    ->where('status',1)->where('approved',1)->latest()->get();

                return view('frontend.category_products',compact('nameOfFather','products','categories','id'));

            }

            if($route == 'brand.filter.subcategory'){
                $products = Product::where('subcategory_id',$id)->where('brand_id',$brand_id)
                    ->where('status',1)->where('approved',1)->latest()->get();

                return view('frontend.subcategory_products',compact('nameOfFather','products','categories','id'));

            }

            if($route == 'brand.filter.sub_subcategory'){
                $products = Product::where('subsubcategory_id',$id)->where('brand_id',$brand_id)
                    ->where('status',1)->where('approved',1)->latest()->get();

                return view('frontend.sub_subcategory_products',compact('nameOfFather','products','categories','id'));

            }

            if($route == 'brand.filter'){
                $products = Product::where('service_id',$id)->where('brand_id',$brand_id)
                    ->where('status',1)->where('approved',1)->latest()->get();

                return view('frontend.products',compact('nameOfFather','products','categories','id'));

            }

            if($route == 'brand.filter.brand'){
                $id = $brand_id;
                $nameOfFather = Brand::find($id)->brand_name;
                $products = Product::where('brand_id',$id)
                    ->where('status',1)->where('approved',1)->latest()->get();

                return view('frontend.brand_products',compact('nameOfFather','products','categories','id'));

            }

        }catch(\Exception $ex){

            $notification = array(
                'message'=>'حدث شىء ما خطأ ، من فضلك حاول مرة أخرى ',
                'alert-type'=>'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    /**
     * SearchPostByTag
     * @param $id
     * @param $nameOfFather
     * @param $tag
     * @return \Illuminate\Http\RedirectResponse
     */
    public function TagFilterProducts($id,$nameOfFather,$tag){

        try{
            $categories = Category::all();

            $route = Route::current()->getName();
            if($route == 'tag.category.products.filter'){
                $products = Product::where('category_id',$id)->where('status',1)->where('approved',1)->where('product_tags','like',"%$tag%")
                    ->paginate(12);
                return view('frontend.category_products',compact('nameOfFather','products','categories','id'));

            }

            if($route == 'tag.subcategory.products.filter'){
                $products = Product::where('subcategory_id',$id)->where('status',1)->where('approved',1)->where('product_tags','like',"%$tag%")
                    ->paginate(12);
                return view('frontend.subcategory_products',compact('nameOfFather','products','categories','id'));

            }

            if($route == 'tag.sub_subcategory.products.filter'){
                $products = Product::where('subsubcategory_id',$id)->where('status',1)->where('approved',1)->where('product_tags','like',"%$tag%")
                    ->paginate(12);
                return view('frontend.sub_subcategory_products',compact('nameOfFather','products','categories','id'));

            }

            if($route == 'tag.service.products.filter'){
                $products = Product::where('service_id',$id)->where('status',1)->where('approved',1)->where('product_tags','like',"%$tag%")
                    ->paginate(12);
                return view('frontend.products',compact('nameOfFather','products','categories','id'));

            }

            if($route == 'tag.brand.products.filter'){
                $products = Product::where('brand_id',$id)->where('status',1)->where('approved',1)->where('product_tags','like',"%$tag%")
                    ->paginate(12);
                return view('frontend.brand_products',compact('nameOfFather','products','categories','id'));

            }

        }catch(\Exception $ex){

            $notification = array(
                'message'=>'حدث شىء ما خطأ ، من فضلك حاول مرة أخرى ',
                'alert-type'=>'error'
            );
            return redirect()->back()->with($notification);
        }

    }



    /**
     * SearchPost
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function SearchPost(Request $request){

        $validate = $request->validate([
            'search'=>'required|string|max:300',
        ]);

        try{


        $search = $request->search;

            if($search ){
                $services = Service::all();
                $posts = Post::where('post_tags','like',"%$search%")
                    ->where('status',1)->latest()
                    ->paginate(12);
                $images = Image::where('image_name','like',"%$search%")->take(8)->get();
                 return view('frontend.posts',compact('posts','services','images'));
            }


        }catch(\Exception $ex){

            $notification = array(
                'message'=>'حدث شىء ما خطأ ، من فضلك حاول مرة أخرى ',
                'alert-type'=>'error'
            );
            return redirect()->back()->with($notification);
        }

    }


    /**
     * SearchPostByTag
     * @param $tag
     * @return \Illuminate\Http\RedirectResponse
     */
    public function SearchPostByTag($tag){

        try{
                $services = Service::all();
                $posts = Post::where('post_tags','like',"%$tag%")
                    ->where('status',1)->latest()
                    ->paginate(12);
            $images = Image::where('image_name','like',"%$tag%")->take(8)->get();
                return view('frontend.posts',compact('posts','services','images'));

        }catch(\Exception $ex){

            $notification = array(
                'message'=>'حدث شىء ما خطأ ، من فضلك حاول مرة أخرى ',
                'alert-type'=>'error'
            );
            return redirect()->back()->with($notification);
        }

    }



}//end of controller
