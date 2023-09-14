<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class ServiceController extends Controller
{
    /**
     * CategoryController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth:sanctum,admin']);
    }

    /**
     * ShowService
     * @return \Illuminate\Http\RedirectResponse
     */
    public function ShowService(){

        try{
            if(Auth::user()->permission->service==1){
                $services = Service::all();
                return view('admin.service.service',compact('services'));

            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لديك صلاحية للدخول لهذة المنطقة',);
            }

        }catch(\Exception $ex){

            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);

        }
    }

    /**
     * StoreService
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function StoreService(Request $request){
        $validate = $request->validate([
            'service_name'=>'required|unique:services|max:150',
            'service_image'=>'required|mimes:jpg,jpeg,gif,png|max:350',
        ],
            [
                'service_name.required'=>' هذا الحقل مطلوب',
                'service_name.unique'=>'هذا الحقل موجود مسبقاً',
                'service_name.max'=>'اسم الحقل لا يتجاوز الـ150 حرف',
                'service_image.required'=>' هذا الحقل مطلوب',
                'service_image.mimes'=>'الصورة يجب ان jpg,jpeg,gif,png',
                'service_image.max'=>'الصورة يجب الا تتعدى ال350 كيلو',


            ]
        );


        try{
            if(Auth::user()->permission->service==1){

                $image = $request->service_image;
                if($image){
                    $image_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
                    Image::make($image)->resize(700,500)->save(public_path('upload/services/').$image_name);

                    Service::create([
                        'service_name' => $request->service_name,
                        'service_image' => $image_name,

                    ]);

                    return redirect()->route('admin.service')->with('success','تم اضافة هذا الخدمة بنجاح');
                }
            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لديك صلاحية للدخول لهذة المنطقة',);
            }
        }catch(\Exception $ex){

            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);
        }
    }

    /**
     * DeleteService
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function DeleteService($id){

        try{
            if(Auth::user()->permission->service==1){
                $service = Service::find($id);
                unlink(public_path('upload/services/'.$service->service_image));
                Service::find($id)->delete();

                return redirect()->route('admin.service')->with('error','تم مسح هذا الخدمة بنجاح');
            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لديك صلاحية للدخول لهذة المنطقة',);
            }
        }catch(\Exception $ex){

            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);
        }
    }

    /**
     * EditService
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function EditService($id){
        try{
            if(Auth::user()->permission->service==1){
                $service = Service::find($id);

                return view('admin.service.edit',compact('service'));
            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لديك صلاحية للدخول لهذة المنطقة',);
            }
        }catch(\Exception $ex){


            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);
        }
    }

    /**
     * UpdateService
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function UpdateService(Request $request , $id){

        $validate = $request->validate([
            'service_name' => ['required','max:150', Rule::unique('services')->ignore($id)],
            'service_image'=>'mimes:jpg,jpeg,gif,png|max:350',
        ],
            [
                'service_name.required'=>' هذا الحقل مطلوب',
                'service_name.unique'=>'هذا الحقل موجود مسبقاً',
                'service_name.max'=>'اسم الحقل لا يتجاوز الـ150 حرف',
                'service_image.mimes'=>'الصورة يجب ان jpg,jpeg,gif,png',
                'service_image.max'=>'الصورة يجب الا تتعدى ال350 كيلو',
            ]
        );

        try{
            if(Auth::user()->permission->service==1){

                $data = array();
                $data['service_name'] = $request->service_name;

                $image = $request->service_image;
                if($image) {
                    $service = Service::find($id);
                    unlink(public_path('upload/services/' . $service->service_image));

                    $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                    Image::make($image)->resize(700, 500)->save(public_path('upload/services/') . $image_name);
                    $data['service_image'] = $image_name;
                }

                Service::find($id)->update($data);

                return redirect()->route('admin.service')->with('success', 'تم تحديث بيانات الخدمة بنجاح',);

            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لديك صلاحية للدخول لهذة المنطقة',);
            }
        }catch(\Exception $ex){

            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);
        }
    }

} // end of controller
