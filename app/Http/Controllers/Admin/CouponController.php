<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class CouponController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum,admin']);
    }

    /**
     * ShowCoupon
     * @return \Illuminate\Http\RedirectResponse
     */
    public function ShowCoupon(){

        try{
            if(Auth::user()->permission->coupon==1){
                $coupons = Coupon::latest()->get();
                return view('admin.coupon.coupon',compact('coupons'));
            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لديك صلاحية للدخول لهذة المنطقة',);
            }

        }catch(\Exception $ex){
            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);

        }
    }

    /**
     * StoreCoupon
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function StoreCoupon(Request $request){
        $validate = $request->validate([
            'coupon_code'=>'required|unique:coupons|max:50',
            'coupon_discount'=>'required|max:2',
        ],
            [
                'coupon_code.required'=>' هذا الحقل مطلوب',
                'coupon_code.unique'=>'هذا الحقل موجود مسبقاً',
                'coupon_code.max'=>'اسم الحقل لا يتجاوز الـ50 حرف',
                'coupon_discount.required'=>' هذا الحقل مطلوب',
                'coupon_discount.max'=>'اسم الحقل لا يتجاوز حرفين'

            ]
        );


        try{
            if(Auth::user()->permission->coupon==1){
                Coupon::insert([
                    'coupon_code' => $request->coupon_code,
                    'coupon_discount' => $request->coupon_discount,
                    'created_at' => Carbon::now()
                ]);

                return redirect()->route('admin.coupon')->with('success','تم اضافة هذا الاشعار بنجاح');

            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لديك صلاحية للدخول لهذة المنطقة',);
            }

        }catch(\Exception $ex){

            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى');
        }
    }

    /**
     * EditCoupon
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function EditCoupon($id){
        try{
            if(Auth::user()->permission->coupon==1){
                $coupon = Coupon::find($id);
                return view('admin.coupon.edit',compact('coupon'));

            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لديك صلاحية للدخول لهذة المنطقة',);
            }

        }catch(\Exception $ex){


            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);
        }
    }

    /**
     * UpdateCoupon
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function UpdateCoupon(Request $request , $id){

        $validate = $request->validate([
            'coupon_code'=>'required|max:50',
            'coupon_discount'=>'required|max:2',
        ],
            [
                'coupon_code.required'=>' هذا الحقل مطلوب',
                'coupon_code.max'=>'اسم الحقل لا يتجاوز الـ50 حرف',
                'coupon_discount.required'=>' هذا الحقل مطلوب',
                'coupon_discount.max'=>'اسم الحقل لا يتجاوز حرفين'

            ]
        );

        try{
            if(Auth::user()->permission->coupon==1){
                $update = Coupon::find($id)->update([
                    'coupon_code'=>$request->coupon_code,
                    'coupon_discount'=>$request->coupon_discount,
                    'updated_at'=>Carbon::now(),
                ]);

                return redirect()->route('admin.coupon')->with('success','تم تحديث الاشعار بنجاح',);

            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لديك صلاحية للدخول لهذة المنطقة',);
            }

        }catch(\Exception $ex){

            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);
        }
    }

    /**
     * DeleteCoupon
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function DeleteCoupon($id){

        try{
            if(Auth::user()->permission->coupon==1){
                Coupon::find($id)->delete();
                return redirect()->route('admin.coupon')->with('error','تم مسح هذا الاشعار بنجاح');
            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لديك صلاحية للدخول لهذة المنطقة',);
            }

        }catch(\Exception $ex){

            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);
        }
    }


}// end of controller
