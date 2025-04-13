<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Browsershot\Browsershot;
use App\Models\User;
use App\Models\Package;
use App\Models\PackageInvoice;
use App\Models\BankAccount;
use App\Models\DailyReport;
use Bouncer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        return view('home');
    }

    public function change_password(Request $request){
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);


        if ($validator->fails()) {
            $message = "";
            foreach($validator->messages()->messages() as $m){
                foreach($m as $mm){
                    $message .=$mm.'\n';
                }
            }
            return redirect()->back()->withInfo($message);
        }

        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect()->route('home')->withSuccess('Password changed successfully.');
    }

    public function notification()
    {
        $package_invoices = User::where('role_id', 3)
            ->where('is_active', 1)
            ->whereHas('last_package_invoice', function ($query) {
                $query->whereRaw('DATEDIFF(invoice_date_to, ?) <= 3', [Carbon::now()->toDateString()]);
            })
            ->with(['last_package_invoice' => function ($query) {
                $query->selectRaw('*, DATEDIFF(invoice_date_to, ?) as days_to_due', [Carbon::now()->toDateString()]);
            }])
            ->get();

        $user_wallets = User::with('last_invoice')
            ->where('role_id', 3)
            ->where('is_active', 1)
            ->get()
            ->map(function ($customer) {
                if ($customer->last_invoice && $customer->last_invoice->total != 0) {
                    $customer->wallet_to_total_rate = round($customer->wallet / $customer->last_invoice->total, 2);
                } else {
                    $customer->wallet_to_total_rate = null; // Handle division by zero
                }
                return $customer;
            })
            ->filter(function ($customer) {
                if ($customer->wallet_to_total_rate !== null) {
                    return $customer->wallet_to_total_rate < 4;
                } else {
                    return $customer->wallet < 0;
                }
            });


        return view('notification', compact('package_invoices', 'user_wallets'));
    }

    public function count()
    {
        $package_invoices_count = User::where('role_id', 3)
            ->where('is_active', 1)
            ->whereHas('last_package_invoice', function ($query) {
                $query->whereRaw('DATEDIFF(invoice_date_to, ?) <= 3', [Carbon::now()->toDateString()]);
            })
            ->count();

        $user_wallets_count = User::with('last_invoice')
            ->where('role_id', 3)
            ->where('is_active', 1)
            ->get()
            ->map(function ($customer) {
                if ($customer->last_invoice && $customer->last_invoice->total != 0) {
                    $customer->wallet_to_total_rate = round($customer->wallet / $customer->last_invoice->total, 2);
                } else {
                    $customer->wallet_to_total_rate = null; // No rate when no last_invoice or total is 0
                }
                return $customer;
            })
            ->filter(function ($customer) {
                if ($customer->wallet_to_total_rate !== null) {
                    return $customer->wallet_to_total_rate < 4;
                } else {
                    return $customer->wallet < 0;
                }
            })
            ->count();

        $count = $package_invoices_count + $user_wallets_count;

        return response()->json(['count' => $count]);
    }
}
