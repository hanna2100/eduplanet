var formsForUpdate = new Array();

$(function(){
    topSelect_init_Setting();
    g_membersGraph();
    listItemPicker();
});


function g_membersGraph(){
    var ctx = document.getElementById('g_members_totalGraph').getContext('2d');
    ctx.canvas.width = 880;
    ctx.canvas.height = 310;
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'bar',

        // The data for our dataset
        data: {
            labels: dayArray(2020,2),
            datasets: [{
                label: '신규회원',
                backgroundColor: red,
                borderColor: red,
                pointHoverBackgroundColor: red,
                data: [100, 80, 80, 80, 90, 99, 120],
                pointRadius: 1,
                pointHitRadius: 10,
                tension: 0.2,
                fill: false,
                borderWidth: 1,
                order: 2
            },{
                label: '탈퇴회원',
                backgroundColor: purple,
                borderColor: purple,
                pointHoverBackgroundColor: purple,
                data: [60, 40, 37, 62, 42, 59, 60],
                pointRadius: 1,
                pointHitRadius: 10,
                tension: 0.2,
                fill: false,
                borderWidth: 1,
                order: 3
            },{
                label: '순 증가회원 수',
                backgroundColor: grey,
                borderColor: grey,
                pointHoverBackgroundColor: grey,
                data: [30, 22, 27, 42, 32, 19, 30],
                pointRadius: 1,
                pointHitRadius: 10,
                tension: 0.2,
                fill: false,
                borderWidth: 5,
                type: 'line',
                order: 1
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

function listItemPicker(){
    $('.list_row').click(function(){
        $(this).css('background-color' , '#8ec4f0a9');
        $(this).children('form').children('.col4').children('input').prop('disabled',false);
        $(this).children('form').children('.col5').children('input').prop('disabled',false);
        $(this).children('form').children('.col7').children('input').prop('disabled',false);
        $(this).children('form').children('.col8').children('input').prop('disabled',false);

        formsForUpdate.push($(this).children('form'));
    });
}

function submitUpdate(){
    //action 경로 설정 및 서브밋
    for(var i in formsForUpdate){
        var no = formsForUpdate[i].children('.col2').innerText;
        formsForUpdate[i].attr("action", "./lib/gm_members_update.php?no="+no);
        formsForUpdate[i].submit();
    }
}

function submitDelete(){
    //action 경로 설정 및 서브밋
    for(var i in formsForUpdate){
        var no = formsForUpdate[i].children('.col2').innerText;
        formsForUpdate[i].attr("action", "./lib/gm_members_delete.php?no="+no);
        formsForUpdate[i].submit();
    }
}