<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use App\Models\Admin\Employee;
use App\Models\Admin\Image;
use App\Models\Admin\Post;
use App\Models\Admin\Product;
use App\Models\Admin\Service;
use App\Models\Admin\Setting;
use App\Models\Admin\Subscriber;
use App\Models\Front\Comment;
use App\Models\Front\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    /**
     * index page
     * @return \Illuminate\Http\RedirectResponse
     */
    public function Index(){
        try{

            $settings = Setting::first();
            $posts = Post::where('status',1)->latest()->take(3)->get();
            $comments = Comment::latest()->take(9)->get();
            $products = Product::latest()->where('status','1')->where('approved',1)->take(8)->get();

            return view('frontend.index',compact('settings' ,'posts' ,'comments','products'));
        }catch (\Exception $ex){

            $notification = array(
                'message'=>'حدث شىء ما خطأ ، من فضلك حاول مرة أخرى ',
                'alert-type'=>'error'
            );
            return redirect()->back()->with($notification);

        }
    }

    /**
     * AboutPage
     * @return \Illuminate\Http\RedirectResponse
     */
    public function AboutPage(){
        try{
            $employees = Employee::take(4)->get();
            $comments = Comment::latest()->take(9)->get();
            return view('frontend.about',compact('employees','comments'));
        }catch(\Exception $ex){
            $notification = array(
                'message'=>'حدث شىء ما خطأ ، من فضلك حاول مرة أخرى ',
                'alert-type'=>'error'
            );
            return redirect()->back()->with($notification);
        }

    }

    /**
     * NewestOffers
     * @return \Illuminate\Http\RedirectResponse
     */
    public function NewestOffers(){
        try{
            $id = 25;
            $category = Category::where('id',$id)->first();

            $nameOfFather = $category->category_name;

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
     * StoreSubscriber
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function StoreSubscriber(Request $request){
        $validate = $request->validate([
            'email'=>'required|unique:subscribers|max:255',

        ]);

        try{

              Subscriber::create([
                  'email' => $request->email,
              ]);
              $notification = array(
                  'message'=>'تم  الاشتراك فى خدمة النشرة الاخبارية',
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
    }

    /**
     *  Delete subscriber
     * @param $email
     * @return mixed
     */
    public function DeleteSubscriber($email){


            try{
                if(Auth::check()){
                $subscriber =Subscriber::where('email',$email)->first();
                if($subscriber){
                    $subscriber->delete();
                    $notification = array(
                        'message'=>'تم إلغاء اشتراكك فى خدمة النشرة الاخبارية',
                        'alert-type'=>'warning'
                    );
                }else{
                    $notification = array(
                        'message'=>'انت غير مشترك فى خدمة النشرة الاخبارية',
                        'alert-type'=>'warning'
                    );
                }

                return redirect()->back()->with($notification);
                }else{
                    return redirect()->route('login');
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
     *  store in subscriber
     * @param $email
     * @return mixed
     */
    public function StoreInSubscriber($email){

        if(Auth::check()){

            try{

                Subscriber::create([
                    'email'=>$email,
                ]);
                $notification = array(
                    'message'=>'تم  الاشتراك فى خدمة النشرة الاخبارية',
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
            return redirect()->route('login');
        }

    }

    /**
     * ContactPage
     * @return \Illuminate\Http\RedirectResponse
     */
    public function ContactPage(){
        try{
            $settings = Setting::first();
            return view('frontend.contact',compact('settings'));
        }catch(\Exception $ex){
            $notification = array(
                'message'=>'حدث شىء ما خطأ ، من فضلك حاول مرة أخرى ',
                'alert-type'=>'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    /**
     * Store Message
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function StoreMessage(Request $request){

        $validated = $request->validate([

            'name'=>'required|max:100',
            'email'=>'required|email|max:100',
            'phone'=>'required|max:200',
            'subject'=>'required|max:200',
            'message'=>'required',

        ],[
                'name.required'=>'هذا الحقل مطلوب',
                'email.required'=>'هذا الحقل مطلوب',
                'phone.required'=>'هذا الحقل مطلوب',
                'subject.required'=>'هذا الحقل مطلوب',
                'message.required'=>'هذا الحقل مطلوب',
            ]
        );

        try{

            $data = array();
            $data['name'] = $request->name;
            $data['email'] = $request->email;
            $data['phone'] = $request->phone;
            $data['subject'] = $request->subject;
            $data['message'] = $request->message;
            $data['status'] = 0;

            Contact::create($data);
            $notification = array(
                'message'=>'تم ارسال استفسارك بنجاح ',
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
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public  function Terms(){
            try{
                return view('frontend.terms-and-conditions');

            }catch(\Exception $ex){
                $notification = array(
                    'message'=>'حدث شىء ما خطأ ، من فضلك حاول مرة أخرى ',
                    'alert-type'=>'error'
                );
                return redirect()->back()->with($notification);
            }
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public  function Shipping(){
        try{
            return view('frontend.shipping-and-payment');

        }catch(\Exception $ex){
            $notification = array(
                'message'=>'حدث شىء ما خطأ ، من فضلك حاول مرة أخرى ',
                'alert-type'=>'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public  function Privacy()
    {
        try {
            return view('frontend.privacy-policy');

        } catch (\Exception $ex) {
            $notification = array(
                'message'=>'حدث شىء ما خطأ ، من فضلك حاول مرة أخرى ',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */

    public  function Faq()
    {
        try {
            return view('frontend.faq');

        } catch (\Exception $ex) {
            $notification = array(
                'message'=>'حدث شىء ما خطأ ، من فضلك حاول مرة أخرى ',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public  function Refund()
    {
        try {
            return view('frontend.refund-exchange-policy');

        } catch (\Exception $ex) {
            $notification = array(
                'message'=>'حدث شىء ما خطأ ، من فضلك حاول مرة أخرى ',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    /**
     * AllPost
     * @return \Illuminate\Http\RedirectResponse
     */
    public function AllPost(){
        try{
            $services = Service::all();
            $posts = Post::where('status',1)->latest()->paginate(12);
            $images = Image::latest()->take(8)->get();

            return view('frontend.posts',compact('services','posts','images'));

        }catch(\Exception $ex){
            $notification = array(
                'message'=>'حدث شىء ما خطأ ، من فضلك حاول مرة أخرى ',
                'alert-type'=>'error'
            );
            return redirect()->route('main.home')->with($notification);
        }
    }


    /**
     * Show post
     * @param $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function ShowPost($slug){

        $post_data = Post::where('slug',$slug)->first();
        if( $post_data){
            $services = Service::all();
            $posts = Post::where('status',1)->latest()->get();
            $comments = Comment::where('post_id',$post_data->id)->latest()->get();
            $images = Image::where('service_id',$post_data->service_id)->latest()->take(12)->get();

            return view('frontend.post_single',compact('services','posts','post_data','comments','images' ));

        }else{
            return view('errors.404');
        }

    }

    /**
     * Gallery
     * @return \Illuminate\Http\RedirectResponse
     */
    public function Gallery(){
        try{
            $services = Service::all();
            $images = Image::latest()->inRandomOrder()->get();
            return view('frontend.gallery',compact('services' ,'images'));
        }catch (\Exception $ex){
            $notification = array(
                'message'=>'حدث شىء ما خطأ ، من فضلك حاول مرة أخرى ',
                'alert-type'=>'error'
            );
            return redirect()->route('main.home')->with($notification);
        }
    }

    /**
     * ComingSoon
     * @return \\Illuminate\Http\RedirectResponse
     */

    public function ComingSoon(){
        try{

            return view('frontend.coming');
        }catch (\Exception $ex){
            $notification = array(
                'message'=>'حدث شىء ما خطأ ، من فضلك حاول مرة أخرى ',
                'alert-type'=>'error'
            );
            return redirect()->route('main.home')->with($notification);
        }
    }

    /**
     * SendInquiry
     * @return \\Illuminate\Http\RedirectResponse
     */

    public function SendInquiry(){
        try{

            return view('frontend.send_inquiry');
        }catch (\Exception $ex){
            $notification = array(
                'message'=>'حدث شىء ما خطأ ، من فضلك حاول مرة أخرى ',
                'alert-type'=>'error'
            );
            return redirect()->route('main.home')->with($notification);
        }
    }
}//end of controller
