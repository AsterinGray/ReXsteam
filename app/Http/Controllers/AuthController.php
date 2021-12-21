<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request) {
        $credentials = $request->validate([
            'username' => 'required|exists:users,username',
            'password' => 'required',
        ]);

        $remember_me = $request->has('remember_me');
        $isAuth = Auth::attempt($credentials, $remember_me);
        
        if($isAuth) return redirect()->route('index');
        return redirect()->route('login');
    }

    public function register(Request $request) {
        $data = $request->validate([
            'username' => 'required|string|unique:users,username|min:6',
            'full_name' => 'required|string',
            'password' => 'required|alpha_num|min:6',
            'role' => 'required|string|in:member,admin',
        ]);
        $data['password'] = Hash::make($request->password);
        User::create($data);
        return redirect()->route('login');
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('login');
    }
}
