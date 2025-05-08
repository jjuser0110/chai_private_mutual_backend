<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Spatie\Browsershot\Browsershot;
use Illuminate\Http\Request;
use App\Models\JoinRecord;
use App\Models\User;
use App\Models\MoneyRecord;
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

    public function pending(Request $request)
    {
        $join = JoinRecord::whereNotIn('status',['Finished','Cancelled'])->get();

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
        $join->update(['status'=>'Cancelled']);
        $amount = $join->investment_amount;
        $user = User::find($join->user_id);
        $original_amount = $user->available_fund;
        $after_amount = round($original_amount+$amount,2);
        $money = MoneyRecord::create([
            'user_id'=>$user->id,
            'type'=>"Join Cancelled",
            'before_amount'=>$original_amount,
            'amount'=>$amount,
            'after_amount'=>$after_amount,
        ]);
        $user->update(['available_fund'=>$after_amount]);

        return redirect()->route('join.index')->withSuccess('Data Cancelled');
    }

    public function status(Request $request)
    {
        // dd($request->all());
        $join = JoinRecord::find($request->join_id);
        $dividend_amount = $request->dividend_amount;
        $join->update([
            'dividend_amount'=>$dividend_amount,
            'status'=>'Finished',
        ]);
        $amount = round($dividend_amount+$join->investment_amount,2);
        $user = User::find($join->user_id);
        $original_amount = $user->available_fund;
        $after_amount = round($original_amount+$amount,2);
        $money = MoneyRecord::create([
            'user_id'=>$user->id,
            'type'=>"Join Earn",
            'before_amount'=>$original_amount,
            'amount'=>$amount,
            'after_amount'=>$after_amount,
        ]);
        $user->update(['available_fund'=>$after_amount,'income'=>round($user->income+$dividend_amount,2)]);

        return redirect()->route('join.pending')->withSuccess('Data saved');
    }

}
