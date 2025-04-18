<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Spatie\Browsershot\Browsershot;
use Illuminate\Http\Request;
use App\Models\Product;
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
        return view('product.create');
    }

    public function store(Request $request)
    {
        $product = Product::create($request->all());

        return redirect()->route('product.index')->withSuccess('Data saved');
    }

    public function edit(Product $product)
    {
        return view('product.create')->with('product',$product);
    }

    public function update(Request $request, Product $product)
    {
        $product->update($request->all());
        return redirect()->route('product.index')->withSuccess('Data updated');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('product.index')->withSuccess('Data deleted');
    }

}
