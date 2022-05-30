<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookComment;

class BookCommentController extends Controller
{
    public function store(Request $request)
    {
        $inputs = $request->validate([
            'body' => 'required|max:255',
        ]);

        $book_comment = new BookComment();
        $book_comment->body = $inputs['body'];
        $book_comment->user_id = auth()->user()->id;
        $book_comment->book_id = $request->book_id;
        $book_comment->save();
        return back();
    }

    public function destroy(BookComment $book_comment)
    {
        $book_comment->delete();
        return back();
    }
}
