<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Mail\Message;
use App\Mail\Sent;
use App\Models\Admin;
use App\Models\Admin\Comment_reply;
use App\Models\Admin\Governorate;
use App\Models\Admin\Seo;
use App\Models\Admin\Product;
use App\Models\Admin\Setting;
use App\Models\Front\Comment;
use App\Models\Front\Contact;
use App\Models\Front\Review;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class MainAdminController extends Controller
{
    /**
     * loginForm
     * @return \Illuminate\Contracts\View\View
     */
    public function loginForm(){
        try{
            return view('admin.auth.login');
        }catch(\Exception $ex){
            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);

        }

    }//end of method

    //----------------------------------------
    /**
     * store
     * @param LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request){
        try{
            if (! Auth::guard('admin')->attempt(([
                'email'=>$request->email,
                'password'=>$request->password,
            ]))){
                return redirect()->route('admin.login')->with('error','الرجاء مراجعة البيانات المدخلة');

            }
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard')->with('success','مرحبا بك ' . Auth::guard('admin')->user()->name ." ".'فى لوحة التحكم الخاصة بكم');

        }catch(\Exception $ex){
            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);

        }

    }//end of method
    //----------------------------------------

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
    {
        try{
            Auth::guard('admin')->logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return redirect()->route('admin.login')->with('success','تم الخروج من لوحة التحكم الخاصة بكم بنجاح');

        }catch(\Exception $ex){
            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);

        }
    }//end of method
    //----------------------------------------

    /**
     * Index
     * index page for admin area
     * @return \Illuminate\Http\RedirectResponse
     */
    public function Index(){
        try{


                if(Auth::user()->permission){

            return view('admin.index');
                }else{
                    $notification = array(
                        'message'=>'قم بالخروج من حساب المستخدم أولا',
                        'alert-type'=>'error'
                    );
                    return redirect()->route('main.home')->with($notification);
                }
        }catch(\Exception $ex){

            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);

        }
    }

    /**
     * show profile
     * @return \Illuminate\Http\RedirectResponse
     */
    public function ShowProfile(){
        try{
            $admin = Admin::find(Auth::id());
            return view('admin.user.profile',compact('admin'));
        }catch(\Exception $ex){
            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);

        }
    }

    /**
     * edit profile
     * @return \Illuminate\Http\RedirectResponse
     */
    public function EditProfile(){

        try{
            $admin = Admin::find(Auth::id());
            return view('admin.user.edit',compact('admin'));
        }catch (\Exception $ex){
            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);

        }
    }

    /**
     * update profile
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function UpdateProfile(Request $request){
        $validate = $request->validate([
            'name'=>['required'],
            'phone'=>['required'],
            'email'=>['required', 'email', 'max:255', Rule::unique('admins')->ignore(Admin::find(Auth::id()))],
            'image'=>['mimes:jpg,jpeg,png|max:250']
        ],
            [
                'name.required'=>'هذا الحقل مطلوب',
                'phone.required'=>'هذا الحقل مطلوب',
                'email.required'=>'هذا الحقل مطلوب',
                'image.mimes'=>'يجب ان تكون الصورة jpg,jpeg,png',
                'image.max'=>'اقصى حجم للصورة 250 كيلو'
            ]);


        try{
            $admin = Admin::find(Auth::id());
            $admin->name = $request->name;
            $admin->phone = $request->phone;
            $admin->email = $request->email;
            $admin->updated_at = Carbon::now();

            if($request->file('image')){
                $image = $request->file('image');
                @unlink(public_path('upload/backend/users/'.$admin->profile_photo_path));
                $new_image = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
                Image::make($image)->resize(228,227)->save(public_path('upload/backend/users/'.$new_image));

              //  $image->move(public_path('upload/backend/users'),$new_image);
                $admin->profile_photo_path = $new_image;
            }
            $admin->save();
            return redirect()->route('admin.profile')->with('success','تم تعديل الملف الشخصى للمستخدم بنجاح');

        }catch (\Exception $ex){
            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);

        }
    }

    /**
     * change password
     * @return \Illuminate\Http\RedirectResponse
     */

   public function ChangePassword(){

        try{
            $admin = Admin::find(Auth::id());
            return view('admin.user.change_password',compact('admin'));
        }catch(\Exception $ex){

            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);

        }
   }

    /**
     * update password
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
                $hashedPassword = Admin::find(Auth::id())->password;
                if(Hash::check($request->current_password,$hashedPassword)){
                    $admin = Admin::find(Auth::id());
                    $admin->password = Hash::make($request->password);
                    $admin->updated_at = Carbon::now();
                    $admin->save();
                    Auth::logout();


                    return redirect()->route('admin.login')->with('success','تم تعديل كلمة المرور بنجاح');
                }else{

                    return redirect()->back()->with('error','كلمة المرور غير صحيحة');
                }

        }catch (\Exception $ex){
            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);

        }


   }

    /**
     * seo
     * @return \Illuminate\Http\RedirectResponse
     */
   public function Seo(){
        try{
            if(Auth::user()->permission->setting==1){
                $id=1;
                $seo = Seo::find($id);
                return view('admin.seo.seo',compact('seo'));
            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية لدخول هذه المنطقة');
            }

        }catch(\Exception $ex){

            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);

        }
   }

    /**
     *  update seo
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */

   public function UpdateSeo(Request $request){

       $validate = $request->validate([
           'meta_title'=>'required|max:100',
           'meta_tag'=>'required',
           'meta_description'=>'required',
           'google_analytics'=>'required|max:100',
       ],
           [
              'meta_title.required'=>'هذا الحقل مطلوب',
              'meta_tag.required'=>'هذا الحقل مطلوب',
              'meta_description.required'=>'هذا الحقل مطلوب',
              'google_analytics.required'=>'هذا الحقل مطلوب',
           ]);
       try{
           if(Auth::user()->permission->setting==1){
               $id = $request->id;
               $data = array();
               $data['meta_title']=$request->meta_title;
               $data['meta_tag']=implode(",",$request->meta_tag);
               $data['meta_description']=$request->meta_description;
               $data['google_analytics']=$request->google_analytics;

               Seo::find($id)->update($data);
               return redirect()->back()->with('success','تم تحديث اعدادات كلمات البحث',);
           }else{
               return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية لدخول هذه المنطقة');
           }

       }catch(\Exception $ex){

                 return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);
        }

   }

    /**
     *  setting page
     * @return \Illuminate\Http\RedirectResponse
     */

    public function Setting(){
        try{
            if(Auth::user()->permission->setting==1){
                $id=1;
                $setting = Setting::find($id);
                $governorates = Governorate::all();
                return view('admin.setting.setting',compact('setting','governorates'));
            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية لدخول هذه المنطقة');
            }

        }catch(\Exception $ex){

            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);

        }
    }

    /**
     * update request
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function UpdateSetting(Request $request){
        $validated = $request->validate([
            'shop_name'=>'required|max:255',
            'email'=>'required|email|max:255',
            'phone'=>'required',
            'address'=>'required',
            'logo_dark'=>'mimes:jpg,jpeg,png|max:100',
            'logo_light'=>'mimes:jpg,jpeg,png|max:100',
            'favicon'=>'mimes:png|max:20',
            'employees'=>'digits_between:1,9',
            'products'=>'digits_between:1,9',
            'clients'=>'digits_between:1,9',
            'branches'=>'digits_between:1,9',
            'facebook'=>'max:255',
            'instagram'=>'max:255',
            'twitter'=>'max:255',
            'whatsup'=>'max:255',
            'youtube'=>'max:255',
            'vat'=>'max:100',
            'shipping_charge'=>'max:100',
            'city_shipping'=>'required',

        ],
            [
                'shop_name.required'=>'هذا الحقل مطلوب',
                'email.required'=>'هذا الحقل مطلوب',
                'phone.required'=>'هذا الحقل مطلوب',
                'address.required'=>'هذا الحقل مطلوب',
                'employees.digits_between'=>'هذا الحقل يجب ان يكون رقم',
                'clients.digits_between'=>'هذا الحقل يجب ان يكون رقم',
                'products.digits_between'=>'هذا الحقل يجب ان يكون رقم',
                'branches.digits_between'=>'هذا الحقل يجب ان يكون رقم',
                'logo_dark.mimes'=>'يجب ان تكون الصورة jpg,jpeg,png',
                'logo_dark.max'=>'اقصى حجم للصورة 100 كيلو',
                'logo_light.mimes'=>'يجب ان تكون الصورة jpg,jpeg,png',
                'logo_light.max'=>'اقصى حجم للصورة 100 كيلو',
                'favicon.mimes'=>'يجب ان تكون الصورة png',
                'favicon.max'=>'اقصى حجم للصورة 20 كيلو',
                'city_shipping.required'=>'هذا الحقل مطلوب',


        ]);

        try{

            if(Auth::user()->permission->setting==1){
                $data=array();
                $id=1;
                $setting = Admin\Setting::find($id);

                if($request->file('logo_dark')){
                    $image = $request->file('logo_dark');
                    @unlink(public_path('upload/'.$setting->logo_dark));
                    $new_image = 'logo_dark'.'.'.$image->getClientOriginalExtension();
                    Image::make($image)->resize(258,75)->save(public_path('upload/'.$new_image));

                    $data['logo_dark'] = $new_image;
                }

                if($request->file('logo_light')){
                    $image = $request->file('logo_light');
                    @unlink(public_path('upload/'.$setting->logo_light));
                    $new_image = 'logo_light'.'.'.$image->getClientOriginalExtension();
                    Image::make($image)->resize(258,75)->save(public_path('upload/'.$new_image));

                    $data['logo_light'] = $new_image;
                }

                if($request->file('favicon')){
                    $image = $request->file('favicon');
                    @unlink(public_path('upload/'.$setting->favicon));
                    $new_image = 'favicon'.'.'.$image->getClientOriginalExtension();
                    Image::make($image)->resize(50,50)->save(public_path('upload/'.$new_image));

                    $data['favicon'] = $new_image;
                }


                $data['shop_name']= $request->shop_name;
                $data['email']= $request->email;
                $data['phone']= $request->phone;
                $data['address']= $request->address;

                $data['employees']= $request->employees;
                $data['clients']= $request->clients;
                $data['branches']= $request->branches;
                $data['products']= $request->products;
                $data['facebook']= $request->facebook;
                $data['instagram']= $request->instagram;
                $data['twitter']= $request->twitter;
                $data['whatsup']= $request->whatsup;
                $data['youtube']= $request->youtube;
                $data['vat']= $request->vat;
                $data['shipping_charge']= $request->shipping_charge;
                $data['city_shipping']= $request->city_shipping;
                if($request->deal_timer){
                    $data['deal_timer']= date('y-m-d',strtotime($request->deal_timer));
                }


                $setting->update($data);

                return redirect()->back()->with('success','تم تحديث  أعدادات المتجر العامة بنجاح');

            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية لدخول هذه المنطقة');
            }

        }catch(\Exception $ex){

            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);

        }
    }

    /**
     * review
     * @return \Illuminate\Http\RedirectResponse
     */
        public function Review(){
             try{
                 if(Auth::user()->permission->review==1){
                   $reviews = Review::latest()->get();
                   return view('admin.review.review',compact('reviews'));
                 }else{
                     return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية لدخول هذه المنطقة');
                 }
             }catch(\Exception $ex){
                 return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);

             }
        }

    /**
     * NewReview
     * @return \Illuminate\Http\RedirectResponse
     */
    public function NewReview(){
        try{
            if(Auth::user()->permission->review==1){
                $reviews = Review::where('status',0)->latest()->get();
                return view('admin.review.review',compact('reviews'));
            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية لدخول هذه المنطقة');
            }
        }catch(\Exception $ex){
            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);

        }
    }

    /**
     * ReadReview
     * @return \Illuminate\Http\RedirectResponse
     */
    public function ReadReview(){
        try{
            if(Auth::user()->permission->review==1){
                $reviews = Review::where('status',1)->latest()->get();
                return view('admin.review.review',compact('reviews'));
            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية لدخول هذه المنطقة');
            }
        }catch(\Exception $ex){
            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);

        }
    }

    /**
     * DeleteReview
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */

        public function DeleteReview($id){

            try{
                if(Auth::user()->permission->review==1){
                     Review::find($id)->delete();
                    return redirect()->back()->with('success','تم حذف هذا التعليق بنجاح');

                }else{
                    return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية لدخول هذه المنطقة');
                }
            }catch(\Exception $ex){
                return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);

            }
        }

    /**
     * Show Review
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */

        public function ShowReview($id){
                   try{
                       if(Auth::user()->permission->review==1) {
                           $review = Review::find($id);
                           Review::find($id)->update([
                               'status'=>1,
                           ]);
                           return view('admin.review.show', compact('review'));
                       }else{
                           return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية لدخول هذه المنطقة');
                       }
                   }catch(\Exception $ex){
                       return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);

                   }
        }

    /**
     * StoreReplyReview
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function StoreReplyReview(Request $request ,$id){

        $validate = $request->validate([
            'description'=>'required|string',
        ],
            [

                'description.required'=>'هذا الحقل مطلوب'
            ]);

        try{
            if(Auth::user()->permission->review == 1){

                $data = array();

                $data['admin_id'] = Auth::id();
                $data['review_id'] = $id;
                $data['description'] = $request->description;

                $reply= Review_reply::create($data);


                return redirect()->route('admin.review')->with('success','تم الرد على هذة التعليق بنجاح');

            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية لدخول هذه المنطقة');

            }

        }catch (\Exception $ex){

            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);
        }
    }

    /**
     * Comment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function Comment(){
        try{
            if(Auth::user()->permission->comment==1){
                $comments = Comment::latest()->get();
                return view('admin.comment.comment',compact('comments'));
            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية لدخول هذه المنطقة');
            }
        }catch(\Exception $ex){

            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);

        }
    }

    /**
     * Comment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function NewComment(){
        try{
            if(Auth::user()->permission->comment==1){
                $comments = Comment::where('status',0)->latest()->get();
                return view('admin.comment.comment',compact('comments'));
            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية لدخول هذه المنطقة');
            }
        }catch(\Exception $ex){

            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);

        }
    }

    /**
     * Comment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function ReplyComment(){
        try{
            if(Auth::user()->permission->comment==1){
                $comments = Comment::where('status',1)->latest()->get();
                return view('admin.comment.comment',compact('comments'));
            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية لدخول هذه المنطقة');
            }
        }catch(\Exception $ex){

            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);

        }
    }

    /**
     * DeleteComment
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */

    public function DeleteComment($id){

        try{
            if(Auth::user()->permission->comment==1){
                Comment_reply::where('comment_id',$id)->delete();
                Comment::find($id)->delete();
                return redirect()->route('admin.comment')->with('success','تم حذف هذا التعليق بنجاح');

            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية لدخول هذه المنطقة');
            }
        }catch(\Exception $ex){
            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);

        }
    }

    /**
     * ShowComment
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */

    public function ShowComment($id){
        try{
            if(Auth::user()->permission->comment==1) {
                $comment = Comment::find($id);
                $comment_replies = Comment_reply::where('comment_id',$comment->id)->latest()->get();
                return view('admin.comment.show', compact('comment','comment_replies'));
            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية لدخول هذه المنطقة');
            }
        }catch(\Exception $ex){
            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);

        }
    }

    /**
     * StoreReplyComment
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function StoreReplyComment(Request $request ,$id){

        $validate = $request->validate([
            'description'=>'required|string',
        ],
            [

                'description.required'=>'هذا الحقل مطلوب'
            ]);

        try{
            if(Auth::user()->permission->comment == 1){

                $data = array();

                $data['admin_id'] = Auth::id();
                $data['comment_id'] = $id;
                $data['description'] = $request->description;

               $reply = Comment_reply::create($data);
               Comment::find($id)->update([
                   'status'=> 1 ,
                   ]);


                $comment = Comment::find($id);

    //لارسال رسالة الى مرسل الرسالة بالرد
                $email = $comment->user->email;
                Mail::to($email)->send(new Sent($reply,$comment));


                return redirect()->back()->with('success','تم الرد على هذة التعليق بنجاح');

            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية لدخول هذه المنطقة');

            }

        }catch (\Exception $ex){

            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);
        }
    }

    /**
     * DeleteReplyComment
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function DeleteReplyComment($id){
        try{
            if(Auth::user()->permission->comment == 1){

                Comment_reply::find($id)->delete();
                return redirect()->back()->with('success','تم حذف الرد على هذا التعليق بنجاح');

            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية لدخول هذه المنطقة');

            }
        }catch (\Exception $ex){

            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);
        }
    }

    /**
     * Message
     * @return \Illuminate\Http\RedirectResponse
     */
        public function Message(){
            try{
                if(Auth::user()->permission->message==1){
                    $messages= Contact::latest()->get();
                    return view('admin.message.message',compact('messages'));
                }else{
                    return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية لدخول هذه المنطقة');
                }
            }catch(\Exception $ex){
                return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);

            }
        }

    /**
     * NewMessage
     * @return \Illuminate\Http\RedirectResponse
     */
    public function NewMessage(){
        try{
            if(Auth::user()->permission->message==1){
                $messages= Contact::where('status',0)->latest()->get();
                return view('admin.message.message',compact('messages'));
            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية لدخول هذه المنطقة');
            }
        }catch(\Exception $ex){
            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);

        }
    }


    /**
     * NewMessage
     * @return \Illuminate\Http\RedirectResponse
     */
    public function ReadMessage(){
        try{
            if(Auth::user()->permission->message==1){
                $messages= Contact::where('status',1)->latest()->get();
                return view('admin.message.message',compact('messages'));
            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية لدخول هذه المنطقة');
            }
        }catch(\Exception $ex){
            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);

        }
    }


    /**
     * NewMessage
     * @return \Illuminate\Http\RedirectResponse
     */
    public function ReplyMessage(){
        try{
            if(Auth::user()->permission->message==1){
                $messages= Contact::where('status',2)->latest()->get();
                return view('admin.message.message',compact('messages'));
            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية لدخول هذه المنطقة');
            }
        }catch(\Exception $ex){
            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);

        }
    }

    /**
     * Delete Message
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */

    public function DeleteMessage($id){

        try{
            if(Auth::user()->permission->message==1){
                Contact::find($id)->delete();
                return redirect()->back()->with('success','تم حذف هذا الرسالة بنجاح');
            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية لدخول هذه المنطقة');
            }
        }catch(\Exception $ex){
            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);

        }
    }

    /**
     * Show Message
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function ShowMessage($id){
        try{
            if(Auth::user()->permission->message==1) {
                $replied = Admin\Sent::where('contact_id',$id)->latest()->get();
                $message = Contact::find($id);
                if($message->status == 0){
                    $message->update([
                        'status'=>1,
                    ]);
                }

                return view('admin.message.show', compact('message','replied'));
            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية لدخول هذه المنطقة');

            }
        }catch(\Exception $ex){

            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);

        }
    }

    /**
     * Sent Message
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function SentMessage(Request $request ,$id){

        $validate = $request->validate([
            'subject'=>'required|string|max:255',
            'message'=>'required|string',
        ],
            [
                'subject.required'=>'هذا الحقل مطلوب',
                'message.required'=>'هذا الحقل مطلوب'
            ]);

        try{
            if(Auth::user()->permission->message == 1){

                $data = array();

                $data['admin_id'] = Auth::id();
                $data['contact_id'] = $id;
                $data['subject'] = $request->subject;
                $data['message'] = $request->message;

               $reply= Admin\Sent::create($data);

                $message = Contact::find($id);
                if($message->status == 1){
                    $message->update([
                        'status'=>2,
                    ]);
                }

                //لارسال رسالة الى مرسل الرسالة بالرد
                $email = $message->email;
                Mail::to($email)->send(new Message($reply,$message));


                return redirect()->route('admin.message')->with('success','تم الرد على هذة الرسالة بنجاح');

            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية لدخول هذه المنطقة');

            }

        }catch (\Exception $ex){

            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);
        }
    }

    /**
     * stock
     * @return \Illuminate\Http\RedirectResponse
     */
    public function Stock(){
        try{
            if(Auth::user()->permission->stock==1){
                $products = Product::latest()->get();
                return view('admin.stock.stock',compact('products'));
            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية لدخول هذه المنطقة');
            }

        }catch(\Exception $ex){

            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);

        }
    }

    /**
     * ShowAllShipping
     * @return \Illuminate\Http\RedirectResponse
     */
        public function ShowAllShipping(){

        try{
            if(Auth::user()->permission->setting==1) {
               $shippings = Governorate::latest()->get();

                return view('admin.shipping.shipping', compact('shippings'));

            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لديك صلاحية للدخول لهذة المنطقة',);

            }

        }catch(\Exception $ex){
            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);

        }
    }

    /**
     * EditShipping
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function EditShipping($id){
        try{
            if(Auth::user()->permission->setting==1) {
                $shipping = Governorate::find($id);
                return view('admin.shipping.edit', compact('shipping'));
            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لديك صلاحية للدخول لهذة المنطقة',);

            }
        }catch(\Exception $ex){


            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);
        }
    }

    /**
     * UpdateShipping
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function UpdateShipping(Request $request ,$id){
        $validate = $request->validate([
            'governorate'=>'required|max:50',
            'shipping_price'=>'required|digits_between:1,3',
        ],[
                'governorate.required'=>' هذا الحقل مطلوب',
                'governorate.max'=>'اسم الحقل لا يتجوز الـ50 حرف',
                'shipping_price.required'=>' هذا الحقل مطلوب',
                'shipping_price.digits_between'=>'شحن المحافظة لا يتجاوز 999'
            ]
        );

        try{
            if(Auth::user()->permission->setting==1) {

                Governorate::find($id)->update([
                    'governorate' => $request->governorate,
                    'shipping_price' => $request->shipping_price,
                ]);

                return redirect()->route('admin.shipping')->with('success', 'تم تحديث سعر الشحن للمحافظة بنجاح',);
            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لديك صلاحية للدخول لهذة المنطقة',);

            }
        }catch(\Exception $ex){

            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);
        }
    }






}//end of controller
