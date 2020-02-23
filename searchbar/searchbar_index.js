$(function(){

    $("#acd_name_index").autocomplete({
        source : function( request, response ) {
            
            $.ajax({
                type: 'post',
                url: "/eduplanet/searchbar/auto_searchbar.php",
                dataType: "json",
                data: { search : request.term },
                success: function(data) {
                    response(data);
                    // alert("ㅠㅠ");
                },

                error:function(request,status,error){
                    alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
                }
                
                
            });
        },

        // 최소 글자입력 수
        minLength: 1,

        // 검색결과를 보여주는 시간
        delay: 100,

        // 포커스 되었을 때 input에 넣어주기
        focus: function(event, ui) {
            $("#acd_name_index").val(ui.item.acd_name);
        },

        // 선택 했을 때 input에 넣어주기
        select: function(event, ui) {

             $('#acd_name_index').val(ui.item.acd_name); // save selected id to input
            return false;
        }

    // 검색했을 때 나오는 자동완성 창을 커스텀하기
    }).autocomplete('instance')._renderItem = function(ul, item) {
        return $("<li>")
        .append("<div><b>" + item.acd_name + "</b><br><span style='font-size: 12px; color: gray;'>" + item.si_name + " / " + item.dong_name + "</span></div>").appendTo(ul);
    };
});