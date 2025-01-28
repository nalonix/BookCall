<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function create(Request $request)
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        // validate 
        $validatedData = $request->validate([
            'username' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        // attempt to login
        if (!Auth::attempt($validatedData)) {
            throw ValidationException::withMessages([
                'username' => ['The provided credentials are incorrect.'],
            ]);
        }

        // regenerate the session token
        request()->session()->regenerate();

        // redirect 
        return redirect('/');
    }

    public function destroy(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }
}
