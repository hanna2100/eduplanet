$(document).ready(function () {

    // 리뷰 작성 버튼을 눌렀을 때    
    // $("#review_write").click(function () {
    //     showPopup(1);
    // });

    // 리뷰 수정 버튼을 눌렀을 때    
    // $("#review_update").click(function () {
    //     showPopup(2);
    // });

    // 닫기 버튼을 눌렀을 때
    $("#button_close_popup").click(function (e) {
        e.preventDefault();
        closePopup();
    });

});

// 팝업 보여주기 함수
function showPopup(mode, no) {

    // 작성하기
    if (mode === 1) {

        $("#popup_wrap, #popup_content").show();
        setPopupPos("#popup_content");

        document.getElementsByClassName("review_write_header")[0].style.backgroundColor = "#2E89FF";
        document.getElementById("review_write_header_title").innerHTML = "학원리뷰 작성";
        document.getElementsByClassName("review_write_content_p")[0].innerHTML = "작성을 완료하시면 모든 학원의 리뷰를 보실 수 있습니다.";
        document.getElementsByClassName("review_write_content_p")[1].innerHTML = "입력하신 모든 정보는 <b>익명</b>으로 처리됩니다.";
        document.getElementById("button_submit_review").innerHTML = "작성하기";
        document.getElementById("acd_name").disabled = false;
        document.getElementById("acd_name").style.border = "1px solid rgb(169, 169, 169)";
        document.getElementById("acd_name").style.fontSize = "13px";
        document.getElementById("acd_name").style.color = "black";
        document.getElementsByName("review_form")[0].action = "/eduplanet/mypage/review_insert.php";

        // input 초기화
        document.getElementById("acd_name").value = "";
        document.getElementById("one_line").value = "";
        document.getElementById("benefit").value = "";
        document.getElementById("drawback").value = "";
        document.getElementById("search_academy_check").innerHTML = "학원을 선택해 주세요.";

        // 글자수 초기화
        countTextLength(1);
        countTextLength(2);
        countTextLength(3);

        // 별점 초기화
        reviewStarSetting(6, 0);

        // 수정하기 
    } else if (mode === 2) {
        $("#popup_wrap, #popup_content").show();
        setPopupPos("#popup_content");

        document.getElementsByClassName("review_write_header")[0].style.backgroundColor = "rgb(115, 176, 255)";
        document.getElementById("review_write_header_title").innerHTML = "학원리뷰 수정";
        document.getElementsByClassName("review_write_content_p")[0].innerHTML = "수정을 완료하신 후 수정하기 버튼을 눌러 주세요.";
        document.getElementsByClassName("review_write_content_p")[1].innerHTML = "";
        document.getElementById("button_submit_review").innerHTML = "수정하기";
        document.getElementById("acd_name").disabled = true;
        document.getElementById("acd_name").style.border = "1px solid white";
        document.getElementById("acd_name").style.fontSize = "15px";
        document.getElementById("acd_name").style.color = "black";
        // document.getElementById("button_submit_review").onclick = "updateReview();";
        document.getElementsByName("review_form")[0].action = "/eduplanet/mypage/review_update.php?no=" + no;

        // 작성리뷰 불러오기
        $.ajax({
            type: 'post',
            url: "/eduplanet/mypage/review_update_ajax.php",
            dataType: "json",
            data: {
                review_no: no
            },

            success: function (data) {
                // console.log(data[0]);

                // input 셋팅
                $("#search_academy_check").html("");
                $("#acd_name").val(data[0]['acd_name']);
                $("#one_line").val(data[0]['one_line']);
                $("#benefit").val(data[0]['benefit']);
                $("#drawback").val(data[0]['drawback']);

                // 글자수 셋팅
                countTextLength(1);
                countTextLength(2);
                countTextLength(3);

                var total_star = 0,
                    facility_star = 1,
                    acsbl_star = 2,
                    teacher_star = 3,
                    cost_efct_star = 4,
                    achievement_star = 5;

                var starArrayName = [total_star, facility_star, acsbl_star, teacher_star, cost_efct_star, achievement_star];
                var starArray = ['total_star', 'facility_star', 'acsbl_star', 'teacher_star', 'cost_efct_star', 'achievement_star'];

                for (i = 0; i < starArray.length; i++) {

                    // 별점 이미지 셋팅
                    reviewStarSetting(starArrayName[i], parseInt(data[0][starArray[i]]));

                    // 별점 라디오버튼 셋팅
                    switch (parseInt(data[0][starArray[i]])) {

                        case 1:
                            document.getElementsByName(starArray[i])[0].checked = true;
                            break;

                        case 2:
                            document.getElementsByName(starArray[i])[1].checked = true;
                            break;

                        case 3:
                            document.getElementsByName(starArray[i])[2].checked = true;
                            break;

                        case 4:
                            document.getElementsByName(starArray[i])[3].checked = true;
                            break;

                        case 5:
                            document.getElementsByName(starArray[i])[4].checked = true;
                            break;

                    }
                }

            }
        });
    }
}

