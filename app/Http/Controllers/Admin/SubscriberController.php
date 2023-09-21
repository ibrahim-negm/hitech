<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\News;
use App\Models\Admin\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SubscriberController extends Controller
{


    /**
     * ShowSubscriber
     * @return \Illuminate\Http\RedirectResponse
     */
    public function ShowSubscriber(){

        try{
            if(Auth::user()->permission->subscriber==1){
                $subscribers = Subscriber::latest()->get();
                return view('backend.subscriber.subscriber',compact('subscribers'));
            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية للدخول الى هذه المنطقة');

            }

        }catch(\Exception $ex){
            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى');

        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function DeleteSubscriber($id){

        try{
            if(Auth::user()->permission->subscriber==1){
                Subscriber::find($id)->delete();
                return redirect()->route('admin.subscriber')->with('error','تم مسح هذا المشترك بنجاح');
            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية للدخول الى هذه المنطقة');

            }

        }catch(\Exception $ex){

            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى');
        }
    }

    /**
     * send news page
     * @return \Illuminate\Http\RedirectResponse
     */
    public function SendNews(){
        try{
            if(Auth::user()->permission->subscriber==1){
                $subscribers = Subscriber::latest()->get();
                return view('backend.subscriber.show',compact('subscribers'));
            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية للدخول الى هذه المنطقة');

            }
        }catch(\Exception $ex){

            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى');
        }

    }

    /**
     * Send News To Subscribers
     * @param Request $request
     * @return \Exception|\Illuminate\Http\RedirectResponse
     */
     public function SendNewsToSubscriber(Request $request){

         $validate = $request->validate([

             'subject'=>'required|string|max:255',
             'message'=>'required|string',
         ],
             [

                 'subject.required'=>'هذا الحقل مطلوب',
                 'message.required'=>'هذا الحقل مطلوب'
             ]);

        try{
             if(Auth::user()->permission->subscriber==1){

                 $data = array();

                 $data['subject'] = $request->subject;
                 $data['message'] = $request->message;
                 if($request->email){
                     $data['email'] =implode(',',$request->email);
                     $news= News::create($data);

                     foreach(explode(',',$news->email) as $key =>$email){
                         //لارسال رسالة الى المتابعين بالنشرة
                         Mail::to($email)->send(new \App\Mail\News($data,$email));
                     }
                 }else{
                     return redirect()->back()->with('error','قم باختيار على الاقل عميل واحد');

                 }

                 return redirect()->back()->with('success','تم إرسال هذة النشرة بنجاح الى العملاء بنجاح');


             }else{
                 return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية للدخول الى هذه المنطقة');

             }
         }catch(\Exception $ex){

             return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى');
         }
     }







}// end of controller
