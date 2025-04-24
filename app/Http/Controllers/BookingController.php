<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Spatie\Browsershot\Browsershot;
use Illuminate\Http\Request;
use App\Models\Booking;
use Bouncer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $booking = Booking::all();

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
        $booking->delete();

        return redirect()->route('booking.index')->withSuccess('Data deleted');
    }

}