// 팝업으로 스크롤 자동이동 (팝업창 위치를 알기 위해 팝업객체 가져오기)
// selector : 가져올 객체 (아이디, this등) // sec : 이동 시간
function scrollMove(selector, sec) {
    var offset = $(selector).offset();
    $('html, body').animate({
        scrollTop: offset.top
    }, sec);
}

// 화면 크기에 따라 가운데로 위치를 지정해주는 함수
function setPopupPos(selector) {
    // $(selector).css("top", (($(window).height() - $(selector).outerHeight()) / 2 + $(window).scrollTop()) + "px");
    $(selector).css("left", (($(window).width() - $(selector).outerWidth()) / 2 + $(window).scrollLeft()) + "px");
    $(selector).css("position", "absolute");
}

// 팝업 닫기 함수
function closePopup() {
    $("#popup_wrap, #popup_content").hide();
}

//////////////////////////////////////////////////////////////////////////////////////////////////

// 학원명 자동완성 함수
$(function () {

    $("#acd_name").autocomplete({

        source: function (request, response) {

            $.ajax({
                type: 'post',
                url: "/eduplanet/mypage/auto_search.php",
                dataType: "json",
                data: {
                    search: request.term
                },
                success: function (data) {
                    response(data);
                }
            });
        },

        // 최소 글자입력 수
        minLength: 1,

        // 검색결과를 보여주는 시간
        delay: 100,

        // 포커스 되었을 때 input에 넣어주기
        focus: function (event, ui) {
            $("#acd_name").val(ui.item.acd_name);
            $("#si_name").val(ui.item.si_name);
            $("#dong_name").val(ui.item.dong_name);
        },

        // 선택 했을 때 input에 넣어주기
        select: function (event, ui) {

            // $('#acd_name').val(ui.item.label); // display the selected text
            $('#acd_name').val(ui.item.acd_name); // save selected id to input
            $("#si_name").val(ui.item.si_name);
            $("#dong_name").val(ui.item.dong_name);
            $("#search_academy_check").html("");

            return false;
        }

        // 검색했을 때 나오는 자동완성 창을 커스텀하기
    }).autocomplete("instance")._renderItem = function (ul, item) {
        return $("<li>")
            .append("<div><b>" + item.acd_name + "</b><br><span style='font-size: 12px; color: gray;'>" + item.si_name + " / " + item.dong_name + "</span></div>").appendTo(ul);
    };
});

/////////////////////////////////////////////////////////////////////////////////////////////////////////

