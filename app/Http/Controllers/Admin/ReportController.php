<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Front\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function __construct(){
        $this->middleware(['auth:sanctum,admin']);
    }

    /**
     * daily report function
     * @return \Illuminate\Http\RedirectResponse
     */

    public function DailyReport (){
        try{
            if(Auth::user()->permission->report == 1){
                $today = date('d-m-y');
                $orders = Order::whereIn('status',[1,2,3,4,5])->where('date',$today)->latest()->get();

                return view('admin.report.today',compact('orders'));

            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لديك صلاحية للدخول لهذة المنطقة',);

            }


        }catch(\Exception $ex){
            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);

        }

    }

    /**
     * montly report function
     * @return \Illuminate\Http\RedirectResponse
     */

    public function MonthlyReport (){

        try{

            if(Auth::user()->permission->report == 1){
                $month = date('F');
                $orders = Order::whereIn('status',[1,2,3,4,5])->where('month',$month)->latest()->get();


                return view('admin.report.month',compact('orders'));

            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لديك صلاحية للدخول لهذة المنطقة',);

            }


        }catch(\Exception $ex){
            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);

        }
    }

    /**
     * search bage
     * @return \Illuminate\Http\RedirectResponse
     */

    public function SearchReport (){
        try{
            if(Auth::user()->permission->report == 1){
                return view('admin.report.search');
            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لديك صلاحية للدخول لهذة المنطقة',);
            }

        }catch(\Exception $ex){
            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);

        }
    }

    /**
     * search by date
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function SearchByDate(Request $request){
        try{
            if(Auth::user()->permission->report == 1){
                $date = date('d-m-y',strtotime($request->date));
                $orders = Order::whereIn('status',[1,2,3,4,5])->where('date',$date)->latest()->get();

                return view('admin.report.search_by_date',compact('orders','date'));

            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لديك صلاحية للدخول لهذة المنطقة',);

            }

        }catch(\Exception $ex){
            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);

        }
    }

    /**
     * search by month
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function SearchByMonth(Request $request){
        try{
            if(Auth::user()->permission->report == 1){
                $month =$request->month;
                $orders = Order::whereIn('status',[1,2,3,4,5])->where('month',$month)->latest()->get();

                return view('admin.report.search_by_month',compact('orders','month'));

            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لديك صلاحية للدخول لهذة المنطقة',);

            }

           }catch(\Exception $ex){
            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);

        }
    }

    /**
     * search by year
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function SearchByYear(Request $request ){
        try{
            if(Auth::user()->permission->report == 1){
                $year =$request->year;
                $orders = Order::whereIn('status',[1,2,3,4,5])->where('year',$year)->latest()->get();

                return view('admin.report.search_by_year',compact('orders','year'));
            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لديك صلاحية للدخول لهذة المنطقة',);

            }

        }catch(\Exception $ex){
            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);

        }
    }

}//end of controller
