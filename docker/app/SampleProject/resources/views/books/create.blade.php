@extends('layouts.app')
@section('content')
<div class="row">
  <div class="col-md-6 my-auto mx-auto">
      <h1 class="head-title">新規投稿</h1>
      @if($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
          </ul>
        </div>
      @endif

      @if(session('message'))
        <div class="alert alert-success">
          {{session('message')}}
        </div>
      @endif

        <form method="post" action="{{route('books.store')}}">
          @csrf
          <div class="form-group">
            <label for="readed_on">読了日</label>
            <input type="date" name="readed_on" class="form-control" id="readed_on"  value="{{old('readed_on')}}">
          </div>

          <div class="form-group">
            <label for="book_title">本の題名</label>
            <input type="text" name="book_title" class="form-control" id="book_title" value="{{old('book_title')}}" placeholder="">
          </div>

          <div class="form-group">
            <label for="author">本の著者</label>
            <input type="text" name="author" class="form-control" id="author" value="{{old('author')}}" placeholder="">
          </div>

          <div class="form-group">
            <label for="title">タイトル</label>
            <input type="text" name="title" class="form-control" id="title" value="{{old('title')}}" placeholder="">
          </div>

          <div class="form-group">
            <label for="body">コメント</label>
            <textarea name="body" class="form-control" id="body" cols="30" rows="10">{{old('body')}}</textarea>
          </div>

          <div class="form-group text-center">
            <button type="submit" class="btn btn-primary">この内容で投稿する</button>
          </div>

        </form>
  </div>
</div>
@endsection