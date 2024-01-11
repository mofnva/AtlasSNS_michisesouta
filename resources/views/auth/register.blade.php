@extends('layouts.logout')

@section('content')
<div class="logoutui">
{!! Form::open() !!}
<div class="formtitle">
<h2>新規ユーザー登録</h
2>
</div>

{{ Form::label('user name') }}
{{ Form::text('username',null,['class' => 'input','maxlength'=>12,'minlength'=>2]) }}

{{ Form::label('mail adress') }}
{{ Form::text('mail',null,['class' => 'input','maxlength'=>40,'minlength'=>5]) }}

{{ Form::label('password') }}
{{ Form::text('password',null,['class' => 'input','maxlength'=>20,'minlength'=>8,'confirmed']) }}

{{ Form::label('password comfirm') }}
{{ Form::text('password_confirmation',null,['class' => 'input','maxlength'=>20,'minlength'=>8]) }}
<div class="loginbutton">
{{ Form::submit('登録') }}
</div>
<div class="registerbutton">
<p><a href="/login">ログイン画面へ戻る</a></p>
</div>
{!! Form::close() !!}


@endsection
