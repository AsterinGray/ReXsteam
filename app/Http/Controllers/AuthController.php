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

    public function edit() {
        $user = Auth::user();
        $user->password;
        return view('auth.profile', compact('user'));
    }

    public function update(Request $request) {
        $user = Auth::user();
        $data = $request->validate([
            'full_name' => 'required|string',
            'current_password' => 'nullable|required_with:password',
            'password' => 'nullable|required_with:password_confirmation|alpha_num|min:6|confirmed',
            'password_confirmation' => 'nullable|alpha_num|min:6',
            'profile_image' => 'nullable|file|mimes:jpg,png|max:100000'
        ]);

        if(!$data['password']) $data['password'] = $user->password;
        else $data['password'] = Hash::make($request->password);

        $isValid = Auth::check($request->password, $user->password);
        if(!$isValid) redirect()->route('edit')->with('failed','Failed Update Profile');

        $user->update($data);
        
        return redirect()->back()->with("success", "Profile Updated Successfully");
    }
}
