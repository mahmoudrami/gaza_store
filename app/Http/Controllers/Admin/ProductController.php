<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Product::latest('id')->get();
        return view('admins.products.index',compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::select('id', 'name')->get();
        return view('admins.products.create', compact('categories'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required',
            'name_ar' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'description_en' => 'required',
            'description_ar' => 'required',
            'image' => 'required',
            'gallery' => 'required',
            'category_id' => 'required',

        ]);

        $name = [
            'ar' => $request->name_ar,
            'en' => $request->name_en,
        ];

        $des = [
            'ar' => $request->description_ar,
            'en' => $request->description_en,
        ];

        $product =  Product::create([
            'name' => json_encode($name, JSON_UNESCAPED_UNICODE),
            'description' => json_encode($des, JSON_UNESCAPED_UNICODE),
            'price' => $request->price,
            'quantity' => $request->quantity,
            'category_id' => $request->category_id,
        ]);

        $img_path = rand().time().'.'.$request->file('image')->getClientOriginalExtension();
        $request->file('image')->move(public_path('images/products'),$img_path);
        $product->image()->create([
            'path' => $img_path
        ]);

        foreach($request->gallery as $img){
            $img_path = rand().time().'.'.$img->getClientOriginalExtension();
            $img->move(public_path('images/products'),$img_path);
            $product->image()->create([
                'path' => $img_path,
                'type' => 'gallery',
            ]);
        }

        return redirect()->route('admin.products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $item = $product;
        $categories = Category::select('id','name')->get();
        return view('admins.products.edit',compact('item', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {

        $request->validate([
            'name_en' => 'required',
            'name_ar' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'description_en' => 'required',
            'description_ar' => 'required',
            // 'image' => 'required',
            // 'gallery' => 'required',
            'category_id' => 'required',

        ]);

        $name = [
            'ar' => $request->name_ar,
            'en' => $request->name_en,
        ];

        $des = [
            'ar' => $request->description_ar,
            'en' => $request->description_en,
        ];

        $product->update([
            'name' => json_encode($name, JSON_UNESCAPED_UNICODE),
            'description' => json_encode($des, JSON_UNESCAPED_UNICODE),
            'price' => $request->price,
            'quantity' => $request->quantity,
            'category_id' => $request->category_id,
        ]);

        if($request->hasFile('image')){
            file::delete(public_path('images/products'.$product->image->path));
            $product->image()->delete();

            $img_path = rand().time().'.'.$request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('images/products'),$img_path);
            $product->image()->create([
                'path' => $img_path
            ]);
        }

        if($request->hasFile('gallery')){

            foreach($request->gallery as $img){
                $image_name = rand().time().'.'. $img->getClientOriginalExtension();
                $img->move(public_path('images/products/'),$image_name);
                $product->image()->create([
                    'path' => $image_name,
                    'type' => 'gallery'
                ]);
            }
        }


        return redirect()->route('admin.products.index')->with('msg', 'Product Updated Successflly');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        file::delete(public_path('images/products'.$product->image->path));
        $product->image()->delete();
        $product->gallery()->delete();
        $product->delete();
        return redirect()->back();
    }

    public function delete_img($id){
        // return $id;
        $image = Image::find($id);
        file::delete(public_path('images/products/'.$image->path));
        $image->delete();

        return true;

    }

}
