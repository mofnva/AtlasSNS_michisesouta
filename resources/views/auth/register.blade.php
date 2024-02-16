@extends('layouts.logout')

@section('content')
<div class="logoutui">
{!! Form::open() !!}
<div class="formtitle">
<h2>新規ユーザー登録</h
2>
</div>
<br>
{{ Form::label('user name') }}
{{ Form::text('username',null,['class' => 'input','maxlength'=>12,'minlength'=>2]) }}
@if (strpos($errors,'The username field is required.') !== false)
  <p>ユーザー名を入力してください。
  </p><br>
@endif

{{ Form::label('mail adress') }}
{{ Form::text('mail',null,['class' => 'input','maxlength'=>40,'minlength'=>5]) }}
@if (strpos($errors,'The mail field is required.') !== false)
  <p>メールアドレスを入力してください。
  </p><br>
@endif

{{ Form::label('password') }}
{{ Form::text('password',null,['class' => 'input','maxlength'=>20,'minlength'=>8,'confirmed']) }}
@if (strpos($errors,'The password field is required.') !== false)
  <p>パスワードを入力してください。</p><br>
@endif

{{ Form::label('password comfirm') }}
{{ Form::text('password_confirmation',null,['class' => 'input','maxlength'=>20,'minlength'=>8]) }}
@if (strpos($errors,'The password confirmation field is required.') !== false)
  <p>確認用パスワードを入力してください。
  </p><br>
@endif
@if (strpos($errors,'The password confirmation does not match.') !== false)
  <p>パスワードと確認用パスワードが一致していません。
  </p><br>
@endif

<div class="loginbutton">
{{ Form::submit('登録') }}
</div>
<div class="registerbutton">
<p><a href="/login">ログイン画面へ戻る</a></p>
</div>
{!! Form::close() !!}


@endsection
