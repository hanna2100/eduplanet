var red= 'rgb(255, 99, 132)',
orange= 'rgb(255, 159, 64)',
yellow= 'rgb(255, 205, 86)',
green= 'rgb(75, 192, 192)',
blue= 'rgb(54, 162, 235)',
purple= 'rgb(153, 102, 255)',
grey= 'rgb(201, 203, 207)';

$(function(){
    
    $('#navigation ul li.nav_menu>a').on('click', function(){
        $(this).removeAttr('href');
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

    //대시보드 년월설정
    topSelect_init_Setting();

    // 대시보드 그래프설정
    salesGraph();
    membersGraph();
    reviewGraph();
    postGraph();
    
});

function salesGraph(){
    var ctx = document.getElementById('dash_salesGraph').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'line',

        // The data for our dataset
        data: {
            labels: ['1월', '2월', '3월', '4월', '5월', '6월'],
            datasets: [{
                label: 'TOTAL',
                backgroundColor: grey,
                borderColor: grey,
                pointHoverBackgroundColor: grey,
                data: [1000, 800, 870, 820, 900, 990, 1200],
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
                data: [600, 400, 370, 620, 420, 590, 600],
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
                data: [400, 400, 500, 200, 480, 400, 600],
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

function membersGraph(){
    var ctx = document.getElementById('dash_membersGraph').getContext('2d');
    ctx.canvas.width = 240;
    ctx.canvas.height = 160;
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'bar',

        // The data for our dataset
        data: {
            labels: ['1월', '2월', '3월', '4월', '5월', '6월'],
            datasets: [{
                label: '일반회원',
                backgroundColor: 'rgb(255, 99, 132, 1)',
                borderColor: red,
                pointHoverBackgroundColor: red,
                data: [100, 80, 80, 80, 90, 99, 120],
                pointRadius: 1,
                pointHitRadius: 10,
                tension: 0.2,
                fill: false,
                borderWidth: 1
            },
            {
                label: '사업자회원',
                backgroundColor: 'rgb(54, 162, 235, 1)',
                borderColor: blue,
                pointHoverBackgroundColor: blue,
                data: [60, 40, 37, 62, 42, 59, 60],
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

function reviewGraph(){
    var ctx = document.getElementById('dash_reviewGraph').getContext('2d');
    ctx.canvas.width = 240;
    ctx.canvas.height = 160;
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'bar',

        // The data for our dataset
        data: {
            labels: ['1월', '2월', '3월', '4월', '5월', '6월'],
            datasets: [{
                label: '리뷰 수',
                backgroundColor: 'rgb(255, 205, 86,1)',
                borderColor: yellow,
                pointHoverBackgroundColor: yellow,
                data: [100, 80, 80, 80, 90, 99, 120],
                pointRadius: 1,
                pointHitRadius: 10,
                tension: 0.2,
                fill: false,
                borderWidth: 1
            }]
        },

        // Configuration options go here
        options: {
            responsive:false,
            maintainAspectRatio: false,
            legend: {
				display : false
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

function postGraph(){
    var ctx = document.getElementById('dash_postGraph').getContext('2d');
    ctx.canvas.width = 240;
    ctx.canvas.height = 160;
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'bar',

        // The data for our dataset
        data: {
            labels: ['1월', '2월', '3월', '4월', '5월', '6월'],
            datasets: [{
                label: '스토리 포스트 수',
                backgroundColor: 'rgb(75, 192, 192, 1)',
                borderColor: green,
                pointHoverBackgroundColor: green,
                data: [100, 80, 80, 80, 90, 99, 120],
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

