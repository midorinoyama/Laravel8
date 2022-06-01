@extends('layouts.app')
@section('content')
<div class="row mt-5">
  <div class="col-12 col-lg-5">
  </div>
  <div class="col-12 col-lg-7">
    @if(session('message'))
      <div class="alert alert-success">
        {{session('message')}}
      </div>
    @endif
      <div class="field">
          <h1 class="book-heading">{{$book->user->name??"匿名"}}さんの投稿</h1>
          <p>本の題名「{{$book->book_title}}」</p>
          <p>著者:{{$book->author}} |
            読了日:{{$book->readed_on->format("Y/m/d")}}</p>
          <h5 class="text-title">{{$book->title}}</h5>
          <p class="text-body">{!! nl2br(htmlspecialchars($book->body)) !!}</p>
          <p class="text-time text-right">投稿日:{{$book->created_at->format("Y/m/d")}}</p>
          <div class="text-right">
          </div>
      </div>

      <div class="field text-right">
        @if (!Auth::guest() && Auth::user()->id == $book->user_id)
          <a href="{{route('book.edit', $book)}}"><button class="btn btn-outline-primary">投稿内容を編集する</button></a>
        @endif

      <!-- 自分の投稿者には「いいね」ボタンを表示させない -->
      @unless($book->user_id == Auth::user()->id)
        <!-- もし$favoriteがあれば＝ユーザーが「いいね」をしていた場合 -->
        @if($favorite)
        <!-- 「いいね」取り消しボタンを表示 -->
          <a href="{{route('unfavorite', $book)}}" class="fa-regular fa-thumbs-up thumbs_yellow">
            <span>{{$book->favorites->count()}}</span></a>
        @else
        <!-- もしユーザーが「いいね」していなければ「いいね」ボタンを表示 -->
        <a href="{{route('favorite', $book)}}" class="fa-regular fa-thumbs-up thumbs_grey">
        <span>{{$book->favorites->count()}}</span></a>
        @endif
      @endunless
      </div>
      <div class="field-link text-right mt-5">
        <a href="{{route('book.index')}}"><button class="btn btn-secondary">一覧に戻る</button></a>
      </div>

      <h4 class="comment-area mt-5">コメント({{$book->bookComments->count()}})件</h4>
      <table>
      @foreach ($book->bookComments as $book_comment)
        <tr>
          <td>
            {{$book_comment->user->name}}
          </td>
          <td>{!! nl2br(htmlspecialchars($book_comment->body)) !!}</td>
            {{--@if ($book_comment->user_id == auth()->user()->id)--}}
          <form method="post" action="{{route('book_comment.destroy', $book_comment)}}">
              @csrf
              @method('delete')
              <td><button type="submit" class="btn btn-warning" onClick="return confirm('コメントを削除しますか？')">削除</button></td>
            </form>
            {{--@endif--}}
        </tr>
        <tr>
          <td colspan="2"></td>
          <td>{{$book_comment->created_at->diffForHumans()}}</td>
        </tr>
      @endforeach
      </table>
      {{-- コメント投稿用フォーム --}}
      <div class="form-group mt-5">
        <form method="post" action="{{route('book_comment.store')}}">
          @csrf
            <input type="hidden" name='book_id' value="{{$book->id}}">
            <textarea name="body" class="form-control" id="body" cols="10" rows="3" placeholder="コメントしてみよう">{{old('body')}}</textarea>
            <button class="btn btn-secondary mb-3">コメントする</button>
        </form>
      </div>
  </div>
</div>
@endsection