@extends('layouts.login')

@section('content')

{!! Form::open(['url'=>'/search'])!!}

{{ Form::label('ユーザー名検索') }}
{{ Form::text('searchName',null,['class' => 'input','required','maxlength'=>255,'minlength'=>1]) }}

{{ Form::submit('検索') }}

{!! Form::close() !!}

<?php
try{
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
      </div>
      <br>";
    };
  }
}catch(exception $e){};
?>
@endsection
