

$('#menubutton').click(function () {
  $('#topmenu').toggleClass('hidden');
  $('#menubutton').toggleClass('reverse');
});

$('.editbutton').click(function () {
  //ここで押されたボタンを拾ってそのフォームを送信させた
  let postid = this.id;
  let posttext = (this.classList.item(1));
  $('.editor').toggleClass('hidden');
  $('.editorback').toggleClass('hidden');
  let editordat = document.getElementsByClassName('editor')[0];
  let textbox = editordat.children[0].children[2];
  let idbox = editordat.children[0].children[1];
  textbox.value = posttext;
  idbox.value = postid;

});

$('.editorback').click(function () {
  $('.editor').toggleClass('hidden');
  $('.editorback').toggleClass('hidden');
});

$('.delbutton').hover(function () {
  let del = this.children[0];
  let del_h = this.children[1];
  $(del).toggleClass('hidden');
  $(del_h).toggleClass('hidden');
});

class editer {

};
