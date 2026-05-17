<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class WebAuthController extends Controller
{
    public function showLogin()
    {
        return Auth::check() ? redirect()->route('home') : view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('home'))->with('success', 'স্বাগতম, ' . Auth::user()->name . '!');
        }

        return back()->withErrors(['email' => 'ইমেইল বা পাসওয়ার্ড ভুল।'])->withInput($request->only('email'));
    }

    public function showRegister()
    {
        return Auth::check() ? redirect()->route('home') : view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'phone'    => 'nullable|string|max:20',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);
        return redirect()->route('home')->with('success', 'অ্যাকাউন্ট তৈরি হয়েছে। স্বাগতম, ' . $user->name . '!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home')->with('success', 'সফলভাবে লগআউট হয়েছে।');
    }

    public function profile()
    {
        return view('auth.profile');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'phone' => 'nullable|string|max:20',
        ]);

        Auth::user()->update($request->only('name', 'email', 'phone'));
        return back()->with('success', 'প্রোফাইল আপডেট হয়েছে।');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password'     => 'required|min:8|confirmed',
        ]);

        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'বর্তমান পাসওয়ার্ড সঠিক নয়।']);
        }

        Auth::user()->update(['password' => Hash::make($request->new_password)]);
        return back()->with('success', 'পাসওয়ার্ড পরিবর্তন হয়েছে।');
    }
}
