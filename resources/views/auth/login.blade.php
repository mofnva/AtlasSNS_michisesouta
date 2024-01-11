@extends('layouts.logout')

@section('content')
<div class="logoutui">
{!! Form::open(['url'=>'/login']) !!}

<div class="formtitle">
<p>AtlasSNSへようこそ</p>
</div>

{{ Form::label('mail address') }}
{{ Form::text('mail',null,['class' => 'input']) }}
{{ Form::label('password') }}
{{ Form::password('password',['class' => 'input']) }}
<div class="loginbutton">
{{ Form::submit('LOGIN') }}
</div>

<div class="registerbutton">
<p><a href="/register">新規ユーザーの方はこちら</a></p>
</div>
{!! Form::close() !!}
</div>

<?php//ログイン処理部分


?>

@endsection
