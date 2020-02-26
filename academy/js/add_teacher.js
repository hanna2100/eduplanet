var teacherName = false;
var teacherSubject = false;
var teahcerContent = false;

$(document).ready(function(){
  var teacherImg = $("#teacherImg"),
  teacherName = $("#teacherName"),
  teacherSubject = $("#teacherSubject"),
  teacherContent = $("#teacherContent");

  teacherName.keyup(function(){
    var nameValue = teacherName.value();
    var exp = /^[a-zA-Z가-힣]{3,20}$/;
    if(nameValue === ""){
      $("#NameText").text('선생님의 이름을 입력하세요.');
      teacherName = false;
    }else if(!exp.test(nameValue)){
      $("#NameText").text('');
      teacherName = false;
    }else {
      $("#NameText").text('알맞게 입력 하였습니다.');
      teacherName = true;
    }
  });
  teacherSubject.keyup(function(){
    var subjectValue = inputId.value();
    var exp = /^[가-힣]{2,10}$/;

    if(subjectValue === ""){
      $("#subjectText").text('과목을 입력하세요.');
      teacherSubject = false;
    }else if(!exp.test(subjectValue)){
      $("#subjectText").text('과목명이 잘못 되었습니다.');
      teacherSubject = false;
    }else{
      $("#subjectText").text('');
      teacherSubject = true;
    }
  });
  teacherContent.keyup(function(){
    var contentValue = teacherContent.value();
    var exp = /^[a-zA-Z가-힣]{2,20}$/;

    if(contentValue === ""){
      $("#contentText").text('경력을 입력하세요.');
      teacherContent = false;
    }else if(!exp.test(contentValue)){
      $("#contentText").text('경력 입력이 잘못 되었습니다.');
      teacherContent = false;
    }else{
      $("#contentText").text('');
      teacherContent = true;
    }
  });
});
