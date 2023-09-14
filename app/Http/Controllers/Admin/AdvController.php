<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Adv;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdvController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum,admin']);
    }

    /**
     * Adv
     * show all advs
     * @return \Illuminate\Http\RedirectResponse
     */
    public function Adv(){
        try{
            if(Auth::user()->permission->advs == 1){
                $advs = Adv::latest()->get();
                return view('admin.adv.adv',compact('advs'));

            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية للدخول فى هذه المنطقة',);

            }

        }catch(\Exception $ex){
            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);

        }
    }

    /**
     * CreateAdv
     * @return \Illuminate\Http\RedirectResponse
     */
    public function CreateAdv(){
        try{

            if(Auth::user()->permission->advs == 1){
                return view('admin.adv.create');
            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية للدخول فى هذه المنطقة',);

            }


        }catch(\Exception $ex){
            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);
        }
    }

    /**
     * StoreAdv
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function StoreAdv(Request $request){

        $validated = $request->validate([
            'title'=>'max:200',
            'description'=>'max:200',
        ],
            [

                'title.max'=>'عدد الحروف لاتتجاوز 200 حرف',
                'description.max'=>'عدد الحروف لاتتجاوز 200 حرف',
            ]
        );
        try{

            if(Auth::user()->permission->advs == 1){
                $advs = Adv::all();
                foreach ($advs as $row){
                    $row->update([
                        'status'=> 0,
                    ]);
                }
                Adv::create([
                    'title' => $request->title,
                    'description' => $request->description,
                    'status'=> 1,
                ]);
                return redirect()->route('admin.adv')->with('success','تم اضافة الاعلان الجديد بنجاح');


            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية للدخول فى هذه المنطقة',);

            }


        }catch(\Exception $ex){

            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);

        }

    }

    /**
     * ActiveAdv
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function ActiveAdv($id){
        try{

            if(Auth::user()->permission->advs == 1){
                $adv =Adv::find($id);
                $advs = Adv::all();
                foreach ($advs as $row){
                    $row->update([
                        'status'=> 0,
                    ]);
                }
                $adv->update([
                    'status' => 1,

                ]);
                return redirect()->route('admin.adv')->with('success','تم تعديل حالة الاعلان الى فعال بنجاح');

            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية للدخول فى هذه المنطقة',);

            }


        }catch (\Exception $ex){

            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);

        }

    }

    /**
     * InactiveAdv
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function InactiveAdv($id){
        try{

            if(Auth::user()->permission->advs == 1){
                $adv =Adv::find($id);
                $adv->update([
                    'status' => 0,

                ]);
                return redirect()->route('admin.adv')->with('success','تم تعديل حالة الاعلان الى غير فعال بنجاح');

            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية للدخول فى هذه المنطقة',);

            }


        }catch (\Exception $ex){

            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);

        }

    }

    /**
     * EditAdv
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function EditAdv($id){
        try{

            if(Auth::user()->permission->advs == 1){
                $adv = Adv::find($id);
                return view('admin.adv.edit',compact('adv'));
            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية للدخول فى هذه المنطقة',);

            }

        }catch (\Exception $ex){

            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);

        }
    }

    /**
     * UpdateAdv
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function UpdateAdv(Request $request,$id){
        $validated = $request->validate([
            'title'=>'max:200',
            'description'=>'max:200',


        ],
            [
                'title.max'=>'عدد الحروف لاتتجاوز 200 حرف',
                'description.max'=>'عدد الحروف لاتتجاوز 200 حرف',
            ]
        );
        try{
            if(Auth::user()->permission->advs == 1){
                Adv::find($id)->update([
                    'title'=>$request->title,
                    'description'=> $request->description
                ]);

                return redirect()->route('admin.adv')->with('success','تم تحديث الاعلان بنجاح');


            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية للدخول فى هذه المنطقة',);

            }

        }catch(\Exception $ex){

            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);

        }
    }

    /**
     * DeleteAdv
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function DeleteAdv($id){
        try{

            if(Auth::user()->permission->advs == 1){
                $adv = Adv::find($id);

                $adv->delete();
                return redirect()->route('admin.adv')->with('success','تم حذف الاعلان بنجاح');

            }else{
                return redirect()->route('admin.dashboard')->with('error','ليس لك صلاحية للدخول فى هذه المنطقة',);

            }

        }catch(\Exception $ex){
            return redirect()->route('admin.dashboard')->with('error','حدث خطأ ما . الرجاء المحاولة مرة اخرى',);

        }
    }








}//end of controller
