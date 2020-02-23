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
        var sc = JSON.parse(schedule);
        console.log(sc);
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
        console.log(min);
        var max_order = max - min + 2;
        var html ="";
        document.getElementById('table').innerHTML = html;
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
            html += `<td id="x`+x+`y2"> - </td>`;
            html += `<td id="x`+x+`y3"> - </td>`;
            html += `<td id="x`+x+`y4"> - </td>`;
            html += `<td id="x`+x+`y5"> - </td>`;
            html += `<td id="x`+x+`y6"> - </td>`;
            html += `<td id="x`+x+`y7"> - </td>`;
          }
          html += "</tr>";
          x++;
        }
        min = min-2;
        console.log(html);
        document.getElementById('table').innerHTML = html;

        for(i=0;i<sc.length;i++){
          console.log(sc[i][1],min,sc[i][1]-min+1);
        }

        for(var i=0; i<sc.length; i++){
            var x = sc[i][1]-min+1;
            var y = sc[i][0]+1;

            var id = '#x'+x+'y'+y;
            console.log(id);
            $(id).html(sc[i][2]);
        }

      }
    });
}
