var formsForUpdate = new Array();
var url;

$(function(){
  
    url = "/eduplanet/admin/review_mng.php?y="+y+"&m="+m;
    
    importReviewData();
    listItemPicker();
    getWordCloudData();
});


function getWordCloudData(){

    $.ajax({
      type: "post",
      data: { mode: 'admin', 
            year: y,
            month: m},
      datatype: 'json',
      url : "/eduplanet/lib/get_wordcloud_api.php",
      success : function(data){
        data = data.trim();
  
        $not_found_keyword1 = $('#not_found_keyword1');
        $not_found_keyword2 = $('#not_found_keyword2');
        $good_key = $("#good_key");
        $bad_key = $("#bad_key");
        if(data=='not_found'){
          $not_found_keyword1.text('[Request error] 요청값이 올바르지 않습니다');
          $not_found_keyword2.text('[Request error] 요청값이 올바르지 않습니다');
          $not_found_keyword1.css('display', 'block');
          $not_found_keyword2.css('display', 'block');
          $good_key.css('display', 'none');
          $bad_key.css('display', 'none');
        }else if(data=='no_data'){
          $not_found_keyword1.text('작성된 리뷰가 없습니다');
          $not_found_keyword2.text('작성된 리뷰가 없습니다');
          $not_found_keyword1.css('display', 'block');
          $not_found_keyword2.css('display', 'block');
          $good_key.css('display', 'none');
          $bad_key.css('display', 'none');

          }else{
            data = JSON.parse(data);
  
            var good = data[0]; //장점키워드
            var bad = data[1]; //단점키워드
  
            var good_array = [];
            var bad_array = [];
            var blue_colors = ['#2E64FE', '#0080FF', '#2E9AFE', '#58ACFA'];
            var red_colors = ['#F78181', '#FA5858', '#FE642E', '#FA8258'];
  
            var length = good.length>20? 20 : good.length;
            for(var i=0; i<length; i++){
              good_array.push({text: good[i][0], weight: good[i][1], color: randomItem(blue_colors)});
            }
  
            length = bad.length>20? 20 : bad.length;
            for(var i=0; i<length; i++){
              bad_array.push({text: bad[i][0], weight: bad[i][1], color: randomItem(red_colors)});
            }
            console.log(bad_array);
            
            $good_key.jQCloud(good_array);
            $bad_key.jQCloud(bad_array);
  
          }
      },
      error : function(){
          alert("시스템에러");
      }
    });
  }
  function randomItem(a) {
    return a[Math.floor(Math.random() * a.length)];
  }

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
