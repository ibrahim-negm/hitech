<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Image;
use App\Models\Admin\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ImageController extends Controller
{
    /**
     * ImageController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth:sanctum,admin']);
    }

    /**
     * ShowImage
     * @return \Illuminate\Http\RedirectResponse
     */
    public function ShowImage(){

        try{
            if(Auth::user()->permission->gallery == 1){
                $services = Service::all();
                $images = Image::latest()->get();
                return view('admin.image.image',compact('images','services'));
            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية للدخول فى هذه المنطقة',);

            }

        }catch(\Exception $ex){
            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);

        }
    }

    /**
     *  StoreImage
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function StoreImage(Request $request){
        $validate = $request->validate([
            'service_id' => 'required',
            'image_name' => 'required|max:200',
            'image' => 'required|max:350',
        ],
            [
                'service_id.required' => 'هذا الحقل مطلوب',
                'image_name.required' =>  'هذا الحقل مطلوب',
                'image_name.max' => 'يجب الا تتجاوز عدد الحروف الـ200 حرف',
                'image.required' => 'هذا الحقل مطلوب',
                'image.max' => 'اقصى حجم للصورة 350 كيلو',


            ]);

        try{
            if(Auth::user()->permission->gallery == 1){
                $images =$request->image;
                foreach ($images as $image){
                    $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
                    \Intervention\Image\Facades\Image::make($image)->resize(1000,674)->save(public_path('upload/gallery/').$name_gen);

                    Image::create([
                        'service_id' => $request-> service_id,
                        'image_name' => $request-> image_name,
                        'image' => $name_gen,
                    ]);
                }

                return redirect()->route('admin.image')->with('success','تم اضافة الصور بنجاح');

            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية للدخول فى هذه المنطقة',);

            }

        }catch(\Exception $ex){

            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);

        }
    }

    /**
     * EditImage
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function EditImage($id){
        try{
            if(Auth::user()->permission->gallery == 1){
                $services = Service::all();
                $image = Image::find($id);
                return view('admin.image.edit',compact('image','services'));
            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية للدخول فى هذه المنطقة',);

            }

        }catch (\Exception $ex){
            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);
        }

    }

    /**
     * UpdateImage
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function UpdateImage(Request $request , $id){
        $validate = $request->validate([

            'image_name' => ['required','max:200'],
            'service_id'=>'required',
            'image' => 'mimes:jpg,jpeg,png|max:350',
        ],
            [

                'image_name.required' => 'هذا الحقل مطلوب',
                'image_name.max' => 'يجب الا تتجاوز عدد الحروف الـ200 حرف',
                'service_id.required' => 'هذا الحقل مطلوب',
                'image.max' => 'اقصى حجم للصورة 350 كيلو',
                'image.mimes' => 'يجب ان تكون الصورة jpg,jpeg,png',

            ]);

        try{
            if(Auth::user()->permission->gallery == 1){
                $data = array();
                $data['image_name']=$request->image_name;
                $data['service_id']=$request->service_id;

                if($request->file('image')){
                    $old_img = $request->old_image;
                    $image = $request->file('image');
                    unlink(public_path('upload/gallery/'.$old_img));
                    $new_image = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
                    \Intervention\Image\Facades\Image::make($image)->resize(1000,674)->save(public_path('upload/gallery/'.$new_image));

                    $data['image'] = $new_image;
                }
                Image::find($id)->update($data);
                return redirect()->route('admin.image')->with('success','تم تحديث الصورة بنجاح');

            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية للدخول فى هذه المنطقة',);

            }

        }catch (\Exception $ex){

            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);

        }
    }

    /**
     * DeleteImage
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function DeleteImage($id){
        try{
            if(Auth::user()->permission->gallery == 1){
                $image = Image::find($id);
                unlink(public_path('upload/gallery/'.$image->image));
                $image->delete();
                return redirect()->route('admin.image')->with('success','تم حذف الصورة بنجاح');


            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية للدخول فى هذه المنطقة',);

            }


        }catch (\Exception $ex){
            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);

        }
    }

}//end of controller

