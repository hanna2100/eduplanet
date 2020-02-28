var formsForUpdate = new Array();
var url = "/eduplanet/admin/membership.php?";

$(function(){
    listItemPicker();
});


function onclickSearch(){

    var col = $('#search_select option:selected').val();
    var search = $('.form-control').val();

    if(col=="상품명"){
        col="prdct_name";
    }else if(col=="개월"){
        col="month";
    }else if(col=="가격"){
        col="price";
    }else if(col=="할인율"){
        col="discount";
    }

    if(!search){
        alert('검색어를 입력해주세요');
    }else{
        location.replace(url+"col="+col+"&search="+search);
    }
}


function listItemPicker(){
    $('.list_row').click(function(){

        //다중 클릭시 폼배열에 중복으로 쌓이는 것 방지
        if($(this).css('background-color')=='rgb(142, 196, 240)'){
            return;
        }

        $(this).css('background-color' , '#8ec4f0a9');
        $(this).children('form').children('.col3').children('input').prop('disabled',false);
        $(this).children('form').children('.col4').children('input').prop('disabled',false);
        $(this).children('form').children('.col5').children('input').prop('disabled',false);
        $(this).children('form').children('.col6').children('input').prop('disabled',false);

        formsForUpdate.push($(this).children('form'));
    });
}

function limitMaxLength(e){
    //최대 길이 넘어가면 못쓰게
    if(e.value.length> e.maxLength){
        e.value = e.value.slice(0, e.maxLength);
    }

    //각 필드마다 형식확인
    switch(e.name){
        case 'month[]':
            if(!(e.value>=1 && e.value<=12)){
                e.value = '';
            }
        break;

        case 'price[]':
            if(!(e.value>=0 && e.value<=1000000)){
                e.value = '';
            }
        break;

        case 'discount[]':
            if(!(e.value>=0 && e.value<=100)){
                e.value = '';
            }
        break;

        case 'prdct_name[]':

            var exp = /^[가-힣a-zA-Z0-9]{1,10}$/;
            if(!exp.test(e.value)){
                e.value='';
            }
        break;
    }

    //입력시 가격 자동계산
    if(e.name=='price[]'){
        var price = e.value;
        var discount = e.parentNode.nextSibling.nextSibling.firstChild.value;

        //계산
        var sales = price*( 1 - (discount/100));
        //판매가 조정
        e.parentNode.nextSibling.nextSibling.nextSibling.nextSibling.innerHTML = parseInt(sales);

    }else if(e.name=='discount[]'){
        var price = e.parentNode.previousSibling.previousSibling.firstChild.value;
        var discount = e.value;
         //계산
         var sales = price*( 1 - (discount/100));
         //판매가 조정
        e.parentNode.nextSibling.nextSibling.innerHTML = parseInt(sales);

    }
}


function submitUpdate(){

    var conf = confirm('멤버십 상품을 수정하시겠습니까?');

    if(conf){

        for(var i in formsForUpdate){
            var value = formsForUpdate[i].children('.col3').children('input').val();
            if(value === ''){
                alert('상품명이 비어있습니다');
                return;
            }
            value = formsForUpdate[i].children('.col4').children('input').val();
            if(value === ''){
                alert('개월 수가 비어있습니다');
                return;
            }
            value = formsForUpdate[i].children('.col5').children('input').val();
            if(value === ''){
                alert('가격이 비어있습니다');
                return;
            }
            value = formsForUpdate[i].children('.col6').children('input').val();
            if(value === ''){
                alert('할인율은 최소 0 ~ 최대 100 사이입니다');
                return;
            }
        }

        var serialize ='';

        for(var i in formsForUpdate){
            serialize += formsForUpdate[i].serialize() + "&";
        }

        serialize = serialize.slice(0,-1);
        console.log(serialize);
        $.ajax({
            type: "post",
            data: serialize,
            url : "./lib/membership_update.php",
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
