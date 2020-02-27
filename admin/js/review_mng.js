var formsForUpdate = new Array();
var url;

$(function(){
  
    url = "/eduplanet/admin/review_mng.php?y="+y+"&m="+m;
    
    importReviewData();
    listItemPicker();

});


function listItemPicker(){
    $('.list_row').click(function(){

        //다중 클릭시 폼배열에 중복으로 쌓이는 것 방지
        if($(this).css('background-color')=='rgb(142, 196, 240)'){
            return;
        }
        $(this).css('background-color' , '#8ec4f0a9');
        formsForUpdate.push($(this).children('form'));
    });
}

function submitDelete(){

    var conf = confirm('선택한 리뷰 데이터를 삭제하시겠습니까?');

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
            url : "./lib/review_delete.php",
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

function onclickSearch(){

    var col = $('#search_select option:selected').val();
    var search = $('.form-control').val();

    if(col=="학원이름"){
        col="acd_name";
    }else if(col=="글쓴이"){
        col="id";
    }else if(col=="한줄평"){
        col="one_line";
    }else if(col=="평균평점"){
        col="avg";
    }else if(col=="등록일"){
        col="regist_day";
    }

    if(!search){
        alert('검색어를 입력해주세요');
    }else{
        location.replace(url+"&col="+col+"&search="+search);
    }
}


function importReviewData(){

    $.ajax({
        url : "/eduplanet/admin/lib/get_review_month_data.php",
        type : "post",
        dataType: "json",
        data: { y: y,
            m: m},
        success : function(data) {
            console.log(data);
            review_totalGraph(data);
            var avg  = 0;
            for(var i=0; i<data.length; i++){
                avg += parseInt(data[i]);
            }
            $('#new_review_cnt').text(avg);

        },
        error : function() {
          console.log("리뷰그래프 가져오기 ajax 실패");
          }
    });
}


function review_totalGraph(review_cnt){

    var ctx = document.getElementById('review_totalGraph').getContext('2d');
    ctx.canvas.width = 880;
    ctx.canvas.height = 310;
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'bar',

        // The data for our dataset
        data: {
            labels: dayArray(y,m),
            datasets: [{
                label: '리뷰 등록 수',
                backgroundColor: yellow,
                borderColor:yellow,
                pointHoverBackgroundColor: yellow,
                data: review_cnt,
                pointRadius: 1,
                pointHitRadius: 10,
                tension: 0.2,
                fill: false,
                borderWidth: 1,
                order: 2
            }]
        },

        // Configuration options go here
        options: {
            responsive: false,
            maintainAspectRatio: false,
            legend: {
				display:false
            }
        }
    });
}
