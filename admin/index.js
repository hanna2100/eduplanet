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