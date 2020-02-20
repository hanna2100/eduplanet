<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>에듀플래닛</title>

    <script src="http://code.jquery.com/jquery-1.12.4.min.js" charset="utf-8"></script>
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/eduplanet/mypage/css/review_write.css">

    <script>
        $(document).ready(function() {

            // 리뷰 작성 버튼을 눌렀을 때    
            $("#review_write").click(function() {
                showPopup(this);
            });

            // 닫기 버튼을 눌렀을 때
            $("#button_close_popup").click(function(e) {
                e.preventDefault();
                closePopup();
            });

        });

        // 팝업 보여주기 함수
        function showPopup(parameter) {
            $("#popup_wrap, #popup_content").show();
            setPopupPos("#popup_content");
            // scrollMove("#popup_content", 400);
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
    </script>

    <script>
        function totalStarSetting(score) {

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
        }

        function countTextLength(input) {

            switch (input) {

                case 1:
                    var text = document.getElementById("one_line").value;
                    document.getElementById("text_length_one_line").innerHTML = text.length;

                    if
                    break;

                case 2:
                    var text = document.getElementById("benefit").value;
                    document.getElementById("text_length_benefit").innerHTML = text.length;
                    break;

                case 3:
                    var text = document.getElementById("drawback").value;
                    document.getElementById("text_length_drawback").innerHTML = text.length;
                    break;

            }



        }
    </script>


</head>

<body>

    <form name="review_form" action="/eduplanet/mypage/review_insert.php" method="post">

        <div id="popup_wrap" class="popup_body_wrap"></div>

        <div id="popup_content">

            <div class="review_write">

                <div class="review_write_header">
                    <span>학원리뷰 작성</span>
                    <img src="/eduplanet/img/close_icon.png" id="button_close_popup">
                </div>

                <div class="review_write_content">
                    <p>작성을 완료하시면 모든 학원의 리뷰를 보실 수 있습니다.</p>
                    <p>입력하신 모든 정보는 <b>익명</b>으로 처리됩니다.</p>

                    <!-- 학원명 선택 자동완성 구현하기 -->
                    <div class="search_academy">
                        <div class="review_subject">
                            <p>학원명</p>
                        </div>

                        <div class="review_input_content">
                            <input type="text" id="acd_name" name="acd_name">
                            <span class="search_academy_check">학원을 선택해 주세요.</span>
                        </div>
                    </div>

                    <!-- 총 만족도 별점 -->
                    <div class="review_total_star">
                        <div class="review_subject">
                            <p>총 만족도</p>
                        </div>

                        <div class="review_input_content">
                            <div class="total_star_wrap">
                                <img id="total_star_img_1">
                                <input type="radio" id="total_star_1" name="total_star" value="1" onclick="totalStarSetting(1);">
                            </div>

                            <div class="total_star_wrap">
                                <img id="total_star_img_2">
                                <input type="radio" id="total_star_2" name="total_star" value="2" onclick="totalStarSetting(2);">
                            </div>

                            <div class="total_star_wrap">
                                <img id="total_star_img_3">
                                <input type="radio" id="total_star_3" name="total_star" value="3" onclick="totalStarSetting(3);">
                            </div>

                            <div class="total_star_wrap">
                                <img id="total_star_img_4">
                                <input type="radio" id="total_star_4" name="total_star" value="4" onclick="totalStarSetting(4);">
                            </div>

                            <div class="total_star_wrap">
                                <img id="total_star_img_5">
                                <input type="radio" id="total_star_5" name="total_star" value="5" onclick="totalStarSetting(5);">
                            </div>

                            <span id="total_star_text"></span>
                        </div>
                    </div>



                    <!-- 한줄평 -->
                    <div class="review_one_line">
                        <div class="review_subject">
                            <p>한줄평</p>
                            <span>최소 20자</span>
                        </div>

                        <div class="review_input_content">
                            <textarea name="one_line" id="one_line" cols="30" rows="8" maxlength="80" onkeyup="countTextLength(1);"></textarea>
                            
                            <div class="count_text_span">
                                <span><span id="text_length_one_line">0</span> / 80</span>
                            </div>
                        </div>
                    </div>

                    <!-- 장점 -->
                    <div class="review_benefit">
                        <div class="review_subject">
                            <p>장점</p>
                            <span>최소 30자</span>
                        </div>

                        <div class="review_input_content">
                            <textarea name="benefit" id="benefit" cols="30" rows="8" maxlength="250" onkeyup="countTextLength(2);"></textarea>
                            <div class="count_text_span">
                                <span><span id="text_length_benefit">0</span> / 250</span>
                            </div>
                        </div>
                    </div>

                    <!-- 단점 -->
                    <div class="review_drawback">
                        <div class="review_subject">
                            <p>단점</p>
                            <span>최소 30자</span>
                        </div>

                        <div class="review_input_content">
                            <textarea name="drawback" id="drawback" cols="30" rows="8" maxlength="250" onkeyup="countTextLength(3);"></textarea>
                            <div class="count_text_span">
                                <span><span id="text_length_drawback">0</span> / 250</span>
                            </div>
                        </div>
                    </div>

                    <!-- 시설 별점 -->
                    <div class="review_star_facility">

                    </div>

                    <!-- 교통편리성 별점 -->
                    <div class="review_star_facility">

                    </div>

                    <!-- 강사 별점 -->
                    <div class="review_star_facility">

                    </div>

                    <!-- 수강료 만족도 별점 -->
                    <div class="review_star_facility">

                    </div>

                    <!-- 학업성취도 별점 -->
                    <div class="review_star_facility">

                    </div>

                </div>

            </div>



        </div>



    </form>
</body>

</html>