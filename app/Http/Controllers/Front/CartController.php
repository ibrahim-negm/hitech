<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Admin\Governorate;
use App\Models\Admin\Product;
use App\Models\Admin\Setting;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class CartController extends Controller
{
    /**
     * AddCart
     * @param $product_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function AddCart($product_id){

        try{

            $product = Product::find($product_id);

            $data = array();

                $data['id'] = $product->id;
                $data['name'] = $product->product_name;
                $data['qty'] = 1;
                if($product->discount_price == NULL){
                $data['price'] = $product->selling_price;
                }else{
                $data['price'] = $product->discount_price;
                }
                $data['weight'] = 1;

                $data['options']['image'] = $product->image_one;

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
     * CheckCart
     * @return \Illuminate\Http\JsonResponse
     */
    public function CheckCart(){

        try{

            $content = Cart::content();
            return response()->json($content);

        }catch(\Exception $ex){
            return Response::json(['error' => 'حدث شىْ ما خطأ , الرجاء المحازلة مرة أخرىً']);
        }
    }

    /**
     * ShowCart
     * @return \Illuminate\Http\RedirectResponse
     */
    public function ShowCart(){

        try{

            $settings = Setting::first();
            $cart = Cart::content();

            return view('frontend.show_cart',compact('cart','settings'));

        }catch(\Exception $ex){

            $notification = array(
                'message'=>'حدث خطأ ما . الرجاء المحاولة مرة اخرى',
                'alert-type'=>'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    /**
     * RemoveCart
     * @param $rowId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function RemoveCart($rowId){

        try{
            Cart::remove($rowId);
            $notification = array(
                'message'=>'تم حذف هذا المنتج بنجاح من سلة المشتريات الخاصة بك',
                'alert-type'=>'success'
            );
            return redirect()->back()->with($notification);

        }catch(\Exception $ex){

            $notification = array(
                'message'=>'حدث خطأ ما . الرجاء المحاولة مرة اخرى',
                'alert-type'=>'error'
            );
            return redirect()->back()->with($notification);
        }

    }

    /**
     * UpdateCart
     * @param Request $request
     * @param $rowId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function UpdateCart(Request $request,$rowId){
        try{


            $data = array();
            $data['qty']= $request->qty;

            $data['options']['image'] = $request->image;

            Cart::update($rowId,$data);



            $notification = array(
                'message'=>'تم تحديث بيانات سلة المشتريات بنجاح',
                'alert-type'=>'success'
            );
            return redirect()->back()->with($notification);

        }catch(\Exception $ex){

            $notification = array(
                'message'=>'حدث خطأ ما . الرجاء المحاولة مرة اخرى',
                'alert-type'=>'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    /**
     * Checkout
     * @return \Illuminate\Http\RedirectResponse
     */
    public function Checkout(){

        try{

               $cart = Cart::content();
               $governorates = Governorate::all();
                return view('frontend.checkout',compact('cart','governorates'));

        }catch (\Exception $ex){

            $notification = array(
                'message' => 'حدث شىْ ما خطأ , الرجاء المحازلة مرة أخرى',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);

        }
    }

}//end of controller
