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

    //입력시 가격 자동계산
    if(e.name=='price[]'){
        var price = e.value;
        var discount = e.parentNode.nextSibling.nextSibling.firstChild.value;

        //계산
        var sales = price*( 1 - (discount/100));
        //판매가 조정
        e.parentNode.nextSibling.nextSibling.nextSibling.nextSibling.innerHTML = sales;

    }else if(e.name=='discount[]'){
        var price = e.parentNode.previousSibling.previousSibling.firstChild.value;
        var discount = e.value;
         //계산
         var sales = price*( 1 - (discount/100));
         //판매가 조정
        e.parentNode.nextSibling.nextSibling.innerHTML = sales;

    }
}