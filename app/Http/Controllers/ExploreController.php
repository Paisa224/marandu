<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ExploreController extends Controller
{
    public function index()
    {
        $tweets = Tweet::with('user')->latest()->get(); 
        $trendingTweets = Tweet::withCount('likes')->orderBy('likes_count', 'desc')->take(10)->get();
        $suggestions = User::whereNotIn('id', auth()->user()->followings->pluck('id')->push(auth()->user()->id))
                           ->orderBy('name', 'asc')
                           ->take(5)
                           ->get();

        return view('explore', compact('tweets', 'trendingTweets', 'suggestions'));
    }
}
