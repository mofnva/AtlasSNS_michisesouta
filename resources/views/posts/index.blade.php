@extends('layouts.login')

@section('content')
<h2>機能を実装していきましょう。</h2>

{!! Form::open(['url'=>'/top'])!!}

{{ Form::label('つぶやき') }}
{{ Form::text('postText',null,['class' => 'input','required','maxlength'=>150,'minlength'=>1]) }}

{{ Form::submit('投稿') }}

{!! Form::close() !!}

<!--<form action="" method="POST">投稿フォーム URLが空なので自身に送信される(<a>と同じ仕様)ただしルーティングでPostsControllerに行く
  <input type="text" name="postText" required maxlength=150 minlength=1>
  <input type="submit">
</form><稿フォームおわり-->
@endsection
