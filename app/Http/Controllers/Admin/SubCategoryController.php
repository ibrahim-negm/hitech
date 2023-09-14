<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use App\Models\Admin\Subcategory;
use App\Models\Admin\SubSubCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubCategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth:sanctum,admin']);
    }

    /**
     * ShowSubCategory
     * @return \Illuminate\Http\RedirectResponse
     */
    public function ShowSubCategory(){

        try{
            if(Auth::user()->permission->subcategory==1) {
                $categories = Category::all();
                $subcategories = Subcategory::latest()->get();

                return view('admin.subcategory.sub_category', compact('categories', 'subcategories'));

            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لديك صلاحية للدخول لهذة المنطقة',);

            }

        }catch(\Exception $ex){
            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);

        }
    }

    /**
     * StoreSubcategory
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function StoreSubcategory(Request $request){

        $validate = $request->validate([
            'category_id'=>'required',
            'subcategory_name'=>'required|max:50',

        ],
            [
                'category_id.required'=>' هذا الحقل مطلوب',
                'subcategory_name.required'=>'هذا الحقل مطلوب',
                'subcategory_name.max'=>'اسم الحقل لا يتجوز الـ50 حرف',


            ]
        );


        try{
            if(Auth::user()->permission->subcategory==1) {
                Subcategory::create([
                    'category_id' => $request->category_id,
                    'subcategory_name' => $request->subcategory_name,

                ]);

                return redirect()->route('admin.subcategory')->with('success', 'تم اضافة هذا القسم الفرعى بنجاح');
            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لديك صلاحية للدخول لهذة المنطقة',);

            }
        }catch(\Exception $ex){

            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);
        }

    }

    /**
     * EditSubCategory
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function EditSubCategory($id){
        try{
            if(Auth::user()->permission->subcategory==1) {
                $categories = Category::all();
                $subcategory = Subcategory::find($id);
                return view('admin.subcategory.edit', compact('subcategory', 'categories'));
            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لديك صلاحية للدخول لهذة المنطقة',);

            }
        }catch(\Exception $ex){


            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);
        }
    }

    /**
     * UpdateSubCategory
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function UpdateSubCategory(Request $request ,$id){
        $validate = $request->validate([
            'subcategory_name'=>'required|max:50',

        ],[
                'subcategory_name.required'=>' هذا الحقل مطلوب',
                'subcategory_name.max'=>'اسم الحقل لا يتجوز الـ50 حرف',
            ]
        );

        try{
            if(Auth::user()->permission->subcategory==1) {

                Subcategory::find($id)->update([
                    'category_id' => $request->category_id,
                    'subcategory_name' => $request->subcategory_name,

                ]);

                return redirect()->route('admin.subcategory')->with('success', 'تم تحديث أسم القسم الفرعى بنجاح',);
            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لديك صلاحية للدخول لهذة المنطقة',);

            }
        }catch(\Exception $ex){

            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);
        }
    }

    /**
     * DeleteSubCategory
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function DeleteSubCategory($id){

        try{
            if(Auth::user()->permission->subcategory==1) {

                Subcategory::find($id)->delete();
                return redirect()->route('admin.subcategory')->with('error', 'تم مسح هذا القسم الفرعى بنجاح');
            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لديك صلاحية للدخول لهذة المنطقة',);

            }

        }catch(\Exception $ex){

            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);
        }
    }

    ///--------------------///
    // all sub subcategory methods ans functions //


    /**
     * ShowSubSubCategory
     * @return \Illuminate\Http\RedirectResponse
     */
    public function ShowSubSubCategory(){

        try{
            if(Auth::user()->permission->subcategory==1) {
                $categories = Category::all();
                $subcategories = Subcategory::latest()->get();
                $subsubcategories = SubSubCategory::latest()->get();

                return view('admin.subsubcategory.sub_subcategory', compact('categories', 'subcategories','subsubcategories'));

            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لديك صلاحية للدخول لهذة المنطقة',);

            }

        }catch(\Exception $ex){
            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);

        }
    }

    /**
     * StoreSubSubcategory
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function StoreSubSubcategory(Request $request){

        $validate = $request->validate([
            'category_id'=>'required',
            'subsubcategory_name'=>'required|max:50',

        ],
            [
                'category_id.required'=>' هذا الحقل مطلوب',
                'subsubcategory_name.required'=>'هذا الحقل مطلوب',
                'subsubcategory_name.max'=>'اسم الحقل لا يتجوز الـ50 حرف',


            ]
        );


        try{
            if(Auth::user()->permission->subcategory==1) {
                SubSubcategory::create([
                    'category_id' => $request->category_id,
                    'subcategory_id' => $request->subcategory_id,
                    'subsubcategory_name' => $request->subsubcategory_name,

                ]);

                return redirect()->route('admin.subsubcategory')->with('success', 'تم اضافة هذا القسم الفرعى الفرعى بنجاح');
            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لديك صلاحية للدخول لهذة المنطقة',);

            }
        }catch(\Exception $ex){

            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);
        }

    }

    /**
     * EditSubSubCategory
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function EditSubSubCategory($id){
        try{
            if(Auth::user()->permission->subcategory==1) {
                $categories = Category::all();
                $subcategories = Subcategory::all();
                $subsubcategory = SubSubcategory::find($id);
                return view('admin.subsubcategory.edit', compact('subcategories', 'categories' ,'subsubcategory'));
            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لديك صلاحية للدخول لهذة المنطقة',);

            }
        }catch(\Exception $ex){


            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);
        }
    }

    /**
     * UpdateSubSubCategory
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function UpdateSubSubCategory(Request $request ,$id){
        $validate = $request->validate([
            'subsubcategory_name'=>'required|max:50',

        ],[
                'subsubcategory_name.required'=>' هذا الحقل مطلوب',
                'subsubcategory_name.max'=>'اسم الحقل لا يتجوز الـ50 حرف',
            ]
        );

        try{
            if(Auth::user()->permission->subcategory==1) {

                SubSubcategory::find($id)->update([
                    'category_id' => $request->category_id,
                    'subcategory_id' => $request->subcategory_id,
                    'subsubcategory_name' => $request->subsubcategory_name,

                ]);

                return redirect()->route('admin.subsubcategory')->with('success', 'تم تحديث أسم القسم الفرعى الفرعى بنجاح',);
            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لديك صلاحية للدخول لهذة المنطقة',);

            }
        }catch(\Exception $ex){

            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);
        }
    }

    /**
     * DeleteSubSubCategory
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function DeleteSubSubCategory($id){

        try{
            if(Auth::user()->permission->subcategory==1) {

                SubSubcategory::find($id)->delete();
                return redirect()->route('admin.subsubcategory')->with('error', 'تم مسح هذا القسم الفرعى الفرعى بنجاح');
            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لديك صلاحية للدخول لهذة المنطقة',);

            }

        }catch(\Exception $ex){

            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);
        }
    }



}//end of controller
