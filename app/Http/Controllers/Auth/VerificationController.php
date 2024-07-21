<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function show()
    {
        return view('auth.verify');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'verification_code' => ['required', 'string', 'size:4'],
        ]);

        $user = User::where('verification_code', $request->verification_code)->first();

        if (!$user) {
            return redirect()->back()->withErrors(['verification_code' => 'El código de verificación es inválido.']);
        }

        $user->email_verified_at = now();
        $user->verification_code = null; 
        $user->save();

        return redirect('/home')->with('status', 'Tu cuenta ha sido verificada con éxito.');
    }
}
