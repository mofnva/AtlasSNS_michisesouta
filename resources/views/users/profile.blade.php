@extends('layouts.login')

@section('content')
{{--@php
var_dump($userProfile);
@endphp--}}

@php
    $profarr= [];
    $profcon = (array)$userProfile['prof'];
    $profobj = $profcon[0];
    $profarr =(array)$profobj;
    $secure = $userProfile['selfprof'];
    $following = $userProfile['following'];
    $loginId = $userProfile['myId'];
@endphp

@if($secure == 1)
{!! Form::open(['url'=>'/profileUpdate','method'=>'post'])!!}

{{ Form::label('ユーザー名を変更') }}
{{ Form::text('newUsername',$profarr['username'],['class' => 'input','required','maxlength'=>12,'minlength'=>2]) }}

<br>

{{ Form::label('新しいメールアドレス') }}
{{ Form::text('newMail',$profarr['mail'],['class' => 'input','required','maxlength'=>40,'minlength'=>5]) }}

<br>

{{ Form::label('新しいパスワード') }}
{{ Form::password('newPassword',null,['required','maxlength'=>20,'minlength'=>8]) }}

<br>

{{ Form::label('パスワードを確認') }}
{{ Form::password('newPassword',null,['required','maxlength'=>20,'minlength'=>8]) }}

<br>

{{ Form::label('自己紹介文を編集') }}
{{ Form::text('newBio',$profarr['bio'],['class' => 'input','maxlength'=>150]) }}

<br>

{{ Form::label('プロフィール画像を選択') }}
{{ Form::file('newIcon',[]) }}

<br>

{{ Form::submit('変更を適用') }}

{!! Form::close() !!}

@else

  @php
  echo '<div>
    <img src='.$profarr['images'].' alt="ユーザーの画像">
    <p>ユーザー名：'.$profarr['username'].'</p>
    <p>自己紹介：'.$profarr['bio'].'</p>';
  @endphp
  @if($following == 1)
    {!! Form::open(['url'=>'/unfollow','method'=>'post'])!!}
    {{ Form::hidden('loginId',$loginId)}}
    {{ Form::hidden('followId',$profarr['id'])}}
    {{ Form::submit('フォロー解除')}}
    {!! Form::close()!!}
  @else
    {!! Form::open(['url'=>'/follow','method'=>'post'])!!}
    {{ Form::hidden('loginId',$loginId)}}
    {{ Form::hidden('followId',$profarr['id'])}}
    {!! Form::close() !!}
    {{ Form::submit('フォローする')}}
  @endif
  @php
    echo '</div>';

    $postsobj = $userProfile['posts'];
    $postsarr = (array)$postsobj;
    $posts = [];
  @endphp
  @foreach ($postsarr as $postcon)
  @php
    $posts[] = (array)$postcon;
  @endphp
@endforeach

  @foreach($posts as $colpos)
  @php
      $postarr = $colpos;
      $loginUserId = Auth::id();
  @endphp

    {!! Form::open(['url'=>'/follow-list', 'method'=>'get'])!!}
    {{ Form::label($colpos['post']) }}

    {!! Form::close() !!}
    <br>
@endforeach


@endif

@endsection
