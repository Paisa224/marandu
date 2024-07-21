<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ExploreController extends Controller
{
    public function index()
    {
        // Obtener los tweets ordenados por likes, y si no hay likes, ordenar por fecha de creación
        $trendingTweets = Tweet::withCount('likes')
            ->orderByDesc('likes_count')
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        // Obtener tweets con paginación
        $tweets = Tweet::with('user')->latest()->paginate(10);

        // Obtener sugerencias de usuarios
        $user = Auth::user();
        if ($user) {
            $followingsIds = $user->followings()->pluck('users.id'); // Especificar la tabla para evitar ambigüedades
            $suggestions = User::whereNotIn('users.id', $followingsIds)
                ->where('users.id', '!=', $user->id)
                ->orderBy('name', 'asc')
                ->take(10)
                ->get();
        } else {
            $suggestions = collect();
        }

        return view('explore', compact('tweets', 'trendingTweets', 'suggestions'));
    }
}
