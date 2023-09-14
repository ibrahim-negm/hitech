<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Mail\InvoiceMail;

use App\Models\Admin\Subscriber;
use App\Models\Front\Guarantee;
use App\Models\Front\Order;
use App\Models\Front\Order_details;
use App\Models\Front\Shipping;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;


class PaymentController extends Controller
{


    /**
     * Payment
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
   public function Payment(Request $request){
       $password =$request->password;

       if( $password != null) {
           $validated= $request->validate([
               'name' => ['required', 'string', 'max:255'],
               'billing_address' => ['required', 'string', 'max:255'],
               'billing_address2' => [ 'max:255'],
               'city' => ['required', 'string' , 'max:255'],
               'phone' => ['required', 'numeric', 'digits:11'],
               'email' => [  'email','max:255','unique:users'],
               'password' => ['max:255','min:8'],

           ],
               [
                   'name.required'=>'هذا الحقل مطلوب',
                   'billing_address.required'=>'هذا الحقل مطلوب',
                   'city.required'=>'هذا الحقل مطلوب',
                   'phone.required'=>'هذا الحقل مطلوب',
                   'phone.numeric'=>'نمط الموبيل ارقام',
                   'phone.digits'=>'رقم الموبيل 11 رقم',
                   'password.min'=>'اقل عدد من الحروف 8',
                   'email.unique'=>'  هذا البريد الالكترونى موجود من قبل او انك مشترك من قبل فقم بتسجيل الدخول أولا',

               ]);
       }else{
           $validated= $request->validate([
               'name' => ['required', 'string', 'max:255'],
               'billing_address' => ['required', 'string', 'max:255'],
               'billing_address2' => [ 'max:255'],
               'city' => ['required', 'string' , 'max:255'],
               'phone' => ['required', 'numeric', 'digits:11'],



           ],
               [
                   'name.required'=>'هذا الحقل مطلوب',
                   'billing_address.required'=>'هذا الحقل مطلوب',
                   'city.required'=>'هذا الحقل مطلوب',
                   'phone.required'=>'هذا الحقل مطلوب',
                   'phone.numeric'=>'نمط الموبيل ارقام',
                   'phone.digits'=>'رقم الموبيل 11 رقم',


               ]);
       }

       try{

           //لتحديث بيانات التليفون للمستخدم//
           if(Auth::check()) {
               User::find(Auth::id())->update([
                   'phone' => $request->phone,
                   'address' => $request->billing_address . " " . $request->billing_address2,
                   'city' => $request->city,
               ]);
           }
               //للتسجيل كعميل جديد//
           if( $password != null) {

               $new_user = array();
               $new_user['name'] = $request->name;
               $new_user['phone'] = $request->phone;
               $new_user['address'] = $request->billing_address . " " . $request->billing_address2;
               $new_user['city'] = $request->city;
               $new_user['email'] = $request->email;
               $new_user['password'] = Hash::make($request->password);


               User::create($new_user);

               //لتسجيل العميل فى النشرة الشهرية
               Subscriber::create([
                   'email' =>$request->email,
               ]);


           }

         //   بيانات الاوردر وادخاله فى جدول orders
           $createdOrder = Order::create([
               'user_id' => (Auth::check()) ? Auth::id() : null ,
               'payment_type' => "1",
               'subtotal' =>$request->subtotal ,
               'total' =>$request->total,
               'status' => 0,
               'return_order' => 0,
               'notes' =>$request->notes,
               'month' => date('F'),
               'date' => date('d-m-y'),
               'year' => date('Y'),


           ]);

        // بيانات المشترى وادخالها فى جدول الShipping
           $shipping = array();
           $shipping['order_id']= $createdOrder->id;
           $shipping['ship_name'] = $request->name ;
           $shipping['ship_country'] = "EGYPT" ;
           $shipping['ship_city'] = $request->city ;
           $shipping['ship_address'] = $request->billing_address." ".$request->billing_address2 ;
           $shipping['ship_phone'] = $request->phone ;
           $shipping['ship_email'] = $request->email ;

           $shipping_data = Shipping::create($shipping);

         // بيانات الضامن وادخالها فى جدول الguarantees
           if( $request->guarantee_name != null) {
               $guarantee = array();
               $guarantee['order_id'] = $createdOrder->id;
               $guarantee['guarantee_name'] = $request->guarantee_name;
               $guarantee['guarantee_city'] = $request->guarantee_city;
               $guarantee['guarantee_address'] = $request->guarantee_billing_address . " " . $request->guarantee_billing_address2;
               $guarantee['guarantee_phone'] = $request->guarantee_phone;
               $guarantee['guarantee_email'] = $request->guarantee_email;

               Guarantee::create($guarantee);
           }


         // تفاصيل الاورد وادخالها فى جدول orders_details
           $cart = Cart::content();
           $order_details = array();
           foreach($cart as $row){
               $order_details['order_id']= $createdOrder->id;
               $order_details['product_id']= $row->id;
               $order_details['product_name']= $row->name;
               if($row->options->color == NULL){$order_details['color']= "";}else{$order_details['color']= $row->options->color;};
               if($row->options->size == NULL){$order_details['size']= "";}else{$order_details['size']= $row->options->size;};
               $order_details['quantity']= $row->qty;
               $order_details['singleprice']= $row->price;
               $order_details['totalprice']= $row->qty * $row->price;

               Order_details::create($order_details);

           }

           if( $request->email != null) {
                 Mail::to($request->email)->send(new InvoiceMail($createdOrder,$shipping_data));
           }

           // لمسح السلة مرة اخرى
           Cart::destroy();
           if(Session::has('coupon')){
               Session::forget('coupon');
           }
//لارسال معلومات بنجاح العملية
           $status ='' ;
           if($createdOrder){
               $status ='success';
           }

           return redirect()->route('order-completed',[$createdOrder->id,$status]);

       }catch (\Exception $ex){

           $notification = array(
               'message' => 'حدث شىْ ما خطأ , الرجاء المحاولة مرة أخرى',
               'alert-type' => 'error'
           );

           return redirect()->back()->with($notification);

       }
   }

    /**
     * orderStatus
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
   public function orderStatus(Request $request,$id){
       try{
           if ( $request->status == 'success' ) {

              $order= Order::findOrfail($id);
                   if ($order) {
                       $orderData = Order::where('id',$id)->first();
                       if ($orderData) {
                           if($orderData->status == 0){
                               $orderData->update([
                                   'status' => 1
                               ]);
                           }

                       }


                   return view('pages.order_completed');
               }
           }

              return redirect()->route('order-not-completed');

       }catch (\Exception $ex){
           $notification = array(
               'message' => 'حدث شىْ ما خطأ , الرجاء المحاولة مرة أخرى',
               'alert-type' => 'error'
           );

           return redirect()->back()->with($notification);

       }
   }

    /**
     * FailOrder
     * @return \Illuminate\Http\RedirectResponse
     */
   public function FailOrder (){
       try{
           return view('pages.order_not_completed');

       }catch (\Exception $ex){

           $notification = array(
               'message' => 'حدث شىْ ما خطأ , الرجاء المحاولة مرة أخرى',
               'alert-type' => 'error'
           );

           return redirect()->back()->with($notification);

       }
   }

