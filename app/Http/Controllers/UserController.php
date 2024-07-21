<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Listar todos los usuarios ordenados por nombre
    public function index()
    {
        $users = User::orderBy('name')->paginate(10);
        return view('users.index', compact('users'));
    }

    // Mostrar el perfil de un usuario específico
    public function show($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        $followersCount = $user->followers()->count();
        $followingsCount = $user->followings()->count();
        $followers = $user->followers()->orderBy('name')->paginate(10);
        $followings = $user->followings()->orderBy('name')->paginate(10);
        $tweets = $user->tweets()->with('user')->latest()->paginate(10);

        return view('users.show', compact('user', 'followersCount', 'followingsCount', 'followers', 'followings', 'tweets'));
    }

    // Mostrar el perfil del usuario autenticado
    public function profile()
    {
        $user = Auth::user();
        $followersCount = $user->followers()->count();
        $followingsCount = $user->followings()->count();
        $followers = $user->followers()->orderBy('name')->paginate(10);
        $followings = $user->followings()->orderBy('name')->paginate(10);
        $suggestions = User::where('id', '!=', $user->id)->inRandomOrder()->take(5)->get();
        $tweets = $user->tweets()->with('user')->latest()->paginate(10);

        return view('profile', compact('user', 'followersCount', 'followingsCount', 'followers', 'followings', 'suggestions', 'tweets'));
    }

    // Seguir a un usuario
    public function follow(User $user)
    {
        $currentUser = Auth::user();
        if (!$currentUser->followings->contains($user->id)) {
            $currentUser->followings()->attach($user->id);
        }

        return back()->with('success', 'Usuario seguido con éxito');
    }

    // Dejar de seguir a un usuario
    public function unfollow(User $user)
    {
        $currentUser = Auth::user();
        if ($currentUser->followings->contains($user->id)) {
            $currentUser->followings()->detach($user->id);
        }

        return back()->with('success', 'Has dejado de seguir al usuario');
    }

    // Buscar usuarios por nombre o nombre de usuario
    public function search(Request $request)
    {
        $query = $request->input('query');
        $users = User::where('name', 'LIKE', "%$query%")
            ->orWhere('username', 'LIKE', "%$query%")
            ->orderBy('name')
            ->paginate(10);
        return view('users.search', compact('users', 'query'));
    }

    // Listar usuarios que el usuario autenticado está siguiendo
    public function followingList()
    {
        $following = Auth::user()->followings()->orderBy('name')->paginate(10);
        return view('users.following', compact('following'));
    }

    // Listar seguidores del usuario autenticado
    public function followersList()
    {
        $followers = Auth::user()->followers()->orderBy('name')->paginate(10);
        return view('users.followers', compact('followers'));
    }

    // Verificar si un nombre de usuario ya existe
    public function checkUsername(Request $request)
    {
        $username = $request->input('username');
        $exists = User::where('username', $username)->exists();

        $suggestions = [];
        if ($exists) {
            $suggestions[] = $username . rand(1, 100);
            $suggestions[] = $username . rand(101, 200);
        }

        return response()->json(['exists' => $exists, 'suggestions' => $suggestions]);
    }

    // Sugerencias de usuarios para seguir
    public function suggestions()
    {
        $user = Auth::user();
        if ($user) {
            $followingsIds = $user->followings()->pluck('id');
            $suggestions = User::whereNotIn('id', $followingsIds)
                ->where('id', '!=', $user->id)
                ->orderBy('name', 'asc')
                ->take(10)
                ->get();
        } else {
            $suggestions = collect();
        }

        return view('suggestions', compact('suggestions'));
    }

    // Mostrar la página de configuración
    public function settings()
    {
        return view('settings');
    }

    // Actualizar la configuración del usuario
    public function updateSettings(UpdateUserRequest $request)
    {
        $user = Auth::user();
        
        // Verificar la contraseña actual antes de cambiar la nueva contraseña
        if ($request->filled('password')) {
            if (!Hash::check($request->input('current_password'), $user->password)) {
                return back()->withErrors(['current_password' => 'La contraseña actual no es correcta']);
            }
            $user->password = Hash::make($request->input('password'));
        }

        $user->name = $request->input('name');
        $user->username = $request->input('username');
        $user->email = $request->input('email');

        $user->save();

        return redirect()->route('settings')->with('success', 'Configuración actualizada con éxito.');
    }

    // Mostrar auditorías de un usuario específico
    public function showAudits($id)
    {
        $user = User::findOrFail($id);
        $audits = $user->audits;

        return view('users.audits', compact('user', 'audits'));
    }
}
