
var teacher_no = '';
var schedule_flag = false; //선생님의 시간표가 이미 있는 지 여부(시간표 이중insert방지)
var url = '/eduplanet/academy/lecture.php?no=';
var sc_delete_forms ; //삭제할 시간표 폼들

$(function(){

});

function getinfo(parent){

    $('.teacher_schedule').css('visibility', 'visible');

    //전역변수 teacher_no설정
    teacher_no = parent;

      $.ajax({
      url : "lecture_schedule.php",
      type : "post",
      datatype : "json",
      data : {
        teacher_no : teacher_no
      },
      success : function(schedule){
        var html ="";
        var sc = JSON.parse(schedule);
        if(sc.length==0){
          schedule_flag = false;

          for(i=2;i>0;i--){
            html += "<tr>";
            if(i==2){
              html += `<td class="sc_top"></td>`;
              html += `<td class="sc_top">월</td>`;
              html += `<td class="sc_top">화</td>`;
              html += `<td class="sc_top">수</td>`;
              html += `<td class="sc_top">목</td>`;
              html += `<td class="sc_top">금</td>`;
              html += `<td class="sc_top">토</td>`;
            }else{
              html += `<td class="sc_time"></td>`;
              html += `<td colspan="6"> 등록된 수업이 없습니다 </td>`;
            }
            html += "</tr>";
            x++;
          }
          document.getElementById('table').innerHTML = html;

        }else{
          schedule_flag = true;

          var temp_array = [];
  
          for(var i=0; i<sc.length; i++){
            temp_array.push(sc[i][1]);
          }
          max_time = Math.max.apply(null, temp_array); // 최대값
          min_time = Math.min.apply(null, temp_array); //최소값
  
          var tr_max = max_time - min_time +2 ; //행 - 1행은 월~금, 총 행은 14-9+2 줄
          var html = "";
          var x = 0; //시간표 x좌표
          var time = min_time; //시간표 맨 첫타임

          for(i=0 ; i<tr_max ;i++){
            html += "<tr>";
            if(i==0){
              html += `<td class="sc_top"></td>`;
              html += `<td class="sc_top">월</td>`;
              html += `<td class="sc_top">화</td>`;
              html += `<td class="sc_top">수</td>`;
              html += `<td class="sc_top">목</td>`;
              html += `<td class="sc_top">금</td>`;
              html += `<td class="sc_top">토</td>`;
            }else{
              html += `<td class="sc_time" id="x`+x+`y1">`+ time +`:00 ~ `+ time++ +`:50 </td>`;
              html += `<td id="x`+x+`y2"> &nbsp </td>`;
              html += `<td id="x`+x+`y3"> &nbsp </td>`;
              html += `<td id="x`+x+`y4"> &nbsp </td>`;
              html += `<td id="x`+x+`y5"> &nbsp </td>`;
              html += `<td id="x`+x+`y6"> &nbsp </td>`;
              html += `<td id="x`+x+`y7"> &nbsp </td>`;
            }
            html += "</tr>";
            x++;
          }

          document.getElementById('table').innerHTML = html;

          for(var i=0; i<sc.length; i++){
            var x = sc[i][1]-min_time+1;
            var y = parseInt(sc[i][0])+1;

            var id = '#x'+x+'y'+y;
            $(id).html(sc[i][2]);
          }
        }
      }
    });
}

function submitTeacherInsert(){
  var form = $('#tc_insert_form')[0];
  var formData = new FormData(form);
  formData.append("upfile", $("#upfile")[0].files[0]);

  $.ajax({
    type: "post",
    processData: false,
    contentType: false,
    data: formData,
    url : "/eduplanet/academy/insert_teacher.php",
    success : function(data){
        if(data==1){
            alert('선생님이 등록되었습니다');
            location.href=url+acd_no;
        }else{
            alert('Error: '+data);
        }
    },
    error : function(){
        alert("시스템에러");
    }
});
}