    /**
     * FastPayment
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function FastPayment(Request $request){

            $validated= $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'address' => ['required', 'string', 'max:255'],
                'phone' => ['required', 'numeric', 'digits:11'],
                'notes' => ['required','max:255','min:5'],

            ],
                [
                    'name.required'=>'هذا الحقل مطلوب',
                    'address.required'=>'هذا الحقل مطلوب',
                    'phone.required'=>'هذا الحقل مطلوب',
                    'phone.numeric'=>'نمط الموبيل ارقام',
                    'phone.digits'=>'رقم الموبيل 11 رقم',
                    'notes.min'=>'اقل عدد من الحروف 5',
                    'notes.required'=>'هذا الحقل مطلوب',

                ]);


        try{

            //   بيانات الاوردر وادخاله فى جدول orders
            $createdOrder = Order::create([
                'user_id' => (Auth::check()) ? Auth::id() : null ,
                'payment_type' => "2",
                'status' => 1,
                'notes' =>$request->notes,
                'month' => date('F'),
                'date' => date('d-m-y'),
                'year' => date('Y'),
            ]);

            // بيانات المشترى وادخالها فى جدول الShipping
            $shipping = array();
            $shipping['order_id']= $createdOrder->id;
            $shipping['ship_name'] = $request->name ;
            $shipping['ship_country'] = "EGYPT" ;
            $shipping['ship_address'] = $request->address ;
            $shipping['ship_phone'] = $request->phone ;

           Shipping::create($shipping);

//لارسال معلومات بنجاح العملية
            $status ='' ;
            if($createdOrder){
                $status ='success';
            }

            return redirect()->route('order-completed',[$createdOrder->id,$status]);

        }catch (\Exception $ex){

            $notification = array(
                'message' => 'حدث شىْ ما خطأ , الرجاء المحاولة مرة أخرى',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);

        }
    }


}//end of controller
