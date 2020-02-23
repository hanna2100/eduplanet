var idPass = false;
var pwPass = false;
var adminPass = false;

const ADMIN_ID = "admin";
const ADMIN_PW = "admin_12";

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
      isAllPass();
    } else if(idValue == ADMIN_ID){
      $("#idSubMsg").text("관리자 로그인");
      idPass = true;
      adminPass = true;
      isAllPass();
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
    }else if(pwValue === "admin_12"){
      $("#pwSubMsg").text("관리자로 로그인합니다.");
      pwPass = true;
      if(adminPass == true){
        

        // location.href="../admin/index.php";
      }
      isAllPass();
    }else {
      $("#pwSubMsg").text("");
      pwPass = true;
      isAllPass();
    }
  });
});


function isAllPass(){
  if(idPass && pwPass){
    $("#btnFormSubmit").attr("disabled", false);
  }else{
    $("#btnFormSubmit").attr("disabled", true);
  }
}
