<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>에듀플래닛</title>

    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/eduplanet/acd_story/css/post.css">

    <script src="./js/post.js"></script>

</head>

<body>


    <header>
        <?php include "../index_header_searchbar_in.php"; ?>
    </header>

    <?php

    // 세션값으로 학원id를 받아서 학원명, 지역 조회 후 상단에 보여주기

    ?>

    <!-- 상단 fixed 타이틀바 ------------------------------------------------------------------------------>
    <div class="story_academy_title_wrap">

        <div class="story_academy_title">

            <!-- 1. 로고이미지 & 학원 이름 -->
            <div class="cource_column_title">

                <a href="#">
                    <div class="academy_small_logo">
                        <!-- small logo 이미지는 32x32 만 가능하도록 하기 -->
                        <img src="/eduplanet/test_img/academy_small_logo.png" alt="academy_small_logo">
                    </div>

                    <span id="academy_title_span">고양이사료개발학원</span>
                    <span id="academy_category">미술</span>

                    <!-- <div class="academy_small_star">
                            <img src="/eduplanet/img/review_star_one.png" alt="academy_small_star">
                            <span id="academt_review_star_score">3.2</span>
                        </div> -->
                </a>

                <!-- <button id="button_add_like" type="button" onclick="">찜하기</button> -->

            </div>
        </div>
    </div>



    <div class="post_wrap">

        <!-- 스토리 작성 ------------------------------------------------------------------------------------------>

        <form name="story_post_form" action="/eduplanet/acd_story/post_insert.php" method="post" enctype="multipart/form-data">

            <div class="story_academy_content_wrap">

                <div class="story_academy_blue_header">
                    <p id="story_mini_p">스토리 등록</p>
                </div>

                <div class="story_academy_content">
                    <div class="story_academy_content_text">
                        <div id="story_academy_html">
                            <div class="story_academy_content_text_header">

                                <div class="story_post_wrap_titles">

                                    <label for="story_post_title">제목</label>
                                    <span id="story_post_title_check" class="story_post_input_check"></span>
                                    <input id="story_post_title" name="story_post_title" type="text" placeholder="제목을 입력해 주세요." onkeyup="checkInputTitle();">

                                    <label for="story_post_content">소제목</label>
                                    <span id="story_post_content_check" class="story_post_input_check"></span>
                                    <input id="story_post_content" name="story_post_content" type="text" placeholder="소제목을 입력해 주세요." onkeyup="checkInputContent();">

                                </div>

                            </div>

                            <div class="story_content_image">

                                <label id="story_post_img_label" for="story_post_img">사진 (필수)</label>
                                <span id="story_post_img_check" class="story_post_input_check"></span>
                                <input type="file" id="upfile" name="upfile" onchange="checkInputImg();">

                            </div>

                            <hr class="hr_bar">

                            <div class="story_post_add_subject">
                                <span><b>* 주제는 총 3개까지 추가하실 수 있습니다.</b></span>
                                <button type="button" id="button_story_post_add_subject" onclick="storyPostAddSubject();">추가</button>
                            </div>

                            <div class="story_post_wrap">
                                <label for="story_post_subtitle_1">주제</label>
                                <span id="story_post_subtitle_1_check" class="story_post_input_check"></span>
                                <input id="story_post_subtitle_1" name="story_post_subtitle_1" type="text" placeholder="ex ) 자기소개" onkeyup="checkInputSubtitle1();">

                                <label for="story_post_description_1">내용</label>
                                <span id="story_post_description_1_check" class="story_post_input_check"></span>
                                <textarea id="story_post_description_1" name="story_post_description_1" type="text" placeholder="내용을 입력해 주세요." onkeyup="checkInputDescription1();"></textarea>
                            </div>

                            <!-- <div class="story_post_wrap">
                            <label id="story_post_subtitle_2_label" for="story_post_subtitle_2">주제</label>
                            <span id="story_post_subtitle_2_check" class="story_post_input_check"></span>
                            <input id="story_post_subtitle_2" name="story_post_subtitle_2" type="text" placeholder="ex ) 공부비법 / 강의비법" onkeyup="checkInputSubtitle2();">

                            <label for="story_post_description_2">내용</label>
                            <span id="story_post_description_2_check" class="story_post_input_check"></span>
                            <textarea id="story_post_description_2" name="story_post_description_2" type="text" placeholder="내용을 입력해 주세요." onkeyup="checkInputDescription2();"></textarea>
                        </div> -->

                            <!-- <div class="story_post_wrap">
                            <label for="story_post_subtitle_3">주제</label>
                            <span id="story_post_subtitle_3_check" class="story_post_input_check"></span>
                            <input id="story_post_subtitle_3" name="story_post_subtitle_3" type="text" placeholder="ex ) 마지막으로 한마디" onkeyup="checkInputSubtitle3();">

                            <label for="story_post_description_3">내용</label>
                            <span id="story_post_description_3_check" class="story_post_input_check"></span>
                            <textarea id="story_post_description_3" name="story_post_description_3" type="text" placeholder="내용을 입력해 주세요." onkeyup="checkInputDescription3();"></textarea>
                        </div> -->

                        </div>

                        <button type="button" id="button_story_post_submit" onclick="checkInput();">작성완료</button>

                    </div>
                </div>
            </div>

    </div>

    </div>
    </form>

    <footer>
        <?php include "../footer.php"; ?>
    </footer>

</body>

</html>