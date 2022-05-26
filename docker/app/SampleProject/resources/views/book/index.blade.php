@extends('layouts.app')
@section('content')

<h1>投稿一覧</h1>
<div class="row">
  @if(session('message'))
    <div class="alert alert-success">
      {{session('message')}}
    </div>
  @endif
  <div class="cok-md-3 offset-md-2"></div>
  <div class="col-md-7">
    <table>
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
            <td><a href="{{route('book.show', $book)}}">{{$book->book_title}}</a></td>
            <td>{{$book->author}}</td>
            <td>{{$book->title}}</td>
            <td>{{$book->readed_on->format("Y/m/d")}}</td>
            <td>{{$book->created_at->diffForHumans()}}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection