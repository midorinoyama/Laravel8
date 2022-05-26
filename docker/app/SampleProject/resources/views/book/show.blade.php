@extends('layouts.app')
@section('content')

<div class="row">
  <div class="col-md-5">
  </div>

  <div class="col-md-7">
    @if(session('message'))
      <div class="alert alert-success">
        {{session('message')}}
      </div>
    @endif

    <div class="field">
        <h1 class="heading">{{$book->user->name??"匿名"}}さんの投稿</h1>
        <p>本の題名「{{$book->book_title}}」</p>
        <p>著者:{{$book->author}}</p>
        <p>読了日:{{$book->readed_on->format("Y/m/d")}}</p>
        <h5 class="text-title">{{$book->title}}</h5>
        <p class="text-body">{!! nl2br(htmlspecialchars($book->body)) !!}</p>
        <p class="text-time text-right">投稿日:{{$book->created_at->format("Y/m/d")}}</p>
    </div>

    @if (!Auth::guest() && Auth::user()->id == $book->user_id)
      <div class="field text-right">
        <a href="{{route('book.edit', $book)}}"><button class="btn btn-primary">投稿内容を編集する</button></a>
      </div>
    @endif

    <div class="field-link text-right mt-5">
      <a href="{{route('book.index')}}"><button class="btn btn-secondary">一覧に戻る</button></a>
    </div>
  </div>
</div>

@endsection