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
          $buttonId=0;
        $loginimg = $viewPosts['headerimg'];
        unset($viewPosts['headerimg']);
        @endphp

        <div class="imgs">
@foreach ($viewPosts[count($viewPosts)-1] as $imgNameobj)
  @php
    $imgNameArr = (array)$imgNameobj;
    $imgName = (array)$imgNameArr[0];
    echo '<a href="/profileOther?id='.$imgName['id'].'" ><img src='.$imgName['images'].' alt="ユーザー の画像"></a>'
  @endphp
@endforeach
</div>

@for ($cnt=0;$cnt!=count($viewPosts)-1;$cnt=$cnt+1)
  @php
      $postarr = $viewPosts[$cnt];
      $loginUserId = Auth::id();
  @endphp
    <div class="posts">
      <div class="postbox">
    @php
      echo '<img src=images/'.$postarr['images'].'>';
    @endphp
    <div class ="posttexts">
    {!! Form::open(['url'=>'/follow-list', 'method'=>'get'])!!}
    @php
      echo '<p class="bold">'.$postarr['username'].'</p>';
      echo '<br>';
      @endphp
    {{ Form::label($postarr['post']) }}
    </div>
    </div>

    {!! Form::close() !!}
    </div>
    <br>
@endfor

@endsection
