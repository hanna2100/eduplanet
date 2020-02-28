
$(function(){
    // 대시보드 그래프설정
    importMembersData();
    getStorySixMonthData();
    getReviewSixMonthData();
    salesGraph();


});


function importMembersData(){

    var year = y;
    var year2 = y;
    var month = m;
    var month2 = m;

    if(month2<=5){
        month = m+7;
        year = y-1;
    }else{
        month = month2-5;
    }

    $.ajax({
        url : "/eduplanet/admin/lib/gm_members_graph.php",
        type : "post",
        dataType: "json",
        data: { y: year,
                m: month,
                y2: year2,
                m2: month2},
        success : function(data) {

            // console.log(data[0]); //data[0] 회원가입수 6개월동안의 데이터
            // console.log(data[1]); //data[1] 탈퇴수 6개월동안의 데이터

            //전년도 마지막날짜 달력
            var lastDate1 = new Array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
            //현재년도 마지막날짜 달력
            var lastDate2 = new Array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);

            //윤년계산
            if((year%4 === 0 && year%100 !== 0) || year%400 === 0 )
                lastDate1[1] = 29;
            if((year2%4 === 0 && year2%100 !== 0) || year2%400 === 0 )
                lastDate2[1] = 29;

            //달력 붙이기
            var lastDate = lastDate1.concat(lastDate2);

            //시작년도 끝년도가 다르면 전년도 달력에서부터 lastDate인덱스시작
            var index;
            if(year!=year2){ 
                index = month-1;
            }else{
                index = 6+month2;
            }

            var total_join_arr = [];
            var i=0; //전체 배열 하나씩 돌리려고
            while(data[0].length>0){
                var arr = [];
                for(var j = 0; j<lastDate[index]; j++){
                    if(data[0][0]!=undefined){
                        arr.push(data[0][0]); //원본배열 맨 앞에있는것만 넣어줌
                        data[0].shift(); //원본배열 앞에서부터 하나씩 삭제함
                    }
                }
                total_join_arr[i] = arr;
                i++;
                index++;
            }

            //인덱스 초기화
            if(year!=year2){ 
                index = month-1;
            }else{
                index = 6+month2;
            }

            var total_wthdr_arr = []; //탈퇴회원
            i=0; //전체 배열 하나씩 돌리려고
            while(data[1].length>0){
                var arr = [];
                for(var j = 0; j<lastDate[index]; j++){
                    if(data[1][0]!=undefined){
                        arr.push(data[1][0]); //원본배열 맨 앞에있는것만 넣어줌
                        data[1].shift(); //원본배열 앞에서부터 하나씩 삭제함
                    }
                }
                total_wthdr_arr[i] = arr;
                i++;
                index++;
            }

            //가입회원수 구하기
            var total_join_sum = [];
            var no = 0;
            for(var i = 0; i<total_join_arr.length; i++){
                var sum = 0;
                for (var j=0; j < total_join_arr[i].length; j++ ) {
                    sum += parseInt(total_join_arr[i][j]);
                }

                total_join_sum[no] = sum;
                no++;
            }

            //탈퇴회원수 구하기
            var total_wthdr_sum = [];
            no = 0;
            for(var i = 0; i<total_wthdr_arr.length; i++){
                var sum = 0;
                for (var j=0; j < total_wthdr_arr[i].length; j++ ) {
                    sum += parseInt(total_wthdr_arr[i][j]);
                }
                total_wthdr_sum[no] = sum;
                no++;
            }


            var increase = (total_join_sum[5]) - (total_wthdr_sum[5]);

            //console.log(total_join_sum);

            $('#increse_gm').text(increase);

           getAcdMemberData(total_join_sum);

        },
        error : function() {
          console.log("회원그래프 가져오기1 ajax 실패");
          }
    });
}


