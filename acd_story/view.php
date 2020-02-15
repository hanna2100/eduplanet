<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>에듀플래닛</title>

    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/eduplanet/acd_story/css/view.css">

</head>

<body>

    <div>
    <header>
        <?php include "../index_header_searchbar_in.php"; ?>
    </header>
    </div>

    <div class="body_wrap">

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

                        <div class="academy_small_star">
                            <img src="/eduplanet/img/review_star_one.png" alt="academy_small_star">
                            <span id="academt_review_star_score">3.2</span>
                        </div>
                    </a>

                    <button id="button_add_like" type="button" onclick="">찜하기</button>

                </div>
            </div>
        </div>

        <!-- 스토리 ------------------------------------------------------------------------------------------>

        <div class="story_academy_content_wrap">
            <div class="story_academy_content">

                <div class="story_academy_content_text">
                    <div class="story_academy_content_text_header">
                        <p id="story_mini_p">스토리</p>
                        <h1 id="story_text_title">코딩 8등급에서 1등급이 된 고양이</h1>
                        <p id="story_text_title_sub">저는 평생 코딩이 적성에 안맞는다고 생각했어요. 그런데...</p>
                    </div>

                    <div class="subtitle">자기소개</div>
                    <div class="description">안녕하세요. 저는 5개월된 고양이 보리라고 합니다. 저는 3개월 때 까지는 몸무게가 2키로도 안되고 코딩도 8등급이었지만 현재는 1등급을 유지하고 있답니다.</div>

                    <div class="story_content_image">
                        <img src="/eduplanet/test_img/story_content_image.png" alt="story_content_image">
                    </div>

                    <div class="subtitle">나만의 공부비법</div>
                    <div class="description">저는 항상 학원에서 한 것을 집에와서 사료를 먹고난 후 공부했습니다. 역시 고양이는 밥힘이죠. 여러분들도 밥을 챙겨 드시고 공부를 하세요. 뇌가 일을 하려면 충분한 영양공급이 중요합니다. 물론 츄르를 많이 먹어야하겠죠?</div>

                    <div class="subtitle">학원에 대해 한마디</div>
                    <div class="description">우리 학원에 대해서 말하자만, 지금 너무 졸려서 생각이 잘 안나요. 그렇지만 쉬는 시간에 아이스 아메리카노를 한 잔 사러 나가는게 유일한 낙이었답니다. 그리고 학원 앞에 편의점 아저씨가 무심하면서도 친절하셔서 좋았어요. 또한 중간중간 수업 시간에 배가 고플 때가 있었는데, 그 때 옆 자리 친구가 츄르를 나눠주었던 것이 가장 인상에 깊에 남습니다. 저는 이 학원을 추천합니다!</div>
                </div>
            </div>
        </div>

        <!-- 하단 다른 스토리 ----------------------------------------------------------------------------------------->

        <div class="academy_other_story_list_wrap">
            <div class="academy_other_story_list">

                <div class="content_title_wrap">
                    <h2 class="title">학원 스토리</h2>
                </div>

                <ul class="content_cource_unorder_list">
                    <li>
                        <div class="cource_column">
                            <a href="/eduplanet/acd_story/view.php">
                                <div class="cource_column_box">
                                    <div class="academy_img_box">
                                        <img src="/eduplanet/test_img/academy_box_img.jpg" alt="academy_img_box">
                                    </div>

                                    <div class="academy_introduce">
                                        <h3 id="academy_introduce_title">코딩 1등급에서 5등급이 된 고양이</h3>
                                        <p id="academy_introduce_content">저는 왜 등급이 내려갔죠...아무튼...모쪼록..클릭해 보세요</p>
                                    </div>

                                </div>
                            </a>
                        </div>
                    </li>

                    <span class="span_padding"></span>

                    <li>
                        <div class="cource_column">
                            <a href="/eduplanet/acd_story/view.php">
                                <div class="cource_column_box">
                                    <div class="academy_img_box">
                                        <img src="/eduplanet/test_img/academy_box_img.jpg" alt="academy_img_box">
                                    </div>

                                    <div class="academy_introduce">
                                        <h3 id="academy_introduce_title">코딩 1등급에서 5등급이 된 고양이</h3>
                                        <p id="academy_introduce_content">저는 왜 등급이 내려갔죠...아무튼...모쪼록..클릭해 보세요</p>
                                    </div>

                                </div>
                            </a>
                        </div>
                    </li>

                    <span class="span_padding"></span>

                    <li>
                        <div class="cource_column">
                            <a href="/eduplanet/acd_story/view.php">
                                <div class="cource_column_box">
                                    <div class="academy_img_box">
                                        <img src="/eduplanet/test_img/academy_box_img.jpg" alt="academy_img_box">
                                    </div>

                                    <div class="academy_introduce">
                                        <h3 id="academy_introduce_title">코딩 1등급에서 5등급이 된 고양이</h3>
                                        <p id="academy_introduce_content">저는 왜 등급이 내려갔죠...아무튼...모쪼록..클릭해 보세요</p>
                                    </div>

                                </div>
                            </a>
                        </div>
                    </li>

                    <span class="span_padding"></span>

                    <li>
                        <div class="cource_column">
                            <a href="/eduplanet/acd_story/view.php">
                                <div class="cource_column_box">
                                    <div class="academy_img_box">
                                        <img src="/eduplanet/test_img/academy_box_img.jpg" alt="academy_img_box">
                                    </div>

                                    <div class="academy_introduce">
                                        <h3 id="academy_introduce_title">코딩 1등급에서 5등급이 된 고양이</h3>
                                        <p id="academy_introduce_content">저는 왜 등급이 내려갔죠...아무튼...모쪼록..클릭해 보세요</p>
                                    </div>

                                </div>
                            </a>
                        </div>
                    </li>
                </ul>

            </div>
        </div>
    </div>

</body>

</html>