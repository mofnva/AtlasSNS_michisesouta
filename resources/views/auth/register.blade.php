@extends('layouts.logout')

@section('content')

{!! Form::open() !!}

<h2>新規ユーザー登録</h2>

{{ Form::label('ユーザー名') }}
{{ Form::text('username',null,['class' => 'input','maxlength'=>12,'minlength'=>2]) }}

{{ Form::label('メールアドレス') }}
{{ Form::text('mail',null,['class' => 'input','maxlength'=>40,'minlength'=>5]) }}

{{ Form::label('パスワード') }}
{{ Form::text('password',null,['class' => 'input','maxlength'=>20,'minlength'=>8]) }}

{{ Form::label('パスワード確認') }}
{{ Form::text('password-confirm',null,['class' => 'input','maxlength'=>12,'minlength'=>2,'confirmed'=>'password']) }}

{{ Form::submit('登録') }}

<p><a href="/login">ログイン画面へ戻る</a></p>

{!! Form::close() !!}


@endsection
