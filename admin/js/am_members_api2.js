var url = "/eduplanet/admin/am_members_api2.php?";

$(function(){
    $().hover(function(){
    });

    $('.old_data').mouseenter(function(){
        $(this).css("background-color", "#f3f3f3");
        $(this).next().css("background-color", "#f3f3f3");

    }).mouseleave(function(){
        $(this).css("background-color", "#fff");
        $(this).next().css("background-color", "#fff");

    });

    
});

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


function submitUpdateAcd(){
    var conf = confirm('[학원변경] 선택한 학원을 DB에 변경합니다.');

    if(conf){
        var formsForUpdate = new Array();

        $("input:checkbox[name='no[]']").each(function() {
            if($(this).is(":checked") == true) {//체크되어있으면
                formsForUpdate.push($(this).closest("form")); //해당 폼 객체를 배열에 저장
            }
        });

        updateSerialization(formsForUpdate);
    }
}

function submitUpdateTotalAcd(){
    var conf = confirm('[학원추가] 변경된 모든 학원을 DB에 적용합니다.');

    //현재화면에 있는 form들은 해당 페이지에만 있는 form이기 때문에
    //전체 데이터를 업데이트 하려면 form을 동적으로 생성해줘야함
    if(conf){
        $.ajax({
            type: "post",
            dataType: "json",
            data: {"mode": "edit"},
            url : "/eduplanet/admin/lib/get_academy_data.php",
            success : function(data){

                var old = data[0]; //기존 학원정보
                var latest = data[1]; //새 학원정보
                
                console.log(old);
                console.log(latest);
                var formsForUpdate = new Array();
                for(var i = 0; i<old.length; i++){

                    var $form = $('<form></form>');
                    $form.attr('action', '#');
                    $form.attr('method', 'post');
                    $form.appendTo('body');
                    
                    var temp1 = $('<input type="hidden" value="'+old[i][8]+'" name="no[]">');
                    var temp2 = $('<input type="hidden" value="'+latest[i][8]+'" name="new_no[]">');
                    var temp3 = $('<input type="hidden" value="'+latest[i][0]+'" name="new_si_name[]">');
                    var temp4 = $('<input type="hidden" value="'+latest[i][1]+'" name="new_dong_name[]">');
                    var temp5 = $('<input type="hidden" value="'+latest[i][2]+'" name="new_sector[]">');
                    var temp6 = $('<input type="hidden" value="'+latest[i][3]+'" name="new_acd_name[]">');
                    var temp7 = $('<input type="hidden" value="'+latest[i][4]+'" name="new_rprsn[]">');
                    var temp8 = $('<input type="hidden" value="'+latest[i][5]+'" name="new_class[]">');
                    var temp9 = $('<input type="hidden" value="'+latest[i][6]+'" name="new_tel[]">');
                    var temp10 = $('<input type="hidden" value="'+latest[i][7]+'" name="new_address[]">');
                    
                    $form.append(temp1).append(temp2).append(temp3).append(temp4).append(temp5).append(temp6).append(temp7).append(temp8).append(temp9).append(temp10);
                    
                    formsForUpdate.push($form);
                }

                updateSerialization(formsForUpdate);
            

            },
            error : function(){
                alert("시스템에러");
            }
        });
    }
}

function updateSerialization(formsForUpdate){
    var serialize ='';

        for(var i in formsForUpdate){
            console.log(formsForUpdate[i]);
            serialize += formsForUpdate[i].serialize() + "&";
        }

        serialize = serialize.slice(0,-1);

        $.ajax({
            type: "post",
            data: serialize,
            url : "./lib/academy_update.php",
            success : function(data){

                console.log(data);
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

