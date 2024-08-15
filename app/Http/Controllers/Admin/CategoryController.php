<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Category::latest('id')->get();

        return view('admins.categories.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return dd($request->all());
        $request->validate([
            'name_en' => 'required',
            'name_ar' => 'required',
            'description_en' => 'required',
            'description_ar' => 'required',
            'image' => 'required'
        ]);

        // حفظ بلغتين في الداتا بيز
        $name = [
            'en' => $request->name_en,
            'ar' => $request->name_ar
        ];
        $des = [
            'en' => $request->description_en,
            'ar' => $request->description_ar
        ];

        $category = Category::create([
            'name' => json_encode($name, JSON_UNESCAPED_UNICODE),
            'description' => json_encode($des, JSON_UNESCAPED_UNICODE),
        ]);

        // $data = $request->except('_token','image');
        $imageName = rand().time(). '.' .$request->file('image')->getClientOriginalExtension();
        $request->file('image')->move(public_path('images/categories/'), $imageName);

        $category->image()->create([
            'path' => $imageName,
        ]);


        return redirect()->route('admin.categories.index')
        ->with('msg', 'Category Caeated Successfully')->with('type', 'success');
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
    public function edit(Category $category)
    {
        // dd($category);
        $item = $category;
        return view('admins.categories.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {

        $request->validate([
            'name_en' => 'required',
            'name_ar' => 'required',
            'description_en' => 'required',
            'description_ar' => 'required',
        ]);

        // حفظ بلغتين في الداتا بيز
        $name = [
            'en' => $request->name_en,
            'ar' => $request->name_ar
        ];
        $des = [
            'en' => $request->description_en,
            'ar' => $request->description_ar
        ];

        $category->update([
            'name' => json_encode($name, JSON_UNESCAPED_UNICODE),
            'description' => json_encode($des, JSON_UNESCAPED_UNICODE),
        ]);

        if($request->hasFile('image')){
            file::delete(public_path('images/categories/'.$category->image->path));
            $imageName = rand().time(). '.' .$request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('images/categories'), $imageName);
            if($category->image){
                $category->image()->update([
                    'path' => $imageName,
                ]);
            }else{
                $category->image()->create([
                    'path' => $imageName,
                ]);
            }
        }

        return redirect()->route('admin.categories.index')
        ->with('msg', 'Category Updated Successfully')->with('type', 'info');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index');
    }
}
