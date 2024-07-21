<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\Notifications\VerificationCode;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/verify';

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        // Creación del usuario
        $user = $this->create($request->all());

        // Generación y guardado del código de verificación
        $verificationCode = rand(1000, 9999);
        $user->verification_code = $verificationCode;
        $user->save();

        // Envío del correo electrónico con el código de verificación
        $user->notify(new VerificationCode($verificationCode));

        // Iniciar sesión en el usuario recién creado
        $this->guard()->login($user);

        // Redirigir a la página de verificación
        return redirect()->route('verify')->with('status', 'Se ha enviado un código de verificación a tu correo.');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'min:5', 'max:40'],
            'username' => ['required', 'string', 'min:5', 'max:20', 'unique:users', 'regex:/^[a-zA-Z0-9_]+$/'],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed', 'regex:/^[a-zA-Z0-9]+$/'],
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
