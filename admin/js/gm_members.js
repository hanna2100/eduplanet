var formsForUpdate = new Array();
var url;

$(function(){
    // if(!search)
    //     url = "/eduplanet/admin/gm_members.php?y="+y+"&m="+m;
    // else
    //     url = "/eduplanet/admin/gm_members.php?y="+y+"&m="+m+"&col="+col+"&search="+search;

    url = "/eduplanet/admin/gm_members.php?y="+y+"&m="+m;

    $('.date_field').datepicker({
        dateFormat: 'yy-mm-dd',
        minDate: -0,
        maxDate: "+1Y",
        beforeShow: function() {
            setTimeout(function(){
                $('.ui-datepicker').css('z-index', 99999999999999);
            }, 0);
        }
    });
    
    importJoinData();
    importAgeData();
    importPrimiumData();
    importIntresData();

    listItemPicker();

    
});


function listItemPicker(){
    $('.list_row').click(function(){

        //다중 클릭시 폼배열에 중복으로 쌓이는 것 방지
        if($(this).css('background-color')=='rgb(142, 196, 240)'){
            return;
        }

        $(this).css('background-color' , '#8ec4f0a9');
        $(this).children('form').children('.col4').children('input').prop('disabled',false);
        $(this).children('form').children('.col5').children('input').prop('disabled',false);
        $(this).children('form').children('.col8').children('input').prop('disabled',false);

        formsForUpdate.push($(this).children('form'));
    });
}

function submitUpdate(){   

    var conf = confirm('회원 데이터를 수정하시겠습니까?');

    if(conf){
        var serialize ='';

        for(var i in formsForUpdate){
            serialize += formsForUpdate[i].serialize() + "&";
        }

        serialize = serialize.slice(0,-1);
        console.log(serialize);
        $.ajax({
            type: "post",
            data: serialize,
            url : "./lib/gm_members_update.php",
            success : function(data){
                if(data==1){
                    location.href=url+'&page='+page;
                }else{
                    alert('오류발생: '+data);
                }
            },
            error : function(){
                alert("시스템에러");
            }
        });
    }
}

function submitDelete(){

    var conf = confirm('회원 데이터를 삭제하시겠습니까?');

    if(conf){
        var serialize ='';

        for(var i in formsForUpdate){
            serialize += formsForUpdate[i].serialize() + "&";
        }

        serialize = serialize.slice(0,-1);
        console.log(serialize);
        $.ajax({
            type: "post",
            data: serialize,
            url : "./lib/gm_members_delete.php",
            success : function(data){
                if(data==1){
                    location.href=url+'&page='+page;
                }else{
                    alert('오류발생: '+data);
                }
            },
            error : function(){
                alert("시스템에러");
            }
        });
    }
    
}

function limitMaxLength(e){
    if(e.value.length> e.maxLength){
        e.value = e.value.slice(0, e.maxLength);
    }
}

function onclickSearch(){

    var col = $('#search_select option:selected').val();
    var search = $('.form-control').val();

    if(col=="회원번호"){
        col="no";
    }else if(col=="아이디"){
        col="id";
    }else if(col=="연락처"){
        col="phone";
    }else if(col=="출생년도"){
        col="age";
    }else if(col=="관심사"){
        col="intres";
    }else if(col=="유료만료일"){
        col="expiry_day";
    }else if(col=="가입일"){
        col="regist_day";
    }

    if(!search){
        alert('검색어를 입력해주세요');
    }else{
        location.replace(url+"&col="+col+"&search="+search);
    }
}


function importJoinData(){

    $.ajax({
        url : "/eduplanet/admin/lib/gm_members_graph.php",
        type : "post",
        dataType: "json",
        data: { y: y,
            y2: y,
            m: m,
            m2: m},
        success : function(data) {
            console.log(data[0]);
            console.log(data[1]);

            var join_arr = data[0];
            var wthdr_arr = data[1];

            var sbtr_arr = new Array();
            for(i = 0; i<join_arr.length ; i++){
                sbtr_arr[i] = join_arr[i]-wthdr_arr[i];
            }

            g_membersGraph(join_arr,wthdr_arr,sbtr_arr);

            //이번달 가입회원수 구하기
            var join_sum = 0;
            for (var i=0; i < join_arr.length; i++ ) {
                join_sum += parseInt(join_arr[i]);
            }
            //이번달 탈퇴회원수 구하기
            var wthdr_sum = 0;
            for (var i=0; i < wthdr_arr.length; i++ ) {
                wthdr_sum += parseInt(wthdr_arr[i]);
            }

            $('#join_m').text(join_sum);
            $('#wthdr_m').text(wthdr_sum);

        },
        error : function() {
          console.log("회원그래프 가져오기 ajax 실패");
          }
    });
}


