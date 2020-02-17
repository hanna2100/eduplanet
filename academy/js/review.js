$(function(){
  // 전체 리뷰 별
  $rate_total_star = Math.floor(document.getElementById("rate_point").innerHTML);
  for(var i=1;i<=$rate_total_star;i++){
   $(".rate_star_ty1 span:nth-child("+i+")").addClass("checked");
  }



});

anychart.onDocumentReady(function () {
      // //radar
    var data_radar = [
      {x: "가성비", value: $rate_bar_cost_efct},
      {x: "강사", value: $rate_bar_teacher},
      {x: "시설", value: $rate_bar_facility},
      {x: "접근성", value: $rate_bar_acsbl},
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

    // word cloud
    var data_word_cloud = [
      {"x": "Mandarin chinese", "value": 1090000000, category: "Sino-Tibetan"},
      {"x": "English", "value": 983000000, category: "Indo-European"},
      {"x": "Hindustani", "value": 544000000, category: "Indo-European"},
      {"x": "Spanish", "value": 527000000, category: "Indo-European"},
      {"x": "Arabic", "value": 422000000, category: "Afro-Asiatic"},
      {"x": "Malay", "value": 281000000, category: "Austronesian"},
      {"x": "Russian", "value": 267000000, category: "Indo-European"},
      {"x": "Bengali", "value": 261000000, category: "Indo-European"},
      {"x": "Portuguese", "value": 229000000, category: "Indo-European"},
      {"x": "French", "value": 229000000, category: "Indo-European"},
      {"x": "Hausa", "value": 150000000, category: "Afro-Asiatic"},
      {"x": "Punjabi", "value": 148000000, category: "Indo-European"},
      {"x": "Japanese", "value": 129000000, category: "Japonic"},
      {"x": "German", "value": 129000000, category: "Indo-European"},
      {"x": "Persian", "value": 121000000, category: "Indo-European"}
    ];
   // create a tag (word) cloud chart
    var chart = anychart.tagCloud(data_word_cloud);
     // set a chart title
    chart.title('15 most spoken languages')
    // set an array of angles at which the words will be laid out
    chart.angles([0])
    // enable a color range
    chart.colorRange(true);
    // set the color range length
    chart.colorRange().length('80%');
    // display the word cloud chart
    chart.container("container");
    chart.draw();
});
