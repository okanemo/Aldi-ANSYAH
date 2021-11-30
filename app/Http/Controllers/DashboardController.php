<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Rekening;
use Illuminate\Support\Facades\Hash;
use Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function create(Request $request)
    {
        $user = User::where('name', '=', $request->name)->first();
        if ($user === null) {
            User::Create([
                'name' => $request->name
            ]);

            return redirect()->back()->with('success', 'Username baru terdeteksi, silahkan login kembali');
        }else{
            $user = User::where('name','=',$request->name)->first();

            Auth::loginUsingId($user->id, TRUE);

            return redirect()->route('dashboard')->with('success', 'Selamat Datang');
        }
    }

    public function dashboard()
    {
        $user = User::where('id','=', auth()->user()->id)->first();
        $rekening = Rekening::where(['user_id' => $user->id])->sum('deposit');
        $rekening_transfer = Rekening::where(['transfer_to' => $user->id])->sum('transfer');

        return view('dashboard-user', compact('user','rekening','rekening_transfer'));
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login')->with(['success' => 'Logout Berhasil']);
    }

    public function deposite()
    {
        $user = User::where('id','=', auth()->user()->id)->first();

        $rekening = Rekening::where(['user_id' => $user->id])->sum('deposit');

        return view('deposite', compact('rekening'));
    }

    public function withdraw()
    {
        $user = User::where('id','=', auth()->user()->id)->first();

        $rekening = Rekening::where(['user_id' => $user->id])->sum('deposit');

        return view('withdraw', compact('rekening'));
    }

    public function withdraw_action(Request $request)
    {
        $user = User::where('id','=',auth()->user()->id)->first();

        $rekening = Rekening::where(['user_id' => $user->id])->first();

        if (empty($rekening)) {
            Rekening::create([
                'user_id' => $user->id,
                'deposit' => $request->deposit,
                'STATUS' => "DEPOSITE"
            ]);
        } else {
            Rekening::where('user_id', $user->id)->update([
                'user_id' => $user->id,
                'deposit' => $rekening->deposit - $request->withdraw,
                'STATUS' => "WITHDRAW"
            ]);
        }

        return redirect()->back()->with('success', 'Tarik Tunai Berhasil');
    }

    public function deposite_action(Request $request)
    {
        $user = User::where('id','=',auth()->user()->id)->first();

        $rekening = Rekening::where(['user_id' => $user->id])->first();

        if (empty($rekening)) {
            Rekening::create([
                'user_id' => $user->id,
                'deposit' => $request->deposit,
                'STATUS' => "DEPOSITE"
            ]);
        } else {
            Rekening::where('user_id', $user->id)->update([
                'user_id' => $user->id,
                'deposit' => $request->deposit + $rekening->deposit,
                'STATUS' => "DEPOSITE"
            ]);
        }

        return redirect()->back()->with('success', 'Setor Tunai Berhasil');
    }

    public function transfer()
    {
        $user = User::where('id','=', auth()->user()->id)->first();

        $user_lain = User::get();

        $rekening = Rekening::where(['user_id' => $user->id])->sum('deposit');

        return view('transfer', compact('rekening','user_lain'));
    }

    public function transfer_action(Request $request)
    {
        $user = User::where('id','=',auth()->user()->id)->first();

        $rekening = Rekening::where(['user_id' => $user->id])->first();

        if (empty($rekening)) {
            Rekening::create([
                'user_id' => $user->id,
                'transfer_to' => $request->transfer_to,
                'transfer' => $rekening->deposit - $request->transfer,
                'total' => $request->transfer,
                'STATUS' => "TRANSFER"
            ]);
        } else {
            Rekening::where('user_id', $user->id)->update([
                'user_id' => $user->id,
                'transfer_to' => $rekening->transfer + $request->transfer_to,
                'transfer' => $rekening->transfer + $request->transfer,
                'deposit' => $rekening->deposit - $request->transfer,
                'total' => $request->transfer,
                'STATUS' => "TRANSFER"
            ]);
        }

        return redirect()->back()->with('success', 'Transfer Tunai Berhasil');
    }
}
