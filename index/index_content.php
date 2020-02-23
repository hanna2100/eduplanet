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

    <!-- css -->
    <link rel="stylesheet" href="/eduplanet/index/index_content.css">

    <!-- 스크립트 -->
    <script src="/eduplanet/searchbar/searchbar_index.js"></script>


</head>

<body>

    <div class="body_wrap">

        <!-- 메인 상단 배경 ------------------------------------------------------>
        <div class="index_main_background">

            <!-- <h2 class="index_title">EDU PLANET</h2> -->
            <h2 class="index_title">
                <div class="index_title_logo_img">
                    <img src="/eduplanet/img/eduplanet_logo.png" alt="index_title_logo_img">
                </div>
            </h2>

            <form name="academy_search_form" action="#" method="POST">

                <!-- 메인 상단 배경 속 검색창 -->
                <div class="index_main_wrap">

                    <div class="index_main_title">

                        <div class="index_main_search">

                            <select name="select_district" id="select_district">
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

                            <form name="search_academy_form" action="#" method="post">
                                <input placeholder="학원 이름으로 검색" type="text" name="acd_name" id="acd_name_index">
                                <button id="button_main_search" type="button">검색</button>
                            </form>

                        </div>

                    </div>
                </div>

        </div>

        <!-- 메인 콘텐츠 --------------------------------------------------------->
        <div class="index_content_wrap">

            <!-- 강의 추천 ------------------------------------------------------->
            <div class="index_content_cource">

                <!-- 콘텐츠 타이틀 -->
                <div class="content_title_wrap">
                    <h2 class="title">학원 스토리</h2>
                    <button type="button" class="button_service_guide">상품안내 > </button>
                </div>


                <!-- 강의 추천 리스트 -->
                <div class="content_cource_list">
                    <ul class="content_cource_unorder_list">

                        <li>
                            <!-- 강의 추천 리스트 하나의 컬럼 -->
                            <div class="cource_column">
                                <a href="/eduplanet/acd_story/view.php">

                                    <!-- 1. 로고이미지 & 학원 이름 -->
                                    <div class="cource_column_title">
                                        <div class="academy_small_logo">
                                            <!-- small logo 이미지는 32x32 만 가능하도록 하기 -->
                                            <img src="/eduplanet/test_img/academy_small_logo.png" alt="academy_small_logo">
                                        </div>

                                        <span id="academy_title_span">고양이사료개발학원</span>
                                    </div>

                                    <!-- 2. 학원 이미지 & 짧은 소개 -->
                                    <div class="cource_column_box">
                                        <div class="academy_img_box">
                                            <img src="/eduplanet/test_img/academy_box_img.jpg" alt="academy_img_box">
                                        </div>

                                        <div class="academy_introduce">
                                            <h3 id="academy_introduce_title">코딩 8등급에서 1등급이 된 고양이</h3>
                                            <p id="academy_introduce_content">저는 평생 코딩이 적성에 안맞는다고 생각했어요. 그런데...</p>
                                        </div>

                                    </div>
                                </a>
                            </div>
                        </li>

                        <span class="span_padding"></span>

                        <li>
                            <div class="cource_column">
                                <a href="/eduplanet/acd_story/view.php">

                                    <div class="cource_column_title">
                                        <div class="academy_small_logo">
                                            <img src="/eduplanet/test_img/academy_small_logo.png" alt="academy_small_logo">
                                        </div>

                                        <span id="academy_title_span">고양이사료개발학원</span>
                                    </div>

                                    <div class="cource_column_box">
                                        <div class="academy_img_box">
                                            <img src="/eduplanet/test_img/academy_box_img.jpg" alt="academy_img_box">
                                        </div>

                                        <div class="academy_introduce">
                                            <h3 id="academy_introduce_title">코딩 8등급에서 1등급이 된 고양이</h3>
                                            <p id="academy_introduce_content">저는 평생 코딩이 적성에 안맞는다고 생각했어요. 그런데...</p>
                                        </div>

                                    </div>
                                </a>
                            </div>
                        </li>

                        <span class="span_padding"></span>

                        <li>
                            <div class="cource_column">
                                <a href="/eduplanet/acd_story/view.php">

                                    <div class="cource_column_title">
                                        <div class="academy_small_logo">
                                            <img src="/eduplanet/test_img/academy_small_logo.png" alt="academy_small_logo">
                                        </div>

                                        <span id="academy_title_span">고양이사료개발학원</span>
                                    </div>

                                    <div class="cource_column_box">
                                        <div class="academy_img_box">
                                            <img src="/eduplanet/test_img/academy_box_img.jpg" alt="academy_img_box">
                                        </div>

                                        <div class="academy_introduce">
                                            <h3 id="academy_introduce_title">코딩 8등급에서 1등급이 된 고양이</h3>
                                            <p id="academy_introduce_content">저는 평생 코딩이 적성에 안맞는다고 생각했어요. 그런데...</p>
                                        </div>

                                    </div>
                                </a>
                            </div>
                        </li>

                        <span class="span_padding"></span>

                        <li>
                            <div class="cource_column">
                                <a href="/eduplanet/acd_story/view.php">

                                    <div class="cource_column_title">
                                        <div class="academy_small_logo">
                                            <img src="/eduplanet/test_img/academy_small_logo.png" alt="academy_small_logo">
                                        </div>

                                        <span id="academy_title_span">고양이사료개발학원</span>
                                    </div>

                                    <div class="cource_column_box">
                                        <div class="academy_img_box">
                                            <img src="/eduplanet/test_img/academy_box_img.jpg" alt="academy_img_box">
                                        </div>

                                        <div class="academy_introduce">
                                            <h3 id="academy_introduce_title">코딩 8등급에서 1등급이 된 고양이</h3>
                                            <p id="academy_introduce_content">저는 평생 코딩이 적성에 안맞는다고 생각했어요. 그런데...</p>
                                        </div>

                                    </div>
                                </a>
                            </div>
                        </li>

                    </ul>
                    <!-- end of ul // content_cource_unorder_list -->
                </div>
            </div>

            <!-- end of 강의 추천 -->

            <!-- 인덱스 메인 리뷰 ------------------------------------------------->
            <div class="index_content_review">

                <!-- 리뷰 타이틀 -->
                <div class="content_title_wrap_review">
                    <p class="review_title">수강생들이 직접 평가한</p>
                    <h2 class="title">"생생 학원 리뷰"</h2>
                </div>

                <!-- 리뷰 컨텐츠 -->
                <div class="content_review_list">
                    <ul>

                        <li>
                            <div class="review_column">

                                <!-- 학원 로고 & 학원명 -->
                                <a href="#">
                                    <div class="review_column_title">
                                        <div class="academy_small_logo">
                                            <img src="/eduplanet/test_img/academy_small_logo.png" alt="academy_small_logo">
                                        </div>

                                        <span id="academy_title_span">고양이사료개발학원</span>
                                    </div>
                                </a>

                                <!-- 학원 리뷰 -->
                                <div class="review_column_box">

                                    <div class="academy_review">
                                        <div class="review_img_box">
                                            <img src="/eduplanet/img/double.png" alt="review_img_box">
                                        </div>

                                        <h3 id="academy_review_title">강사분이 굉장히 열정적이시고, 배고플 때 간식도 많이 주셔서 좋았어요.</h3>

                                        <div class="academt_review_detail">
                                            <span id="academy_option">바리스타학원</span>
                                            <span class="comma"> · </span>
                                            <span id="academy_district">고양시</span>
                                            <span class="comma"> · </span>
                                            <span id="regist_day">2020. 02. 12</span>
                                        </div>

                                        <img id="review_star" src="/eduplanet/img/review_star.png" alt="review_star">
                                    </div>

                                    <div class="academy_review_button">
                                        <button id="button_more_review" type="button">23개의 수강생 리뷰</button>
                                    </div>

                                </div>
                                </a>
                            </div>
                        </li>

                        <span class="span_padding"></span>

                        <li>
                            <div class="review_column">

                                <!-- 학원 로고 & 학원명 -->
                                <a href="#">
                                    <div class="review_column_title">
                                        <div class="academy_small_logo">
                                            <img src="/eduplanet/test_img/academy_small_logo.png" alt="academy_small_logo">
                                        </div>

                                        <span id="academy_title_span">고양이사료개발학원</span>
                                    </div>
                                </a>

                                <!-- 학원 리뷰 -->
                                <div class="review_column_box">

                                    <div class="academy_review">
                                        <div class="review_img_box">
                                            <img src="/eduplanet/img/double.png" alt="review_img_box">
                                        </div>

                                        <h3 id="academy_review_title">강사분이 굉장히 열정적이시고, 배고플 때 간식도 많이 주셔서 좋았어요.</h3>

                                        <div class="academt_review_detail">
                                            <span id="academy_option">바리스타학원</span>
                                            <span class="comma"> · </span>
                                            <span id="academy_district">고양시</span>
                                            <span class="comma"> · </span>
                                            <span id="regist_day">2020. 02. 12</span>
                                        </div>

                                        <img id="review_star" src="/eduplanet/img/review_star.png" alt="review_star">
                                    </div>

                                    <div class="academy_review_button">
                                        <button id="button_more_review" type="button">23개의 수강생 리뷰</button>
                                    </div>

                                </div>
                                </a>
                            </div>
                        </li>

                        <li>
                            <div class="review_column">

                                <!-- 학원 로고 & 학원명 -->
                                <a href="#">
                                    <div class="review_column_title">
                                        <div class="academy_small_logo">
                                            <img src="/eduplanet/test_img/academy_small_logo.png" alt="academy_small_logo">
                                        </div>

                                        <span id="academy_title_span">고양이사료개발학원</span>
                                    </div>
                                </a>

                                <!-- 학원 리뷰 -->
                                <div class="review_column_box">

                                    <div class="academy_review">
                                        <div class="review_img_box">
                                            <img src="/eduplanet/img/double.png" alt="review_img_box">
                                        </div>

                                        <h3 id="academy_review_title">강사분이 굉장히 열정적이시고, 배고플 때 간식도 많이 주셔서 좋았어요.</h3>

                                        <div class="academt_review_detail">
                                            <span id="academy_option">바리스타학원</span>
                                            <span class="comma"> · </span>
                                            <span id="academy_district">고양시</span>
                                            <span class="comma"> · </span>
                                            <span id="regist_day">2020. 02. 12</span>
                                        </div>

                                        <img id="review_star" src="/eduplanet/img/review_star.png" alt="review_star">
                                    </div>

                                    <div class="academy_review_button">
                                        <button id="button_more_review" type="button">23개의 수강생 리뷰</button>
                                    </div>

                                </div>
                                </a>
                            </div>
                        </li>

                        <span class="span_padding"></span>

                        <li>
                            <div class="review_column">

                                <!-- 학원 로고 & 학원명 -->
                                <a href="#">
                                    <div class="review_column_title">
                                        <div class="academy_small_logo">
                                            <img src="/eduplanet/test_img/academy_small_logo.png" alt="academy_small_logo">
                                        </div>

                                        <span id="academy_title_span">고양이사료개발학원</span>
                                    </div>
                                </a>

                                <!-- 학원 리뷰 -->
                                <div class="review_column_box">

                                    <div class="academy_review">
                                        <div class="review_img_box">
                                            <img src="/eduplanet/img/double.png" alt="review_img_box">
                                        </div>

                                        <h3 id="academy_review_title">강사분이 굉장히 열정적이시고, 배고플 때 간식도 많이 주셔서 좋았어요.</h3>

                                        <div class="academt_review_detail">
                                            <span id="academy_option">바리스타학원</span>
                                            <span class="comma"> · </span>
                                            <span id="academy_district">고양시</span>
                                            <span class="comma"> · </span>
                                            <span id="regist_day">2020. 02. 12</span>
                                        </div>

                                        <img id="review_star" src="/eduplanet/img/review_star.png" alt="review_star">
                                    </div>

                                    <div class="academy_review_button">
                                        <button id="button_more_review" type="button">23개의 수강생 리뷰</button>
                                    </div>

                                </div>
                                </a>
                            </div>
                        </li>

                        <li>
                            <div class="review_column">

                                <!-- 학원 로고 & 학원명 -->
                                <a href="#">
                                    <div class="review_column_title">
                                        <div class="academy_small_logo">
                                            <img src="/eduplanet/test_img/academy_small_logo.png" alt="academy_small_logo">
                                        </div>

                                        <span id="academy_title_span">고양이사료개발학원</span>
                                    </div>
                                </a>

                                <!-- 학원 리뷰 -->
                                <div class="review_column_box">

                                    <div class="academy_review">
                                        <div class="review_img_box">
                                            <img src="/eduplanet/img/double.png" alt="review_img_box">
                                        </div>

                                        <h3 id="academy_review_title">강사분이 굉장히 열정적이시고, 배고플 때 간식도 많이 주셔서 좋았어요.</h3>

                                        <div class="academt_review_detail">
                                            <span id="academy_option">바리스타학원</span>
                                            <span class="comma"> · </span>
                                            <span id="academy_district">고양시</span>
                                            <span class="comma"> · </span>
                                            <span id="regist_day">2020. 02. 12</span>
                                        </div>

                                        <img id="review_star" src="/eduplanet/img/review_star.png" alt="review_star">
                                    </div>

                                    <div class="academy_review_button">
                                        <button id="button_more_review" type="button">23개의 수강생 리뷰</button>
                                    </div>

                                </div>
                                </a>
                            </div>
                        </li>

                        <span class="span_padding"></span>

                        <li>
                            <div class="review_column">

                                <!-- 학원 로고 & 학원명 -->
                                <a href="#">
                                    <div class="review_column_title">
                                        <div class="academy_small_logo">
                                            <img src="/eduplanet/test_img/academy_small_logo.png" alt="academy_small_logo">
                                        </div>

                                        <span id="academy_title_span">고양이사료개발학원</span>
                                    </div>
                                </a>

                                <!-- 학원 리뷰 -->
                                <div class="review_column_box">

                                    <div class="academy_review">
                                        <div class="review_img_box">
                                            <img src="/eduplanet/img/double.png" alt="review_img_box">
                                        </div>

                                        <h3 id="academy_review_title">강사분이 굉장히 열정적이시고, 배고플 때 간식도 많이 주셔서 좋았어요.</h3>

                                        <div class="academt_review_detail">
                                            <span id="academy_option">바리스타학원</span>
                                            <span class="comma"> · </span>
                                            <span id="academy_district">고양시</span>
                                            <span class="comma"> · </span>
                                            <span id="regist_day">2020. 02. 12</span>
                                        </div>

                                        <img id="review_star" src="/eduplanet/img/review_star.png" alt="review_star">
                                    </div>

                                    <div class="academy_review_button">
                                        <button id="button_more_review" type="button">23개의 수강생 리뷰</button>
                                    </div>

                                </div>
                                </a>
                            </div>
                        </li>

                        <li>
                            <div class="review_column">

                                <!-- 학원 로고 & 학원명 -->
                                <a href="#">
                                    <div class="review_column_title">
                                        <div class="academy_small_logo">
                                            <img src="/eduplanet/test_img/academy_small_logo.png" alt="academy_small_logo">
                                        </div>

                                        <span id="academy_title_span">고양이사료개발학원</span>
                                    </div>
                                </a>

                                <!-- 학원 리뷰 -->
                                <div class="review_column_box">

                                    <div class="academy_review">
                                        <div class="review_img_box">
                                            <img src="/eduplanet/img/double.png" alt="review_img_box">
                                        </div>

                                        <h3 id="academy_review_title">강사분이 굉장히 열정적이시고, 배고플 때 간식도 많이 주셔서 좋았어요.</h3>

                                        <div class="academt_review_detail">
                                            <span id="academy_option">바리스타학원</span>
                                            <span class="comma"> · </span>
                                            <span id="academy_district">고양시</span>
                                            <span class="comma"> · </span>
                                            <span id="regist_day">2020. 02. 12</span>
                                        </div>

                                        <img id="review_star" src="/eduplanet/img/review_star.png" alt="review_star">
                                    </div>

                                    <div class="academy_review_button">
                                        <button id="button_more_review" type="button">23개의 수강생 리뷰</button>
                                    </div>

                                </div>
                                </a>
                            </div>
                        </li>

                        <span class="span_padding"></span>

                        <li>
                            <div class="review_column">

                                <!-- 학원 로고 & 학원명 -->
                                <a href="#">
                                    <div class="review_column_title">
                                        <div class="academy_small_logo">
                                            <img src="/eduplanet/test_img/academy_small_logo.png" alt="academy_small_logo">
                                        </div>

                                        <span id="academy_title_span">고양이사료개발학원</span>
                                    </div>
                                </a>

                                <!-- 학원 리뷰 -->
                                <div class="review_column_box">

                                    <div class="academy_review">
                                        <div class="review_img_box">
                                            <img src="/eduplanet/img/double.png" alt="review_img_box">
                                        </div>

                                        <h3 id="academy_review_title">강사분이 굉장히 열정적이시고, 배고플 때 간식도 많이 주셔서 좋았어요.</h3>

                                        <div class="academt_review_detail">
                                            <span id="academy_option">바리스타학원</span>
                                            <span class="comma"> · </span>
                                            <span id="academy_district">고양시</span>
                                            <span class="comma"> · </span>
                                            <span id="regist_day">2020. 02. 12</span>
                                        </div>

                                        <img id="review_star" src="/eduplanet/img/review_star.png" alt="review_star">
                                    </div>

                                    <div class="academy_review_button">
                                        <button id="button_more_review" type="button">23개의 수강생 리뷰</button>
                                    </div>

                                </div>
                                </a>
                            </div>
                        </li>

                    </ul>
                </div>

            </div>

        </div>

    </div>
    <!-- end of body_wrap -->

</body>

</html>