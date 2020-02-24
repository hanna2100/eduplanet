var idPass = false;
var pwPass = false;
var emailPass = false;
var telPass = false;
var agePass = false;
var intresPass = false;

$(document).ready(function(){
  var inputId = $("#inputId"),
      inputPw1 = $("#inputPw1"),
      inputPw2 = $("#inputPw2"),
      inputEmail = $("#inputEmail"),
      inputTel = $("#inputTel"),
      inputAge = $("#inputAge"),
      inputIntres = $("#inputIntres");

  //아이디 중복체크 - ajax사용
  inputId.keyup(function() {
    var idValue = inputId.val();
    var exp = /^[a-z0-9]{4,12}$/;

    if(idValue === ""){
      //아이디 입력 안 할 경우
      $("#idSubMsg").text('아이디를 입력해주세요.');
      idPass = false;
      isAllPass();
    } else if(!exp.test(idValue)) {
      //형식에 어긋날경우
      $('#idSubMsg').text("아이디는 소문자와 숫자 4~12자리여야 합니다.");
      idPass = false;
      isAllPass();
    } else{
      $.ajax({
        url : "g_members_checkId.php?id="+ idValue,
        type : "get",
        success : function(data) {
          //아이디 중복시
          if (data === "1") {
            $("#idSubMsg").text("사용중인 아이디입니다.");
            idPass = false;
            isAllPass();
          }else {
            //사용가능한 아이디
            console.log("사용가능아이디");
            $("#idSubMsg").text("");
            idPass = true;
            isAllPass();
          }
        },
        error : function() {
            console.log("아이디 중복확인 ajax 실패");
            idPass = false;
            isAllPass();
        }
      });
    }
  });

  //비밀번호 체크
  inputPw2.keyup(function(){
    var pw1Value = inputPw1.val();
    var pw2Value = inputPw2.val();
    var exp = /^(?=.*\d{1,50})(?=.*[!@#$%^*()\-_=+\\\|\[\]{};:\'",.<>\/?]{1,50})(?=.*[a-zA-Z]{1,50}).{8,50}$/;

    if(!exp.test(pw1Value) || !exp.test(pw2Value)){
      $("#pwSubMsg").text("비밀번호는 숫자, 영문자, 특수문자가 모두 있는 8자리 글자여야 합니다.");
      pwPass = false;
      isAllPass();
    } else if(pw1Value != pw2Value){
      $("#pwSubMsg").text("비밀번호가 서로 일치하지 않습니다.");
      pwPass = false;
      isAllPass();
    }else{
      $("#pwSubMsg").text("");
      pwPass = true;
      isAllPass();
    }

  });

  //이메일 체크
  inputEmail.keyup(function(){
    var emailValue = inputEmail.val();
    var exp = /^[\w_\.\-]+@[\w\-]+\.[\w\-]+/;

    if(!exp.test(emailValue)){
      $("#emailSubMsg").text("이메일 형식이 맞지 않습니다.");
      emailPass = false;
      isAllPass();
    }else{
      $("#emailSubMsg").text("");
      emailPass = true;
      isAllPass();
    }
  });

  //전화번호 체크
  inputTel.keyup(function(){
    var telValue = inputTel.val();
    var mobile_exp = /^01(?:0|1|[6-9])(?:\d{3}|\d{4})\d{4}$/;

    if(!mobile_exp.test(telValue)){
      $("#telSubMsg").text("휴대전화 형식에 맞춰 -없이 입력해주세요");
      telPass = false;
      isAllPass();
    }else{
      $("#telSubMsg").text("");
      telPass = true;
      isAllPass();
    }
  });

  //출생년도 select box
  setDateBox();
  inputAge.change(function(){
    var ageValue = $("#inputAge option:selected").val();
    console.log("출생년도", ageValue);

    if(!ageValue){
      agePass = false;
      isAllPass();
    }else{
      agePass = true;
      isAllPass();
    }
  });

  //관심과목 체크
  inputIntres.keyup(function(){
    var intresValue = inputIntres.val();
    var exp = /^[가-힣a-zA-Z]{2,10}$/;

    if(!exp.test(intresValue)){
      $("#intresSubMsg").text("관심과목은 한글 혹은 영문 2~10자 이내로 입력해주세요.");
      intresPass = false;
      isAllPass();
    }else{
      $("#intresSubMsg").text("");
      intresPass = true;
      isAllPass();
    }
  });

});

function setDateBox(){
   var dt = new Date();
   var year = "";
   var com_year = dt.getFullYear();

   $("#inputAge").append("<option value=''>년도</option>");
   for(var y = (com_year-5); y >= (com_year-60); y--){
       $("#inputAge").append("<option value='"+ y +"'>"+ y + " 년" +"</option>");
   }
}

function isAllPass(){
  console.log("올패스", idPass, pwPass, emailPass, telPass, agePass, intresPass);
  if(idPass && pwPass && emailPass && telPass && agePass && intresPass){
    $("#btnFormSubmit").attr("disabled", false);
  }else{
    $("#btnFormSubmit").attr("disabled", true);
  }
}
