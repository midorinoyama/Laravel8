@extends('layouts.app')
@section('content')

  {{--エラーメッセージ--}}
 {{-- @if($errors->any())
    <div class="col-8 mx-auto alert alert-danger">
      <ul>
        @foreach($errors->all() as $eeror)
          <li>{{$error}}</li>
        @endforeach
      </ul>
    </div>
  @endif--}}

<div class="row">
  <div class="col-md-6 my-auto mx-auto">
      <h1 class="head-title">プロフィール編集</h1>
      <form method="post" action="{{route('users.update', $user)}}" enctype="multipart/form-data">
        @csrf
        @method('put')

        <div class="form-group">
          <label for="name">アカウント名</label>
          <input type="text" name="name" class="form-control" id="name" value="{{old('name', $user->name)}}">
        </div>

        <div class="form-group">
          <label for="profile_image">プロフィール画像</label>
          {{--登録されている画像を、未登録はデフォルト画像を表示--}}
          <img src="{{asset('storage/images/'.($user->profile_image??'default.jpg'))}}" class="d-block rounded-circle mb-3" style="height:100px;width:100px;">
          <input type="file" name="profile_image" class="form-control" id="profile_image">
        </div>

        <div class="form-group">
          <label for="email">メールアドレス</label>
          <input type="text" name="email" class="form-control" id="email" value="{{old('email', $user->email)}}">
        </div>

        {{--<div class="form-group">
          <label for="password">パスワード(8文字以上)</label>
          <input type="password" name="password" class="form-control" id="password" placeholder="パスワードを入力してください"
          required autocomplete="new-password">
        </div>

        <div class="form-group">
          <label for="password">パスワード再入力</label>
          <input type="password-confirm" name="password-confirm" class="form-control" id="password-confirm"placeholder="パスワードを再入力してください" 
          required autocomplete="new-password">
        </div>
--}}
        <div class="form-group">
          <label for="introduction">自己紹介</label>
          <textarea name="introduction" class="form-control" id="introduction" cols="20" rows="10">{{old('introduction', $user->introduction)}}</textarea>
        </div>

        <div class="form-group text-center">
          <button type="submit" class="btn btn-primary">この内容で保存する</button>
        </div>
      </form>
  </div>
</div
@endsection
