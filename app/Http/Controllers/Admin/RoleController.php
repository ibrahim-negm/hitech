<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Admin\Permission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    public function __construct(){
        $this->middleware(['auth:sanctum,admin']);
    }

    /**
     * ShowAdmin
     * show all admins
     * @return \Illuminate\Http\RedirectResponse
     */
    public function ShowAdmin(){
        try{
            if(Auth::user()->permission->role==1) {
                $admins = Permission::whereIn('type', [2,3])->latest()->get();
                return view('admin.role.show', compact('admins'));
            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية للدخول الى هذه المنطقة');
            }

        }catch(\Exception $ex){
            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى');

        }
    }

    /**
     * create new admin
     * @return \Illuminate\Http\RedirectResponse
     */

    public function CreateAdmin(){
        try{
            if(Auth::user()->permission->role==1) {
            return view('admin.role.create');
            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية للدخول الى هذه المنطقة');
            }
        }catch(\Exception $ex){
            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);

        }
    }

    /**
     * store new admin
     * @param Request $request
     * @return \Exception|\Illuminate\Http\RedirectResponse
     */
    public function StoreAdmin(Request $request){
        $validate = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required','string', 'max:255'],
            'email' => ['required', 'email', 'max:255','unique:admins'],
            'password' => ['required','max:255','min:8'],
        ],
            [
                'name.required' => 'هذا الحقل مطلوب',
                'name.max'=>'هذا الحقل لايتجاوز الـ255 حرف',
                'phone.required' => 'هذا الحقل مطلوب',
                'email.required' => 'هذا الحقل مطلوب',
                'email.max' => 'هذا الحقل لايتجاوز الـ255 حرف',
                'email.unique' => 'هذا البريد الالكترونى موجود مسبقا',
                'password.required' => 'هذا الحقل مطلوب',
                'password.min'=>'اقل عدد من الحروف 8',
            ]
        );

        try{
            if(Auth::user()->permission->role==1) {
            $admin = array();
            $admin['name'] = $request->name;
            $admin['phone'] = $request->phone;
            $admin['email'] = $request->email;
            $admin['password'] = Hash::make($request->password);


            $created_admin = Admin::create($admin);

            $data=array();
            $data['admin_id']=$created_admin->id;
            $data['category']=$request->category;
            $data['subcategory']=$request->subcategory;
            $data['product']=$request->product;
            $data['brand']=$request->brand;
            $data['coupon']=$request->coupon;
            $data['order']=$request->order;
            $data['user']=$request->user;
            $data['report']=$request->report;
            $data['setting']=$request->setting;
            $data['stock']=$request->stock;
            $data['role']=$request->role;
            $data['gallery']=$request->gallery;
            $data['employee']=$request->employee;
            $data['post']=$request->post;
            $data['subscriber']=$request->subscriber;
            $data['slider']=$request->slider;
            $data['advs']=$request->advs;
            $data['message']=$request->message;
            $data['review']=$request->review;
            $data['company']=$request->company;
            $data['comment']=$request->comment;
            $data['service']=$request->service;
            if($request->company == 1){
                $data['type'] = 3;
            }else{
                $data['type'] = 2;
            }


            Permission::create($data);
            return redirect()->route('admin.show.admin')->with('success','تم إضافة مدير جديد بنجاح',);
            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية للدخول الى هذه المنطقة');
            }

        }catch(\Exception $ex){

            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);

        }
    }

    /**
     * delete admin
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */

    public function DeleteAdmin($id){
        try{
            if(Auth::user()->permission->role==1) {
            $permission = Permission::find($id);
            $permission->delete();
            $admin=Admin::find($permission->admin_id);
                if($admin->profile_photo_path == null){

                }else{
                    @unlink(public_path('upload/backend/users/'.$admin->profile_photo_path));
                }
            $admin->delete();
            return redirect()->route('admin.show.admin')->with('success','تم حذف مدير مسئول بنجاح',);
            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية للدخول الى هذه المنطقة');
            }

        }catch(\Exception $ex){

            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);

        }
    }

    /**
     * EditAdmin
     * edit page for admin
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */

    public function EditAdmin($id){

        try{
            if(Auth::user()->permission->role==1) {
            $admin_permission = Permission::find($id);
            return view('admin.role.edit',compact('admin_permission'));
            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية للدخول الى هذه المنطقة');
            }
        }catch(\Exception $ex){

            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);

        }
    }

    /**
     * UpdateAdmin
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function UpdateAdmin(Request $request,$id){

        $permission_admin = Permission::find($id);
        $admin_id =  Admin::find($permission_admin->admin_id);

        $validate = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required','string', 'max:255'],
            'email' => ['required', 'email', 'max:255',Rule::unique('admins')->ignore($admin_id)],

        ],
            [
                'name.required' => 'هذا الحقل مطلوب',
                'name.max'=>'هذا الحقل لايتجاوز الـ255 حرف',
                'phone.required' => 'هذا الحقل مطلوب',
                'email.required' => 'هذا الحقل مطلوب',
                'email.max' => 'هذا الحقل لايتجاوز الـ255 حرف',
                'email.unique' => 'هذا البريد الالكترونى موجود مسبقا',
                'password.min'=>'اقل عدد من الحروف 8',
            ]
        );

        try{
            if(Auth::user()->permission->role==1) {


            $admin = array();
            $admin['name'] = $request->name;
            $admin['phone'] = $request->phone;
            $admin['email'] = $request->email;
            if($request->password == null){

            }else{
                $admin['password'] = Hash::make($request->password);
            }
            Admin::find($permission_admin->admin_id)->update($admin);

            $data=array();
                $data['admin_id']=$permission_admin->admin_id;
                $data['category']=$request->category;
                $data['subcategory']=$request->subcategory;
                $data['product']=$request->product;
                $data['brand']=$request->brand;
                $data['coupon']=$request->coupon;
                $data['order']=$request->order;
                $data['user']=$request->user;
                $data['report']=$request->report;
                $data['setting']=$request->setting;
                $data['stock']=$request->stock;
                $data['role']=$request->role;
                $data['gallery']=$request->gallery;
                $data['employee']=$request->employee;
                $data['post']=$request->post;
                $data['subscriber']=$request->subscriber;
                $data['slider']=$request->slider;
                $data['advs']=$request->advs;
                $data['message']=$request->message;
                $data['review']=$request->review;
                $data['company']=$request->company;
                $data['comment']=$request->comment;
                $data['service']=$request->service;
                if($request->company == 1){
                    $data['type'] = 3;
                }else{
                    $data['type'] = 2;
                }



                Permission::find($id)->update($data);
            return redirect()->route('admin.show.admin')->with('success','تم تعديل بيانات هذا المدير بنجاح',);

            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية للدخول الى هذه المنطقة');
            }

        }catch(\Exception $ex){

            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);

        }

    }

    /**
     * ShowUser
     * @return \Illuminate\Http\RedirectResponse
     */
    public function ShowUser(){
        try{
            if(Auth::user()->permission->user==1) {

                $users = User::latest()->get();
                if($users){
                    return view('admin.role.user.show',compact('users'));
                }
            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية للدخول الى هذه المنطقة');
            }

        }catch(\Exception $ex){

            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);

        }
    }



}//end of controller
