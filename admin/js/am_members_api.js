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

        insertSerialization(formsForUpdate);
    }
}

function updateAcdFromApi(){
    $.ajax({
        type: "post",
        dataType: "text",
        url : "/eduplanet/admin/lib/update_academy_from_api.php",
        success : function(data){
            data.trim();
            if(data==1){
                alert("API에서 새로운 데이터를 업데이트 했습니다");
                location.replace(url);
            }else{
                alert("API 업데이트를 실패했습니다");
            }
        },
        error : function(){
            alert("시스템에러");
        }
    });
}

function modifyData(){
    $.ajax({
        type: "post",
        dataType: "text",
        url : "/eduplanet/admin/lib/modify_data_for_testing.php",
        success : function(data){
            data.trim();
            if(data==1){
                alert("DB정보수정 완료");
                location.replace('/eduplanet/admin/am_members_api.php');
            }else{
                alert("DB정보수정 실패");
            }
        },
        error : function(){
            alert("시스템에러");
        }
    }); 
}

function submitInsertTotalAcd(){
    var conf = confirm('[학원추가] 모든 신규학원을 DB에 추가합니다.');

    if(conf){
        $.ajax({
            type: "post",
            dataType: "json",
            data: {"mode": "new"},
            url : "/eduplanet/admin/lib/get_academy_data.php",
            success : function(data){

                var formsForUpdate = new Array();
                for(var i = 0; i<data.length; i++){

                    var $form = $('<form></form>');
                    $form.attr('action', '#');
                    $form.attr('method', 'post');
                    $form.appendTo('body');
                    
                    var no = $('<input type="hidden" value="'+data[i][8]+'" name="no[]">');
                    
                    $form.append(no);
                    
                    formsForUpdate.push($form);
                }

                insertSerialization(formsForUpdate);
            

            },
            error : function(){
                alert("시스템에러");
            }
        });
    }
}

function insertSerialization(formsForUpdate){
    var serialize ='';

        for(var i in formsForUpdate){
            console.log(formsForUpdate[i]);
            serialize += formsForUpdate[i].serialize() + "&";
        }

        serialize = serialize.slice(0,-1);

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
