<?php

namespace App\Http\Controllers;

use App\Models\Category;
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

    // public function single(){
    //     return view('frontend.single-post');
    // }

    public function single_post($slug){

        $post = Post::where('slug',$slug)->first();
        $post->views = $post->views + 1;
        $post->save();
        return view('frontend.single-post',compact('post'));
    }

    public function post_categories($slug){

        $category = Category::where('slug',$slug)->first();

        $posts = Post::where('category_id',$category->id)->latest()->take(5)->get();
        return view('frontend.category-posts',compact('posts'));
    }
}
