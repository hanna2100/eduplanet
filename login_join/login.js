var idPass = false;
var pwPass = false;

$(document).ready(function() {
  var inputId = $("#inputId"),
      inputPw = $("#inputPw");

  inputId.keyup(function() {
    var idValue = inputId.val();
    var exp = /^[a-z0-9]{4,12}$/;

    if(idValue === "") {
      //아이디 입력 안 할 경우
      $("#idSubMsg").text('아이디를 입력해주세요.');
      idPass = false;
      isAllPass();
    } else if(!exp.test(idValue)) {
      //형식에 어긋날경우
      $('#idSubMsg').text("아이디는 소문자와 숫자 4~12자리 입니다.");
      idPass = false;
    } else {
      $("#idSubMsg").text("");
      idPass = true;
      isAllPass();
    }
  });

  //비밀번호 체크
  inputPw.keyup(function(){
    var pwValue = inputPw.val();
    var exp = /^(?=.*\d{1,50})(?=.*[!@#$%^*()\-_=+\\\|\[\]{};:\'",.<>\/?]{1,50})(?=.*[a-zA-Z]{1,50}).{8,50}$/;

    if(pwValue === "") {
      //비밀번호 입력 안 할 경우
      $("#pwSubMsg").text('비밀번호를 입력해주세요.');
      pwValue = false;
      isAllPass();
    }else if(!exp.test(pwValue)) {
      $("#pwSubMsg").text("비밀번호는 숫자, 영문자, 특수문자가 모두 있는 8자리 글자여야 합니다.");
      pwPass = false;
      isAllPass();
    }else {
      $("#pwSubMsg").text("");
      pwPass = true;
      isAllPass();
      // 엔터키 눌렀을 때 자동 로그인
    if (window.event.keyCode == 13) {
      document.getElementById('form_login').submit();
    }
    }

  });
});

function isAllPass(){
  console.log(idPass, pwPass);
  if(idPass && pwPass){
    $("#btnFormSubmit").attr("disabled", false);
  }else{
    $("#btnFormSubmit").attr("disabled", true);
  }
}
