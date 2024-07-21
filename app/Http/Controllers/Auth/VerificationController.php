<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Notifications\VerificationCode;

class VerificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        return view('auth.verify');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'verification_code' => ['required', 'string', 'size:4'],
        ]);

        $user = Auth::user();

        if ($user->verification_code !== $request->verification_code) {
            return redirect()->back()->withErrors(['verification_code' => 'El código de verificación es inválido.']);
        }

        $user->markEmailAsVerified();
        $user->verification_code = null;
        $user->save();

        return redirect()->route('home')->with('status', 'Tu cuenta ha sido verificada con éxito.');
    }

    public function resend(Request $request)
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            return redirect()->route('home');
        }

        $user->verification_code = rand(1000, 9999);
        $user->save();

        $user->notify(new VerificationCode($user->verification_code));

        return back()->with('resent', true);
    }
}
