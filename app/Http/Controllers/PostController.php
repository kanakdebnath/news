<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = Post::with('category')->get();
        return view('admin.post.index',compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $models = Category::where('status','Active')->get();
        return view('admin.post.create',compact('models'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $request->validate([
            'title' => ['required','unique:posts'],
            'category_id' => ['required'],
            'status' => ['required'],
            'short_description' => ['required'],
            'description' => ['required'],
            'photo' => ['required']
       ]);
       

       $model = new Post;
       $model->title = $request->title;
       $model->category_id = $request->category_id;
       $model->added_by = Auth::user()->id;
       $model->status = $request->status;
       $model->short_description = $request->short_description;
       $model->description = $request->description;
       $model->slug = Str::slug($request->title);

       if($request->hasFile('photo')){
            $file = $request->file('photo');
            $ext = $file->extension() ? : 'png';
            $photo = Str::random(10) . '.' . $ext;

            // resize image

            $path = public_path(). '/uploads/post/';
            $resize = Image::make($file->getRealPath());
            $resize->resize(900,570);
            $resize->save($path.'/'.$photo);

            $model->photo = $photo;
       }

       $model->save();

        return redirect()->route('posts.index')->with('message','Post Insert Successfully');

       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = Post::findOrFail($id);
        $models = Category::where('status','Active')->get();
        return view('admin.post.edit',compact('models','model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
       
       $model = $post;
       $model->title = $request->title;
       $model->category_id = $request->category_id;
       $model->status = $request->status;
       $model->short_description = $request->short_description;
       $model->description = $request->description;
       $model->slug = Str::slug($request->title);

       if($request->hasFile('photo')){
            $file = $request->file('photo');
            $ext = $file->extension() ? : 'png';
            $photo = Str::random(10) . '.' . $ext;

            // resize image

            $path = public_path(). '/uploads/post/';
            $resize = Image::make($file->getRealPath());
            $resize->resize(900,570);

            // Old Photo Delete 
            if($request->old_photo){
                $asdsdf = public_path(). '/uploads/post/'.$request->old_photo;
                unlink($asdsdf);
            }
            $resize->save($path.'/'.$photo);

            $model->photo = $photo;
       }

       $model->save();

        return redirect()->route('posts.index')->with('message','Post Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }

    public function delete($id)
    {
        $model = Post::findOrFail($id);
        if($model->photo){
            $asdsdf = public_path(). '/uploads/post/'.$model->photo;
            unlink($asdsdf);
        }
        $model->delete();
    }

    public function search()
    {
        return view('admin.post.search');
    }

    public function autocomplete(Request $request)
    {
        $data = [];
  
        if($request->filled('q')){
            $data = Post::select("title", "id")
                        ->where('title', 'LIKE', '%'. $request->get('q'). '%')
                        ->get();
        }
        // dd($data);
    
        return response()->json($data);
    }

    public function dataappend(Request $request)
    {
        
        $post = Post::find($request->id);
    
        return view('admin.post.partials.data',compact('post'));
    }

}
