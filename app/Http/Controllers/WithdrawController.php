<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Spatie\Browsershot\Browsershot;
use Illuminate\Http\Request;
use App\Models\Withdraw;
use App\Models\MoneyRecord;
use App\Models\User;
use Bouncer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class WithdrawController extends Controller
{
    public function index(Request $request)
    {
        $withdraw = Withdraw::all();

        return view('withdraw.index')->with('withdraw',$withdraw);
    }

    public function pending(Request $request)
    {
        $withdraw = Withdraw::where('status','Pending')->get();

        return view('withdraw.index')->with('withdraw',$withdraw);
    }

    public function edit(Withdraw $withdraw)
    {
        return view('withdraw.create')->with('withdraw',$withdraw);
    }

    public function update(Request $request, Withdraw $withdraw)
    {
        $user= User::find($withdraw->user_id);
        if($request->status == "Approved" && $withdraw->status == "Pending"){
            MoneyRecord::create([
                'user_id'=>$user->id,
                'type'=>"Withdraw",
                'before_amount'=>round($user->available_fund+$withdraw->amount,2),
                'amount'=>$withdraw->amount,
                'after_amount'=>$user->available_fund,
            ]);
        }
        if($request->status == "Rejected" && $withdraw->status == "Pending"){
            $user->update([
                'available_fund'=>round($user->available_fund+$withdraw->amount,2),
            ]);
        }

        $withdraw->update($request->all());
        return redirect()->route('withdraw.index')->withSuccess('Data updated');
    }

    public function destroy(Withdraw $withdraw)
    {
        $withdraw->delete();

        return redirect()->route('withdraw.index')->withSuccess('Data deleted');
    }

}
