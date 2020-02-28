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

          for(i=max_order;i>0;i--){
            html += "<tr>";
            if(i==max_order){
              html += `<td class="sc_top"></td>`;
              html += `<td class="sc_top">월</td>`;
              html += `<td class="sc_top">화</td>`;
              html += `<td class="sc_top">수</td>`;
              html += `<td class="sc_top">목</td>`;
              html += `<td class="sc_top">금</td>`;
              html += `<td class="sc_top">토</td>`;
            }else{
              html += `<td class="sc_time" id="x`+x+`y1">`+ min +`:00 ~ `+ min++ +`:50 </td>`;
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