function popupInsertTeacher(){
  $("#insertTeacher, #overlay").show();
  setPopupLayerPos("#insertTeacher");

  $("#overlay").click(function(e){
    e.preventDefault();
    $("#insertTeacher").hide();
    $("#overlay").hide();
  });

  $("#btn_add_tu_close").click(function(e){
    e.preventDefault();
    $("#insertTeacher").hide();
    $("#overlay").hide();
  });
}

function popupInsertSchedule(){

  if(schedule_flag==true){
    alert('선생님의 시간표가 이미 존재합니다');
  }else{
    $("#insertSchedule, #overlay").show();
    setPopupLayerPos("#insertSchedule");
  
    $("#overlay").click(function(e){
      e.preventDefault();
      $("#insertSchedule").hide();
      $("#overlay").hide();
    });
  
    $("#btn_add_si_close").click(function(e){
      e.preventDefault();
      $("#insertSchedule").hide();
      $("#overlay").hide();
    });

  }
}
function deleteTeacher(){

  $.ajax({
    type: "post",
    data: {no: teacher_no},
    url : "/eduplanet/academy/delete_teacher.php",
    success : function(data){
        if(data==1){
            alert('선생님이 삭제되었습니다');
            location.href=url+acd_no;
        }else{
            alert('Error: '+data);
        }
    },
    error : function(){
        alert("시스템에러");
    }
});
}

function popupUpdateSchedule(){
  if(schedule_flag==false){
    alert('등록된 시간표가 없습니다');
  }else{

    scheduleTblLoad();

    $("#updateSchedule, #overlay").show();
    setPopupLayerPos("#updateSchedule");
  
    $("#overlay").click(function(e){
      e.preventDefault();
      $("#updateSchedule").hide();
      clearLectureTable('update');
      $("#overlay").hide();
    });
  
    $("#btn_add_su_close").click(function(e){
      e.preventDefault();
      $("#updateSchedule").hide();
      clearLectureTable('update');
      $("#overlay").hide();
    });
  }
}


