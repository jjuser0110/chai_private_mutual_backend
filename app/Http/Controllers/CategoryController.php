<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Spatie\Browsershot\Browsershot;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Bouncer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $category = ProductCategory::all();

        return view('category.index')->with('category',$category);
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
        $category = ProductCategory::create($request->all());
        if(isset($request->file_attachment)){
            $upload = $this->upload($request->file_attachment, 'category',$category->id);
            $category->update(['icon_path'=>$upload['file_path']]);
        }
        return redirect()->route('category.index')->withSuccess('Data saved');
    }

    public function edit(ProductCategory $category)
    {
        return view('category.create')->with('category',$category);
    }

    public function update(Request $request, ProductCategory $category)
    {
        $category->update($request->all());
        if(isset($request->file_attachment)){
            $upload = $this->upload($request->file_attachment, 'category',$category->id);
            $category->update(['icon_path'=>$upload['file_path']]);
        }
        return redirect()->route('category.index')->withSuccess('Data updated');
    }

    public function destroy(ProductCategory $category)
    {
        $category->delete();

        return redirect()->route('category.index')->withSuccess('Data deleted');
    }

}
