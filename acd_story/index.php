<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>에듀플래닛</title>

    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/eduplanet/acd_story/css/index.css">

</head>

<body>

    <header>
        <?php include "../index_header_searchbar_out.php"; ?>
    </header>

    <div class="story_list_wrap">
        <div class="story_list_background">

            <!-- select box -------------------------------------------------------------------------------------->
            <div class="story_list_select">

                <h2>
                    학원 스토리
                    <button id="button_write_story" onclick="location.href='/eduplanet/acd_story/post.php'">스토리 등록</button>
                </h2>
                <span id="story_total_span">총 <span id="story_total_num">1024</span> 개의 스토리가 있습니다.</span>

                <select name="story_list_select_district" id="story_list_select_district">
                    <option selected>시/군 선택</option>
                    <option value="district_01">가평군</option>
                    <option value="district_02">고양시</option>
                    <option value="district_03">과천시</option>
                    <option value="district_04">광명시</option>
                    <option value="district_05">광주시</option>
                    <option value="district_06">구리시</option>
                    <option value="district_07">군포시</option>
                    <option value="district_08">김포시</option>
                    <option value="district_09">남양주시</option>
                    <option value="district_10">동두천시</option>
                    <option value="district_11">부천시</option>
                    <option value="district_12">성남시</option>
                    <option value="district_13">수원시</option>
                    <option value="district_14">시흥시</option>
                    <option value="district_15">안산시</option>
                    <option value="district_16">안성시</option>
                    <option value="district_17">안양시</option>
                    <option value="district_18">양주시</option>
                    <option value="district_19">양평군</option>
                    <option value="district_20">여주시</option>
                    <option value="district_21">연천군</option>
                    <option value="district_22">오산시</option>
                    <option value="district_23">용인시</option>
                    <option value="district_24">의왕시</option>
                    <option value="district_25">의정부시</option>
                    <option value="district_26">이천시</option>
                    <option value="district_27">파주시</option>
                    <option value="district_28">평택시</option>
                    <option value="district_29">포천시</option>
                    <option value="district_30">하남시</option>
                    <option value="district_31">화성시</option>
                </select>

                <select name="story_list_select_mode" id="story_list_select_mode">
                    <option value="star_max">총 만족도 순</option>
                    <option value="hit_max">조회수 순</option>
                    <option value="hit_max">최근 등록 순</option>
                </select>
            </div>

            <!-- start of ul ------------------------------------------------------------------------------------->
            <ul class="story_unorder_list">

                <li>
                    <!-- 하나의 스토리 컬럼 -->
                    <div class="story_list_column">

                        <a href="/eduplanet/acd_story/view.php">
                            <div class="story_list_column_img">
                                <img src="/eduplanet/test_img/story_content_image.png" alt="story_list_column_img">
                            </div>

                            <div class="story_list_column_text">
                                <h1 id="story_text_title">코딩 8등급에서 1등급이 된 고양이
                        </a>

                        <div class="story_academy_heart">
                            <span>학원 찜하기</span>
                            <button id="button_academy_heart">like</button>
                        </div>

                        </h1>
                        <p id="story_text_title_sub">저는 평생 코딩이 적성에 안맞는다고 생각했어요. 그런데...</p>

                        <div class="story_list_column_academy_info">
                            <span id="academy_title_span">고양이사료개발학원</span>
                            <span id="academy_district">고양시</span>

                            <div class="academy_small_star">
                                <img src="/eduplanet/img/review_star_one.png" alt="academy_small_star">
                                <span id="academt_review_star_score">3.2</span>
                            </div>
                        </div>
                    </div>
        </div>
        </li>

        <li>
            <!-- 하나의 스토리 컬럼 -->
            <div class="story_list_column">

                <a href="/eduplanet/acd_story/view.php">
                    <div class="story_list_column_img">
                        <img src="/eduplanet/test_img/story_content_image.png" alt="story_list_column_img">
                    </div>

                    <div class="story_list_column_text">
                        <h1 id="story_text_title">코딩 8등급에서 1등급이 된 고양이
                </a>

                <div class="story_academy_heart">
                    <span>학원 찜하기</span>
                    <button id="button_academy_heart">like</button>
                </div>

                </h1>
                <p id="story_text_title_sub">저는 평생 코딩이 적성에 안맞는다고 생각했어요. 그런데...</p>

                <div class="story_list_column_academy_info">
                    <span id="academy_title_span">고양이사료개발학원</span>
                    <span id="academy_district">고양시</span>

                    <div class="academy_small_star">
                        <img src="/eduplanet/img/review_star_one.png" alt="academy_small_star">
                        <span id="academt_review_star_score">3.2</span>
                    </div>
                </div>
            </div>
    </div>
    </li>

    <li>
        <!-- 하나의 스토리 컬럼 -->
        <div class="story_list_column">

            <a href="/eduplanet/acd_story/view.php">
                <div class="story_list_column_img">
                    <img src="/eduplanet/test_img/story_content_image.png" alt="story_list_column_img">
                </div>

                <div class="story_list_column_text">
                    <h1 id="story_text_title">코딩 8등급에서 1등급이 된 고양이
            </a>

            <div class="story_academy_heart">
                <span>학원 찜하기</span>
                <button id="button_academy_heart">like</button>
            </div>

            </h1>
            <p id="story_text_title_sub">저는 평생 코딩이 적성에 안맞는다고 생각했어요. 그런데...</p>

            <div class="story_list_column_academy_info">
                <span id="academy_title_span">고양이사료개발학원</span>
                <span id="academy_district">고양시</span>

                <div class="academy_small_star">
                    <img src="/eduplanet/img/review_star_one.png" alt="academy_small_star">
                    <span id="academt_review_star_score">3.2</span>
                </div>
            </div>
        </div>
        </div>
    </li>

    <li>
        <!-- 하나의 스토리 컬럼 -->
        <div class="story_list_column">

            <a href="/eduplanet/acd_story/view.php">
                <div class="story_list_column_img">
                    <img src="/eduplanet/test_img/story_content_image.png" alt="story_list_column_img">
                </div>

                <div class="story_list_column_text">
                    <h1 id="story_text_title">코딩 8등급에서 1등급이 된 고양이
            </a>

            <div class="story_academy_heart">
                <span>학원 찜하기</span>
                <button id="button_academy_heart">like</button>
            </div>

            </h1>
            <p id="story_text_title_sub">저는 평생 코딩이 적성에 안맞는다고 생각했어요. 그런데...</p>

            <div class="story_list_column_academy_info">
                <span id="academy_title_span">고양이사료개발학원</span>
                <span id="academy_district">고양시</span>

                <div class="academy_small_star">
                    <img src="/eduplanet/img/review_star_one.png" alt="academy_small_star">
                    <span id="academt_review_star_score">3.2</span>
                </div>
            </div>
        </div>
        </div>
    </li>

    <li>
        <!-- 하나의 스토리 컬럼 -->
        <div class="story_list_column">

            <a href="/eduplanet/acd_story/view.php">
                <div class="story_list_column_img">
                    <img src="/eduplanet/test_img/story_content_image.png" alt="story_list_column_img">
                </div>

                <div class="story_list_column_text">
                    <h1 id="story_text_title">코딩 8등급에서 1등급이 된 고양이
            </a>

            <div class="story_academy_heart">
                <span>학원 찜하기</span>
                <button id="button_academy_heart">like</button>
            </div>

            </h1>
            <p id="story_text_title_sub">저는 평생 코딩이 적성에 안맞는다고 생각했어요. 그런데...</p>

            <div class="story_list_column_academy_info">
                <span id="academy_title_span">고양이사료개발학원</span>
                <span id="academy_district">고양시</span>

                <div class="academy_small_star">
                    <img src="/eduplanet/img/review_star_one.png" alt="academy_small_star">
                    <span id="academt_review_star_score">3.2</span>
                </div>
            </div>
        </div>
        </div>
    </li>

    <li>
        <!-- 하나의 스토리 컬럼 -->
        <div class="story_list_column">

            <a href="/eduplanet/acd_story/view.php">
                <div class="story_list_column_img">
                    <img src="/eduplanet/test_img/story_content_image.png" alt="story_list_column_img">
                </div>

                <div class="story_list_column_text">
                    <h1 id="story_text_title">코딩 8등급에서 1등급이 된 고양이
            </a>

            <div class="story_academy_heart">
                <span>학원 찜하기</span>
                <button id="button_academy_heart">like</button>
            </div>

            </h1>
            <p id="story_text_title_sub">저는 평생 코딩이 적성에 안맞는다고 생각했어요. 그런데...</p>

            <div class="story_list_column_academy_info">
                <span id="academy_title_span">고양이사료개발학원</span>
                <span id="academy_district">고양시</span>

                <div class="academy_small_star">
                    <img src="/eduplanet/img/review_star_one.png" alt="academy_small_star">
                    <span id="academt_review_star_score">3.2</span>
                </div>
            </div>
        </div>
        </div>
    </li>

    <li>
        <!-- 하나의 스토리 컬럼 -->
        <div class="story_list_column">

            <a href="/eduplanet/acd_story/view.php">
                <div class="story_list_column_img">
                    <img src="/eduplanet/test_img/story_content_image.png" alt="story_list_column_img">
                </div>

                <div class="story_list_column_text">
                    <h1 id="story_text_title">코딩 8등급에서 1등급이 된 고양이
            </a>

            <div class="story_academy_heart">
                <span>학원 찜하기</span>
                <button id="button_academy_heart">like</button>
            </div>

            </h1>
            <p id="story_text_title_sub">저는 평생 코딩이 적성에 안맞는다고 생각했어요. 그런데...</p>

            <div class="story_list_column_academy_info">
                <span id="academy_title_span">고양이사료개발학원</span>
                <span id="academy_district">고양시</span>

                <div class="academy_small_star">
                    <img src="/eduplanet/img/review_star_one.png" alt="academy_small_star">
                    <span id="academt_review_star_score">3.2</span>
                </div>
            </div>
        </div>
        </div>
    </li>

    <li>
        <!-- 하나의 스토리 컬럼 -->
        <div class="story_list_column">

            <a href="/eduplanet/acd_story/view.php">
                <div class="story_list_column_img">
                    <img src="/eduplanet/test_img/story_content_image.png" alt="story_list_column_img">
                </div>

                <div class="story_list_column_text">
                    <h1 id="story_text_title">코딩 8등급에서 1등급이 된 고양이
            </a>

            <div class="story_academy_heart">
                <span>학원 찜하기</span>
                <button id="button_academy_heart">like</button>
            </div>

            </h1>
            <p id="story_text_title_sub">저는 평생 코딩이 적성에 안맞는다고 생각했어요. 그런데...</p>

            <div class="story_list_column_academy_info">
                <span id="academy_title_span">고양이사료개발학원</span>
                <span id="academy_district">고양시</span>

                <div class="academy_small_star">
                    <img src="/eduplanet/img/review_star_one.png" alt="academy_small_star">
                    <span id="academt_review_star_score">3.2</span>
                </div>
            </div>
        </div>
        </div>
    </li>

    <li>
        <!-- 하나의 스토리 컬럼 -->
        <div class="story_list_column">

            <a href="/eduplanet/acd_story/view.php">
                <div class="story_list_column_img">
                    <img src="/eduplanet/test_img/story_content_image.png" alt="story_list_column_img">
                </div>

                <div class="story_list_column_text">
                    <h1 id="story_text_title">코딩 8등급에서 1등급이 된 고양이
            </a>

            <div class="story_academy_heart">
                <span>학원 찜하기</span>
                <button id="button_academy_heart">like</button>
            </div>

            </h1>
            <p id="story_text_title_sub">저는 평생 코딩이 적성에 안맞는다고 생각했어요. 그런데...</p>

            <div class="story_list_column_academy_info">
                <span id="academy_title_span">고양이사료개발학원</span>
                <span id="academy_district">고양시</span>

                <div class="academy_small_star">
                    <img src="/eduplanet/img/review_star_one.png" alt="academy_small_star">
                    <span id="academt_review_star_score">3.2</span>
                </div>
            </div>
        </div>
        </div>
    </li>

    <li>
        <!-- 하나의 스토리 컬럼 -->
        <div class="story_list_column">

            <a href="/eduplanet/acd_story/view.php">
                <div class="story_list_column_img">
                    <img src="/eduplanet/test_img/story_content_image.png" alt="story_list_column_img">
                </div>

                <div class="story_list_column_text">
                    <h1 id="story_text_title">코딩 8등급에서 1등급이 된 고양이
            </a>

            <div class="story_academy_heart">
                <span>학원 찜하기</span>
                <button id="button_academy_heart">like</button>
            </div>

            </h1>
            <p id="story_text_title_sub">저는 평생 코딩이 적성에 안맞는다고 생각했어요. 그런데...</p>

            <div class="story_list_column_academy_info">
                <span id="academy_title_span">고양이사료개발학원</span>
                <span id="academy_district">고양시</span>

                <div class="academy_small_star">
                    <img src="/eduplanet/img/review_star_one.png" alt="academy_small_star">
                    <span id="academt_review_star_score">3.2</span>
                </div>
            </div>
        </div>
        </div>
    </li>

    </ul>
    <!-- end of ul ------------------------------------------------------------------>

    <div class="page_num_wrap">
        <div class="page_num">
            <a href="#"><span class="page_num_direction">
                    <<</span> </a> <a href="#"><span class="page_num_direction">
                            <</span> </a> <a href="#"><span class="page_num_set">1</span></a>
            <a href="#"><span class="page_num_set">2</span></a>
            <a href="#"><span class="page_num_set">3</span></a>
            <a href="#"><span class="page_num_set">4</span></a>
            <a href="#"><span class="page_num_set">5</span></a>
            <a href="#"><span class="page_num_direction">></span></a>
            <a href="#"><span class="page_num_direction_last">>></span></a>
        </div>
    </div>



    </div>

    </div>
</body>

</html>