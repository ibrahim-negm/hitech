<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LanguageController extends Controller
{

    /**
     * @param Request $request
     * @param $locale
     * @return \Illuminate\Http\RedirectResponse
     */
    public function SwitchLanguage( Request $request ,$locale) {
        try {
            session(['APP_LOCALE' => $locale]);

            return redirect()->back();

        } catch (\Exception $ex){

            $notification = array(
            'message' => 'حدث شىْ ما خطأ , الرجاء المحازلة مرة أخرى',
            'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);

            }
         }







}// end of class
