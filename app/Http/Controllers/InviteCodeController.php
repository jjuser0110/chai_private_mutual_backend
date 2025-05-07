<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Spatie\Browsershot\Browsershot;
use Illuminate\Http\Request;
use App\Models\InvitationCode;
use Bouncer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class InviteCodeController extends Controller
{
    public function index(Request $request)
    {
        $invitation_code = InvitationCode::orderBy('id',"DESC")->get();

        return view('invitation_code.index')->with('invitation_code',$invitation_code);
    }

    public function generate()
    {
        $random = $this->getCode();
        InvitationCode::create([
            'code'=>$random,
        ]);
        return redirect()->route('invitation_code.index')->withSuccess('Data saved');
    }

    public function store(Request $request)
    {
        $request->merge(['created_by_id'=>Auth::user()->id]);
        $invitation_code = InvitationCode::create($request->all());

        return redirect()->route('invitation_code.index')->withSuccess('Data saved');
    }

    public function edit(InvitationCode $invitation_code)
    {
        return view('invitation_code.create')->with('invitation_code',$invitation_code);
    }

    public function update(Request $request, InvitationCode $invitation_code)
    {
        $invitation_code->update($request->all());
        return redirect()->route('invitation_code.index')->withSuccess('Data updated');
    }

    public function destroy(InvitationCode $invitation_code)
    {
        $invitation_code->delete();

        return redirect()->route('invitation_code.index')->withSuccess('Data deleted');
    }

}
