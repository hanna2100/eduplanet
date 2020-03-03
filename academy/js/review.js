$(function(){
  getWordCloudData();
});


anychart.onDocumentReady(function () {
  // //radar
var data_radar = [
  {x: "수강료만족도", value: $rate_bar_cost_efct},
  {x: "강사", value: $rate_bar_teacher},
  {x: "시설", value: $rate_bar_facility},
  {x: "교통편의성", value: $rate_bar_acsbl},
  {x: "학업성취도", value: $rate_bar_achievement}
];
// create a chart
chart = anychart.radar();
// create the first series (line) and set the data
var series1 = chart.line(data_radar);
// set the container id
chart.container("radarChart");
// initiate drawing the chart
chart.draw();

});

function getWordCloudData(){

  $.ajax({
    type: "post",
    data: {no: get_no},
    datatype: 'json',
    url : "/eduplanet/lib/get_wordcloud_api.php",
    success : function(data){
      data = JSON.parse(data);

        $not_found_keyword = $('#not_found_keyword');
        if(data=='not_found_no'){//학원 넘버가 없을때
          $not_found_keyword.text('학원번호가 올바르지 않습니다');
          $not_found_keyword.css('display', 'block');
        }else if(data=='no_data'){
          $not_found_keyword.text('작성된 리뷰가 없습니다');
          $not_found_keyword.css('display', 'block');
        }else{

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

          $("#good_key").jQCloud(good_array);
          $("#bad_key").jQCloud(bad_array);

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