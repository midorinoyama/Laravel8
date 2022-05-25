@extends('layouts.app')
@section('content')

<div class="row">
  <div class="col-md-5">
  </div>

  <div class="col-md-7">
    <div class="field">
        <h1 class="heading">{{$book->user->name}}さんの投稿</h1>
        <p>本の題名「{{$book->book_title}}」</p>
        <p>著者:{{$book->author}}</p>
        <p>読了日:{{$book->readed_on->format("Y/m/d")}}</p>
        <h5 class="text-title">{{$book->title}}</h5>
        <p class="text-body">{{$book->title}}</p>
        <p class="text-time text-right">投稿日:{{$book->created_at->format("Y/m/d")}}</p>
    </div>

    <div class="field text-right">
      投稿内容を編集する
    </div>

    <div class="field-link text-right mt-5">
      一覧に戻る
    </div>
  </div>
</div>

@endsection