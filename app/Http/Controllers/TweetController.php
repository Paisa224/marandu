<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TweetController extends Controller
{
    public function index()
    {
        $tweets = Tweet::with('user')->latest()->get();
        return view('tweets.index', compact('tweets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:280',
        ], [
            'content.required' => 'El contenido es obligatorio.',
            'content.max' => 'El tweet no debe contener más de 280 caracteres.',
        ]);

        Tweet::create([
            'user_id' => Auth::id(),
            'content' => $request->content,
        ]);

        return redirect()->back()->with('status', 'Tweet publicado!');
    }

    public function like($id)
    {
        $tweet = Tweet::findOrFail($id);
        $tweet->likes()->attach(Auth::id());

        return redirect()->back();
    }

    public function unlike($id)
    {
        $tweet = Tweet::findOrFail($id);
        $tweet->likes()->detach(Auth::id());

        return redirect()->back();
    }

    public function edit(Tweet $tweet)
    {
        $this->authorize('update', $tweet);

        return view('tweets.edit', compact('tweet'));
    }

    public function update(Request $request, Tweet $tweet)
    {
        $this->authorize('update', $tweet);

        $request->validate([
            'content' => 'required|string|max:280',
        ], [
            'content.required' => 'El contenido es obligatorio.',
            'content.max' => 'El tweet no debe contener más de 280 caracteres.',
        ]);

        $tweet->content = $request->input('content');
        $tweet->save();

        return redirect()->route('home')->with('success', 'Tweet actualizado exitosamente.');
    }

    public function destroy(Tweet $tweet)
    {
        $this->authorize('delete', $tweet);

        $tweet->delete();

        return redirect()->route('home')->with('success', 'Tweet borrado exitosamente.');
    }
}
