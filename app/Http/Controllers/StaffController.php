<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Spatie\Browsershot\Browsershot;
use Illuminate\Http\Request;
use App\Models\User;
use Bouncer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class StaffController extends Controller
{
    public function index(Request $request)
    {
        $staff = User::where('role_id',2)->get();

        return view('staff.index')->with('staff',$staff);
    }

    public function create()
    {
        return view('staff.create');
    }

    public function store(Request $request)
    {
        $request->merge(['role_id'=>2,'password'=>Hash::make('123456789')]);
        $staff = User::create($request->all());

        return redirect()->route('staff.index')->withSuccess('Data saved');
    }

    public function edit(User $staff)
    {
        return view('staff.create')->with('staff',$staff);
    }

    public function update(Request $request, User $staff)
    {
        $staff->update($request->all());
        return redirect()->route('staff.index')->withSuccess('Data updated');
    }

    public function destroy(User $staff)
    {
        $staff->forceDelete();

        return redirect()->route('staff.index')->withSuccess('Data deleted');
    }

}
