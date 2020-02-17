$(function(){
    $('#navigation ul li.nav_menu>a').on('click', function(){
        //$(this).removeAttr('href');
        var element = $(this).parent('li');
        if (element.hasClass('open')) {
            element.removeClass('open');
            element.find('li').removeClass('open');
            element.find('ul').slideUp();
        }
        else {
            element.addClass('open');
            element.children('ul').slideDown();
            element.siblings('li').children('ul').slideUp();
            element.siblings('li').removeClass('open');
            element.siblings('li').find('li').removeClass('open');
            element.siblings('li').find('ul').slideUp();
        }
    });
    
    $('#navigation>ul>li.nav_menu>a').append('<span class="holder"></span>');
});

var red= 'rgb(255, 99, 132)',
    orange= 'rgb(255, 159, 64)',
    yellow= 'rgb(255, 205, 86)',
    green= 'rgb(75, 192, 192)',
    blue= 'rgb(54, 162, 235)',
    purple= 'rgb(153, 102, 255)',
    grey= 'rgb(201, 203, 207)';


function topSelect_init_Setting(){
    var selectYear = document.getElementById('top_select_year');
    var selectMonth = document.getElementById('top_select_month');
    var $selectYear = $('#top_select_year');
    var $selectMonth = $('#top_select_month');
    var nowYear = new Date().getFullYear();
    var nowMonth = new Date().getMonth();

    var yearValue = selectYear.value;

    //옵션 모두 지우기
    while (selectYear.hasChildNodes()){
        selectYear.removeChild(selectYear.firstChild);
    }
    while (selectMonth.hasChildNodes()){
        selectMonth.removeChild(selectMonth.firstChild);
    }

    var yearOpt = "";
    var monthOpt = "";

    if(yearValue != '' && yearValue != nowYear){ //작년 이하 년도 선택일 경우(12월까지 출력)

        for(var i = 2019; i<=nowYear ; i++){
            yearOpt += '<option>'+i+'</option>';
        }

        for(var j= 1; j<=12; j++){
            monthOpt += '<option>'+j+'</option>';
        }
        $selectYear.append(yearOpt);
        $selectMonth.append(monthOpt);

    }else{ //현재 년도 선택일 경우(현재 달까지만 출력)

        var yearOpt = "";
        for(var i = 2019; i<=nowYear ; i++){
            yearOpt += '<option>'+i+'</option>';
        }
    
        var monthOpt = "";
        for(var j= 1; j<=nowMonth+1; j++){
            monthOpt += '<option>'+j+'</option>';
        }
        
        $selectYear.append(yearOpt);
        $selectMonth.append(monthOpt);

        $selectYear.val(nowYear).prop("selected", true);
        $selectMonth.val(nowMonth+1).prop("selected", true);
    }
}

function dayArray(year, month){
    var maxDay = 0;
    var dayArray = new Array();

    switch(month){
        case 1: case 3: case 5: case 7: case 8: case 10: case 12:
            maxDay = 31;
            break;

        case 4: case 6: case 9: case 11:
            maxDay = 30;
            break;

        case 2:
            // 윤년 체크
	        if( year%4==0 && year%100!=0 || year%400==0 ) {
		        maxDay = 29;
	        }else{
                maxDay = 28;
            }
        break;
    }

    for(var i=1; i<=maxDay; i++){
        dayArray.push(String(i));
    }

    return dayArray;
}
