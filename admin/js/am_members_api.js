var url = "/eduplanet/admin/am_members_api.php?";

$(function(){
    
});

function getNewAcademy(){
    $.ajax({
        type: "post",
        dataType: "json",
        data: {"mode": "new"},
        url : "/eduplanet/admin/lib/get_academy_data.php",
        success : function(data){

        },
        error : function(){
            alert("시스템에러");
        }
    });
}

function submitInsertAcd(){
    var conf = confirm('[학원추가] 선택한 신규학원을 DB에 추가합니다.');

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
            url : "./lib/academy_insert.php",
            success : function(data){
                if(data==1){//업데이트 성공시
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

function submitInsertTotalAcd(){
    var conf = confirm('[학원추가] 모든 신규학원을 DB에 추가합니다.');

    if(conf){
        var formsForUpdate = new Array();

        var data = JSON.parse(new_acd);
        var array = [];
        for(var i=0; i<data.length; i++){
            array[i] = new_acd[i][0];
        }

        console.log(array);

        // $("input:checkbox[name='no[]']").each(function() {
        //     if($(this).is(":checked") == true) {//체크되어있으면
        //         formsForUpdate.push($(this).closest("form")); //해당 폼 객체를 배열에 저장
        //     }
        // });

        // var serialize ='';

        // for(var i in formsForUpdate){
        //     serialize += formsForUpdate[i].serialize() + "&";
        // }

        // serialize = serialize.slice(0,-1);
        // console.log(serialize);
        // $.ajax({
        //     type: "post",
        //     data: serialize,
        //     url : "./lib/am_members_delete.php",
        //     success : function(data){
        //         if(data==1){
        //             location.href=url+'&page='+page;
        //         }else{
        //             alert('오류발생: '+data);
        //         }
        //     },
        //     error : function(){
        //         alert("시스템에러");
        //     }
        // });
    }
}
