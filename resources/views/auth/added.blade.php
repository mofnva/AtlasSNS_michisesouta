@extends('layouts.logout')

@section('content')

@php
$user = $username['username'];
echo "<div id=\"clear\">
  <p>".$user."さん</p>
  <p>ようこそ！AtlasSNSへ！</p>
  <p>ユーザー登録が完了しました。</p>
  <p>早速ログインをしてみましょう。</p>

  <p class=\"btn\"><a href=\"/login\">ログイン画面へ</a></p>
</div>";
@endphp

@endsection