function g_membersGraph(join, wthdr, sbtr){

    var ctx = document.getElementById('g_members_totalGraph').getContext('2d');
    ctx.canvas.width = 880;
    ctx.canvas.height = 310;
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'bar',

        // The data for our dataset
        data: {
            labels: dayArray(y,m),
            datasets: [{
                label: '신규회원',
                backgroundColor: 'rgb(255, 51, 51, 0.2)',
                borderColor: 'rgb(255, 51, 51, 0.2)',
                pointHoverBackgroundColor:'rgb(255, 51, 51, 0.2)',
                data: join,
                pointRadius: 1,
                pointHitRadius: 10,
                tension: 0.1,
                fill: false,
                borderWidth: 1,
                order: 2
            },{
                label: '탈퇴회원',
                backgroundColor: 'rgb(128, 128, 128, 0.2)',
                borderColor: 'rgb(128, 128, 128, 0.2)',
                pointHoverBackgroundColor: 'rgb(128, 128, 128, 0.2)',
                data: wthdr,
                pointRadius: 1,
                pointHitRadius: 10,
                tension: 0.1,
                fill: false,
                borderWidth: 1,
                order: 3
            },{
                label: '순 증가회원 수',
                backgroundColor: red,
                borderColor: red,
                pointHoverBackgroundColor: red,
                data: sbtr,
                pointRadius: 1,
                pointHitRadius: 10,
                tension: 0,
                fill: false,
                borderWidth: 2,
                type: 'line',
                order: 1
            }]
        },

        // Configuration options go here
        options: {
            responsive: false,
            maintainAspectRatio: false,
            legend: {
				display:false
            },
            scales: {
                xAxes: [{
                    stacked: true,
                }],
                yAxes: [{
                    stacked: true
                }]
            }
        }
    });
}


function dash_age_range(child, elmnt, middle, high, adult){
    var ctx = document.getElementById('dash_age_range').getContext('2d');
    ctx.canvas.width = 240;
    ctx.canvas.height = 160;
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'doughnut',

        // The data for our dataset
        data: {
            datasets: [{
                backgroundColor: [yellow, orange, green, blue, red],
                borderColor:  [yellow, orange, green, blue, red],
                data: [child,elmnt,middle,high,adult],
                borderWidth: 1
            }],
            labels: ['아동', '초등', '중등', '고등', '성인'
            ]
        },

        options: {
            responsive: false,
            maintainAspectRatio: false,
            legend: {
				display:false
            },
            scales: { //X,Y축 옵션
                display:false
            }
        }
    });
}


function dash_pm_ratio(none, primium){
    var ctx = document.getElementById('dash_pm_ratio').getContext('2d');
    ctx.canvas.width = 240;
    ctx.canvas.height = 160;
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'doughnut',

        // The data for our dataset
        data: {
            datasets: [{
                backgroundColor: [purple, grey],
                borderColor:  [purple, grey],
                data: [primium,none],
                borderWidth: 1
            }],
            labels: ['프리미엄', '일반'
            ]
        },

        options: {
            responsive: false,
            maintainAspectRatio: false,
            legend: {
				display:false
            },
            scales: { //X,Y축 옵션
                display:false
            }
        }
    });
}



function importAgeData(){

    $.ajax({
        url : "/eduplanet/admin/lib/gm_members_age_graph.php",
        type : "post",
        dataType: "json",
        data: { y: y,
                m: m,
                mode: "DATE"},
        success : function(data) {
            dash_age_range(data[0], data[1], data[2], data[3], data[4]);

        },
        error : function() {
          console.log("나이그래프 가져오기 ajax 실패");
          }
    });
}

function importPrimiumData(){

    $.ajax({
        url : "/eduplanet/admin/lib/gm_members_primium_graph.php",
        type : "post",
        dataType: "json",
        data: { y: y,
                m: m},
        success : function(data) {
            dash_pm_ratio(data[0], data[1]);

        },
        error : function() {
          console.log("프리미엄그래프 가져오기 ajax 실패");
          }
    });
}

function importIntresData(){

    $.ajax({
        url : "/eduplanet/admin/lib/gm_members_intres_graph.php",
        type : "post",
        dataType: "json",
        data: { y: y,
                m: m,
                mode: "DATE"},
        success : function(data) {

            if(data[0][0]==null)
                return;

            var temp = data[1][i];
            var rank = 0;
            for(var i =0; i<5; i++){

                if(data[1][i]==temp){
                    document.getElementsByClassName('dasn_intres_label')[i].innerHTML = rank;
                }else{
                    document.getElementsByClassName('dasn_intres_label')[i].innerHTML = ++rank;
                }
                if(data[0][i]==null){
                    document.getElementsByClassName('dasn_intres_data')[i].innerHTML = '-';
                    document.getElementsByClassName('dasn_intres_label')[i].innerHTML = '-';
                }else{
                    document.getElementsByClassName('dasn_intres_data')[i].innerHTML =data[0][i]+'<span>('+data[1][i]+')</span>';

                }

                temp = data[1][i];
            }

        },
        error : function() {
          console.log("프리미엄그래프 가져오기 ajax 실패");
          }
    });
}