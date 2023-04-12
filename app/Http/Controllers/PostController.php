<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
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
    public function edit(Post $post)
    {
        //
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
        //
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

    public function delete(Request $request)
    {
        //
    }
}