// 별점을 클릭했을 때 별점 이미지와 텍스트를 바꿔주는 함수
function reviewStarSetting(group, score) {

    // 총 만족도
    if (group === 0) {

        switch (score) {

            case 1:
                document.getElementById("total_star_text").innerHTML = "매우 불만족";
                document.getElementById("total_star_img_1").style.backgroundPosition = "-50px -350px";
                document.getElementById("total_star_img_2").style.backgroundPosition = "0 -350px";
                document.getElementById("total_star_img_3").style.backgroundPosition = "0 -350px";
                document.getElementById("total_star_img_4").style.backgroundPosition = "0 -350px";
                document.getElementById("total_star_img_5").style.backgroundPosition = "0 -350px";
                break;

            case 2:
                document.getElementById("total_star_text").innerHTML = "불만족";
                document.getElementById("total_star_img_1").style.backgroundPosition = "-50px -350px";
                document.getElementById("total_star_img_2").style.backgroundPosition = "-50px -350px";
                document.getElementById("total_star_img_3").style.backgroundPosition = "0 -350px";
                document.getElementById("total_star_img_4").style.backgroundPosition = "0 -350px";
                document.getElementById("total_star_img_5").style.backgroundPosition = "0 -350px";
                break;

            case 3:
                document.getElementById("total_star_text").innerHTML = "보통";
                document.getElementById("total_star_img_1").style.backgroundPosition = "-50px -350px";
                document.getElementById("total_star_img_2").style.backgroundPosition = "-50px -350px";
                document.getElementById("total_star_img_3").style.backgroundPosition = "-50px -350px";
                document.getElementById("total_star_img_4").style.backgroundPosition = "0 -350px";
                document.getElementById("total_star_img_5").style.backgroundPosition = "0 -350px";
                break;

            case 4:
                document.getElementById("total_star_text").innerHTML = "만족";
                document.getElementById("total_star_img_1").style.backgroundPosition = "-50px -350px";
                document.getElementById("total_star_img_2").style.backgroundPosition = "-50px -350px";
                document.getElementById("total_star_img_3").style.backgroundPosition = "-50px -350px";
                document.getElementById("total_star_img_4").style.backgroundPosition = "-50px -350px";
                document.getElementById("total_star_img_5").style.backgroundPosition = "0 -350px";
                break;

            case 5:
                document.getElementById("total_star_text").innerHTML = "매우 만족";
                document.getElementById("total_star_img_1").style.backgroundPosition = "-50px -350px";
                document.getElementById("total_star_img_2").style.backgroundPosition = "-50px -350px";
                document.getElementById("total_star_img_3").style.backgroundPosition = "-50px -350px";
                document.getElementById("total_star_img_4").style.backgroundPosition = "-50px -350px";
                document.getElementById("total_star_img_5").style.backgroundPosition = "-50px -350px";
                break;
        }

        // 시설 만족도
    } else if (group === 1) {

        switch (score) {

            case 1:
                document.getElementById("facility_star_text").innerHTML = "매우 불만족";
                document.getElementById("facility_star_img_1").style.backgroundPosition = "0 -50px";
                document.getElementById("facility_star_img_2").style.backgroundPosition = "0 0";
                document.getElementById("facility_star_img_3").style.backgroundPosition = "0 0";
                document.getElementById("facility_star_img_4").style.backgroundPosition = "0 0";
                document.getElementById("facility_star_img_5").style.backgroundPosition = "0 0";
                break;

            case 2:
                document.getElementById("facility_star_text").innerHTML = "불만족";
                document.getElementById("facility_star_img_1").style.backgroundPosition = "0 -50px";
                document.getElementById("facility_star_img_2").style.backgroundPosition = "0 -50px";
                document.getElementById("facility_star_img_3").style.backgroundPosition = "0 0";
                document.getElementById("facility_star_img_4").style.backgroundPosition = "0 0";
                document.getElementById("facility_star_img_5").style.backgroundPosition = "0 0";
                break;

            case 3:
                document.getElementById("facility_star_text").innerHTML = "보통";
                document.getElementById("facility_star_img_1").style.backgroundPosition = "0 -50px";
                document.getElementById("facility_star_img_2").style.backgroundPosition = "0 -50px";
                document.getElementById("facility_star_img_3").style.backgroundPosition = "0 -50px";
                document.getElementById("facility_star_img_4").style.backgroundPosition = "0 0";
                document.getElementById("facility_star_img_5").style.backgroundPosition = "0 0";
                break;

            case 4:
                document.getElementById("facility_star_text").innerHTML = "만족";
                document.getElementById("facility_star_img_1").style.backgroundPosition = "0 -50px";
                document.getElementById("facility_star_img_2").style.backgroundPosition = "0 -50px";
                document.getElementById("facility_star_img_3").style.backgroundPosition = "0 -50px";
                document.getElementById("facility_star_img_4").style.backgroundPosition = "0 -50px";
                document.getElementById("facility_star_img_5").style.backgroundPosition = "0 0";
                break;

            case 5:
                document.getElementById("facility_star_text").innerHTML = "매우 만족";
                document.getElementById("facility_star_img_1").style.backgroundPosition = "0 -50px";
                document.getElementById("facility_star_img_2").style.backgroundPosition = "0 -50px";
                document.getElementById("facility_star_img_3").style.backgroundPosition = "0 -50px";
                document.getElementById("facility_star_img_4").style.backgroundPosition = "0 -50px";
                document.getElementById("facility_star_img_5").style.backgroundPosition = "0 -50px";
                break;
        }

        // 교통 편의성 
    } else if (group === 2) {

        switch (score) {

            case 1:
                document.getElementById("acsbl_star_text").innerHTML = "매우 불만족";
                document.getElementById("acsbl_star_img_1").style.backgroundPosition = "0 -50px";
                document.getElementById("acsbl_star_img_2").style.backgroundPosition = "0 0";
                document.getElementById("acsbl_star_img_3").style.backgroundPosition = "0 0";
                document.getElementById("acsbl_star_img_4").style.backgroundPosition = "0 0";
                document.getElementById("acsbl_star_img_5").style.backgroundPosition = "0 0";
                break;

            case 2:
                document.getElementById("acsbl_star_text").innerHTML = "불만족";
                document.getElementById("acsbl_star_img_1").style.backgroundPosition = "0 -50px";
                document.getElementById("acsbl_star_img_2").style.backgroundPosition = "0 -50px";
                document.getElementById("acsbl_star_img_3").style.backgroundPosition = "0 0";
                document.getElementById("acsbl_star_img_4").style.backgroundPosition = "0 0";
                document.getElementById("acsbl_star_img_5").style.backgroundPosition = "0 0";
                break;

            case 3:
                document.getElementById("acsbl_star_text").innerHTML = "보통";
                document.getElementById("acsbl_star_img_1").style.backgroundPosition = "0 -50px";
                document.getElementById("acsbl_star_img_2").style.backgroundPosition = "0 -50px";
                document.getElementById("acsbl_star_img_3").style.backgroundPosition = "0 -50px";
                document.getElementById("acsbl_star_img_4").style.backgroundPosition = "0 0";
                document.getElementById("acsbl_star_img_5").style.backgroundPosition = "0 0";
                break;

            case 4:
                document.getElementById("acsbl_star_text").innerHTML = "만족";
                document.getElementById("acsbl_star_img_1").style.backgroundPosition = "0 -50px";
                document.getElementById("acsbl_star_img_2").style.backgroundPosition = "0 -50px";
                document.getElementById("acsbl_star_img_3").style.backgroundPosition = "0 -50px";
                document.getElementById("acsbl_star_img_4").style.backgroundPosition = "0 -50px";
                document.getElementById("acsbl_star_img_5").style.backgroundPosition = "0 0";
                break;

            case 5:
                document.getElementById("acsbl_star_text").innerHTML = "매우 만족";
                document.getElementById("acsbl_star_img_1").style.backgroundPosition = "0 -50px";
                document.getElementById("acsbl_star_img_2").style.backgroundPosition = "0 -50px";
                document.getElementById("acsbl_star_img_3").style.backgroundPosition = "0 -50px";
                document.getElementById("acsbl_star_img_4").style.backgroundPosition = "0 -50px";
                document.getElementById("acsbl_star_img_5").style.backgroundPosition = "0 -50px";
                break;
        }

        // 강사 만족도
    } else if (group === 3) {

        switch (score) {

            case 1:
                document.getElementById("teacher_star_text").innerHTML = "매우 불만족";
                document.getElementById("teacher_star_img_1").style.backgroundPosition = "0 -50px";
                document.getElementById("teacher_star_img_2").style.backgroundPosition = "0 0";
                document.getElementById("teacher_star_img_3").style.backgroundPosition = "0 0";
                document.getElementById("teacher_star_img_4").style.backgroundPosition = "0 0";
                document.getElementById("teacher_star_img_5").style.backgroundPosition = "0 0";
                break;

            case 2:
                document.getElementById("teacher_star_text").innerHTML = "불만족";
                document.getElementById("teacher_star_img_1").style.backgroundPosition = "0 -50px";
                document.getElementById("teacher_star_img_2").style.backgroundPosition = "0 -50px";
                document.getElementById("teacher_star_img_3").style.backgroundPosition = "0 0";
                document.getElementById("teacher_star_img_4").style.backgroundPosition = "0 0";
                document.getElementById("teacher_star_img_5").style.backgroundPosition = "0 0";
                break;

            case 3:
                document.getElementById("teacher_star_text").innerHTML = "보통";
                document.getElementById("teacher_star_img_1").style.backgroundPosition = "0 -50px";
                document.getElementById("teacher_star_img_2").style.backgroundPosition = "0 -50px";
                document.getElementById("teacher_star_img_3").style.backgroundPosition = "0 -50px";
                document.getElementById("teacher_star_img_4").style.backgroundPosition = "0 0";
                document.getElementById("teacher_star_img_5").style.backgroundPosition = "0 0";
                break;

            case 4:
                document.getElementById("teacher_star_text").innerHTML = "만족";
                document.getElementById("teacher_star_img_1").style.backgroundPosition = "0 -50px";
                document.getElementById("teacher_star_img_2").style.backgroundPosition = "0 -50px";
                document.getElementById("teacher_star_img_3").style.backgroundPosition = "0 -50px";
                document.getElementById("teacher_star_img_4").style.backgroundPosition = "0 -50px";
                document.getElementById("teacher_star_img_5").style.backgroundPosition = "0 0";
                break;

            case 5:
                document.getElementById("teacher_star_text").innerHTML = "매우 만족";
                document.getElementById("teacher_star_img_1").style.backgroundPosition = "0 -50px";
                document.getElementById("teacher_star_img_2").style.backgroundPosition = "0 -50px";
                document.getElementById("teacher_star_img_3").style.backgroundPosition = "0 -50px";
                document.getElementById("teacher_star_img_4").style.backgroundPosition = "0 -50px";
                document.getElementById("teacher_star_img_5").style.backgroundPosition = "0 -50px";
                break;

        }

        // 수업료 만족도
    } else if (group === 4) {

        switch (score) {

            case 1:
                document.getElementById("cost_efct_star_text").innerHTML = "매우 불만족";
                document.getElementById("cost_efct_star_img_1").style.backgroundPosition = "0 -50px";
                document.getElementById("cost_efct_star_img_2").style.backgroundPosition = "0 0";
                document.getElementById("cost_efct_star_img_3").style.backgroundPosition = "0 0";
                document.getElementById("cost_efct_star_img_4").style.backgroundPosition = "0 0";
                document.getElementById("cost_efct_star_img_5").style.backgroundPosition = "0 0";
                break;

            case 2:
                document.getElementById("cost_efct_star_text").innerHTML = "불만족";
                document.getElementById("cost_efct_star_img_1").style.backgroundPosition = "0 -50px";
                document.getElementById("cost_efct_star_img_2").style.backgroundPosition = "0 -50px";
                document.getElementById("cost_efct_star_img_3").style.backgroundPosition = "0 0";
                document.getElementById("cost_efct_star_img_4").style.backgroundPosition = "0 0";
                document.getElementById("cost_efct_star_img_5").style.backgroundPosition = "0 0";
                break;

            case 3:
                document.getElementById("cost_efct_star_text").innerHTML = "보통";
                document.getElementById("cost_efct_star_img_1").style.backgroundPosition = "0 -50px";
                document.getElementById("cost_efct_star_img_2").style.backgroundPosition = "0 -50px";
                document.getElementById("cost_efct_star_img_3").style.backgroundPosition = "0 -50px";
                document.getElementById("cost_efct_star_img_4").style.backgroundPosition = "0 0";
                document.getElementById("cost_efct_star_img_5").style.backgroundPosition = "0 0";
                break;

            case 4:
                document.getElementById("cost_efct_star_text").innerHTML = "만족";
                document.getElementById("cost_efct_star_img_1").style.backgroundPosition = "0 -50px";
                document.getElementById("cost_efct_star_img_2").style.backgroundPosition = "0 -50px";
                document.getElementById("cost_efct_star_img_3").style.backgroundPosition = "0 -50px";
                document.getElementById("cost_efct_star_img_4").style.backgroundPosition = "0 -50px";
                document.getElementById("cost_efct_star_img_5").style.backgroundPosition = "0 0";
                break;

            case 5:
                document.getElementById("cost_efct_star_text").innerHTML = "매우 만족";
                document.getElementById("cost_efct_star_img_1").style.backgroundPosition = "0 -50px";
                document.getElementById("cost_efct_star_img_2").style.backgroundPosition = "0 -50px";
                document.getElementById("cost_efct_star_img_3").style.backgroundPosition = "0 -50px";
                document.getElementById("cost_efct_star_img_4").style.backgroundPosition = "0 -50px";
                document.getElementById("cost_efct_star_img_5").style.backgroundPosition = "0 -50px";
                break;
        }

        // 학업 성취도
    } else if (group === 5) {

        switch (score) {

            case 1:
                document.getElementById("achievement_star_text").innerHTML = "매우 불만족";
                document.getElementById("achievement_star_img_1").style.backgroundPosition = "0 -50px";
                document.getElementById("achievement_star_img_2").style.backgroundPosition = "0 0";
                document.getElementById("achievement_star_img_3").style.backgroundPosition = "0 0";
                document.getElementById("achievement_star_img_4").style.backgroundPosition = "0 0";
                document.getElementById("achievement_star_img_5").style.backgroundPosition = "0 0";
                break;

            case 2:
                document.getElementById("achievement_star_text").innerHTML = "불만족";
                document.getElementById("achievement_star_img_1").style.backgroundPosition = "0 -50px";
                document.getElementById("achievement_star_img_2").style.backgroundPosition = "0 -50px";
                document.getElementById("achievement_star_img_3").style.backgroundPosition = "0 0";
                document.getElementById("achievement_star_img_4").style.backgroundPosition = "0 0";
                document.getElementById("achievement_star_img_5").style.backgroundPosition = "0 0";
                break;

            case 3:
                document.getElementById("achievement_star_text").innerHTML = "보통";
                document.getElementById("achievement_star_img_1").style.backgroundPosition = "0 -50px";
                document.getElementById("achievement_star_img_2").style.backgroundPosition = "0 -50px";
                document.getElementById("achievement_star_img_3").style.backgroundPosition = "0 -50px";
                document.getElementById("achievement_star_img_4").style.backgroundPosition = "0 0";
                document.getElementById("achievement_star_img_5").style.backgroundPosition = "0 0";
                break;

            case 4:
                document.getElementById("achievement_star_text").innerHTML = "만족";
                document.getElementById("achievement_star_img_1").style.backgroundPosition = "0 -50px";
                document.getElementById("achievement_star_img_2").style.backgroundPosition = "0 -50px";
                document.getElementById("achievement_star_img_3").style.backgroundPosition = "0 -50px";
                document.getElementById("achievement_star_img_4").style.backgroundPosition = "0 -50px";
                document.getElementById("achievement_star_img_5").style.backgroundPosition = "0 0";
                break;

            case 5:
                document.getElementById("achievement_star_text").innerHTML = "매우 만족";
                document.getElementById("achievement_star_img_1").style.backgroundPosition = "0 -50px";
                document.getElementById("achievement_star_img_2").style.backgroundPosition = "0 -50px";
                document.getElementById("achievement_star_img_3").style.backgroundPosition = "0 -50px";
                document.getElementById("achievement_star_img_4").style.backgroundPosition = "0 -50px";
                document.getElementById("achievement_star_img_5").style.backgroundPosition = "0 -50px";
                break;

        }

        // 작성하기 페이지 처음으로 셋팅
    } else if (group === 6) {
        
        document.getElementById("total_star_text").innerHTML = "";
        document.getElementById("facility_star_text").innerHTML = "";
        document.getElementById("acsbl_star_text").innerHTML = "";
        document.getElementById("teacher_star_text").innerHTML = "";
        document.getElementById("cost_efct_star_text").innerHTML = "";
        document.getElementById("achievement_star_text").innerHTML = "";

        for (i=1; i <= 5; i++) {

        document.getElementById("total_star_img_"+i).style.backgroundPosition = "0 -350px";
        document.getElementById("facility_star_img_"+i).style.backgroundPosition = "0 0";
        document.getElementById("acsbl_star_img_"+i).style.backgroundPosition = "0 0";
        document.getElementById("teacher_star_img_"+i).style.backgroundPosition = "0 0";
        document.getElementById("cost_efct_star_img_"+i).style.backgroundPosition = "0 0";
        document.getElementById("achievement_star_img_"+i).style.backgroundPosition = "0 0";
    }
    }
}

