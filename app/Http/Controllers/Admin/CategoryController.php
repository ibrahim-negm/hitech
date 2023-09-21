<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{

    /**
     * ShowCategory
     * @return \Illuminate\Http\RedirectResponse
     */
    public function ShowCategory(){

        try{
            if(Auth::user()->permission->category==1){
                $categories = Category::latest()->get();
                return view('backend.category.category',compact('categories'));

            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لديك صلاحية للدخول لهذة المنطقة');
            }

        }catch(\Exception $ex){

            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى');

        }
     }

    /**
     * StoreCategory
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
     public function StoreCategory(Request $request){
        $validate = $request->validate([
            'category_name'=>'required|unique:categories|max:50',

        ],
            [
                'category_name.required'=>' هذا الحقل مطلوب',
                'category_name.unique'=>'هذا الحقل موجود مسبقاً',
                'category_name.max'=>'اسم الحقل لا يتجاوز الـ50 حرف',

            ]
        );


        try{
            if(Auth::user()->permission->category==1){
            Category::create([
                'category_name' => $request->category_name,

            ]);

            return redirect()->route('admin.category')->with('success','تم اضافة هذا القسم بنجاح');
            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لديك صلاحية للدخول لهذة المنطقة');
            }
        }catch(\Exception $ex){

            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى');
        }
     }

    /**
     * DeleteCategory
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
     public function DeleteCategory($id){

        try{
            if(Auth::user()->permission->category==1){
            Category::find($id)->delete();
            return redirect()->route('admin.category')->with('error','تم مسح هذا القسم بنجاح');
        }else{
             return redirect()->route('admin.dashboard')->with('error','ليس لديك صلاحية للدخول لهذة المنطقة');
         }
       }catch(\Exception $ex){

            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى');
       }
     }

    /**
     * EditCategory
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
     public function EditCategory($id){
        try{
            if(Auth::user()->permission->category==1){
            $category = Category::find($id);

            return view('backend.category.edit',compact('category'));
            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لديك صلاحية للدخول لهذة المنطقة');
            }
        }catch(\Exception $ex){


            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى');
        }
     }

    /**
     * UpdateCategory
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
     public function UpdateCategory(Request $request , $id){

        $validate = $request->validate([
            'category_name' => ['required','max:50', Rule::unique('categories')->ignore($id)],
        ],
            [
                'category_name.required'=>' هذا الحقل مطلوب',
                'category_name.max'=>'اسم الحقل لا يتجاوز الـ50 حرف',
                'category_name.unique'=>' هذا الحقل موجود من قبل',

            ]
        );

        try{
            if(Auth::user()->permission->category==1){
            $update = Category::find($id)->update([
                'category_name'=>$request->category_name,

            ]);

                return redirect()->route('admin.category')->with('success','تم تحديث بيانات القسم بنجاح');
        }else{
             return redirect()->route('admin.dashboard')->with('error','ليس لديك صلاحية للدخول لهذة المنطقة');
         }
        }catch(\Exception $ex){

            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى');
        }
     }

}//end of controller
