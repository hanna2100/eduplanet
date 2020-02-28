var teacherName = false;
var teacherSubject = false;
var teahcerContent = false;
$("#formButton").attr("disabled", true);
$("#saveForm").attr("disabled", true);

$(document).ready(function(){
  var teacherImg = $("#teacherImg"),
  teacherNameVal = $("#teacherName"),
  teacherSubjectVal = $("#teacherSubject"),
  teacherContentVal = $("#teacherContent");

  teacherNameVal.keyup(function(){
    var nameValue = teacherNameVal.val();
    console.log(nameValue);
    var exp = /^[a-zA-Z가-힣]{3,20}$/;
    if(nameValue === ""){
      $("#NameText").text('선생님의 이름을 입력하세요.');
      teacherName = false;
      allPass();
    }else if(!exp.test(nameValue)){
      $("#NameText").text('선생님의 이름 입력이 잘못되었습니다');
      teacherName = false;
      allPass();
    }else {
      $("#NameText").text('알맞게 입력 하였습니다.');
      teacherName = true;
      allPass();
    }
  });
  teacherSubjectVal.keyup(function(){
    var subjectValue = teacherSubjectVal.val();
    var exp = /^[가-힣]{2,10}$/;

    if(subjectValue === ""){
      $("#subjectText").text('과목을 입력하세요.');
      teacherSubject = false;
      allPass();
    }else if(!exp.test(subjectValue)){
      $("#subjectText").text('과목명이 잘못 되었습니다.');
      teacherSubject = false;
      allPass();
    }else{
      $("#subjectText").text('알맞게 입력 하였습니다');
      teacherSubject = true;
      allPass();
    }
  });
  teacherContentVal.keyup(function(){
    var contentValue = teacherContentVal.val();
    var exp = /^[0-9a-zA-Z가-힣\s]{2,20}$/;

    if(contentValue === ""){
      $("#contentText").text('경력을 입력하세요.');
      teacherContent = false;
      allPass();
    }else if(!exp.test(contentValue)){
      $("#contentText").text('경력 입력이 잘못 되었습니다.');
      teacherContent = false;
      allPass();
    }else{
      $("#contentText").text('알맞게 입력 하였습니다');
      teacherContent = true;
      allPass();
    }
  });
});

function allPass(){
  console.log("pass", teacherName, teacherSubject, teacherContent);
  if(teacherName && teacherSubject && teacherContent){
    $("#saveForm").attr("disabled", false);
  }else{
    $("#saveForm").attr("disabled", true);
  }
}

function formButtonOn(){
  $("#formButton").attr("disabled", false);
}

function scrollDiv(){
  var offset = $(".add_schedule").offset();

  $("html bodt").animate({scrollTop:offset.top},3000);
}

function saveTeacherInfo(){
  var formImg
  var teacherName
  var teacherSchedule
  var teacherContent
  // $.ajax({
  //   url : "add_teacher_info.php",
  //   type : "post",
  //   datatype : "json",
  //   data : {
  //     teacher_name : ,
  //     teacher_subject : ,
  //     teacher_content :
  //   },
  //   success : function(){
  //     var html = "";
  //     var ati = JSON.parse();
  //   }
  // });
}
