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

<div class="row">
  <div class="col-md-12">

    @foreach ($book->bookComments as $book_comment)
      <div class="card mb-4">
          <div class="card-header">
              {{$book_comment->user->name}}
          </div>
          <div class="card-body">
              {{$book_comment->body}}
          </div>
          <div class="card-footer">
              <span class="mr-2 float-right">
                  投稿日時 {{$book_comment->created_at->diffForHumans()}}
              </span>
              {{--@if ($book_comment->user_id == auth()->user()->id)--}}
              <form method="post" action="{{route('book_comment.destroy', $book_comment)}}">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger" onClick="return confirm('コメントを削除しますか？')">削除</button>
              </form>
              {{--@endif--}}
          </div>
      </div>
    @endforeach


    {{-- コメント投稿用のバリデーション --}}
    @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
    @endif

    {{-- コメント投稿用フォーム --}}
    <div class="card mb-4">
        <form method="post" action="{{route('book_comment.store')}}">
            @csrf
            <input type="hidden" name='book_id' value="{{$book->id}}">
            <div class="form-group">
                <textarea name="body" class="form-control" id="body" cols="30" rows="5"
                placeholder="コメントを入力する">{{old('body')}}</textarea>
            </div>
            <div class="form-group">
              <button class="btn btn-success float-right mb-3 mr-3">コメントする</button>
            </div>
        </form>
    </div>
  </div>
</div>
@endsection