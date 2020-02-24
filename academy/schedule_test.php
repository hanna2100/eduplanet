<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
    <title>Document</title>
    <script>

        $(document).ready(function(){
        //찍고 싶은 시간표
        //월 9, 10, 11시
        //화 13, 14시
        //금 12, 14시

        var array = [[1,9],[1,10],[1,11],[2,13],[2,14],[5,12],[5,14]];

        var min_time = array[0][1];
        var max_time = array[0][1];

        for(var i=0; i<array.length; i++){
            if(min_time>array[i][1]){
                min_time = array[i][1];
            }else if(max_time<array[i][1]){
                max_time = array[i][1];
            }

        }

        console.log(min_time + ", "+max_time);

        var tr_max = max_time - min_time +2 ; //행 - 1행은 월~금, 총 행은 14-9+2 줄
        var td_max = 7; //렬 - 1열은 시간나와야함 시간+월~금 총 6열
        var html = "";
        var x = 0; //시간표 x좌표
        var time = min_time; //시간표 맨 첫타임
        for(var i=tr_max ; i > 0 ; i--){
            html += "<tr>";
            if(i==tr_max){ // 1행일경우 , for문 첫 루프
                html += `<td>시간</td>`;
                html += `<td>월</td>`;
                html += `<td>화</td>`;
                html += `<td>수</td>`;
                html += `<td>목</td>`;
                html += `<td>금</td>`;
            }else{ // for문 2행~끝행일경우
                html += `<td id="x${x}y1"> ${time++} </td>`;
                html += `<td id="x${x}y2"> - </td>`;
                html += `<td id="x${x}y3"> - </td>`;
                html += `<td id="x${x}y4"> - </td>`;
                html += `<td id="x${x}y5"> - </td>`;
                html += `<td id="x${x}y6"> - </td>`;
            }
            html += "</tr>";
            x++;
        }
        document.getElementById('table').innerHTML = html;

        //var array = [[1,9],[1,10],[1,11],[2,13],[2,14],[5,12],[5,14]];
        var array2 = ["수학","수학","영어","영어","국어","국어","사회"];


        for(var i=0; i<array.length; i++){
            var x = array[i][1]-min_time+1;
            var y = array[i][0]+1;

            var id = '#x'+x+'y'+y;
            console.log(id);
            $(id).html(array2[i]);
        }

        });

    </script>
    <style>
        table{
            border: 1px solid black;
        }
        tr{
            border: 1px solid black;
        }
        td{
            border: 1px solid black;
        }
    </style>
</head>
<body>
    <table id="table">

    </table>
</body>
</html>
