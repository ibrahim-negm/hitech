<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Admin\Coupon;
use App\Models\Front\Guarantee;
use App\Models\Front\Order;
use App\Models\Front\Order_details;
use App\Models\Front\Shipping;
use App\Models\User;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{


    /**
     * UpdateProfile
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function UpdateProfile(Request $request,$id){

        $validate = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($id)],
            'profile_photo_path'=>['mimes:jpg,jpeg,png|max:250']
        ],
            [
                'name.required' => 'هذا الحقل مطلوب',
                'name.max'=>'هذا الحقل لايتجاوز الـ255 حرف',
                'email.required' => 'هذا الحقل مطلوب',
                'email.max' => 'هذا الحقل لايتجاوز الـ255 حرف',
                'email.unique' => 'هذا البريد الالكترونى موجود مسبقا',
                'profile_photo_path.mimes'=>'يجب ان تكون الصورة jpg,jpeg,png',
                'profile_photo_path.max'=>'اقصى حجم للصورة 250 كيلو'
            ]);
        try{
            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;

            if($request->file('profile_photo_path')){
                $image = $request->file('profile_photo_path');
                @unlink(public_path('upload/frontend/users/'.$user->profile_photo_path));
                $new_image = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
                Image::make($image)->resize(200,200)->save(public_path('upload/frontend/users/'.$new_image));

                $user->profile_photo_path = $new_image;
            }

            $user->save();

            $notification = array(
                'message' => 'تم تحديث البيانات الشخصية بنجاح',
                'alert-type' => 'success'
            );

            return redirect()->route('dashboard')->with($notification);

        }catch (\Exception $ex){
            $notification = array(
                'message'=>'حدث شىء ما خطأ ، من فضلك حاول مرة أخرى ',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);

        }
    }

    /**
     * UserUpdatePassword page
     * @return \Illuminate\Http\RedirectResponse
     */
    public function UserUpdatePassword(){
        try{
            if(Auth::check()){

                return view('frontend.user_update_password');
            }else{
                return redirect()->route('login');
            }

        }catch (\Exception $ex){
            $notification = array(
                'message'=>'حدث شىء ما خطأ ، من فضلك حاول مرة أخرى ',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);

        }
    }

    /**
     * UpdatePassword
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function UpdatePassword(Request $request){

        $validate = $request->validate([
            'current_password'=>'required',
            'password'=>'required|confirmed|min:8',
            'password_confirmation'=>'required',
        ],
            [
                'current_password.required'=>'هذا الحقل مطلوب',
                'password.required'=>'هذا الحقل مطلوب',
                'password.min'=>'اقل عدد من الحروف 8',
                'password.confirmed'=>'لايوجد تطابق فى كلمة المرور',
                'password_confirmation.required'=>'هذا الحقل مطلوب',
            ]);


        try{
            $hashedPassword = User::find(Auth::id())->password;
            if(Hash::check($request->current_password,$hashedPassword)){
                $user = User::find(Auth::id());
                $user->password = Hash::make($request->password);
                $user->updated_at = Carbon::now();
                $user->save();


                $notification = array(
                    'message' => 'تم تغيير كلمة المرور بنجاح',
                    'alert-type' => 'success'
                );

                return redirect()->route('dashboard')->with($notification);
            }else{
                $notification = array(
                    'message' => 'كلمة المرور غير صحيحة',
                    'alert-type' => 'error'
                );

                return redirect()->route('dashboard')->with($notification);
            }

        }catch (\Exception $ex){
            $notification = array(
                'message'=>'حدث شىء ما خطأ ، من فضلك حاول مرة أخرى ',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);

        }
    }

    /**
     * show wishlist
     * @return \Illuminate\Http\RedirectResponse
     */
    public function ShowWishlist(){
        try{
            if(Auth::check()){

                return view('frontend.user_wishlist');
             }else{
            return redirect()->route('login');
        }


        }catch (\Exception $ex){
            $notification = array(
                'message'=>'حدث شىء ما خطأ ، من فضلك حاول مرة أخرى ',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);

        }
    }

    /**
     * ShowOrder
     * @return \Illuminate\Http\RedirectResponse
     */
        public function ShowOrder()
        {
            try {
                if (Auth::check()) {

                    return view('frontend.user_order');
                } else {
                    return redirect()->route('login');
                }


            } catch (\Exception $ex) {
                $notification = array(
                    'message'=>'حدث شىء ما خطأ ، من فضلك حاول مرة أخرى ',
                    'alert-type' => 'error'
                );

                return redirect()->back()->with($notification);

            }
        }


    /**
     * apply coupon
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function ApplyCoupon(Request $request){

        $validate = $request->validate([
            'coupon'=>'required|max:100|string',
        ],
            [
                'coupon.required'=>'هذا الحقل مطلوب',
                'coupon.max'=>'هذا الحقل لايتجاوز الـ100 حرف',
                'coupon.string'=>'هذا الحقل لايقبل تلك الصيغة',
            ]);

        try{

            $coupon = $request->coupon;
            $check = Coupon::where('coupon_code',$coupon)->first();

            if($check){

                Session::put('coupon',[
                    'name'     => $check->coupon_code,
                    'discount' => $check->coupon_discount,
                    'balance'  => Cart::subtotal()- $check->coupon_discount,
                ]);

                $notification = array(
                    'message'=>'تم تنفيذ كود الخصم بنجاح',
                    'alert-type'=>'success'
                );
                return redirect()->back()->with($notification);
            }else{
              $notification = array(
                  'message'=>'هذا الكود غير صحيح',
                  'alert-type' => 'error'

              );
                return redirect()->back()->with($notification);
            }

        }catch (\Exception $ex){

            $notification = array(
                'message'=>'حدث شىء ما خطأ ، من فضلك حاول مرة أخرى ',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);

        }
    }

    /**
     * remove coupon
     * @return \Illuminate\Http\RedirectResponse
     */
    public function RemoveCoupon(){
        try{

            Session::forget('coupon');
            $notification = array(
                'message' => 'تم حذف كود الخصم بنجاح',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        }catch (\Exception $ex){

            $notification = array(
                'message'=>'حدث شىء ما خطأ ، من فضلك حاول مرة أخرى ',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);

        }
    }

    /**
     * Quick view for orders
     * @param $id
     * @return mixed
     */
        public function QuickViewOrder($id){
        try{
            $order = Order::find($id);
            $order_details = Order_details::where('order_id',$id)->get();
            $shipping = Shipping::where('order_id',$id)->first();
            $guarantee = Guarantee::where('order_id',$id)->first();

            return view('frontend.quick_view_order',compact('order','order_details','shipping','guarantee')) ;

        }catch (\Exception $ex){
            $notification = array(
                'message'=>'حدث شىء ما خطأ ، من فضلك حاول مرة أخرى ',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);

        }
    }

    /**
     * order traced
     * @param $id
     * @return mixed
     */

    public function TracedOrder($id){

        try{
        $order = Order::find($id);
        $order_details = Order_details::where('order_id',$id)->get();
        if($order){
        return view('frontend.quick_view_traced_order',compact('order','order_details'));
        }

        }catch (\Exception $ex){
            $notification = array(
                'message'=>'حدث شىء ما خطأ ، من فضلك حاول مرة أخرى ',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);

        }
    }



    /**
     * UserAddress
     * @return \Illuminate\Http\RedirectResponse
     */
    public function UserAddress(){

        try{
            if(Auth::check()){

                return view('frontend.user_address');
            }else{
                return redirect()->route('login');
            }

        }catch (\Exception $ex){
            $notification = array(
                'message'=>'حدث شىء ما خطأ ، من فضلك حاول مرة أخرى ',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);

        }
    }

    /**
     * UserSubscriber
     * @return \Illuminate\Http\RedirectResponse
     */
    public function UserSubscriber(){
        try{
            if(Auth::check()){

                return view('frontend.user_subscriber');
            }else{
                return redirect()->route('login');
            }

        }catch (\Exception $ex){
            $notification = array(
                'message'=>'حدث شىء ما خطأ ، من فضلك حاول مرة أخرى ',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);

        }
    }

}//end of controller