function getAcdMemberData(gm_in){
    var year = y;
    var year2 = y;
    var month = m;
    var month2 = m;

    if(month2<=5){
        month = m+7;
        year = y-1;
    }else{
        month = m-5;
    }

    $.ajax({
        url : "/eduplanet/admin/lib/am_members_graph.php",
        type : "post",
        dataType: "json",
        data: { y: year,
                m: month,
                y2: year2,
                m2: month2},
        success : function(data) {

            // console.log(data[0]); //data[0] 회원가입수 6개월동안의 데이터
            // console.log(data[1]); //data[1] 탈퇴수 6개월동안의 데이터

            //전년도 마지막날짜 달력
            var lastDate1 = new Array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
            //현재년도 마지막날짜 달력
            var lastDate2 = new Array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
            var monthName = new Array('1월', '2월', '3월', '4월', '5월', '6월', '7월'
            , '8월', '9월', '10월', '11월', '12월','1월', '2월', '3월', '4월', '5월', '6월', '7월'
            , '8월', '9월', '10월', '11월', '12월');
            
            //윤년계산
            if((year%4 === 0 && year%100 !== 0) || year%400 === 0 )
                lastDate1[1] = 29;
            if((year2%4 === 0 && year2%100 !== 0) || year2%400 === 0 )
                lastDate2[1] = 29;

            //달력 붙이기
            var lastDate = lastDate1.concat(lastDate2);

            //시작년도 끝년도가 다르면 전년도 달력에서부터 인덱스시작
            var index;
            if(year!=year2){ 
                index = month-1;
            }else{
                index = 6+month2;
            }

            monthName = monthName.slice(index, index+6);

            var total_arr = [];
            $i=0; //전체 배열 하나씩 돌리려고
            while(data[0].length>0){
                var arr = [];
                for(var j = 0; j<lastDate[index]; j++){
                    if(data[0][0]!=undefined){
                        arr.push(data[0][0]); //원본배열 맨 앞에있는것만 넣어줌
                        data[0].shift(); //원본배열 앞에서부터 하나씩 삭제함
                    }
                }
                total_arr[$i] = arr;
                $i++;
                index++;
            }

            //인덱스 초기화
            if(year!=year2){ 
                index = month-1;
            }else{
                index = 6+month2;
            }

            var total_arr2 = []; //탈퇴회원
            $i=0; //전체 배열 하나씩 돌리려고
            while(data[1].length>0){
                var arr = [];
                for(var j = 0; j<lastDate[index]; j++){
                    if(data[1][0]!=undefined){
                        arr.push(data[1][0]); //원본배열 맨 앞에있는것만 넣어줌
                        data[1].shift(); //원본배열 앞에서부터 하나씩 삭제함
                    }
                }
                total_arr2[$i] = arr;
                $i++;
                index++;
            }

            //가입회원수 구하기
            var total_join_sum = [];
            var no = 0;
            for(var i = 0; i<total_arr.length; i++){
                var sum = 0;
                for (var j=0; j < total_arr[i].length; j++ ) {
                    sum += parseInt(total_arr[i][j]);
                }
               // console.log(sum);
                total_join_sum[no] = sum;
                no++;
            }

            //탈퇴회원수 구하기
            var total_wthdr_sum = [];
            no = 0;
            for(var i = 0; i<total_arr2.length; i++){
                var sum = 0;
                for (var j=0; j < total_arr2[i].length; j++ ) {
                    sum += parseInt(total_arr2[i][j]);
                }
                total_wthdr_sum[no] = sum;
                no++;
            }

            // console.log(total_join_sum+','+total_wthdr_sum);

            var increase = total_join_sum[5]-total_wthdr_sum[5]

            $('#increse_am').text(increase);
            membersGraph(monthName, gm_in, total_join_sum);

        },
        error : function() {
          console.log("회원그래프 가져오기2 ajax 실패");
          }
    });
}



function getStorySixMonthData(){

    $.ajax({
        url : "/eduplanet/admin/lib/get_story_sixmonth_data.php",
        type : "post",
        dataType: "json",
        data: { y: y,
                m: m},
        success : function(data) {

            //월 배열
            var month_arr = data[0];
            //스토리 갯수 배열
            var story_cnt = data[1];

            var increase = story_cnt[story_cnt.length-1]

            $('#increse_story').text(increase);
            storyGraph(month_arr, story_cnt);

        },
        error : function() {
          console.log("스토리 그래프 ajax 실패");
          }
    });
}

function storyGraph(month_arr, story_cnt){

    // console.log(gm_in);
    // console.log(am_in);
    var ctx = document.getElementById('dash_postGraph').getContext('2d');
    ctx.canvas.width = 240;
    ctx.canvas.height = 160;
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'bar',

        // The data for our dataset
        data: {
            labels: month_arr,
            datasets: [{
                label: '학원스토리 등록 수',
                backgroundColor: green,
                borderColor: green,
                pointHoverBackgroundColor: green,
                data: story_cnt,
                pointRadius: 1,
                pointHitRadius: 10,
                tension: 0.2,
                fill: false,
                borderWidth: 1
            }]
        },

        // Configuration options go here
        options: {
            responsive: false,
            maintainAspectRatio: false,
            legend: {
				display:false
            },
            scales: { //X,Y축 옵션
                yAxes: [{
                    ticks: {
                        beginAtZero:true  //Y축의 값이 0부터 시작
                    }
                }]
            }
        }
    });
}


