<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    
    public function index(){
        $models = Category::all();
        return view('admin.category.index',compact('models'));
    }
    
    public function create(){
        return view('admin.category.create');
    }
    
    public function store(Request $request){

        $model = new Category;
        $model->name = $request->name;
        $model->status = $request->status;
        $model->slug = Str::slug($request->name);
        $model->save();

        return redirect()->route('category.index')->with('message','Category Insert Successfully');
        
    }
    
    public function update(Request $request){

        $model = Category::findOrFail($request->id);
        $model->name = $request->name;
        $model->status = $request->status;
        $model->slug = Str::slug($request->name);
        $model->save();

        return redirect()->route('category.index')->with('message','Category Update Successfully');
        
    }
    
    public function edit($id){

        $model = Category::findOrFail($id);
        return view('admin.category.edit',compact('model'));
        
    }
    
    public function delete(Request $request){

        $model = Category::findOrFail($request->id);
        $model->delete();

        return response()->json([
            'success' => 'Category Delete Successfully!'
        ]);
        
    }

    
}
