<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Post;
use App\Models\Admin\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    /**
     * PostController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth:sanctum,admin']);
    }

    /**
     * Index
     * @return \Illuminate\Http\RedirectResponse
     */
    public function Index(){

        try{
            if(Auth::user()->permission->post==1){
                $posts = Post::latest()->get();
                return view('admin.post.post',compact('posts'));
            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية لدخول هذه المنطقة');
            }
        }catch(\Exception $ex){
            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);

        }
    }

    /**
     * CreatePost
     * @return \Illuminate\Http\RedirectResponse
     */
    public function CreatePost(){

        try{
            if(Auth::user()->permission->post==1){
                $services = Service::all();

                return view('admin.post.create',compact('services'));
            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية لدخول هذه المنطقة');
            }
        }catch(\Exception $ex){
            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);

        }
    }

    /**
     * StorePost
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function StorePost(Request $request){

        $validate = $request->validate([
            'post_title'=>'required|max:255',
            'service_id'=>'required',
            'post_details'=>'required|min:5',
            'post_short_details'=>'required|min:5|max:75',
            'post_image'=>'required|mimes:jpg,jpeg,png|max:350',
            'post_tags'=>'required',


        ],
            [
                'post_title.required'=>'عنوان المنشور مطلوب',
                'post_title.max'=>'عدد الحروف لايتجاوز 255 حرف',
                'service_id.required'=>'اسم الخدمة الرئيسى مطلوب',
                'post_details.required'=>'تفاصيل المنشور مطلوب',
                'post_details.min'=>'تفاصيل المنشور لايقل عن 5 حرف',
                'post_short_details.required'=>'النبذة المختصرة مطلوب',
                'post_short_details.min'=>'النبذة المختصرة لايقل عن 5 حرف',
                'post_short_details.max'=>'النبذة المختصرة لا يزيد عن 75 حرف',
                'post_image.required'=>'صورة المنشور مطلوبة',
                'post_image.max'=>'صورة المنشور يجب الا يزيد حجمها عن 350 كيلو',
                'post_image.mimes'=>'صورة المنشور  يجب ان تكون jpg,png,jpeg',
                'post_tags.required'=>'الكلمات الاسترشادية مطلوبة',

            ]);
        try{
            if(Auth::user()->permission->post==1){
                $post_data = new Post();
                $data = array();

                $data['post_title'] = $request->post_title;
                $data['user_id'] =  (Auth::id());
                $data['service_id'] = $request->service_id;
                $data['post_details'] = $request->post_details;
                $data['post_short_details'] = $request->post_short_details;
                $data['post_tags'] = implode(",",$request->post_tags);
                $data['slug'] = $post_data->setSlugAttribute($request->post_title);
                $data['status'] = 1;

                $image = $request->post_image;


                if($image){
                    $image_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
                    Image::make($image)->resize(1000,600)->save(public_path('upload/blog/').$image_name);
                    $data['post_image'] = $image_name;

                    Post::create($data);
                    return redirect()->route('admin.post')->with('success','تم اضافة المنشور بنجاح');
                }
            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية لدخول هذه المنطقة');
            }

        }catch(\Exception $ex){
            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);
        }
    }

    /**
     * ActivePost
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function ActivePost($id){
        try{
            if(Auth::user()->permission->post==1){
                $post_data =Post::find($id);
                $post_data->update([
                    'status' => 1,

                ]);
                return redirect()->route('admin.post')->with('success','تم تعديل حالة المنشور الى فعال بنجاح');
            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية لدخول هذه المنطقة');
            }

        }catch (\Exception $ex){

            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);

        }

    }

    /**
     * InactivePost
     * InactiveProduct
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function InactivePost($id){
        try{
            if(Auth::user()->permission->post==1){
                $post_data =Post::find($id);
                $post_data->update([
                    'status' => 0,

                ]);
                return redirect()->route('admin.post')->with('success','تم تعديل حالة المنشور الى غير فعال بنجاح');

            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية لدخول هذه المنطقة');
            }
        }catch (\Exception $ex){

            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);

        }

    }

    /**
     * ShowPost
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function ShowPost($id){

        try{
            if(Auth::user()->permission->post==1){
                $post_data =Post::find($id);

                return view('admin.post.show',compact('post_data'));
            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية لدخول هذه المنطقة');
            }
        }catch (\Exception $ex){

            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);

        }
    }

    /**
     * EditPost
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function EditPost($id){
        try{
            if(Auth::user()->permission->post==1){
                $post_data = Post::find($id);
                $services = Service::all();


                return view('admin.post.edit',compact('post_data','services'));
            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية لدخول هذه المنطقة');
            }
        }catch (\Exception $ex){
            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);

        }
    }

    /**
     * UpdatePost
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function UpdatePost(Request $request,$id){
        $validate = $request->validate([

            'post_title'=>'required|max:255',
            'service_id'=>'required',
            'post_details'=>'required|min:5',
            'post_short_details'=>'required|min:5|max:75',
            'post_image'=>'mimes:jpg,jpeg,png|max:350',
            'post_tags'=>'required',

        ],
            [
                'post_title.required'=>'عنوان المنشور مطلوب',
                'post_title.max'=>'عدد الحروف لايتجاوز 255 حرف',
                'service_id.required'=>'اسم الخدمة الرئيسى مطلوب',
                'post_details.required'=>'تفاصيل المنشور مطلوب',
                'post_details.min'=>'تفاصيل المنشور لايقل عن 5 حرف',
                'post_short_details.required'=>'النبذة المختصرة مطلوب',
                'post_short_details.min'=>'النبذة المختصرة لايقل عن 5 حرف',
                'post_short_details.max'=>'النبذة المختصرة لا يزيد عن 75 حرف',
                'post_image.max'=>'صورة المنشور يجب الا يزيد حجمها عن 350 كيلو',
                'post_image.mimes'=>'صورة المنشور  يجب ان تكون jpg,png,jpeg',
                'post_tags.required'=>'الكلمات الاسترشادية مطلوبة',


            ]);

        try{
            if(Auth::user()->permission->post==1){
                $post_data = Post::find($id);
                $data = array();

                $data['post_title'] = $request->post_title;
                $data['user_id'] =  (Auth::id());
                $data['service_id'] = $request->service_id;
                $data['post_details'] = $request->post_details;
                $data['post_short_details'] = $request->post_short_details;
                $data['post_tags'] = implode(",",$request->post_tags);


                $image = $request->file('post_image');

                if($image){
                    $old_image = $post_data->post_image;
                    $image_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
                    Image::make($image)->resize(1000,600)->save(public_path('upload/blog/').$image_name);

                    unlink(public_path('upload/blog/').$old_image);
                    $data['post_image'] = $image_name;
                }

                Post::find($id)->update($data);

                return redirect()->route('admin.post')->with('success','تم تعديل بيانات المنشور  بنجاح');

            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية لدخول هذه المنطقة');
            }
        }catch (\Exception $ex){

            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);

        }
    }

    /**
     * DeleteProduct
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function DeletePost($id){

        try{
            if(Auth::user()->permission->post==1){
                $post_data = Post::find($id);
                $image= $post_data->post_image;
              if($image){
                    unlink(public_path('upload/blog/').$image);
               }
                $post_data->delete();
                return redirect()->route('admin.post')->with('success','تم حذف المنشور بنجاح');

            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية لدخول هذه المنطقة');
            }
        }catch(\Exception $ex){

            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);

        }
    }














} // end of controller
