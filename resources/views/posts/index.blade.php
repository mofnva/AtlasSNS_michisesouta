@extends('layouts.login')

@section('content')
@php
        $followscnt = $viewPosts['follows'];
        $followedcnt = $viewPosts['followed'];
          unset($viewPosts['follows']);
          unset($viewPosts['followed']);
          $buttonId=0;
        $loginimg = $viewPosts['headerimg'];
        unset($viewPosts['headerimg']);
        $selfname = $viewPosts['myname'];
        unset($viewPosts['myname']);
        @endphp
<div class="postform">
{!! Form::open(['url'=>'/top'])!!}

@php
      echo '<img src=images/'.$loginimg.'>';
    @endphp
{{ Form::text('postText',null,['class' => 'input','required','maxlength'=>150,'minlength'=>1,'placeholder'=>'投稿内容を入力してください']) }}
{{ Form::image('images/post.png') }}

{!! Form::close() !!}
</div>

<?php
 // for($cnt=0;$cnt!=count($viewPosts);$cnt=$cnt+1){
      //$postobj=$viewPosts[$cnt];
      //$postarr = (array)$postobj;
      //echo "<div>
      //<p>".$postarr['post']."</p>";
      //if($postarr['user_id'] == Auth::id()){

       // echo "<form action=\"/delete\"method=\"post\" name=\"delete".$postarr['id']."\">
         // <script>
         // function delete".$postarr['id']."(){confirm(\"本当に削除しますか？\");
         // }
          //</script>
          //"
        //echo "<input type=\"hidden\" value=".$postarr['id']." name=\"deleteId\">
        //<input type=\"submit\" onclick=\"delete".$postarr['id']."()\">
        //</form>";
        ?>
        <?php
        //var_dump($viewPosts);
        ?>

@foreach ($viewPosts as $postobj)
<div class="posts">
  <br>
  @php
      $postarr = [];
      $postarr = $postobj;
      $loginUserId = Auth::id();
    @endphp
      <div class="postbox">
    @php
      echo '<img src=images/'.$postarr['images'].'>';
    @endphp
    <div class ="posttexts">
    @php
      echo '<p class="bold">'.$postarr['username'].'</p>';
      echo '<br>';
      echo $postarr['post'];
      @endphp
         </div>
         </div>
    @if($loginUserId == $postarr['user_id'])
    <div class="buttons">
      <div class="delbutton">
        <img src="images/trash.png" alt="">
        {!! Form::open(['url'=>'/delete', 'method'=>'post','class'=>'hidden','onsubmit'=>'return confirm (\'本当に削除しますか？\')'])!!}
        {{Form::hidden('deleteId',$postarr['id'],['class'=>'input'])}}
        {{ Form::image('images/trash-h.png') }}
      {!! Form::close() !!}
      </div>
      @php
      $address = $_SERVER['HTTP_HOST'];
     echo '<img src="images/edit.png" class=\'editbutton '.$postarr['post'].'\' id='.$postarr['id'].'>';
     @endphp
         </div>
    @endif
    <br>
     </div>
@endforeach

    <div class='editorback hidden'></div>
    <div class='editor hidden'>
      {!! Form::open(['url'=>'postedit','method'=>'post',]) !!}
      {{Form::hidden('editId'),['class'=>'input']}}
      {{form::text('postText','dummy'),['class'=>'textboxedit']}}
      <div class="brbox"></div>
      <div class="editorsubmit">
      {{Form::image('images/edit.png')}}
      </div>
      {!! Form::close()!!}
    </div>

@endsection
