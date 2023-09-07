

$('#menubutton').click(function () {
  $('#topmenu').toggleClass('hidden');
  $('#menubutton').toggleClass('reverse');
});

$('.editbutton').click(function () {
  let editpost = prompt('投稿を編集します');
  if (editpost !== null) {
    //ここで押されたボタンを拾ってそのフォームを送信させた
    let from = this.previousElementSibling;
    document.form.value = editpost;
  };

});

class editer {

};
