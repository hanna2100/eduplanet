
function popupAddInfo(){ //정보수정 버튼을 눌렀을때 둘다 모달창이랑 뒤에 흐린화면을 보여준다.
  $("#addInfo, #overlay").show();
  setPopupLayerPos("#addInfo");

  $("#overlay").click(function(e){ //뒤에 흐린 화면 눌렀을때
    e.preventDefault();
    $("#addInfo").hide(); //숨긴다
    $("#overlay").hide(); //숨긴다
  });
  $("#cancel").click(function(e) {
    e.preventDefault();
    $("#addInfo").hide(); //숨긴다
    $("#overlay").hide(); //숨긴다

  });
  $("#btn_add_tu_close").click(function(e){ //x(창닫기) 버튼 눌렀을때
    e.preventDefault();
    $("#addInfo").hide();
    $("#overlay").hide();
  });
}


function setPopupLayerPos(selector){  //모달창을 중앙으로 띄어준다.
  $(selector).css("top", (($(window).height()-$(selector).outerHeight())/2+$(window).scrollTop())+"px");
  $(selector).css("left", (($(window).width()-$(selector).outerWidth())/2+$(window).scrollLeft())+"px");
  $(selector).css("position", "absolute");
}
