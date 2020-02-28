
var url = "/eduplanet/admin/am_members_waiting.php?";
var bsnsLic_url = "/eduplanet/data/bsnsLic/";


function onclickSearch(){

    var col = $('#search_select option:selected').val();
    var search = $('.form-control').val();

    if(col=="회원번호"){
        col="no";
    }else if(col=="아이디"){
        col="id";
    }else if(col=="이메일"){
        col="email";
    }else if(col=="학원고유번호"){
        col="acd_no";
    }else if(col=="학원명"){
        col="acd_name";
    }else if(col=="대표자명"){
        col="rprsn";
    }else if(col=="가입일"){
        col="regist_day";
    }

    if(!search){
        alert('검색어를 입력해주세요');
    }else{
        location.replace(url+"&col="+col+"&search="+search);
    }
}

function submitApproval(){
    var conf = confirm('[가입승인] 선택한 회원의 가입을 승인합니다.');

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
            url : "./lib/am_members_approval.php",
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

function submitDeny(){
    var conf = confirm('[가입거절] 선택한 회원의 데이터를 삭제합니다.');

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
            url : "./lib/am_members_delete.php",
            success : function(data){
                if(data==1){
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

function showPopupLayer(file_name){
    //이미지설정
    var imgurl = bsnsLic_url+file_name;
    $('#bsns_lic_img').attr("src", imgurl);
    $('#bsns_lic_img').attr("width", "600px");

    setPopupLayerPos("#popupLayer");
    viewScrollMove("#popupLayer", 400);
    $("#popupLayer, #overlay").show();
  
    $("#overlay").click(function(e){
      e.preventDefault();
      closePopupLayer("#popupLayer, #overlay");
    });
}

function setDefaultImg(){
    $('#bsns_lic_img').attr("src", "/eduplanet/admin/img/no_bsns_lic.png");
    $('#bsns_lic_img').attr("width", "300px");
}


function setPopupLayerPos(selector){
    $(selector).css("top", "100px");
    $(selector).css("left", (($(window).width()-$(selector).outerWidth())/2+$(window).scrollLeft())+"px");
    $(selector).css("position", "absolute");
}


function viewScrollMove(selector, sec){
    //팝업으로 스크롤 자동이동 - 팝업창이 있는 위치를 알기 위해 팝업객체를 가져옴
    var offset = $(selector).offset();
    $('html, body').animate({scrollTop : offset.top-100}, sec);
}


function closePopupLayer(selector){
    $(selector).hide();
}
