<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class SliderController extends Controller
{


    /**
     * Slider
     * @return \Illuminate\Http\RedirectResponse
     */
    public function Slider(){
        try{
            if(Auth::user()->permission->slider==1) {
                $sliders = Slider::latest()->get();
                return view('backend.slider.slider',compact('sliders'));
            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لديك صلاحية للدخول لهذة المنطقة');

            }

        }catch (\Exception $ex){
            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى');

        }
    }

    /**
     * CreateSlider
     * @return \Illuminate\Http\RedirectResponse
     */
    public function CreateSlider(){
        try{
            if(Auth::user()->permission->slider==1) {
                return view('backend.slider.create');
            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لديك صلاحية للدخول لهذة المنطقة');

            }

        }catch (\Exception $ex){
            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى');

        }
    }

    /**
     * StoreSlider
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function StoreSlider(Request $request){

        $validated = $request->validate([

            'image'=> 'required|mimes:jpg,jpeg,png|max:350',

        ],
            [


                'image.required'=> 'هذا الحقل مطلوب',
                'image.mimes'=> 'الصورة يجب ان تكون jpg,jpeg,png',
                'image.max'=> 'حجم الصورة لايتعدى الـ350 كيلو',


            ]
        );
        try{
            if(Auth::user()->permission->slider==1) {
                $slider_img = $request->file('image');
                $name_gen = hexdec(uniqid()).'.'.$slider_img->getClientOriginalExtension();
                Image::make($slider_img)->resize(1920,1024)->save(public_path('upload/sliders/'.$name_gen));

                $last_img ='upload/sliders/'.$name_gen;

                $sliders= Slider::all();
                foreach($sliders as $slider){
                    $slider ->update([
                        'status'=> 0 ,
                    ]);
                }

                Slider::create([

                    'image' => $last_img,
                    'status'=> 1 ,

                ]);

                return redirect()->route('admin.slider')->with('success','تم اضافة سلايدر جديد بنجاح');

            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لديك صلاحية للدخول لهذة المنطقة');

            }

        }catch (\Exception $ex){
            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى');

        }
    }


    /**
     * EditSlider
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function EditSlider($id){
      try{

          if(Auth::user()->permission->slider==1) {
              $slider = Slider::find($id);
              return view('backend.slider.edit',compact('slider'));
          }else{
              return redirect()->route('admin.dashboard')->with('error','ليس لديك صلاحية للدخول لهذة المنطقة');

          }

      }catch (\Exception $ex){
          return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى');

      }
    }

    /**
     * UpdateSlider
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function UpdateSlider(Request $request ,$id){

        $slider = Slider::find($id);

            $validated = $request->validate([

                'image'=> 'mimes:jpg,jpeg,png|max:350',


            ],
                [


                    'image.mimes'=> 'الصورة يجب ان تكون jpg,jpeg,png',
                    'image.max'=> 'حجم الصورة لايتعدى الـ350 كيلو',


                ]
            );

        try{

            if(Auth::user()->permission->slider==1){




                if($request->file('image')){
                    $old_img =  $request->old_img;
                    $image = $request->file('image');
                    unlink(public_path($old_img));
                    $new_image = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
                    Image::make($image)->resize(1920,700)->save(public_path('upload/sliders/'.$new_image));

                    $slider->image = 'upload/sliders/'.$new_image;
                }


                $slider->save();
                return redirect()->route('admin.slider')->with('success','تم تحديث السلايدر بنجاح');


            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية لدخول هذه المنطقة');

            }



        }catch (\Exception $ex){

            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى');

        }
    }

    /**
     * DeleteSlider
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function DeleteSlider($id){

        try{
            if(Auth::user()->permission->slider==1){
                $slider = Slider::find($id);
                unlink(public_path($slider->image));
                $slider->delete();
                return redirect()->route('admin.slider')->with('success','تم حذف السلايدر بنجاح');
            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية لدخول هذه المنطقة');

            }


        }catch (\Exception $ex){
            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى');

        }

    }

    /**
     * ActiveSlider
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function ActiveSlider($id){
        try{
            if(Auth::user()->permission->slider==1){

                $sliders= Slider::all();
                foreach($sliders as $slider) {
                    $slider->update([
                        'status' => 0,
                    ]);
                }
                $slider =Slider::find($id);
                $slider->update([
                    'status' => 1,
                   ]);
                return redirect()->route('admin.slider')->with('success','تم تعديل حالة السلايدر الى فعال بنجاح');
            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية لدخول هذه المنطقة');
            }

        }catch (\Exception $ex){

            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى');

        }

    }

    /**
     * InactiveSlider
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function InactiveSlider($id){
        try{
            if(Auth::user()->permission->product==1){
                $slider =Slider::find($id);
                $slider->update([
                    'status' => 0,

                ]);


                return redirect()->route('admin.slider')->with('success','تم تعديل حالة السلايدر الى غير فعال بنجاح');

            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية لدخول هذه المنطقة');
            }
        }catch (\Exception $ex){

            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى');

        }

    }


}// end of controller

