var y;
var m;

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
    $('#top_select_year').val(y).prop("selected", true);
    $('#top_select_month').val(m).prop("selected", true);
});

var red= '#ff4d4d',
    orange= 'rgb(255, 159, 64)',
    yellow= '#ffcc00',
    green= 'rgb(75, 192, 192)',
    blue= '#0099ff',
    purple= 'rgb(153, 102, 255)',
    grey= 'rgb(201, 203, 207)';


function topSelect_init_Setting(name){
    var selectYear = document.getElementById('top_select_year');
    var selectMonth = document.getElementById('top_select_month');
    var slctYearVal = selectYear.options[selectYear.selectedIndex].value;
    var slctMonthVal = selectMonth.options[selectYear.selectedIndex].value;
    var nowYear = new Date().getFullYear();
    var nowMonth = new Date().getMonth();

    var monthOpt = "";
    if(slctYearVal<nowYear){
        while (selectMonth.hasChildNodes()){
            selectMonth.removeChild(selectMonth.firstChild);
        }
        for(var j= 1; j<=12; j++){
            monthOpt += '<option>'+j+'</option>';
        }
        $("#top_select_month").html(monthOpt);
    }else{
        while (selectMonth.hasChildNodes()){
            selectMonth.removeChild(selectMonth.firstChild);
        }
        for(var j= 1; j<=nowMonth+1; j++){
            monthOpt += '<option>'+j+'</option>';
        }
        $("#top_select_month").html(monthOpt);
    }

    location.href ='/eduplanet/admin/'+name+'.php?y='+slctYearVal+'&m='+1;
}


function hrefDateChange(name){
    var year = $('#top_select_year option:selected').val();
    var month = $('#top_select_month option:selected').val();

    location.href ='/eduplanet/admin/'+name+'.php?y='+year+'&m='+month;

}

function prevDateChange(name){
    var year = $('#top_select_year option:selected').val();
    var month = $('#top_select_month option:selected').val();

    if(year==2010&&month==1){
        return;
    }else if(month==1){
        //year = (year==2019)? 2019 : year-1;
        year--;
        month = 12;
    }else{
        month--;
    }

    location.href ='/eduplanet/admin/'+name+'.php?y='+year+'&m='+month;
}

function nextDateChange(name){
    var year = $('#top_select_year option:selected').val();
    var month = $('#top_select_month option:selected').val();

    if(year == new Date().getFullYear() && month == new Date().getMonth()+1){
        return;
    }else if(month==12){
        //year = (year==2019)? 2019 : year-1;
        year++;
        month = 1;
    }else{
        month++;
    }

    location.href ='/eduplanet/admin/'+name+'.php?y='+year+'&m='+month;
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

