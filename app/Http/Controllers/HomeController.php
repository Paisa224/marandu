<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Tweet;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user) {
            $followersCount = $user->followers()->count();
            $followingsCount = $user->followings()->count();
            $followings = $user->followings()->orderBy('name')->take(5)->get();
            $followers = $user->followers()->orderBy('name')->take(5)->get();

            // Obtener tweets con paginación
            $tweets = Tweet::with('user')->latest()->paginate(10);

            // Obtener sugerencias de usuarios ordenadas alfabéticamente
            $suggestions = User::whereNotIn('id', $user->followings->pluck('id')->push($user->id))
                ->orderBy('name', 'asc')
                ->take(5)
                ->get();
        } else {
            $followersCount = 0;
            $followingsCount = 0;
            $followings = collect();
            $followers = collect();
            $tweets = Tweet::with('user')->latest()->paginate(10);
            $suggestions = collect();
        }

        return view('home', compact('followersCount', 'followingsCount', 'followings', 'followers', 'tweets', 'suggestions'));
    }
}
