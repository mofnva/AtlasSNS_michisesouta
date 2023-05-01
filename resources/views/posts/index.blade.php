@extends('layouts.login')

@section('content')
<h2>機能を実装していきましょう。</h2>




<?php
  if($_POST!=null){
//機能を作る必要があるがログイン情報がないとレコードを作れない
  }
?>

<form action="" method="POST"><!--投稿フォーム URLが空なので自身に送信される(<a>と同じ仕様)-->
  <input type="text" name="postText" required maxlength=150 minlength=1><!--投稿テキスト-->
  <input type="submit">
</form><!--投稿フォームおわり-->

@endsection
