<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;


class EmployeeController extends Controller
{
    /**
     * EmployeeController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth:sanctum,admin']);
    }

    /**
     * ShowEmployee
     * @return \Illuminate\Http\RedirectResponse
     */
    public function ShowEmployee(){

        try{
            if(Auth::user()->permission->employee == 1){
                $employees = Employee::latest()->get();
                return view('admin.employee.employee',compact('employees'));
            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية للدخول فى هذه المنطقة',);
            }

        }catch(\Exception $ex){
            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);

        }
    }

    /**
     * StoreEmployee
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function StoreEmployee(Request $request){
        $validate = $request->validate([

            'employee_name' => 'required|unique:employees|max:100',
            'image' => 'required|mimes:jpg,jpeg,png|max:350',
            'position' => 'required|max:250',
            'facebook' => 'max:250',
            'instgram' => 'max:250',
            'twitter' => 'max:250',
            'whatsup' => 'max:250',
        ],
            [
                'employee_name.required' => 'هذا الحقل مطلوب',
                'employee_name.unique' => 'هذه الماركة مسجلة مسبقاً',
                'employee_name.max' => 'يجب الا تتجاوز عدد الحروف الـ100 حرف',
                'image.required' => 'هذا الحقل مطلوب',
                'position.required' => 'هذا الحقل مطلوب',
                'position.max' => 'يجب الا تتجاوز عدد الحروف الـ250 حرف',
                'image.max' => 'اقصى حجم للصورة 350 كيلو',
                'image.mimes' => 'يجب ان تكون الصورة jpg,jpeg,png',
                'facebook.max' => 'يجب الا تتجاوز عدد الحروف الـ250 حرف',
                'instgram.max' => 'يجب الا تتجاوز عدد الحروف الـ250 حرف',
                'twitter.max' => 'يجب الا تتجاوز عدد الحروف الـ250 حرف',
                'whatsup.max' => 'يجب الا تتجاوز عدد الحروف الـ250 حرف',

            ]);

        try{
            if(Auth::user()->permission->employee == 1){
                $employee_image = $request->file('image');
                $name_gen = hexdec(uniqid()).'.'.$employee_image->getClientOriginalExtension();
                Image::make($employee_image)->resize(500,600)->save(public_path('upload/employees/'.$name_gen));

                $last_img ='upload/employees/'.$name_gen;

                Employee::create([
                    'employee_name' => $request-> employee_name,
                    'image' => $last_img,
                    'position' => $request-> position,
                    'facebook' => $request-> facebook,
                    'instgram' => $request-> instgram,
                    'twitter' => $request-> twitter,
                    'whatsup' => "https://wa.me/".$request-> whatsup,
                ]);
                return redirect()->route('admin.employee')->with('success','تم اضافة الموظف بنجاح');

            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية للدخول فى هذه المنطقة',);

            }

        }catch(\Exception $ex){

            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);

        }
    }

    /**
     * EditEmployee
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function EditEmployee($id){
        try{
            if(Auth::user()->permission->employee == 1){
                $employee = Employee::find($id);
                return view('admin.employee.edit',compact('employee'));
            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية للدخول فى هذه المنطقة',);

            }

        }catch (\Exception $ex){
            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);

        }

    }

    /**
     * UpdateEmployee
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function UpdateEmployee(Request $request , $id){
        $validate = $request->validate([


            'employee_name' => ['required','max:100', Rule::unique('employees')->ignore($id)],
            'image' => 'mimes:jpg,jpeg,png|max:350',
            'position' => 'required|max:250',
            'facebook' => 'max:250',
            'instgram' => 'max:250',
            'twitter' => 'max:250',
            'whatsup' => 'max:250',
        ],
            [

                'employee_name.required' => 'هذا الحقل مطلوب',
                'employee_name.unique' => 'هذه الاسم مسجل مسبقاً',
                'employee_name.max' => 'يجب الا تتجاوز عدد الحروف الـ100 حرف',
                'image.required' => 'هذا الحقل مطلوب',
                'position.required' => 'هذا الحقل مطلوب',
                'position.max' => 'يجب الا تتجاوز عدد الحروف الـ250 حرف',
                'image.max' => 'اقصى حجم للصورة 350 كيلو',
                'image.mimes' => 'يجب ان تكون الصورة jpg,jpeg,png',
                'facebook.max' => 'يجب الا تتجاوز عدد الحروف الـ250 حرف',
                'instgram.max' => 'يجب الا تتجاوز عدد الحروف الـ250 حرف',
                'twitter.max' => 'يجب الا تتجاوز عدد الحروف الـ250 حرف',
                'whatsup.max' => 'يجب الا تتجاوز عدد الحروف الـ250 حرف',

            ]);

        try{

            if(Auth::user()->permission->employee == 1){
                $employee = Employee::find($id);
                $data = array();


                $data['employee_name'] = $request->employee_name;
                $data['position'] = $request-> position;
                $data['facebook'] = $request->facebook;
                $data['twitter'] = $request->twitter;
                $data['instgram'] = $request->instgram;
                $data['whatsup'] =  $request-> whatsup;


                if($request->file('image')){
                    $old_img = $request->old_image;
                    $image = $request->file('image');
                    unlink(public_path($old_img));
                    $new_image = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
                    Image::make($image)->resize(500,600)->save(public_path('upload/employees/'.$new_image));

                    $data['image'] = 'upload/employees/'.$new_image;
                }
                Employee::find($id)->update($data);
                return redirect()->route('admin.employee')->with('success','تم تحديث بيانات الموظف بنجاح');


            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية للدخول فى هذه المنطقة',);

            }



        }catch (\Exception $ex){

            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);

        }
    }

    /**
     * DeleteEmployee
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function DeleteEmployee($id){
        try{

            if(Auth::user()->permission->employee == 1){
                $employee = Employee::find($id);
                unlink(public_path($employee->image));
                $employee->delete();
                return redirect()->route('admin.brand')->with('success','تم حذف الموظف بنجاح ');

            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية للدخول فى هذه المنطقة',);

            }

        }catch (\Exception $ex){
            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);

        }
    }
}// end of controller
