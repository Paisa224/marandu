<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Tweet;
use App\Notifications\LikeNotification;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function likeTweet(Request $request, $tweetId)
    {
        $tweet = Tweet::findOrFail($tweetId);
        $user = auth()->user();

        $tweet->likes()->attach($user->id);

        $tweet->user->notify(new LikeNotification($user->name, $tweet));

        return "¡Like enviado!";
    }
}