//시간표 수정을 위한 시간표 업로드
function scheduleTblLoad(){
  $.ajax({
    url : "lecture_schedule.php",
    type : "post",
    datatype : "json",
    data : {
      teacher_no : teacher_no
    },
    success : function(schedule){

      var sc = JSON.parse(schedule);

      console.log(sc);

      //몇행 생성할지 생각해보자 (타임이 몇종류?있는지 검사)
      var time_array = [];
  
      for(var i=0; i<sc.length; i++){
        time_array.push(sc[i][1]);
      }
      time_array = Array.from(new Set(time_array)); //중복제거
      time_array.sort(function(a,b) {return a-b;});

      console.log(time_array);
      var html = '';
      var j = 0; //time_array용 인덱스
      //월화수목~도 찍어야해서 length에 +1
      for(i=0 ; i<time_array.length+1 ;i++){
        html += "<tr>";
        if(i==0){
          html += `<td class="sc_top"></td>
            <td class="sc_top">월</td>
            <td class="sc_top">화</td>
            <td class="sc_top">수</td>
            <td class="sc_top">목</td>
            <td class="sc_top">금</td>
            <td class="sc_top">토</td>`;
        }else{
          html += `<td class="sc_order">
          <input value="`+time_array[j]+`" type="number" name="input_order2[]" placeholder="시간입력" oninput="setOrder(this)">
        </td>
        <td>
          <form action="#" method="post">
            <input class="order_value" type="hidden" name="order[]" value="`+time_array[j]+`">
            <input class="parent_value" type="hidden" name="parent[]" value="`+teacher_no+`">
            <input type="hidden" name="day[]" value="1">
            <input id="a1b`+time_array[j]+`" type="text" name="subject[]" placeholder="과목">
          </form>
        </td>
        <td>
          <form action="#" method="post">
            <input class="order_value" type="hidden" name="order[]" value="`+time_array[j]+`">
            <input class="parent_value" type="hidden" name="parent[]" value="`+teacher_no+`">
            <input type="hidden" name="day[]" value="2">
            <input id="a2b`+time_array[j]+`" type="text" name="subject[]" placeholder="과목">
          </form>
        </td>
        <td>
          <form action="#" method="post">
            <input class="order_value" type="hidden" name="order[]" value="`+time_array[j]+`">
            <input class="parent_value" type="hidden" name="parent[]" value="`+teacher_no+`">
            <input type="hidden" name="day[]" value="3">
            <input id="a3b`+time_array[j]+`" type="text" name="subject[]" placeholder="과목">
          </form>
        </td>
        <td>
          <form action="#" method="post">
            <input class="order_value" type="hidden" name="order[]" value="`+time_array[j]+`">
            <input class="parent_value" type="hidden" name="parent[]" value="`+teacher_no+`">
            <input type="hidden" name="day[]" value="4">
            <input id="a4b`+time_array[j]+`" type="text" name="subject[]" placeholder="과목">
          </form>
        </td>
        <td>
          <form action="#" method="post">
            <input class="order_value" type="hidden" name="order[]" value="`+time_array[j]+`">
            <input class="parent_value" type="hidden" name="parent[]" value="`+teacher_no+`">
            <input type="hidden" name="day[]" value="5">
            <input id="a5b`+time_array[j]+`" type="text" name="subject[]" placeholder="과목">
          </form>
        </td>
        <td>
          <form action="#" method="post">
            <input class="order_value" type="hidden" name="order[]" value="`+time_array[j]+`">
            <input class="parent_value" type="hidden" name="parent[]" value="`+teacher_no+`">
            <input type="hidden" name="day[]" value="6">
            <input id="a6b`+time_array[j]+`" type="text" name="subject[]" placeholder="과목">
          </form>
        </td>`;
        j++;
        }
        html += "</tr>";
      }

      sc_delete_forms = $('<form></form>');
      sc_delete_forms.attr('action', '#');
      sc_delete_forms.attr('method', 'post');
      for(var k=0; k<sc.length; k++){
        var no = $('<input type="hidden" name="no[]" value="'+sc[k][3]+'">');
        sc_delete_forms.append(no);
      }
      sc_delete_forms.appendTo('body');

      document.getElementById('scheduleTblUpdate').innerHTML = html;

      for(var i=0; i<sc.length; i++){
        var a = parseInt(sc[i][0]);
        var b = sc[i][1];
        var id = '#a'+a+'b'+b;
        $(id).val(sc[i][2]);
      }

    }
  });
}

function addScheduleTime(type){
  var name ;
  var $table;
  if(type=='insert'){
    name= 'input_order1[]';
    $table = $('.table_temp:first');
  }else{
    name= 'input_order2[]';
    $table = $('.table_temp:last')
  }
  var html= `<tr>
  <td class="sc_order">
    <input type="number" name="`+name+`" placeholder="시간입력" oninput="setOrder(this)">
  </td>
  <td>
    <form action="#" method="post">
      <input class="order_value" type="hidden" name="order[]" value="">
      <input class="parent_value" type="hidden" name="parent[]" value="">
      <input type="hidden" name="day[]" value="1">
      <input type="text" name="subject[]" placeholder="과목">
    </form>
  </td>
  <td>
    <form action="#" method="post">
      <input class="order_value" type="hidden" name="order[]" value="">
      <input class="parent_value" type="hidden" name="parent[]" value="">
      <input type="hidden" name="day[]" value="2">
      <input type="text" name="subject[]" placeholder="과목">
    </form>
  </td>
  <td>
    <form action="#" method="post">
      <input class="order_value" type="hidden" name="order[]" value="">
      <input class="parent_value" type="hidden" name="parent[]" value="">
      <input type="hidden" name="day[]" value="3">
      <input type="text" name="subject[]" placeholder="과목">
    </form>
  </td>
  <td>
    <form action="#" method="post">
      <input class="order_value" type="hidden" name="order[]" value="">
      <input class="parent_value" type="hidden" name="parent[]" value="">
      <input type="hidden" name="day[]" value="4">
      <input type="text" name="subject[]" placeholder="과목">
    </form>
  </td>
  <td>
    <form action="#" method="post">
      <input class="order_value" type="hidden" name="order[]" value="">
      <input class="parent_value" type="hidden" name="parent[]" value="">
      <input type="hidden" name="day[]" value="5">
      <input type="text" name="subject[]" placeholder="과목">
    </form>
  </td>
  <td>
    <form action="#" method="post">
      <input class="order_value" type="hidden" name="order[]" value="">
      <input class="parent_value" type="hidden" name="parent[]" value="">
      <input type="hidden" name="day[]" value="6">
      <input type="text" name="subject[]" placeholder="과목">
    </form>
  </td>
</tr>`;

  
  $table.append(html);
}


