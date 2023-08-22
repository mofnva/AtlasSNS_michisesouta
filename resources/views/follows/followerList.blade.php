@extends('layouts.login')

@section('content')

@php
$textF = '<p>フォロワーリスト</p><br>';
echo $textF;
@endphp

@php
        $followscnt = $viewPosts['follows'];
        $followedcnt = $viewPosts['followed'];
          unset($viewPosts['follows']);
          unset($viewPosts['followed']);
        @endphp

@foreach ($viewPosts[count($viewPosts)-1] as $imgNameobj)
  @php
    $imgNameArr = (array)$imgNameobj;
    $imgName = (array)$imgNameArr[0];
    echo '<a href="/profileOther?id='.$imgName['id'].'" ><img src='.$imgName['images'].' alt="ユーザー の画像"></a>'
  @endphp
@endforeach

@for ($cnt=0;$cnt!=count($viewPosts)-1;$cnt=$cnt+1)
  @php
      $postarr = $viewPosts[$cnt];
      $loginUserId = Auth::id();
  @endphp

    {!! Form::open(['url'=>'/follow-list', 'method'=>'get'])!!}
    {{ Form::label($postarr['post']) }}

    {!! Form::close() !!}
    <br>

@endfor

@endsection
