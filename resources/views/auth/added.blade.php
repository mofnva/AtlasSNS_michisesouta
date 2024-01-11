@extends('layouts.logout')

@section('content')
<div class="logoutui">
<div class="added">
@php
$user = $username['username'];
echo "<div class=\"center\">
  <p>".$user."さん</p>
  <p>ようこそ！AtlasSNSへ！</p>
  <br>
  <p>ユーザー登録が完了しました。</p>
  <p>早速ログインをしてみましょう。</p>
  <div class=\"registerbutton\">
  <p class=\"btn\"><a href=\"/login\">ログイン画面へ</a></p>
  </div>
</div>";
@endphp
</div>
</div>
@endsection
