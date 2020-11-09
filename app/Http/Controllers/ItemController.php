<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Brand;
use App\Category;
use App\Subcategory;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::all();
        $brands = Brand::all();
        $subcategories = Subcategory::all();
        return view('item.index', compact('items', 'brands', 'subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brand::all();
        $categories = Category::all();
        $subcategories = Subcategory::all();
        return view('item.create', compact('brands','categories', 'subcategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(Request $request)
    {

        // dd($request);

        $request->validate([
            "name" => "required|min:4",
            "price" => "required",
            "discount" => "sometimes|required",
            "photo" => "required|mimes:jpeg,bmp,png",
            "brand" => "required",
            "subcategory" => "required",
            "description" => "required"
        ]);

        if($request->file()){
            $fileName = time().'_'.$request->photo->getClientOriginalName();

            $filePath = $request->file('photo')->storeAs('itemimg', $fileName, 'public');

            $path = '/storage/'.$filePath;

        }

        // store
        $item = new Item;
        $item->name = $request->name;
        $item->codeno = 'ITM_'.strtotime("now");
        $item->price = $request->price;
        $item->discount = $request->discount;
        $item->photo =  $path;
        $item->brand_id =  $request->brand;
        $item->subcategory_id =  $request->subcategory;
        $item->description =  $request->description;
        $item->save();

        // redirect
        return redirect()->route('item.index');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        return view('item.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        $brands = Brand::all();
        $categories = Category::all();
        $subcategories = Subcategory::all();
        return view('item.edit', compact('item', 'brands', 'categories', 'subcategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        $request->validate([
            "name" => "required|min:4",
            "price" => "required",
            "discount" => "sometimes|required",
            "photo" => "sometimes|required|mimes:jpeg,bmp,png",
            "brand" => "required",
            "subcategory" => "required",
            "description" => "required"
        ]);

        // If include file, upload
        if($request->file()) {
            // 624872374523_a.jpg
            $fileName = time().'_'.$request->photo->getClientOriginalName();

            // brandimg/624872374523_a.jpg
            $filePath = $request->file('photo')->storeAs('itemimg', $fileName, 'public');

            $path = '/storage/'.$filePath;
        }else{
            $path = $request->oldphoto;
        }

        // store
        // $item->codeno = 'ITM_'.strtotime("now");
        $item->name = $request->name;
        $item->price = $request->price;
        $item->discount = $request->discount;
        $item->photo =  $path;
        $item->brand_id =  $request->brand;
        $item->subcategory_id =  $request->subcategory;
        $item->description =  $request->description;
        $item->save();

        // redirect
        return redirect()->route('item.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        //
    }

    public function filterCategory(Request $request)
    {
        $cid = $request->cid;
        $subcategories = Subcategory::where('category_id',$cid)->get();
        return $subcategories;
    }
}
