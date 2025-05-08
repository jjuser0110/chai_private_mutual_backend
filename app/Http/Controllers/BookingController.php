<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Spatie\Browsershot\Browsershot;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\User;
use App\Models\MoneyRecord;
use Bouncer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $booking = Booking::all();

        return view('booking.index')->with('booking',$booking);
    }

    public function pending(Request $request)
    {
        $booking = Booking::whereNotIn('status',['Finished','Cancelled'])->get();

        return view('booking.index')->with('booking',$booking);
    }

    public function create()
    {
        return view('booking.create');
    }

    public function store(Request $request)
    {
        $request->merge(['created_by_id'=>Auth::user()->id]);
        $booking = Booking::create($request->all());

        return redirect()->route('booking.index')->withSuccess('Data saved');
    }

    public function edit(Booking $booking)
    {
        return view('booking.create')->with('booking',$booking);
    }

    public function update(Request $request, Booking $booking)
    {
        $booking->update($request->all());
        return redirect()->route('booking.index')->withSuccess('Data updated');
    }

    public function destroy(Booking $booking)
    {
        // dd($booking);
        $booking->update(['status'=>'Cancelled']);
        $amount = $booking->total_payment;
        $user = User::find($booking->user_id);
        $original_amount = $user->available_fund;
        $after_amount = round($original_amount+$amount,2);
        $money = MoneyRecord::create([
            'user_id'=>$user->id,
            'type'=>"Booking Cancelled",
            'before_amount'=>$original_amount,
            'amount'=>$amount,
            'after_amount'=>$after_amount,
        ]);
        $user->update(['available_fund'=>$after_amount]);

        return redirect()->route('booking.pending')->withSuccess('Data deleted');
    }

    public function extra(Request $request)
    {
        // dd($request->all());
        $booking = Booking::find($request->booking_id);
        $no_of_time =$request->no_of_time;
        $booking_amount = $booking->booking_amount;
        $final_payment = round($booking_amount*$no_of_time,2);
        $booking->update([
            'number'=>$no_of_time,
            'final_payment'=>$final_payment,
            'status'=>'Pending Final Payment',
        ]);

        return redirect()->route('booking.pending')->withSuccess('Data saved');
    }

    public function status(Request $request)
    {
        // dd($request->all());
        $booking = Booking::find($request->booking_id_2);
        $dividend_amount = $request->dividend_amount;
        $booking->update([
            'dividend_amount'=>$dividend_amount,
            'status'=>'Finished',
        ]);
        $amount = round($dividend_amount+$booking->total_payment,2);
        $user = User::find($booking->user_id);
        $original_amount = $user->available_fund;
        $after_amount = round($original_amount+$amount,2);
        $money = MoneyRecord::create([
            'user_id'=>$user->id,
            'type'=>"Booking Earn",
            'before_amount'=>$original_amount,
            'amount'=>$amount,
            'after_amount'=>$after_amount,
        ]);
        $user->update(['available_fund'=>$after_amount,'income'=>round($user->income+$dividend_amount,2)]);

        return redirect()->route('booking.pending')->withSuccess('Data saved');
    }

    public function add_countdown(Request $request)
    {
        // dd($request->all());
        $booking = Booking::find($request->booking_id_3);
        $countdown_datetime = Carbon::parse($request->countdown_datetime);
        $booking->update([
            'countdown'=>$countdown_datetime,
        ]);

        return redirect()->route('booking.pending')->withSuccess('Data saved');
    }

}
