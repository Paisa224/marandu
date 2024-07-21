<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tweet;
use App\Models\User;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        // Buscar tweets que contengan la palabra clave
        $tweets = Tweet::where('content', 'LIKE', "%{$query}%")->with('user')->get();

        // Buscar usuarios que coincidan con la palabra clave
        $users = User::where('name', 'LIKE', "%{$query}%")
                      ->orWhere('username', 'LIKE', "%{$query}%")
                      ->get();

        return view('search.results', compact('tweets', 'users', 'query'));
    }
}
