var tempPass = false;
var pwPass = false;

$(document).ready(function () {

  var inputTemp = $("#temp_pw"),
      inputPw1 = $("#inputPw1"),
      inputPw2 = $("#inputPw2");

  // 임시번호 체크
  inputTemp.keyup(function(){
    var temp_pw_val = inputTemp.val();

    if(temp_pw_val === ""){
      $("#tempPwSubMsg").text('임시 번호를 입력해주세요.');
      tempPass = false;
      isAllPass();
    }else {
      $("#tempPwSubMsg").text("");
      tempPass = true;
      isAllPass();
    }

  });

  // 비밀번호 체크
  inputPw2.keyup(function(){
    var pw1Value = inputPw1.val();
    var pw2Value = inputPw2.val();
    var exp = /^(?=.*\d{1,50})(?=.*[!@#$%^*()\-_=+\\\|\[\]{};:\'",.<>\/?]{1,50})(?=.*[a-zA-Z]{1,50}).{8,50}$/;

    if(!exp.test(pw1Value) || !exp.test(pw2Value)){
      $("#pwSubMsg").text("숫자, 영문자, 특수문자 포함 8자리를 입력해 주세요.");
      pwPass = false;
      isAllPass();
    } else if(pw1Value != pw2Value){
      $("#pwSubMsg").text("비밀번호가 일치하지 않습니다.");
      pwPass = false;
      isAllPass();
    }else{
      $("#pwSubMsg").text("");
      pwPass = true;
      isAllPass();
    }
  });


});

function isAllPass() {
  console.log(tempPass, pwPass);
  if (tempPass && pwPass) {
    $("#btn_update_pw").attr("disabled", false);
  } else {
    $("#btn_update_pw").attr("disabled", true);
  }
}
