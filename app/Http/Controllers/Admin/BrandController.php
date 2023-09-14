<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Admin\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
    /**
     * BrandController constructor.
     *
     */
    public function __construct()
    {
        $this->middleware(['auth:sanctum,admin']);
    }

    /**
     * ShowBrand
     * @return \Illuminate\Http\RedirectResponse
     */
    public function ShowBrand(){

        try{
            if(Auth::user()->permission->brand == 1){
                $brands = Brand::latest()->get();
                $admins = Admin::all();
                return view('admin.brand.brand',compact('brands','admins'));
            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لديك صلاحية للدخول لهذة المنطقة',);

            }

        }catch(\Exception $ex){

            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);

        }
    }

    /**
     * StoreBrand
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function StoreBrand(Request $request){
        $validate = $request->validate([

            'brand_name' => 'required|unique:brands|max:50',
            'brand_logo' => 'required|mimes:jpg,jpeg,png|max:350',
        ],
            [
                'brand_name.required' => 'هذا الحقل مطلوب',
                'brand_name.unique' => 'هذه الماركة مسجلة مسبقاً',
                'brand_name.max' => 'يجب الا تتجاوز عدد الحروف الـ50 حرف',
                'brand_logo.required' => 'هذا الحقل مطلوب',
                'brand_logo.max' => 'اقصى حجم للصورة 350 كيلو',
                'brand_logo.mimes' => 'يجب ان تكون الصورة jpg,jpeg,png',

            ]);

        try{
            if(Auth::user()->permission->brand == 1){
                $brand_logo = $request->file('brand_logo');
                $name_gen = hexdec(uniqid()).'.'.$brand_logo->getClientOriginalExtension();
                Image::make($brand_logo)->resize(300,200)->save(public_path('upload/brands/'.$name_gen));

                $last_img ='upload/brands/'.$name_gen;

                Brand::create([
                    'brand_name' => $request-> brand_name,
                    'brand_logo' => $last_img,
                    'admin_id' => $request->admin_id,

                ]);
                return redirect()->route('admin.brand')->with('success','تم اضافة ماركة عالمية بنجاح');

            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لديك صلاحية للدخول لهذة المنطقة',);

            }

        }catch(\Exception $ex){

            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);

        }
    }

    /**
     * EditBrand
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function EditBrand($id){
        try{
            if(Auth::user()->permission->brand == 1){
                $brand = Brand::find($id);
                $admins = Admin::all();
                return view('admin.brand.edit',compact('brand','admins'));
            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لديك صلاحية للدخول لهذة المنطقة',);

            }

        }catch (\Exception $ex){
            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);

        }

    }

    /**
     * UpdateBrand
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function UpdateBrand(Request $request , $id){
        $validate = $request->validate([

            'brand_name' => ['required','max:50', Rule::unique('brands')->ignore($id)],
            'brand_logo' => 'mimes:jpg,jpeg,png|max:350',
        ],
            [

                'brand_name.required' => 'هذا الحقل مطلوب',
                'brand_name.unique' => 'هذا الحقل موجود من قبل',
                'brand_name.max' => 'يجب الا تتجاوز عدد الحروف الـ50 حرف',
                'brand_logo.max' => 'اقصى حجم للصورة 350 كيلو',
                'brand_logo.mimes' => 'يجب ان تكون الصورة jpg,jpeg,png',

            ]);

        try{
            if(Auth::user()->permission->brand == 1){
                $brand = Brand::find($id);
                $brand->brand_name = $request->brand_name;
                $brand->admin_id = $request->admin_id;


                if($request->file('brand_logo')){
                    $old_img = $request->old_image;
                    $image = $request->file('brand_logo');
                    unlink(public_path($old_img));
                    $new_image = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
                    Image::make($image)->resize(300,200)->save(public_path('upload/brands/'.$new_image));

                    $brand->brand_logo = 'upload/brands/'.$new_image;
                }
                $brand->save();
                return redirect()->route('admin.brand')->with('success','تم تحديث الماركة العالمية بنجاح');

            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لديك صلاحية للدخول لهذة المنطقة',);

            }



        }catch (\Exception $ex){

            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);

        }
    }

    /**
     * DeleteBrand
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function DeleteBrand($id){
        try{
            if(Auth::user()->permission->brand == 1){
                $brand = Brand::find($id);
                unlink(public_path($brand->brand_logo));
                $brand->delete();
                return redirect()->route('admin.brand')->with('success','تم حذف الماركة العالمية بنجاح');

            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لديك صلاحية للدخول لهذة المنطقة',);

            }



        }catch (\Exception $ex){
            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);

        }
    }

}//end of controller
