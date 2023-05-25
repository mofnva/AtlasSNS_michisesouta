@extends('layouts.login')

@section('content')

<?php
  try {
    $profarr = (array)$userProfile[0];
  } catch (exception $e) {
  }
?>

{!! Form::open(['url'=>'/profile'])!!}

{{ Form::label('ユーザー名を変更') }}
{{ Form::text('newUsername',$profarr['username'],['class' => 'input','required','maxlength'=>255,'minlength'=>1]) }}

<br>

{{ Form::label('新しいメールアドレス') }}
{{ Form::text('newMail',$profarr['mail'],['class' => 'input','required','maxlength'=>255,'minlength'=>1]) }}

<br>

{{ Form::label('新しいパスワード') }}
{{ Form::password('newPassword',null,['required','maxlength'=>255,'minlength'=>1]) }}

<br>

{{ Form::label('自己紹介文を編集') }}
{{ Form::text('newBio',$profarr['bio'],['class' => 'input','required','maxlength'=>400]) }}

<br>

{{ Form::label('プロフィール画像を選択') }}
{{ Form::file('newIcon',[]) }}

<br>

{{ Form::submit('変更を適用') }}

{!! Form::close() !!}

<?php
  //var_dump(auth::users);
?>

@endsection