//시간표 초기화
function clearLectureTable(type){
  var name ;
  var $table;
  if(type=='insert'){
    name= 'input_order1[]';
    $table = $('.table_temp:first');
  }else{
    name= 'input_order2[]';
    $table = $('.table_temp:last')
  }
  $table.html(`<tr>
  <td class="sc_top"></td>
  <td class="sc_top">월</td>
  <td class="sc_top">화</td>
  <td class="sc_top">수</td>
  <td class="sc_top">목</td>
  <td class="sc_top">금</td>
  <td class="sc_top">토</td>
</tr>
<tr>
  <td class="sc_order">
    <input type="number" name="`+name+`" placeholder="시간입력" oninput="setOrder(this)">
  </td>
  <td>
    <form action="#" method="post">
      <input class="order_value" type="hidden" name="order[]" value="">
      <input class="parent_value" type="hidden" name="parent[]" value="">
      <input type="hidden" name="day[]" value="1">
      <input type="text" name="subject[]" placeholder="과목">
    </form>
  </td>
  <td>
    <form action="#" method="post">
      <input class="order_value" type="hidden" name="order[]" value="">
      <input class="parent_value" type="hidden" name="parent[]" value="">
      <input type="hidden" name="day[]" value="2">
      <input type="text" name="subject[]" placeholder="과목">
    </form>
  </td>
  <td>
    <form action="#" method="post">
      <input class="order_value" type="hidden" name="order[]" value="">
      <input class="parent_value" type="hidden" name="parent[]" value="">
      <input type="hidden" name="day[]" value="3">
      <input type="text" name="subject[]" placeholder="과목">
    </form>
  </td>
  <td>
    <form action="#" method="post">
      <input class="order_value" type="hidden" name="order[]" value="">
      <input class="parent_value" type="hidden" name="parent[]" value="">
      <input type="hidden" name="day[]" value="4">
      <input type="text" name="subject[]" placeholder="과목">
    </form>
  </td>
  <td>
    <form action="#" method="post">
      <input class="order_value" type="hidden" name="order[]" value="">
      <input class="parent_value" type="hidden" name="parent[]" value="">
      <input type="hidden" name="day[]" value="5">
      <input type="text" name="subject[]" placeholder="과목">
    </form>
  </td>
  <td>
    <form action="#" method="post">
      <input class="order_value" type="hidden" name="order[]" value="">
      <input class="parent_value" type="hidden" name="parent[]" value="">
      <input type="hidden" name="day[]" value="6">
      <input type="text" name="subject[]" placeholder="과목">
    </form>
  </td>
</tr>`);
}



//시간표에 시간입력하면 자동으로 form의 order, parent의 value값을 설정
function setOrder(e){
  var order = e.value;
  //시간을 입력하면 해당 tr의 모든 .order_value 인풋 밸류값을 변경시킴
  $(e).parent('td').parent('tr').find('.order_value').val(order);
  //parent 도 마찬가지
  $(e).parent('td').parent('tr').find('.parent_value').val(teacher_no);
}

