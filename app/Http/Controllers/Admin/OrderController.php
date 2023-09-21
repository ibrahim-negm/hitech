<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Product;
use App\Models\Front\Guarantee;
use App\Models\Front\Order;
use App\Models\Front\Order_details;
use App\Models\Front\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{

    /**
     * orders
     * @return \Illuminate\Http\RedirectResponse
     */
    public function Order(){
        try{

            if(Auth::user()->permission->order==1){
                $orders = Order::where('status',1)
                    ->latest()->get();


                return view('backend.order.order',compact('orders'));
            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية لدخول هذه المنطقة');
            }

        }catch(\Exception $ex){

            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى');

        }
    }

    /**
     * ReviewedOrder
     * @return \Illuminate\Http\RedirectResponse
     */
    public function ReviewedOrder(){
        try{

            if(Auth::user()->permission->order==1){
                $orders = Order::where('status',2)
                    ->latest()->get();


                return view('backend.order.order',compact('orders'));
            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية لدخول هذه المنطقة');
            }

        }catch(\Exception $ex){

            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى');

        }
    }

    /**
     * DoneOrder
     * @return \Illuminate\Http\RedirectResponse
     */
    public function DoneOrder(){
        try{

            if(Auth::user()->permission->order==1){
                $orders = Order::where('status',3)
                    ->latest()->get();


                return view('backend.order.order',compact('orders'));
            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية لدخول هذه المنطقة');
            }

        }catch(\Exception $ex){

            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى');

        }
    }

    /**
     * DoneOrder
     * @return \Illuminate\Http\RedirectResponse
     */
    public function ApprovedOrder(){
        try{

            if(Auth::user()->permission->order==1){
                $orders = Order::where('status',4)
                    ->latest()->get();


                return view('backend.order.order',compact('orders'));
            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية لدخول هذه المنطقة');
            }

        }catch(\Exception $ex){

            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى');

        }
    }

    /**
     * RefusedOrder
     * @return \Illuminate\Http\RedirectResponse
     */
    public function RefusedOrder(){
        try{

            if(Auth::user()->permission->order==1){
                $orders = Order::where('status',5)
                    ->latest()->get();


                return view('backend.order.order',compact('orders'));
            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية لدخول هذه المنطقة');
            }

        }catch(\Exception $ex){

            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى');

        }
    }

    /**
     * Show order details
     * @param $id
     * @return  mixed
     */
    public function ShowOrder($id){
        try{
            if(Auth::user()->permission->order==1){
           $order = Order::find($id);
           $order_details = Order_details::where('order_id',$id)->get();
           $shipping = Shipping::where('order_id',$id)->first();
           $guarantee = Guarantee::where('order_id',$id)->first();

            return view('backend.order.show',compact('order','order_details','shipping','guarantee'));


            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية لدخول هذه المنطقة');
            }
        }catch(\Exception $ex){

            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى');

        }
    }

    /**
     * DeliveryProcess
     * @param $id
     * @return  mixed
     */
    public function DeliveryProcess($id){
        try{
            if(Auth::user()->permission->order==1){
            Order::find($id)->update([
                'status'=> 2,
            ]);
            return redirect()->back()->with('success','نم تحديث حالة المنتج الى مرحلة المراجعة ');
            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية لدخول هذه المنطقة');
            }

        }catch(\Exception $ex){


            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى');

        }
    }



    /**
     * DeliveryDone
     * make the order in a  done delivery status
     * @param $id
     * @return  mixed
     */
    public function DeliveryDone($id){
        try{
            if(Auth::user()->permission->order==1){

            $products = Order_details::where('order_id',$id)->get();

            foreach ($products as $row){

                Product::where('id',$row->product_id)->update([
                    'product_quantity'=>DB::raw('product_quantity-'.$row->quantity),
                ]);

                }

            Order::find($id)->update([
                'status'=> 3,
            ]);
            return redirect()->back()->with('success','نم تحديث حالة المنتج الى مرحلة التنفيذ للعميل ');
            }else{
            return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية لدخول هذه المنطقة');
        }

        }catch(\Exception $ex){

            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى');

        }
    }

    /**
     * OrderRefused
     * make the order in a  refused  status
     * @param $id
     * @return  mixed
     */
    public function OrderRefused($id){
        try{
            if(Auth::user()->permission->order==1){

                $products = Order_details::where('order_id',$id)->get();

                foreach ($products as $row){

                    Product::where('id',$row->product_id)->update([
                        'product_quantity'=>DB::raw('product_quantity-'.$row->quantity),
                    ]);

                }

                Order::find($id)->update([
                    'status'=> 5,
                ]);
                return redirect()->back()->with('error','نم تحديث حالة المنتج الى رفض الاستعلام للعميل ');
            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية لدخول هذه المنطقة');
            }

        }catch(\Exception $ex){

            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى');

        }
    }


    /**
     * OrderedApproved
     * @param $id
     * @return  mixed
     */
    public function OrderedApproved($id){
        try{
            if(Auth::user()->permission->order==1){
                Order::find($id)->update([
                    'status'=> 4,
                ]);
                return redirect()->back()->with('success','نم تحديث حالة المنتج الى مرحلة الاستلام  ');
            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية لدخول هذه المنطقة');
            }

        }catch(\Exception $ex){


            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى');

        }
    }

}//end of controller
