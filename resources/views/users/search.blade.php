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
    <p>検索ワード：".$searchResult[count($searchResult)-2]."</p>
   </div>
   <br>";
    $followchecker = $searchResult[count($searchResult)-1];
    //よくわからんけどこれ使うと壊れて何もでなくなる$followchecker = (array)$searchResult[count($searchResult)];
    // $searchResultの最後の１こがnull配列になってるのが原因っぽい、null配列をさわるとエラーが出ずにそのあとの処理全部が動かかなくなる
    for($cnt=0;$cnt!=count($searchResult)-2;$cnt=$cnt+1){
      $resultobj=$searchResult[$cnt];
      $resultarr = (array)$resultobj;
      echo "<div>
      <img src=".$resultarr['images']."alt=\"ユーザー画像\".></img>
      <p>".$resultarr['username']."</p>
      </div>";
      if($followchecker[$cnt] == 0){
      echo "<form action=\"/follow\" method=\"POST\">
      <input type=\"hidden\" name=\"_token\" value=". csrf_token() . ">
      <input type=\"hidden\" name=\"followId\" value=\"".$resultarr['id']."\">
      <input type=\"hidden\" name=\"loginId\" value=\"".$loginId."\">
      <input type=\"submit\" value=\"フォローする\">
      </form>
      ";
      }else{
      echo "<form action=\"/unfollow\" method=\"POST\">
      <input type=\"hidden\" name=\"_token\" value=" . csrf_token() . ">
      <input type=\"hidden\" name=\"followId\" value=\"".$resultarr['id']."\">
      <input type=\"hidden\" name=\"loginId\" value=\"".$loginId."\">
      <input type=\"submit\" value=\"フォロー解除\">
      </form>
      ";
      };
      echo "<br>";
    };
  }
}catch(exception $e){};
?>
@endsection
