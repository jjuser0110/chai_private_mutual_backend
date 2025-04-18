<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Spatie\Browsershot\Browsershot;
use Illuminate\Http\Request;
use App\Models\ShopItem;
use Bouncer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ShopItemController extends Controller
{
    public function index(Request $request)
    {
        $shop_item = ShopItem::all();

        return view('shop_item.index')->with('shop_item',$shop_item);
    }

    public function create()
    {
        return view('shop_item.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $shop_item = ShopItem::create($request->all());
        if(isset($request->file_attachment)){
            $upload = $this->upload($request->file_attachment, 'shop_item',$shop_item->id);
            $shop_item->file_attachments()->create([
                'file_path'=>$upload['file_path'],
                'file_name'=>$upload['file_name'],
                'file_type'=>$upload['file_type'],
            ]);
        }
        return redirect()->route('shop_item.index')->withSuccess('Data saved');
    }

    public function edit(ShopItem $shop_item)
    {
        return view('shop_item.create')->with('shop_item',$shop_item);
    }

    public function update(Request $request, ShopItem $shop_item)
    {
        $shop_item->update($request->all());
        if(isset($request->file_attachment)){
            $upload = $this->upload($request->file_attachment, 'shop_item',$shop_item->id);
            $shop_item->file_attachments()->create([
                'file_path'=>$upload['file_path'],
                'file_name'=>$upload['file_name'],
                'file_type'=>$upload['file_type'],
            ]);
        }
        return redirect()->route('shop_item.index')->withSuccess('Data updated');
    }

    public function destroy(ShopItem $shop_item)
    {
        $shop_item->delete();

        return redirect()->route('shop_item.index')->withSuccess('Data deleted');
    }

}
