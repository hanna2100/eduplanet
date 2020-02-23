var idPass = false;
var pwPass = false;
var namePass = false;
var emailPass = false;

$(document).ready(function(){
  var inputId = $("#inputId"),
      inputPw1 = $("#inputPw1"),
      inputPw2 = $("#inputPw2"),
      inputName = $("#inputName"),
      inputEmail = $("#inputEmail");

  //아이디 중복체크 - ajax사용
  inputId.keyup(function() {
    var idValue = inputId.val();
    var exp = /^[a-z0-9]{4,12}$/;

    if(idValue === ""){
      //아이디 입력 안 할 경우
      $("#idSubMsg").text('아이디를 입력해주세요.');
      idPass = false;
      isAllPass();
    }
    else if(!exp.test(idValue)) {
      //형식에 어긋날경우
      $('#idSubMsg').text("아이디는 소문자와 숫자 4~12자리여야 합니다.");
      idPass = false;
      isAllPass();
    }
    else{
      $.ajax({
        url : "member_checkId.php?id="+ idValue,
        type : "get",
        //data: {inputId: idValue}, 포스트 방식으로 보낼 경우
        success : function(data) {
          //아이디 중복시
          if (data === "1") {
            $("#idSubMsg").text("사용중인 아이디입니다.");
            idPass = false;
            isAllPass();
          }else {
            //사용가능한 아이디
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

    if(!exp.test(pw1Value)){
      $("#pwSubMsg").text("비밀번호는 숫자, 영문자, 특수문자가 모두 있는 8자리 글자여야 합니다.");
      pwPass = false;
      isAllPass();
    }
    else if(pw1Value!=pw2Value){
      $("#pwSubMsg").text("비밀번호가 서로 일치하지 않습니다.");
      pwPass = false;
      isAllPass();
    }else{
      $("#pwSubMsg").text("");
      pwPass = true;
      isAllPass();
    }

  });

  //이름 체크
  inputName.keyup(function(){
    var nameValue = inputName.val();
    var exp = /^[가-힣a-zA-Z]{2,50}$/;

    if(!exp.test(nameValue)){
      $("#nameSubMsg").text("이름은 한글 혹은 영문 2자 이상이어야 합니다.");
      namePass = false;
      isAllPass();
    }else{
      $("#nameSubMsg").text("");
      namePass = true;
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
});

function isAllPass(){
  if(idPass && pwPass && emailPass && namePass){
    $("#btnFormSubmit").attr("disabled", false);
  }else{
    $("#btnFormSubmit").attr("disabled", true);
  }
}
