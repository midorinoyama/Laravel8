<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function favorite(Book $book, Request $request)
    {
        $favorite = new Favorite();
        $favorite->book_id = $book->id;
        $favorite->user_id = auth()->user()->id;
        $favorite->save();
        return back();
    }

    public function unfavorite(Book $book, Request $request)
    {
        $user = auth()->user()->id;
        $favorite = Favorite::where('book_id', $book->id)->where('user_id', $user)->first();
        $favorite->delete();
        return back();
    }
}
