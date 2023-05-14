@extends('layouts.login')

@section('content')

{!! Form::open(['url'=>'<!--ここに検索機能走らせるURLを入れる-->'])!!}

{{ Form::label('ユーザー名検索') }}
{{ Form::text('searchName',null,['class' => 'input','required','maxlength'=>255,'minlength'=>1]) }}

{{ Form::submit('検索') }}

{!! Form::close() !!}

@endsection
