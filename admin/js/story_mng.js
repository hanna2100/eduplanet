var formsForUpdate = new Array();
var url;

$(function(){
  
    url = "/eduplanet/admin/story_mng.php?y="+y+"&m="+m;
    
    importStoryData();

});

function submitDelete(){

    var conf = confirm('선택한 스토리 데이터를 삭제하시겠습니까?');

    if(conf){
        var formsForUpdate = new Array();

        $("input:checkbox[name='no[]']").each(function() {
            if($(this).is(":checked") == true) {//체크되어있으면
                formsForUpdate.push($(this).closest("form")); //해당 폼 객체를 배열에 저장
            }
        });

        var serialize ='';

        for(var i in formsForUpdate){
            serialize += formsForUpdate[i].serialize() + "&";
        }

        serialize = serialize.slice(0,-1);
        console.log(serialize);
        $.ajax({
            type: "post",
            data: serialize,
            url : "./lib/story_delete.php",
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
    }else if(col=="제목"){
        col="title";
    }else if(col=="부제목"){
        col="subtitle";
    }else if(col=="등록일"){
        col="regist_day";
    }

    if(!search){
        alert('검색어를 입력해주세요');
    }else{
        location.replace(url+"&col="+col+"&search="+search);
    }
}


function importStoryData(){

    $.ajax({
        url : "/eduplanet/admin/lib/get_story_month_data.php",
        type : "post",
        dataType: "json",
        data: { y: y,
            m: m},
        success : function(data) {
            console.log(data);
            story_totalGraph(data);
            var avg  = 0;
            for(var i=0; i<data.length; i++){
                avg += parseInt(data[i]);
            }
            $('#new_story').text(avg);

        },
        error : function() {
          console.log("스토리그래프 가져오기 ajax 실패");
          }
    });
}


function story_totalGraph(review_cnt){

    var ctx = document.getElementById('story_graph').getContext('2d');
    ctx.canvas.width = 880;
    ctx.canvas.height = 310;
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'bar',

        // The data for our dataset
        data: {
            labels: dayArray(y,m),
            datasets: [{
                label: '스토리 등록 수',
                backgroundColor: green,
                borderColor:green,
                pointHoverBackgroundColor: green,
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
