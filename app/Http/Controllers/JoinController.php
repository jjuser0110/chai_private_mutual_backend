<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Spatie\Browsershot\Browsershot;
use Illuminate\Http\Request;
use App\Models\JoinRecord;
use Bouncer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class JoinController extends Controller
{
    public function index(Request $request)
    {
        $join = JoinRecord::all();

        return view('join.index')->with('join',$join);
    }

    public function create()
    {
        return view('join.create');
    }

    public function store(Request $request)
    {
        $request->merge(['created_by_id'=>Auth::user()->id]);
        $join = JoinRecord::create($request->all());

        return redirect()->route('join.index')->withSuccess('Data saved');
    }

    public function edit(JoinRecord $join)
    {
        return view('join.create')->with('join',$join);
    }

    public function update(Request $request, JoinRecord $join)
    {
        $join->update($request->all());
        return redirect()->route('join.index')->withSuccess('Data updated');
    }

    public function destroy(JoinRecord $join)
    {
        $join->delete();

        return redirect()->route('join.index')->withSuccess('Data deleted');
    }

}
