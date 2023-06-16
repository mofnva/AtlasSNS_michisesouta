@extends('layouts.login')

@section('content')
<h2>機能を実装していきましょう。</h2>

{!! Form::open(['url'=>'/top'])!!}

{{ Form::label('つぶやき') }}
{{ Form::text('postText',null,['class' => 'input','required','maxlength'=>150,'minlength'=>1]) }}

{{ Form::submit('投稿') }}

{!! Form::close() !!}

<br>

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
@foreach ($viewPosts as $postobj)
  @php
      $postarr = (array)$postobj;
      $loginUserId = Auth::id();
  @endphp
  @if($loginUserId == $postarr['user_id'])
    {!! Form::open(['url'=>'/delete', 'method'=>'post','onsubmit'=>'return confirm (\'本当に削除しますか？\')'])!!}
    {{ Form::label($postarr['post']) }}
    {{Form::hidden('deleteId',$postarr['id'],['class'=>'input'])}}

    {{ Form::submit('削除') }}

    {!! Form::close() !!}
    <br>
  @endif
@endforeach


@endsection
