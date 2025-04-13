<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Spatie\Browsershot\Browsershot;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Bank;
use App\Models\UserBank;
use App\Models\UserAddress;
use Bouncer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $user = User::where('role_id',3)->get();

        return view('user.index')->with('user',$user);
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $request->merge(['role_id'=>3,'password'=>Hash::make($request->password),'invitation_code'=>$this->getReferral()]);
        // dd($request->all());
        $user = User::create($request->all());

        return redirect()->route('user.index')->withSuccess('Data saved');
    }

    public function edit(User $user)
    {
        return view('user.create')->with('user',$user);
    }

    public function update(Request $request, User $user)
    {
        $user->update($request->all());
        return redirect()->route('user.index')->withSuccess('Data updated');
    }

    public function destroy(User $user)
    {
        $user->forceDelete();

        return redirect()->route('user.index')->withSuccess('Data deleted');
    }

    public function create_bank(User $user)
    {
        $bank = Bank::all();
        return view('user.create_bank')->with('user',$user)->with('bank',$bank);
    }

    public function store_bank(Request $request, User $user)
    {
        $request->merge(['user_id'=>$user->id]);
        $user_bank = UserBank::create($request->all());

        return redirect()->route('user.edit',$user)->withSuccess('Data saved');
    }

    public function edit_bank(UserBank $user_bank)
    {
        $bank = Bank::all();
        return view('user.create_bank')->with('user_bank',$user_bank)->with('bank',$bank);
    }

    public function update_bank(Request $request, UserBank $user_bank)
    {
        $user_bank->update($request->all());

        return redirect()->route('user.edit',$user_bank->user_id)->withSuccess('Data saved');
    }

    public function create_address(User $user)
    {
        return view('user.create_address')->with('user',$user);
    }

    public function store_address(Request $request, User $user)
    {
        $request->merge(['user_id'=>$user->id]);
        $user_address = UserAddress::create($request->all());

        return redirect()->route('user.edit',$user)->withSuccess('Data saved');
    }

    public function edit_address(UserAddress $user_address)
    {
        return view('user.create_address')->with('user_address',$user_address);
    }

    public function update_address(Request $request, UserAddress $user_address)
    {
        $user_address->update($request->all());

        return redirect()->route('user.edit',$user_address->user_id)->withSuccess('Data saved');
    }

}
