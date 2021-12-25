<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function profile() {
        $user = Auth::user();
        return view('user.profile', compact('user'));
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


        if($request->profile_image) {
            $profile_image = $request->file('profile_image')->getClientOriginalName();
            $path = $request->file('profile_image')->storeAs('public/images', $profile_image);
            $data["profile_image"] = $profile_image;
        }
        
        $user->update($data);
        
        return redirect()->back()->withSuccess("Profile Updated Successfully");
    }

    public function checkAge(Request $request) {
        $data = $request->validate([
            'birth_date' => 'required',
        ]);
        
        Auth::user()->update($data);

        $age = Carbon::parse($request->birth_date)->diff(Carbon::now())->y;
        
        if($age < 17) return redirect()->route('index')->withErrors("You need to be at least 17 to access this page");

        return redirect()->route('index');
    }

    public function cancelCheckAge() {
        return redirect()->route('index')->withErrors('You need to input your age to access the page');
    }
}