// 텍스트 길이를 구해 실시간으로 화면에 보여주는 함수
// 글자 길이 제한을 넘었을 때 1이 추가되는 것 수정함
function countTextLength(input) {

    switch (input) {

        case 1:
            var text = document.getElementById("one_line").value;
            document.getElementById("text_length_one_line").innerHTML = text.length;

            if (text.length === 81) {
                document.getElementById("text_length_one_line").innerHTML = 80;
            }
            break;

        case 2:
            var text = document.getElementById("benefit").value;
            document.getElementById("text_length_benefit").innerHTML = text.length;

            if (text.length === 251) {
                document.getElementById("text_length_one_line").innerHTML = 80;
            }
            break;

        case 3:
            var text = document.getElementById("drawback").value;
            document.getElementById("text_length_drawback").innerHTML = text.length;

            if (text.length === 251) {
                document.getElementById("text_length_one_line").innerHTML = 80;
            }
            break;

    }
}

// 학원을 선택했을 때 옆의 text 사라지기
function checkAcademy() {

    if (document.getElementById("acd_name").value === "") {
        document.getElementById("search_academy_check").innerHTML = "학원을 선택해 주세요.";
    }

}

///////////////////////////////////////////////////////////////////////////////////////////

// 등록하기 버튼을 눌렀을 때
function registReview() {

    if (document.getElementById("acd_name").value != "" &&
        document.getElementById("total_star_text").innerHTML != "" &&
        document.getElementById("one_line").value != "" &&
        document.getElementById("benefit").value != "" &&
        document.getElementById("drawback").value != "" &&
        document.getElementById("facility_star_text").innerHTML != "" &&
        document.getElementById("acsbl_star_text").innerHTML != "" &&
        document.getElementById("teacher_star_text").innerHTML != "" &&
        document.getElementById("cost_efct_star_text").innerHTML != "" &&
        document.getElementById("achievement_star_text").innerHTML != "") {

        if (document.getElementById("one_line").value.length < 20) {
            alert("한줄평은 20자 이상이어야 합니다.");
        } else if (document.getElementById("benefit").value.length < 30) {
            alert("장점은 30자 이상이어야 합니다.");

        } else if (document.getElementById("drawback").value.length < 30) {
            alert("단점은 30자 이상이어야 합니다.");

        } else {

            document.review_form.submit();
        }


    } else {
        alert("입력하지 않은 항목이 있습니다.");
    }

}

// 리뷰 삭제하기 버튼을 눌렀을 때
function deleteReview(review_no) {

    var deleteConf = confirm('리뷰를 삭제하시겠습니까?');

    if (deleteConf === true) {
        location.href = "/eduplanet/mypage/review_delete.php?no=" + review_no;

    } else {
        alert("삭제가 취소되었습니다.");
    }

}