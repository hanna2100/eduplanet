$(document).ready(function() {
  $("#myCarousel").on("slide.bs.carousel", function(e) {
    var $e = $(e.relatedTarget);
    var idx = $e.index();
    var itemsPerSlide = 3;
    var totalItems = $(".carousel-item").length;

    if (idx >= totalItems - (itemsPerSlide - 1)) {
      var it = itemsPerSlide - (totalItems - idx);
      for (var i = 0; i < it; i++) {
        // append slides to end
        if (e.direction == "left") {
          $(".carousel-item")
            .eq(i)
            .appendTo(".carousel-inner");
        } else {
          $(".carousel-item")
            .eq(0)
            .appendTo($(this).find(".carousel-inner"));
        }
      }
    }
  });
});


function getinfo(parent){
    var no = parent;
      $.ajax({
      url : "lecture_schedule.php",
      type : "post",
      datatype : "json",
      data : {
        teacher_no : no
      },
      success : function(schedule){
        var html ="";
        var sc = JSON.parse(schedule);
        if(sc.length==0){
          for(i=2;i>0;i--){
            html += "<tr>";
            if(i==2){
              html += `<td>시간</td>`;
              html += `<td>월요일</td>`;
              html += `<td>화요일</td>`;
              html += `<td>수요일</td>`;
              html += `<td>목요일</td>`;
              html += `<td>금요일</td>`;
              html += `<td>토요일</td>`;
            }else{
              html += `<td id="x`+x+`y1"> 1교시 <br> (9:00~9:50) </td>`;
              html += `<td id="x`+x+`y2"> 수업 등록 X </td>`;
              html += `<td id="x`+x+`y3"> 수업 등록 X </td>`;
              html += `<td id="x`+x+`y4"> 수업 등록 X </td>`;
              html += `<td id="x`+x+`y5"> 수업 등록 X </td>`;
              html += `<td id="x`+x+`y6"> 수업 등록 X </td>`;
              html += `<td id="x`+x+`y7"> 수업 등록 X </td>`;
            }
            html += "</tr>";
            x++;
          }
          document.getElementById('table').innerHTML = html;
        }else{
          var min = sc[0][1]; //최소 수업시간
          var max = sc[0][1]; //최대 수업시간
          for(i=0;i<sc.length;i++){
            if(min>sc[i][1]){
              min = sc[i][1];
            }
            if(max<sc[i][1]){
              max = sc[i][1];
            }
          }
          var max_order = max - min + 2;
          var x = 0;
          var time = 9;
          for(i=max_order;i>0;i--){
            html += "<tr>";
            if(i==max_order){
              html += `<td>시간</td>`;
              html += `<td>월요일</td>`;
              html += `<td>화요일</td>`;
              html += `<td>수요일</td>`;
              html += `<td>목요일</td>`;
              html += `<td>금요일</td>`;
              html += `<td>토요일</td>`;
            }else{
              html += `<td id="x`+x+`y1"> `+ min++ +`교시</br>(`+ time +`:00 ~ `+ time++ +`:50 ) </td>`;
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
          min = min-2;
          document.getElementById('table').innerHTML = html;

          for(var i=0; i<sc.length; i++){
            var x = sc[i][1]-min+1;
            var y = parseInt(sc[i][0])+1;

            var id = '#x'+x+'y'+y;
            $(id).html(sc[i][2]);
          }
        }
      }
    });
}