function getReviewSixMonthData(){

    $.ajax({
        url : "/eduplanet/admin/lib/get_review_sixmonth_data.php",
        type : "post",
        dataType: "json",
        data: { y: y,
                m: m},
        success : function(data) {

            //월 배열
            var month_arr = data[0];
            //스토리 갯수 배열
            var review_cnt = data[1];

            var increase = review_cnt[review_cnt.length-1]

            $('#increse_review').text(increase);

            console.log(month_arr, review_cnt);
            reviewGraph(month_arr, review_cnt);

        },
        error : function() {
          console.log("리뷰 그래프 ajax 실패");
          }
    });
}

function reviewGraph(month_arr, review_cnt){

    console.log(month_arr);
    console.log(review_cnt);
    var ctx = document.getElementById('dash_reviewGraph').getContext('2d');
    ctx.canvas.width = 240;
    ctx.canvas.height = 160;
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'bar',

        // The data for our dataset
        data: {
            labels: month_arr,
            datasets: [{
                label: '리뷰 등록 수',
                backgroundColor: yellow,
                borderColor: yellow,
                pointHoverBackgroundColor: yellow,
                data: review_cnt,
                pointRadius: 1,
                pointHitRadius: 10,
                tension: 0.2,
                fill: false,
                borderWidth: 1
            }]
        },

        // Configuration options go here
        options: {
            responsive: false,
            maintainAspectRatio: false,
            legend: {
				display:false
            },
            scales: { //X,Y축 옵션
                yAxes: [{
                    ticks: {
                        beginAtZero:true  //Y축의 값이 0부터 시작
                    }
                }]
            }
        }
    });
}

function membersGraph(lbl, gm_in, am_in){

    // console.log(gm_in);
    // console.log(am_in);
    var ctx = document.getElementById('dash_membersGraph').getContext('2d');
    ctx.canvas.width = 240;
    ctx.canvas.height = 160;
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'bar',

        // The data for our dataset
        data: {
            labels: lbl,
            datasets: [{
                label: '일반회원 신규가입',
                backgroundColor: red,
                borderColor: red,
                pointHoverBackgroundColor: red,
                data: gm_in,
                pointRadius: 1,
                pointHitRadius: 10,
                tension: 0.2,
                fill: false,
                borderWidth: 1
            },{
                label: '사업자회원 신규가입',
                backgroundColor: blue,
                borderColor: blue,
                pointHoverBackgroundColor: blue,
                data: am_in,
                pointRadius: 1,
                pointHitRadius: 10,
                tension: 0.2,
                fill: false,
                borderWidth: 1
            }]
        },

        // Configuration options go here
        options: {
            responsive: false,
            maintainAspectRatio: false,
            legend: {
				display:false
            },
            scales: { //X,Y축 옵션
                yAxes: [{
                    ticks: {
                        beginAtZero:true  //Y축의 값이 0부터 시작
                    }
                }]
            }
        }
    });
}

function salesGraph(){

    var ctx = document.getElementById('dash_salesGraph').getContext('2d');
    ctx.canvas.width = 880;
    ctx.canvas.height = 310;
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'line',

        // The data for our dataset
        data: {
            labels:month_arr,
            datasets: [{
                label: 'TOTAL',
                backgroundColor: grey,
                borderColor: grey,
                pointHoverBackgroundColor: grey,
                data:  total_sales,
                pointRadius: 1,
                pointHitRadius: 10,
                tension: 0.2,
                fill: false,
                borderWidth: 3
            },
            {
                label: '일반회원',
                backgroundColor: red,
                borderColor: red,
                pointHoverBackgroundColor: red,
                data: gm_sales,
                pointRadius: 1,
                pointHitRadius: 10,
                tension: 0.2,
                fill: false,
                borderWidth: 3
            },
            {
                label: '사업자회원',
                backgroundColor: blue,
                borderColor: blue,
                pointHoverBackgroundColor: blue,
                data: am_sales,
                pointRadius: 1,
                pointHitRadius: 10,
                tension: 0.2,
                fill: false,
                borderWidth: 3
            }]
        },

        // Configuration options go here
        options: {
            legend: {
                display: false,
				// labels: {
				// 	fontColor: '#1d1d1d',
                //     fontSize: 12,
                //     boxWidth: 7,
                //     usePointStyle: true
                // }
            },
            scales: { //X,Y축 옵션
                yAxes: [{
                    ticks: {
                        beginAtZero:true  //Y축의 값이 0부터 시작
                    }
                }]
            }
        }
    });
}




