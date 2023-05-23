@extends('layouts.login')

@section('content')

{!! Form::open(['url'=>'/search'])!!}

{{ Form::label('ユーザー名検索') }}
{{ Form::text('searchName',null,['class' => 'input','required','maxlength'=>255,'minlength'=>1]) }}

{{ Form::submit('検索') }}

{!! Form::close() !!}

<?php
try{
    foreach($searchResult as $resultobj){
      $resultarr = (array)$resultobj;
      echo "<div>
      <img src=".$resultarr['images']."alt=\"ユーザー画像\".></img>
      <p>".$resultarr['username']."</p>
      </div>
      <br>";
    };
}catch(exception $e){};
?>
@endsection
