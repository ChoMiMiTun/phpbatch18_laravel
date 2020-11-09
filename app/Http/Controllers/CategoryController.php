<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
         return view('category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
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
            "name" => "required|min:4",
            "photo" => "required|mimes:jpeg,bmp,png"
        ]);

        if($request->file()){
            $fileName = strtotime("now")."_".$request->photo->getClientOriginalName();

            // categoryimg/624872374523_a.jpg
            $filePath = $request->file('photo')->storeAs('categoryimg', $fileName, 'public');

            $path = 'storage/'.$filePath;
            
        }

        // store
            $category = new Category;
            $category->name = $request->name;
            $category->photo = $path;
            $category->save();


        // redirect
            return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        // Validation
        $request->validate([
            "name" => "required|min:4",
            "photo" => "sometimes|required|mimes:jpeg,bmp,png", // a.jpg
            "oldphoto" => "required"
        ]);

        // if include file, upload
        if($request->file()) {
            // delete olo photo
            

            // 624872374523_a.jpg
            $fileName = strtotime("now").'_'.$request->photo->getClientOriginalName();

            // brandimg/624872374523_a.jpg
            $filePath = $request->file('photo')->storeAs('categoryimg', $fileName, 'public');

            $path = 'storage/'.$filePath;
            //unlink("$path");

        }else{
            $path = $request->oldphoto;
            
        }

        // update
        // $category = Category::find($id);
        $category->name = $request->name;
        $category->photo = $path;
        $category->save();

        // redirect
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('category.index');
    }
}
