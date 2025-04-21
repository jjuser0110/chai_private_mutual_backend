<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Spatie\Browsershot\Browsershot;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;
use Bouncer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $product = Product::all();

        return view('product.index')->with('product',$product);
    }

    public function create()
    {
        $category = ProductCategory::where('is_active',1)->get();
        
        return view('product.create')->with('category',$category);
    }

    public function store(Request $request)
    {
        $product = Product::create($request->all());
        if(isset($request->file_attachment)){
            $upload = $this->upload($request->file_attachment, 'product',$product->id);
            $product->file_attachments()->create([
                'file_path'=>$upload['file_path'],
                'file_name'=>$upload['file_name'],
                'file_type'=>$upload['file_type'],
            ]);
        }
        return redirect()->route('product.index')->withSuccess('Data saved');
    }

    public function edit(Product $product)
    {
        $category = ProductCategory::where('is_active',1)->get();
        return view('product.create')->with('product',$product)->with('category',$category);
    }

    public function update(Request $request, Product $product)
    {
        $product->update($request->all());
        if(isset($request->file_attachment)){
            $upload = $this->upload($request->file_attachment, 'product',$product->id);
            $product->file_attachments()->create([
                'file_path'=>$upload['file_path'],
                'file_name'=>$upload['file_name'],
                'file_type'=>$upload['file_type'],
            ]);
        }
        return redirect()->route('product.index')->withSuccess('Data updated');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('product.index')->withSuccess('Data deleted');
    }

}
