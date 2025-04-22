<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Spatie\Browsershot\Browsershot;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Bank;
use App\Models\UserBank;
use App\Models\UserAddress;
use App\Models\UserScore;
use App\Models\MoneyRecord;
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
        if(isset($request->password)){
            $request->merge(['password'=>Hash::make($request->password)]);
        }else{
            $request->request->remove('password');
        }
        // dd($request->all());
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

    public function create_score(User $user)
    {
        return view('user.create_score')->with('user',$user);
    }

    public function store_score(Request $request, User $user)
    {
        if($request->score >=80){
            $value = "Good";
        }else if($request->score >=60){
            $value = "Fair";
        }else if($request->score >=40){
            $value = "Poor";
        }else if($request->score >=20){
            $value = "Very Poor";
        }else{
            $value = "Extremely Poor";
        }
        $request->merge(['user_id'=>$user->id,'value'=>$value]);
        // dd($request->all());
        $user_score = UserScore::create($request->all());

        $user->update([
            'credit_score'=>$request->score,
            'account_health'=>$value,
        ]);

        return redirect()->route('user.edit',$user)->withSuccess('Data saved');
    }

    public function deposit(Request $request)
    {
        // dd($request->all());
        $user= User::find($request->user_id);
        if(isset($user)){
            if($request->deposit_amount>0){
                $original_amount = $user->available_fund;
                $amount = $request->deposit_amount;
                $after_amount = round($original_amount+$amount,2);
                $money = MoneyRecord::create([
                    'user_id'=>$user->id,
                    'type'=>"Deposit",
                    'before_amount'=>$original_amount,
                    'amount'=>$amount,
                    'after_amount'=>$after_amount,
                ]);
                $user->update(['available_fund'=>$after_amount]);
            }
        }

        return redirect()->route('user.edit',$user)->withSuccess('Data saved');
    }

}
