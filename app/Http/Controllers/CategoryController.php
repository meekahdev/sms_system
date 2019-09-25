<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Sentinel;
use App\Http\Requests;
use App\Category;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
       // $this->AuthUser = Sentinel::getUser(); 
    }

    public function index(Request $request)
    {
        if(isset($request->type) && $request->type == 'json')
        {
            $categories = Category::get();

            return response()->json([ 'data' => $categories]);
        }

        return view('admin.cateogry.index');
    }

    public function edit(Request $request)
    {

        $category = Category::find($request->id);
        

        return view('admin.cateogry.edit',compact('category'));
    }

    public function update(Request $request)
    {
        $category = Category::find($request->id);
        $category->name = $request->name;
        $category->description = $request->description;
        $category->comment = $request->comment;
        $category->save();
        
        return response()->json(true);
        //return redirect('/admin/categoery/get-category');
    }

    public function store(Request $request)
    {
        $category = Category::create([
            'name' => $request->name,
            'description' => $request->description,
            'comment' => $request->comment

        ]);
        
        return response()->json(true);
        //return redirect('/admin/categoery/get-category');
    }

    public function delete(Request $request)
    {
        $category = Category::find($request->id)->delete();
        return redirect('/admin/categoery/get-category');
    }
}
