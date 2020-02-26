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
                <a class="button_service_guide" href="./membership/index.php">상품안내 ></a>
                <!-- <button type="button" class="button_service_guide" onclick="location.href='../membership/index.php'">상품안내 > </button> -->
            </div>


            <!-- 강의 추천 리스트 -->
            <div class="content_cource_list">
                <ul class="content_cource_unorder_list">

                    <?php
                    // 스토리 등록일자 기준 조회순으로 정렬
                    $sql = "select * from acd_story order by hit desc limit 4;";
                    $result = mysqli_query($conn, $sql);

                    for ($i = 0; $i < 4; $i++) {
                        mysqli_data_seek($result, $i);
                        $row = mysqli_fetch_array($result);

                        $no = $row['parent'];
                        $acd_name = $row['acd_name'];
                        $title = $row['title'];
                        $subtitle = $row['subtitle'];
                        // $file_copy = $row['$file_copy'];

                    ?>
                        <li>
                            <!-- 강의 추천 리스트 하나의 컬럼 -->
                            <div class="cource_column">
                                <a href="/eduplanet/acd_story/view.php?no=<?= $no ?>">

                                    <!-- 1. 로고이미지 & 학원 이름 -->
                                    <div class="cource_column_title">
                                        <div class="academy_small_logo">
                                            <!-- small logo 이미지는 32x32 만 가능하도록 하기 -->
                                            <img src="/eduplanet/test_img/academy_small_logo.png" alt="academy_small_logo">
                                        </div>

                                        <span id="academy_title_span"><?= $acd_name ?></span>
                                    </div>

                                    <!-- 2. 학원 이미지 & 짧은 소개 -->
                                    <div class="cource_column_box">
                                        <div class="academy_img_box">
                                            <img src="/eduplanet/test_img/academy_box_img.jpg" alt="academy_img_box">
                                        </div>

                                        <div class="academy_introduce">
                                            <h3 id="academy_introduce_title"><?= $title ?></h3>
                                            <p id="academy_introduce_content"><?= $subtitle ?></p>
                                        </div>

                                    </div>
                                </a>
                            </div>
                        </li>

                        <span class="span_padding"></span>

                    <?php
                    } // end of for
                    ?>

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

                    <?php
                    // 리뷰 등록일자 기준 최신순으로 정렬
                    $sql = "select R.one_line, R.total_star, R.regist_day, A.no, A.si_name, A.acd_name, A.class
                                from review R inner join academy A on R.parent=A.no order by regist_day desc limit 8;";

                    $result = mysqli_query($conn, $sql);

                    for ($i = 0; $i < 8; $i++) {
                        mysqli_data_seek($result, $i);
                        $row = mysqli_fetch_array($result);

                        $acd_name = $row['acd_name'];
                        $one_line = $row['one_line'];
                        $class = $row['class'];
                        $si_name = $row['si_name'];
                        $regist_day = $row['regist_day'];
                        $total_star = $row['total_star'];
                        $no = $row['no'];

                        // 해당 학원의 평균 총 만족도
                        $sql = "SELECT AVG(total_star) as total_star FROM review WHERE parent='$no'";
                        $result_total_star = mysqli_query($conn, $sql);
                        $row_total_star = mysqli_fetch_array($result_total_star);
                        $total_star = $row_total_star["total_star"];
                        $total_star = sprintf('%0.1f', $total_star);

                        // 해당 학원의 리뷰 갯수
                        $sql_count = "select count(*) from review where parent='$no' group by parent;";
                        $result_count = mysqli_query($conn, $sql_count);
                        $row_count = mysqli_fetch_array($result_count);
                        $count = $row_count[0];

                    ?>

                        <li>
                            <div class="review_column">

                                <!-- 학원 로고 & 학원명 -->
                                <a href="#">
                                    <div class="review_column_title">
                                        <div class="academy_small_logo">
                                            <img src="/eduplanet/test_img/academy_small_logo.png" alt="academy_small_logo">
                                        </div>

                                        <span id="academy_title_span"><?= $acd_name ?></span>
                                    </div>
                                </a>

                                <!-- 학원 리뷰 -->
                                <div class="review_column_box">

                                    <div class="academy_review">
                                        <div class="review_img_box">
                                            <img src="/eduplanet/img/double.png" alt="review_img_box">
                                        </div>

                                        <h3 id="academy_review_title"><?= $one_line ?></h3>

                                        <div class="academt_review_detail">

                                            <?php

                                                // 학원 정보에 class 가 없는 곳도 있음
                                                if ($class != "") {
                                                    echo "<span id='academy_option'>$class</span>";
                                                } else {
                                                    echo "<span id='academy_option'>교습소</span>";
                                                }
                                            ?>

                                            <span class="comma"> · </span>
                                            <span id="academy_district"><?= $si_name ?></span>
                                            <span class="comma"> · </span>
                                            <span id="regist_day"><?= $regist_day ?></span>
                                        </div>


                                        <?php
                                        // 총 만족도 평균에 따라 별 보여주기
                                        for ($j = 1; $j <= 5; $j++) {

                                            if ($j <= round($total_star)) {
                                                echo "<img id='review_star' src='/eduplanet/img/academy_big_one_star.png' alt='review_star'>";
                                            } else {
                                                echo "<img id='review_star' src='/eduplanet/img/academy_big_one_star_empty.png' alt='review_star'>";
                                            }
                                        }
                                        ?>

                                        <span class="academy_star_num"><?= $total_star ?></span>

                                    </div>

                                    <div class="academy_review_button">
                                        <button id="button_more_review" type="button" onclick="location.href='academy/review.php?no=<?= $no ?>'">
                                            <span><?= $count ?></span>개의 수강생 리뷰
                                        </button>
                                    </div>

                                </div>
                                </a>
                            </div>
                        </li>

                        <span class="span_padding"></span>

                    <?php
                    } // end of for
                    mysqli_close($conn);
                    ?>


                </ul>
            </div>

        </div>

    </div>

</div>
<!-- end of body_wrap -->