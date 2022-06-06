@extends('layouts.app')
@section('content')
<h5 class="text-center mt-3">{{$user->name}}さんのマイページ</h5>
<div class="row mt-5">
  <div class="col-lg-2">
  <table class="table table-borderless">
    <tr>
      @if ($user->profile_image != null)
        <img class="rounded-circle" src="{{asset('storage/images/'.$user->profile_image)}}" alt="プロフィール画像" style="width:60px;height:60px;">
      @else
        <img class="rounded-circle" src="{{asset('storage/images/default.png')}}" alt="プロフィール画像" style="width:60px;height:60px;">
      @endif
    </tr>
    <tr>
      <th>{{$user->name}}</th>
    </tr>
    <tr>
      <td>フォロー</td>
      <td></td>
    </tr>
    <tr>
      <td>フォロワー</td>
      <td></td>
    </tr>
  </table>
  <div class="info">
    <div class="info-text">
      {!! nl2br(htmlspecialchars($user->introduction)) !!}
    </div>
    <div class="info-btn">
      <a href="{{route('users.edit', $user)}}"><button class="btn btn-outline-secondary">プロフィールを編集</button></a>
    </div>
  </div>
  </div>
  <div class="col-lg-10">
    @if(session('message'))
      <div class="alert alert-success">
        {{session('message')}}
      </div>
    @endif
    <p>投稿済みの本</p>
    <table class="table">
      <thead>
        <tr>
          <th>ユーザー</th>
          <th>本の題名</th>
          <th>著者</th>
          <th>タイトル</th>
          <th>読了日</th>
          <th>投稿時間</th>
          <th colspan="3"></th>
        </tr>
      </thead>

      <tbody>
        @foreach ($books as $book)
          <tr>
            <td>{{$book->user->name}}</td>
            <td><a href="{{route('books.show', $book)}}">{{$book->book_title}}</a></td>
            <td>{{$book->author}}</td>
            <td>{{Str::limit($book->title, 18, '...')}}</td>
            <td>{{$book->readed_on->format("Y/m/d")}}</td>
            <td>{{$book->created_at->diffForHumans()}}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection