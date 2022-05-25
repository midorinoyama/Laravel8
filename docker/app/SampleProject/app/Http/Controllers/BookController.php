<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::orderBy('id', 'desc')->get();
        $user  = auth()->user();
        return view('book.index', compact('books', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('book.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputs = $request->validate([
            'book_title' => 'required|max:100',
            'author'     => 'required|max:100',
            'title'      => 'required|max:100',
            'body'       => 'required|max:500',
            //明日からの日にちを選べないようにしたい
            //'readed_on'  => 'required|after:today',
        ]);

        $book = new Book();
        $book->user_id = auth()->user()->id;
        $book->book_title = $inputs['book_title'];
        $book->author = $inputs['author'];
        $book->title = $inputs['title'];
        $book->body = $inputs['body'];
        $book->readed_on = $request->readed_on;
        //$book->readed_on = $inputs['readed_on'];
        $book->save();
        return back()->with('message', '投稿を保存しました');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return view('book.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        return view('book.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $inputs = $request->validate([
            'book_title' => 'required|max:100',
            'author'     => 'required|max:100',
            'title'      => 'required|max:100',
            'body'       => 'required|max:500',
            //明日からの日にちを選べないようにしたい
            //'readed_on'  => 'required|after:today',
        ]);

        $book->book_title = $inputs['book_title'];
        $book->author = $inputs['author'];
        $book->title = $inputs['title'];
        $book->body = $inputs['body'];
        $book->readed_on = $request->readed_on;
        //$book->readed_on = $inputs['readed_on'];
        $book->save();
        return back()->with('message', '投稿を更新しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
