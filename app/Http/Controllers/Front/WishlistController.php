<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Front\Wishlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;


class WishlistController extends Controller
{
    /**
     * AddWishlist
     * @param $product_id
     * @return \Illuminate\Http\JsonResponse
     */
   public function AddWishlist($product_id){

       try{
           $user_id = Auth::id();
           $check = Wishlist::where('user_id',$user_id)->where('product_id',$product_id)->first();

           $data = array(
               'user_id' => $user_id,
               'product_id' => $product_id,

           );

           if(Auth::check()){
               if($check){

                   return Response::json(['error' => 'هذا المنتج محفوظ من قبل فى قائمة المنتجات المفضلة لديك']);

               }else{
                   Wishlist::create($data);

                   return Response::json(['success' => 'تم إضافة المنتج بنجاح فى قائمة المنتجات المفضلة لديك']);

               }
           }else{

               return Response::json(['error' => 'يجب عليك  تسجيل الدخول اولاً']);
           }


       }catch (\Exception $ex){


           return Response::json(['error' => 'حدث شىْ ما خطأ , الرجاء المحازلة مرة أخرىً']);


       }
   }

    /**
     * @param $product_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function RemoveWishlist($product_id){

        try{
            $user_id = Auth::id();
            $check = Wishlist::where('user_id',$user_id)->where('product_id',$product_id)->first();

            if(Auth::check()){
                if($check){
                   $check->delete();

                    return Response::json(['success' => 'تم حذف المنتج بنجاح فى قائمة المنتجات المفضلة لديك']);

                }else{
                    return Response::json(['error' => 'تم حذف المنتج من قبل من قائمة المنتجات المفضلة لديك']);

                }

            }else{
                return Response::json(['error' => 'يجب عليك  تسجيل الدخول اولاً']);
            }

        }catch (\Exception $ex){
            return Response::json(['error' => 'حدث شىْ ما خطأ , الرجاء المحازلة مرة أخرىً']);

        }

    }



}//end of controller
