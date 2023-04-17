<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home(){
        if(Auth::user()){
            if(Auth::user()->user_type == 'user'){
                return view('dashboard');
            }elseif(Auth::user()->user_type == 'admin'){
                return view('admin.dashboard');
            }else{
                return redirect()->route('login');
            }
        }else{
            return redirect()->route('login');
        }
    }

    public function about(){
        return view('frontend.about');
    }

    public function single(){
        return view('frontend.single-post');
    }

    public function single_post($slug){

        $post = Post::where('slug',$slug)->first();
        return view('frontend.single-post',compact('post'));
    }
}
