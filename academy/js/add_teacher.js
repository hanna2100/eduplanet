var teacherImgShow = false;
var teacherName = false;
var teacherSubject = false;
var teacherContent = false;
$("#formButton").attr("disabled", true);
$("#saveForm").attr("disabled", true);

$(document).ready(function(){
  var teacherImgShowVal = $("#teacherImg"),
  teacherNameVal = $("#teacherName"),
  teacherSubjectVal = $("#teacherSubject"),
  teacherContentVal = $("#teacherContent");

  teacherNameVal.keyup(function(){
    var nameValue = teacherNameVal.val();
    console.log(nameValue);
    var exp = /^[a-zA-Z가-힣]{2,20}$/;
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
var srcDefault = '../img/member_basic.png';
$("#teacherImg").change(function(){
   var input = (this);
   var image = $(this).siblings('#teacherImgShow');
   if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
          console.log(this);
          image.attr('src', e.target.result);
          teacherImgShow = true;
          allPass()
        }
        reader.readAsDataURL(input.files[0]);
    }
});


function allPass(){
  console.log("pass", teacherImgShow, teacherName, teacherSubject, teacherContent);
  if(teacherImgShow && teacherName && teacherSubject && teacherContent){
    $("#saveForm").attr("disabled", false);
  }else{
    $("#saveForm").attr("disabled", true);
  }
}


function formButtonOn(){
  alert("선생님 정보가 등록되었습니다");
  $("#formButton").attr("disabled", false);
}

function scrollDiv(){
  var offset = $(".add_schedule").offset();

  $("html body").animate({scrollTop:offset.top},3000);
}

function saveTeacherInfo(parent, img, tn, ts, tc){
  $("#formButton").attr("disabled", true);
  var parent = parent;
  var formImg = img;
  var teacherName = tn;
  var teacherSchedule = ts;
  var teacherContent = tc;
  $.ajax({
    url : "add_teacher_info.php",
    type : "post",
    datatype : "json",
    data : {
      parent : parent,
      teacher_img : formImg,
      teacher_name : teacherName,
      teacher_subject : teacherSchedule,
      teacher_content : teacherContent
    },
    success : function(){
      formButtonOn();
    }
  });
}
