<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Admin\Post;
use Illuminate\Http\Request;

class SitemapXmlController extends Controller
{
    /**
     * index
     * Illuminate\Http\RedirectResponse
     */
    public function index() {

        try{
            $posts = Post::all();
            return view('frontend.sitemap',compact('posts'));
        }catch (\Exception $ex ){
            $notification = array(
                'message'=>'حدث شىء ما خطأ ، من فضلك حاول مرة أخرى ',
                'alert-type'=>'error'
            );
            return redirect()->route('main.home')->with($notification);
        }
    }//end of method
}//end of controller
