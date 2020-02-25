var formsForUpdate = new Array();
var url;

$(function(){
    
    url = "/eduplanet/admin/am_members.php?y="+y+"&m="+m;
    salesGraph(gm_sales, am_sales);
    dash_prcd1_ratio(am_prdct_one ,am_prdct_two, am_prdct_thr);
    dash_prcd2_ratio(gm_prdct_one ,gm_prdct_two, gm_prdct_thr);
    dash_method_ratio(kakao, payco, smile);
    
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
    
});


function salesGraph(gm, am){

    for(var i = 0; i<gm.length; i++){
        gm[i] = gm[i]/10000;
        am[i] = am[i]/10000;
    }

    var ctx = document.getElementById('g_members_totalGraph').getContext('2d');
    ctx.canvas.width = 880;
    ctx.canvas.height = 310;
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'line',

        // The data for our dataset
        data: {
            labels: dayArray(y,m),
            datasets: [{
                label: '일반회원',
                backgroundColor: red,
                borderColor: red,
                pointHoverBackgroundColor: red,
                data: gm,
                pointRadius: 1,
                pointHitRadius: 10,
                tension: 0.1,
                fill: false,
                borderWidth: 3,
                order: 1
            },{
                label: '사업자회원',
                backgroundColor: blue,
                borderColor: blue,
                pointHoverBackgroundColor: blue,
                data: am,
                pointRadius: 1,
                pointHitRadius: 10,
                tension: 0.1,
                fill: false,
                borderWidth: 3,
                order: 2
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

function dash_prcd1_ratio(mnth_one ,mnth_two, mnth_three){
    var ctx = document.getElementById('dash_prcd1_ratio').getContext('2d');
    ctx.canvas.width = 240;
    ctx.canvas.height = 160;
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'doughnut',

        // The data for our dataset
        data: {
            datasets: [{
                backgroundColor: ['#ffcccc', '#ff8080', red],
                borderColor:  ['#ffcccc', '#ff8080', red],
                data: [mnth_one ,mnth_two, mnth_three],
                borderWidth: 1
            }],
            labels: ['프리미엄 1개월', '프리미엄 2개월', '프리미엄 3개월'
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


function dash_prcd2_ratio(mnth_one ,mnth_two, mnth_three){
    var ctx = document.getElementById('dash_prcd2_ratio').getContext('2d');
    ctx.canvas.width = 240;
    ctx.canvas.height = 160;
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'doughnut',

        // The data for our dataset
        data: {
            datasets: [{
                backgroundColor: ['#ccebff', '#80ccff', blue],
                borderColor:  ['#ccebff', '#80ccff', blue],
                data: [mnth_one ,mnth_two, mnth_three],
                borderWidth: 1
            }],
            labels: ['학원관리 1개월', '학원관리 2개월', '학원관리 3개월'
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

function dash_method_ratio(kakao ,payco, smile){
    var ctx = document.getElementById('dash_method_ratio').getContext('2d');
    ctx.canvas.width = 240;
    ctx.canvas.height = 160;
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'doughnut',

        // The data for our dataset
        data: {
            datasets: [{
                backgroundColor: [yellow, red, '#333399'],
                borderColor:  [yellow, red, '#333399'],
                data: [kakao ,payco, smile],
                borderWidth: 1
            }],
            labels: ['카카오페이', '페이코', '스마일페이'
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