@extends('layouts.login')

@section('content')

{!! Form::open(['url'=>'/profile])!!}

{{ Form::label('ユーザー名') }}
{{ Form::text('newUsername',null,['class' => 'input','required','maxlength'=>255,'minlength'=>1]) }}

{{ Form::label('メールアドレス') }}
{{ Form::text('newMail',null,['class' => 'input','required','maxlength'=>255,'minlength'=>1]) }}

{{ Form::label('新しいパスワード') }}
{{ Form::text('newPassword',null,['class' => 'input','required','maxlength'=>255,'minlength'=>1]) }}

{{ Form::label('自己紹介文を編集') }}
{{ Form::text('newBio',null,['class' => 'input','required','maxlength'=>400]) }}



{{ Form::submit('検索') }}

{!! Form::close() !!}


@endsection
