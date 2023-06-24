@extends('layouts.login')

@section('content')

{!! Form::open(['url'=>'/search'])!!}

{{ Form::label('ユーザー名検索') }}
{{ Form::text('searchName',null,['class' => 'input','required','maxlength'=>255,'minlength'=>1]) }}

{{ Form::submit('検索') }}

{!! Form::close() !!}

<?php
try{
  $loginId = Auth::id();
  if($searchResult!=null){
    echo "<br>";
    echo "<div>
    <p>検索ワード：".$searchResult[count($searchResult)-1]."</p>
   </div>
   <br>";
    for($cnt=0;$cnt!=count($searchResult);$cnt=$cnt+1){
      $resultobj=$searchResult[$cnt];
      $resultarr = (array)$resultobj;
      echo "<div>
      <img src=".$resultarr['images']."alt=\"ユーザー画像\".></img>
      <p>".$resultarr['username']."</p>
      </div>";
      //if()
      echo "<form action=\"/follow\" method=\"POST\">
      <input type=\"hidden\" name=\"_token\" value=". csrf_token() . ">
      <input type=\"hidden\" name=\"followId\" value=\"".$resultarr['id']."\">
      <input type=\"hidden\" name=\"loginId\" value=\"".$loginId."\">
      <input type=\"submit\" value=\"フォローする\">
      </form>
      ";
      //ifelse
      echo "<form action=\"/unfollow\" method=\"POST\">
      <input type=\"hidden\" name=\"_token\" value=" . csrf_token() . ">
      <input type=\"hidden\" name=\"followId\" value=\"".$resultarr['id']."\">
      <input type=\"hidden\" name=\"loginId\" value=\"".$loginId."\">
      <input type=\"submit\" value=\"フォロー解除\">
      </form>
      ";
      //if閉じ
      echo "<br>";
    };
  }
}catch(exception $e){};
?>
@endsection