function insertLecture(){
  var returnNow = false;
  //시간이 입력되었는지 검사
  $("input[name='input_order1[]']").each(function() {
    if(!$(this).val()) {//시간이 입력 안되어 있으면
        console.log($(this));
        alert('좌측에 시간이 모두 입력되었는 지 확인해주세요');
        returnNow = true;
        return false;
    }
  });
  //시간이 입력되지 않았으므로 함수종료
  if(returnNow){
    return;
  }

  var formsForLecture = new Array(); //db lecture테이블에 들어갈 폼들

  //폼 과목이 입력된것만 걸러내서 배열에 저장
  $("input:text[name='subject[]']").each(function() {
    if($(this).val()) {//과목이 입력되어 있으면
        formsForLecture.push($(this).closest("form")); //해당 폼 객체를 배열에 저장
    }
  });

  //여러개의 폼들을 직렬화하여 db전송
  var serialize ='';

  for(var i in formsForLecture){
      serialize += formsForLecture[i].serialize() + '&';
  }
  serialize = serialize.slice(0,-1);

  $.ajax({
      type: "post",
      data: serialize,
      url : "/eduplanet/academy/insert_lecture.php",
      success : function(data){
          if(data==1){
              alert('시간표가 등록되었습니다');
              location.href=url+acd_no;
          }else{
              alert('오류발생: '+data);
          }
      },
      error : function(){
          alert("시스템에러");
      }
  });
}


function updateLecture(){
  var returnNow = false;
  //시간이 입력되었는지 검사
  $("input[name='input_order2[]']").each(function() {
    if(!$(this).val()) {//시간이 입력 안되어 있으면
        alert('좌측에 시간이 모두 입력되었는 지 확인해주세요');
        returnNow = true;
        return false;
    }
  });
  //시간이 입력되지 않았으므로 함수종료
  if(returnNow){
    return;
  }

  //선생님의 기존 시간표를 몽땅 다 지우고 수정하나 시간표를 insert할것임
  var serialize = sc_delete_forms.serialize();

  $.ajax({
    type: "post",
    data: serialize,
    url : "/eduplanet/academy/delete_lecture.php",
    success : function(data){
        if(data!=1){
          alert('[error] db 정보 수정에 실패했습니다.');
          returnNow = true;
        }
    },
    error : function(){
        alert("시스템에러");
    }
  });
  if(returnNow){
    return;
  }
  
  //새 시간표를 전부 insert
  var formsForLecture = new Array(); //db lecture테이블에 들어갈 폼들

  //폼 과목이 입력된것만 걸러내서 배열에 저장
  $("input:text[name='subject[]']").each(function() {
    if($(this).val()) {//과목이 입력되어 있으면
        formsForLecture.push($(this).closest("form")); //해당 폼 객체를 배열에 저장
    }
  });

  //여러개의 폼들을 직렬화하여 db전송
  var serialize ='';

  for(var i in formsForLecture){
      serialize += formsForLecture[i].serialize() + '&';
  }
  serialize = serialize.slice(0,-1);
  console.log(serialize);
  $.ajax({
      type: "post",
      data: serialize,
      url : "/eduplanet/academy/insert_lecture.php",
      success : function(data){
          if(data==1){
              alert('시간표가 등록되었습니다');
              location.href=url+acd_no;
          }else{
              alert('오류발생: '+data);
          }
      },
      error : function(){
          alert("시스템에러");
      }
  });
}

function deleteLecture(){
  var serialize = sc_delete_forms.serialize();

  console.log(serialize);
  $.ajax({
    type: "post",
    data: serialize,
    url : "/eduplanet/academy/delete_lecture.php",
    success : function(data){
        if(data==1){
            alert('시간표가 삭제되었습니다');
            location.href=url+acd_no;
        }else{
          alert('오류발생: '+data);
        }
    },
    error : function(){
        alert("시스템에러");
    }
  });

}

function setPopupLayerPos(selector){
  $(selector).css("top", (($(window).height()-$(selector).outerHeight())/2+$(window).scrollTop())+"px");
  $(selector).css("left", (($(window).width()-$(selector).outerWidth())/2+$(window).scrollLeft())+"px");
  $(selector).css("position", "absolute");
}



