<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>에듀플래닛</title>

    <!-- 제이쿼리 -->
    <script src="http://code.jquery.com/jquery-1.12.4.min.js" charset="utf-8"></script>

    <!-- 자동완성 -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    
    <!-- 폰트 -->
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR&amp;display=swap" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="/eduplanet/mypage/css/review_write_popup.css">

    <!-- 스크립트 -->
    <script src="/eduplanet/mypage/js/review_write.js"></script>

</head>

<body>

    <form name="review_form" action="/eduplanet/mypage/review_insert.php" method="post">

        <div id="popup_wrap" class="popup_body_wrap"></div>

        <div id="popup_content">

            <div class="review_write">

                <div class="review_write_header">
                    <span id="review_write_header_title">학원리뷰 작성</span>
                    <img src="/eduplanet/img/close_icon.png" id="button_close_popup">
                </div>

                <div class="review_write_content">
                    <p class="review_write_content_p">작성을 완료하시면 모든 학원의 리뷰를 보실 수 있습니다.</p>
                    <p class="review_write_content_p">입력하신 모든 정보는 <b>익명</b>으로 처리됩니다.</p>

                    <!-- 학원명 선택 자동완성 구현하기 -->
                    <div class="search_academy">
                        <div class="review_subject_search">
                            <p>학원명</p>
                        </div>

                        <div class="review_input_content_search">
                            <input type="text" id="acd_name" name="acd_name" onchange="checkAcademy();">
                            <input type="hidden" id="si_name" name="si_name">
                            <input type="hidden" id="dong_name" name="dong_name">
                            <span id="search_academy_check">학원을 선택해 주세요.</span>
                        </div>
                    </div>

                    <!-- 총 만족도 별점 -->
                    <div class="review_total_star">
                        <div class="review_subject">
                            <p>총 만족도</p>
                        </div>

                        <div class="review_input_content">
                            <div class="total_star_wrap">
                                <img id="total_star_img_1" src="/eduplanet/img/background_none.png">
                                <input type="radio" id="total_star_1" name="total_star" value="1" onclick="reviewStarSetting(0,1);">
                            </div>

                            <div class="total_star_wrap">
                                <img id="total_star_img_2" src="/eduplanet/img/background_none.png">
                                <input type="radio" id="total_star_2" name="total_star" value="2" onclick="reviewStarSetting(0,2);">
                            </div>

                            <div class="total_star_wrap">
                                <img id="total_star_img_3" src="/eduplanet/img/background_none.png">
                                <input type="radio" id="total_star_3" name="total_star" value="3" onclick="reviewStarSetting(0,3);">
                            </div>

                            <div class="total_star_wrap">
                                <img id="total_star_img_4" src="/eduplanet/img/background_none.png">
                                <input type="radio" id="total_star_4" name="total_star" value="4" onclick="reviewStarSetting(0,4);">
                            </div>

                            <div class="total_star_wrap">
                                <img id="total_star_img_5" src="/eduplanet/img/background_none.png">
                                <input type="radio" id="total_star_5" name="total_star" value="5" onclick="reviewStarSetting(0,5);">
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

                    <!-- 시설 만족도 별점 -->
                    <div class="review_star_facility">
                        <div class="review_subject_star">
                            <p>시설 만족도</p>
                        </div>

                        <div class="review_input_content_star">
                            <div class="facility_star_wrap">
                                <img id="facility_star_img_1" src="/eduplanet/img/background_none.png">
                                <input type="radio" id="facility_star_1" name="facility_star" value="1" onclick="reviewStarSetting(1,1);">
                            </div>

                            <div class="facility_star_wrap">
                                <img id="facility_star_img_2" src="/eduplanet/img/background_none.png">
                                <input type="radio" id="facility_star_2" name="facility_star" value="2" onclick="reviewStarSetting(1,2);">
                            </div>

                            <div class="facility_star_wrap">
                                <img id="facility_star_img_3" src="/eduplanet/img/background_none.png">
                                <input type="radio" id="facility_star_3" name="facility_star" value="3" onclick="reviewStarSetting(1,3);">
                            </div>

                            <div class="facility_star_wrap">
                                <img id="facility_star_img_4" src="/eduplanet/img/background_none.png">
                                <input type="radio" id="facility_star_4" name="facility_star" value="4" onclick="reviewStarSetting(1,4);">
                            </div>

                            <div class="facility_star_wrap">
                                <img id="facility_star_img_5" src="/eduplanet/img/background_none.png">
                                <input type="radio" id="facility_star_5" name="facility_star" value="5" onclick="reviewStarSetting(1,5);">
                            </div>

                            <span id="facility_star_text"></span>
                        </div>
                    </div>

                    <!-- 교통 편의성 별점 -->
                    <div class="review_star_acsbl">
                        <div class="review_subject_star">
                            <p>교통 편의성</p>
                        </div>

                        <div class="review_input_content_star">
                            <div class="acsbl_star_wrap">
                                <img id="acsbl_star_img_1" src="/eduplanet/img/background_none.png">
                                <input type="radio" id="acsbl_star_1" name="acsbl_star" value="1" onclick="reviewStarSetting(2,1);">
                            </div>

                            <div class="acsbl_star_wrap">
                                <img id="acsbl_star_img_2" src="/eduplanet/img/background_none.png">
                                <input type="radio" id="acsbl_star_2" name="acsbl_star" value="2" onclick="reviewStarSetting(2,2);">
                            </div>

                            <div class="acsbl_star_wrap">
                                <img id="acsbl_star_img_3" src="/eduplanet/img/background_none.png">
                                <input type="radio" id="acsbl_star_3" name="acsbl_star" value="3" onclick="reviewStarSetting(2,3);">
                            </div>

                            <div class="acsbl_star_wrap">
                                <img id="acsbl_star_img_4" src="/eduplanet/img/background_none.png">
                                <input type="radio" id="acsbl_star_4" name="acsbl_star" value="4" onclick="reviewStarSetting(2,4);">
                            </div>

                            <div class="acsbl_star_wrap">
                                <img id="acsbl_star_img_5" src="/eduplanet/img/background_none.png">
                                <input type="radio" id="acsbl_star_5" name="acsbl_star" value="5" onclick="reviewStarSetting(2,5);">
                            </div>

                            <span id="acsbl_star_text"></span>
                        </div>
                    </div>

                    <!-- 강사 만족도 별점 -->
                    <div class="review_star_teacher">
                        <div class="review_subject_star">
                            <p>강사 만족도</p>
                        </div>

                        <div class="review_input_content_star">
                            <div class="teacher_star_wrap">
                                <img id="teacher_star_img_1" src="/eduplanet/img/background_none.png">
                                <input type="radio" id="teacher_star_1" name="teacher_star" value="1" onclick="reviewStarSetting(3,1);">
                            </div>

                            <div class="teacher_star_wrap">
                                <img id="teacher_star_img_2" src="/eduplanet/img/background_none.png">
                                <input type="radio" id="teacher_star_2" name="teacher_star" value="2" onclick="reviewStarSetting(3,2);">
                            </div>

                            <div class="teacher_star_wrap">
                                <img id="teacher_star_img_3" src="/eduplanet/img/background_none.png">
                                <input type="radio" id="teacher_star_3" name="teacher_star" value="3" onclick="reviewStarSetting(3,3);">
                            </div>

                            <div class="teacher_star_wrap">
                                <img id="teacher_star_img_4" src="/eduplanet/img/background_none.png">
                                <input type="radio" id="teacher_star_4" name="teacher_star" value="4" onclick="reviewStarSetting(3,4);">
                            </div>

                            <div class="teacher_star_wrap">
                                <img id="teacher_star_img_5" src="/eduplanet/img/background_none.png">
                                <input type="radio" id="teacher_star_5" name="teacher_star" value="5" onclick="reviewStarSetting(3,5);">
                            </div>

                            <span id="teacher_star_text"></span>
                        </div>
                    </div>

                    <!-- 수강료 만족도 별점 -->
                    <div class="review_star_cost_efct">
                        <div class="review_subject_star">
                            <p>수강료 만족도</p>
                        </div>

                        <div class="review_input_content_star">
                            <div class="cost_efct_star_wrap">
                                <img id="cost_efct_star_img_1" src="/eduplanet/img/background_none.png">
                                <input type="radio" id="cost_efct_star_1" name="cost_efct_star" value="1" onclick="reviewStarSetting(4,1);">
                            </div>

                            <div class="cost_efct_star_wrap">
                                <img id="cost_efct_star_img_2" src="/eduplanet/img/background_none.png">
                                <input type="radio" id="cost_efct_star_2" name="cost_efct_star" value="2" onclick="reviewStarSetting(4,2);">
                            </div>

                            <div class="cost_efct_star_wrap">
                                <img id="cost_efct_star_img_3" src="/eduplanet/img/background_none.png">
                                <input type="radio" id="cost_efct_star_3" name="cost_efct_star" value="3" onclick="reviewStarSetting(4,3);">
                            </div>

                            <div class="cost_efct_star_wrap">
                                <img id="cost_efct_star_img_4" src="/eduplanet/img/background_none.png">
                                <input type="radio" id="cost_efct_star_4" name="cost_efct_star" value="4" onclick="reviewStarSetting(4,4);">
                            </div>

                            <div class="cost_efct_star_wrap">
                                <img id="cost_efct_star_img_5" src="/eduplanet/img/background_none.png">
                                <input type="radio" id="cost_efct_star_5" name="cost_efct_star" value="5" onclick="reviewStarSetting(4,5);">
                            </div>

                            <span id="cost_efct_star_text"></span>
                        </div>
                    </div>

                    <!-- 학업 성취도 별점 -->
                    <div class="review_star_achievement">
                        <div class="review_subject_star">
                            <p>학업 성취도</p>
                        </div>

                        <div class="review_input_content_star">
                            <div class="achievement_star_wrap">
                                <img id="achievement_star_img_1" src="/eduplanet/img/background_none.png">
                                <input type="radio" id="achievement_star_1" name="achievement_star" value="1" onclick="reviewStarSetting(5,1);">
                            </div>

                            <div class="achievement_star_wrap">
                                <img id="achievement_star_img_2" src="/eduplanet/img/background_none.png">
                                <input type="radio" id="achievement_star_2" name="achievement_star" value="2" onclick="reviewStarSetting(5,2);">
                            </div>

                            <div class="achievement_star_wrap">
                                <img id="achievement_star_img_3" src="/eduplanet/img/background_none.png">
                                <input type="radio" id="achievement_star_3" name="achievement_star" value="3" onclick="reviewStarSetting(5,3);">
                            </div>

                            <div class="achievement_star_wrap">
                                <img id="achievement_star_img_4" src="/eduplanet/img/background_none.png">
                                <input type="radio" id="achievement_star_4" name="achievement_star" value="4" onclick="reviewStarSetting(5,4);">
                            </div>

                            <div class="achievement_star_wrap">
                                <img id="achievement_star_img_5" src="/eduplanet/img/background_none.png">
                                <input type="radio" id="achievement_star_5" name="achievement_star" value="5" onclick="reviewStarSetting(5,5);">
                            </div>

                            <span id="achievement_star_text"></span>
                        </div>
                    </div>
                </div>

                <div class="review_write_footer">
                    <button type="button" id="button_submit_review" onclick="registReview();">등록하기</button>
                </div>


            </div>
        </div>

    </form>

</body>

</html>