function setSelectDis() {
  document.getElementById('follow_list_select_district').value = '$selectDis';
  document.getElementById('view_all_title').innerHTML = '$selectDis';

}

$(document).ready() {
  function onclick_heart(){
    $(this).css("background",url('/eduplanet/img/common_sprite.png'));

  }
  setSelectDis(); setSelectSort();
}

function onclick_heart() {
    var follow = document.getElementById("button_academy_heart");
    follow.style.background = url('/eduplanet/img/common_sprite.png'));
    background-position = 0px -2680px;
    background-repeat = no-repeat;
}

// function onclick_heart() {
//
//   var heart = document.getelementById("call_dibs_button");
//
//   heart.style("background", "url('/eduplanet/img/common_sprite.png')");
// }
