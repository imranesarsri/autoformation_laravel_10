<?php

namespace App\Http\Controllers;

// use Illuminate\Contracts\Session\Session;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function index()
    {
        return view('login.index');
    }
    public function authenticate(Request $request)
    {
        // dd($request->email, $request->password);
        // dd($request);
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // dd(Auth::attempt($credentials));
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect('/')->with('success', "Vous êtes bien connecté");
        }

        return back()->withErrors([
            'email' => 'Identifiants incorrects.',
        ])->onlyInput('email');
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('login')->with('success', "Vous êtes bien Deconnecté");
    }
}