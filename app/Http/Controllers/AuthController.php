<?php

namespace App\Http\Controllers;

use App\Models\TransactionHeader;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login() {
        if(Auth::check()) return redirect()->route('index');
        return view('auth.login');
    }

    public function loginAction(Request $request) {
        $credentials = $request->validate([
            'username' => 'required|exists:users,username',
            'password' => 'required',
        ]);

        $remember_me = $request->has('remember_me');
        $isAuth = Auth::attempt($credentials, $remember_me);

        if($remember_me) Cookie::queue('rexsteam', $request->username, 120);

        if($isAuth) return redirect()->route('index');
        return redirect()->route('login')->withErrors("Credential doesn't match record");
    }

    public function register() {
        if(Auth::check()) return redirect()->route('index');
        return view('auth.register');
    }

    public function registerAction(Request $request) {
        $data = $request->validate([
            'username' => 'required|string|unique:users,username|min:6',
            'full_name' => 'required|string',
            'password' => 'required|alpha_num|min:6',
            'role' => 'required|string|in:member,admin',
        ]);
        $data['password'] = Hash::make($request->password);
        $user = User::create($data);

        $transactionHeader = new TransactionHeader();
        $transactionHeader->user_id = $user->id;
        $transactionHeader->save();

        return redirect()->route('login')->withSuccess('Account Registered');
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('login');
    }
}
