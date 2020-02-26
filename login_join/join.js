var idPass = false;
var pwPass = false;
var emailPass = false;

var telPass = false;
var agePass = false;
var intresPass = false;

var acdNamePass = false;
var rprsnPass = false;
var licensePass= false;

$(document).ready(function(){
  var inputId = $("#inputId"),
      inputPw1 = $("#inputPw1"),
      inputPw2 = $("#inputPw2"),
      inputEmail = $("#inputEmail"),
      inputTel = $("#inputTel"),
      inputAge = $("#inputAge"),
      inputIntres = $("#inputIntres"),
      inputAcdName = $("#acd_name"),
      inputRprsn = $("#inputRprsn"),
      inputLicense = $("#inputLicense");


  //아이디 중복체크 - ajax사용
  inputId.keyup(function() {
    var idValue = inputId.val();
    var exp = /^[a-z0-9]{4,12}$/;

    if(idValue === ""){
      //아이디 입력 안 할 경우
      $("#idSubMsg").text('아이디를 입력해주세요.');
      idPass = false;
      isGmAllPass();
      isAmAllPass();
    } else if(!exp.test(idValue)) {
      //형식에 어긋날경우
      $('#idSubMsg').text("아이디는 소문자와 숫자 4~12자리여야 합니다.");
      idPass = false;
      isGmAllPass();
      isAmAllPass();
    } else{
      if(mode == "gm"){
        var url = "members_checkId.php?id="+idValue+"&mode=gm";
      }else if(mode == "am"){
        var url = "members_checkId.php?id="+idValue+"&mode=am";
      }
      $.ajax({
        url : url,
        type : "get",
        success : function(data) {
          //아이디 중복시
          if (data == 1) {
            $("#idSubMsg").text("사용중인 아이디입니다.");
            idPass = false;
            isGmAllPass();
            isAmAllPass();
          }else {
            //사용가능한 아이디
            console.log("사용가능아이디");
            $("#idSubMsg").text("");
            idPass = true;
            isGmAllPass();
            isAmAllPass();
          }
        },
        error : function() {
            console.log("아이디 중복확인 ajax 실패");
            idPass = false;
            isGmAllPass();
            isAmAllPass();
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
      isGmAllPass();
      isAmAllPass();
    } else if(pw1Value != pw2Value){
      $("#pwSubMsg").text("비밀번호가 서로 일치하지 않습니다.");
      pwPass = false;
      isGmAllPass();
      isAmAllPass();
    }else{
      $("#pwSubMsg").text("");
      pwPass = true;
      isGmAllPass();
      isAmAllPass();
    }

  });

  //이메일 체크
  inputEmail.keyup(function(){
    var emailValue = inputEmail.val();
    var exp = /^[\w_\.\-]+@[\w\-]+\.[\w\-]+/;

    if(!exp.test(emailValue)){
      $("#emailSubMsg").text("이메일 형식이 맞지 않습니다.");
      emailPass = false;
      isGmAllPass();
      isAmAllPass();
    }else{
      $("#emailSubMsg").text("");
      emailPass = true;
      isGmAllPass();
      isAmAllPass();
    }
  });

  //전화번호 체크
  inputTel.keyup(function(){
    var telValue = inputTel.val();
    var mobile_exp = /^01(?:0|1|[6-9])(?:\d{3}|\d{4})\d{4}$/;

    if(!mobile_exp.test(telValue)){
      $("#telSubMsg").text("휴대전화 형식에 맞춰 -없이 입력해주세요");
      telPass = false;
      isGmAllPass();
    }else{
      $("#telSubMsg").text("");
      telPass = true;
      isGmAllPass();
    }
  });



  //출생년도 select box
  inputAge.change(function(){
    var ageValue = $("#inputAge > option:selected").val();
    console.log("출생년도", ageValue);
    if(!ageValue){
      agePass = false;
      isGmAllPass();
    }else{
      agePass = true;
      isGmAllPass();
    }
  });

  //관심과목 체크
  inputIntres.keyup(function(){
    var intresValue = inputIntres.val();
    var exp = /^[가-힣a-zA-Z]{2,10}$/;

    if(!exp.test(intresValue)){
      $("#intresSubMsg").text("관심과목은 한글 혹은 영문 2~10자 이내로 입력해주세요.");
      intresPass = false;
      isGmAllPass();
    }else{
      $("#intresSubMsg").text("");
      intresPass = true;
      isGmAllPass();
    }
  });



  //학원/교습소명 체크
  inputAcdName.change(function(){
    var acdNameValue = inputAcdName.val();
    // var exp = /^[가-힣a-zA-Z]{2,50}$/;
    if(!acdNameValue){
      $("#AcdNameSubMsg").text("학원/교습소명은 반드시 입력해 주세요.");
      acdNamePass = false;
      isAmAllPass();
    }else{
      $("#AcdNameSubMsg").text("");
      acdNamePass = true;
      isAmAllPass();
    }
  });



  //대표자명 체크
  inputRprsn.keyup(function(){
    var nameValue = inputRprsn.val();
    var exp = /^[가-힣a-zA-Z]{2,50}$/;

    if(!exp.test(nameValue)){
      $("#RprsnSubMsg").text("이름은 한글 혹은 영문 2자 이상이어야 합니다.");
      rprsnPass = false;
      isAmAllPass();
    }else{
      $("#RprsnSubMsg").text("");
      rprsnPass = true;
      isAmAllPass();
    }
  });

  // 파일 첨부 여부 확인
  $("input[name=inputLicense]").change(function(){
    var licenseValue = inputLicense.val();
    if(!licenseValue){
      $("#LicenseSubMsg").text("사업자 등록증을 반드시 업로드 해주세요.");
      licensePass = false;
      isAmAllPass();
    }else{
      $("#LicenseSubMsg").text("");
      licensePass = true;
      isAmAllPass();
    }
  });

});

// 학원명 자동완성 함수
$("#acd_name").autocomplete({
    source: function (request, response) {
        $.ajax({
            type: 'post',
            url: "/eduplanet/mypage/auto_search.php",
            dataType: "json",
            data: {
                search: request.term
            },
            success: function (data) {
                response(data);
            }
        });
    },
    // 최소 글자입력 수
    minLength: 1,
    // 검색결과를 보여주는 시간
    delay: 100,
    // 포커스 되었을 때 input에 넣어주기
    focus: function (event, ui) {
        $("#acd_name").val(ui.item.acd_name);
        $("#si_name").val(ui.item.si_name);
        $("#dong_name").val(ui.item.dong_name);
    },
    // 선택 했을 때 input에 넣어주기
    select: function (event, ui) {
        // $('#acd_name').val(ui.item.label); // display the selected text
        $('#acd_name').val(ui.item.acd_name); // save selected id to input
        $("#si_name").val(ui.item.si_name);
        $("#dong_name").val(ui.item.dong_name);
        return false;
    }
    // 검색했을 때 나오는 자동완성 창을 커스텀하기
}).autocomplete("instance")._renderItem = function (ul, item) {
    return $("<li>")
        .append("<div><b>" + item.acd_name + "</b><br><span style='font-size: 12px; color: gray;'>" + item.si_name + " / " + item.dong_name + "</span></div>").appendTo(ul);
};


function setDateBox(){
   var dt = new Date();
   var year = "";
   var com_year = dt.getFullYear();

   $("#inputAge").append("<option value=''>년도</option>");
   for(var y = (com_year-5); y >= (com_year-60); y--){
       $("#inputAge").append("<option value='"+ y +"'>"+ y + " 년" +"</option>");
   }
}

function isGmAllPass(){
    console.log("GM패스", idPass, pwPass, emailPass, telPass, agePass, intresPass);
  if(idPass && pwPass && emailPass && telPass && agePass && intresPass){
    $("#btnFormSubmit").attr("disabled", false);
  }else{
    $("#btnFormSubmit").attr("disabled", true);
  }
}

function isAmAllPass(){
    // console.log("AM패스", idPass, pwPass, emailPass, acdNamePass, rprsnPass, licensePass);
  if(idPass && pwPass && emailPass && acdNamePass && rprsnPass && licensePass){
    $("#btnFormSubmit").attr("disabled", false);
  }else{
    $("#btnFormSubmit").attr("disabled", true);
  }
}
