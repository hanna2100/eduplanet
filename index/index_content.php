<div class="body_wrap">

    <div class="index_main_background">

        <h2 class="index_title">
            <div class="index_title_logo_img">
                <img src="/eduplanet/img/eduplanet_logo.png" alt="index_title_logo_img">
            </div>
        </h2>

        <!-- 슬라이더 start -->
        <div class="index_slider">
            <div class="slider-wrapper theme-mi-slider">
                <div id="slider" class="nivoSlider">
                    <img src="/eduplanet/index/nivo-slider/img/slider_img1.jpg" alt="index_img" title="#htmlcaption1" />
                    <img src="/eduplanet/index/nivo-slider/img/slider_img2.jpg" alt="index_img" title="#htmlcaption2" />
                    <img src="/eduplanet/index/nivo-slider/img/slider_img3.jpg" alt="index_img" title="#htmlcaption3" />
                </div>
                <div id="htmlcaption1" class="nivo-html-caption">
                    <h1>우주의 별들처럼 수 많은 학원들</h1>
                    <p>모든 학원의 정보를 한 눈에 보고, 간편하게 비교해 보세요.</p>
                </div>
                <div id="htmlcaption2" class="nivo-html-caption">
                    <h1>나에게 꼭 맞는 학원 찾기, 어려우시죠?</h1>
                    <p>에듀플래닛과 함께 시작해 보세요.</p>
                </div>
                <div id="htmlcaption3" class="nivo-html-caption">
                    <h1>텅 빈 강의실, 한숨은 이제 그만!</h1>
                    <p>효율적인 학원 관리의 시작, 에듀플래닛과 함께하세요.</p>
                </div>
            </div>

            <div class="index_main_wrap">
                <div class="index_main_title">
                    <div class="index_main_search">

                        <select name="select_district" id="select_district">
                            <option selected value="">시/군 선택</option>
                            <option value="가평군">가평군</option>
                            <option value="고양시">고양시</option>
                            <option value="과천시">과천시</option>
                            <option value="광명시">광명시</option>
                            <option value="광주시">광주시</option>
                            <option value="구리시">구리시</option>
                            <option value="군포시">군포시</option>
                            <option value="김포시">김포시</option>
                            <option value="남양주시">남양주시</option>
                            <option value="동두천시">동두천시</option>
                            <option value="부천시">부천시</option>
                            <option value="성남시">성남시</option>
                            <option value="수원시">수원시</option>
                            <option value="시흥시">시흥시</option>
                            <option value="안산시">안산시</option>
                            <option value="안성시">안성시</option>
                            <option value="안양시">안양시</option>
                            <option value="양주시">양주시</option>
                            <option value="양평군">양평군</option>
                            <option value="여주시">여주시</option>
                            <option value="연천군">연천군</option>
                            <option value="오산시">오산시</option>
                            <option value="용인시">용인시</option>
                            <option value="의왕시">의왕시</option>
                            <option value="의정부시">의정부시</option>
                            <option value="이천시">이천시</option>
                            <option value="파주시">파주시</option>
                            <option value="평택시">평택시</option>
                            <option value="포천시">포천시</option>
                            <option value="하남시">하남시</option>
                            <option value="화성시">화성시</option>
                        </select>

                        <input placeholder="학원 이름으로 검색" type="text" name="search" id="acd_name_index" onkeyup="enterKey();">
                        <button id="button_main_search" type="button" onclick="searchAcademy();">검색</button>

                        <script>
                            // 엔터키 눌렀을 때 자동 검색
                            function enterKey() {
                                if (window.event.keyCode == 13) {
                                    searchAcademy();
                                }
                            }

                            function searchAcademy() {

                                // 검색어를 입력하지 않았을 때
                                if (document.getElementById("acd_name_index").value == "") {

                                    // 지역을 선택하지 않았을 때
                                    if (document.getElementById("select_district").value == "") {
                                        location.href = '/eduplanet/acd_list/view_all.php';

                                    // 지역을 선택했을 때
                                    } else if (document.getElementById("select_district").value != "") {
                                        location.href = '/eduplanet/acd_list/view_all.php?district=' + document.getElementById("select_district").value + '&sort=bace_max';
                                    }

                                // 검색어를 입력했을 때
                                } else if (document.getElementById("acd_name_index").value != "") {

                                    // 지역을 선택하지 않았을 때
                                    if (document.getElementById("select_district").value == "") {
                                        location.href = '/eduplanet/acd_list/view_all.php?search=' + document.getElementById("acd_name_index").value;

                                    // 지역을 선택했을 때
                                    } else if (document.getElementById("select_district").value != "") {
                                        location.href = '/eduplanet/acd_list/view_all.php?search=' + document.getElementById("acd_name_index").value + '&district=' + document.getElementById("select_district").value;
                                    }

                                }
                            }
                        </script>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="index_content_wrap">

        <!-- 상단 이벤트 -->
        <div class="inner_section">

            <div class="content_title_wrap_review">
                <h2 class="title">오늘의 에듀</h2>
            </div>

            <div class="story_container">

                <div class="story_card a1">
                    <a href="/eduplanet/membership/index.php">
                        <div class="story_img">
                            <img src="/eduplanet/img/index_img1.jpg" width="100%" height="200px" alt="academy_story">
                        </div>
                        <div class="story_contents">
                            <div class="story_subtitle">고양이는 멤버십 30% 할인!</div>
                            <div class="story_title">멤버십 둘러보기</div>
                        </div>
                    </a>
                </div>

                <div class="story_card a2">
                    <a href="/eduplanet/login_join/join_form.php?mode=am">
                        <div class="story_img">
                            <img src="/eduplanet/img/index_img4.jpg" width="100%" height="200px" alt="academy_story">
                        </div>
                        <div class="story_contents">
                            <div class="story_subtitle">학원관리가 어려우세요?</div>
                            <div class="story_title">사업자회원 가입하기</div>
                        </div>
                    </a>
                </div>

                <div class="story_card a3">
                    <a href="/eduplanet/acd_list/view_all.php?district=전체&sort=achievement_max">
                        <!-- <div class="story_img"> -->
                        <img src="/eduplanet/img/index_img2.jpg" width="100%" height="100%" alt="academy_story">
                        <!-- </div> -->
                        <div class="story_contents" style="top:75%">
                            <div class="story_subtitle">우리 아이는 공부를 싫어해요.</div>
                            <div class="story_title">학업 성취도 높은 학원</div>
                        </div>
                    </a>
                </div>

                <div class="story_card a4">
                    <a href="/eduplanet/acd_list/view_all.php?search=미술">
                        <div class="story_img" id="story_img_wrap">
                            <img id="story_img" src="/eduplanet/img/index_img3.jpg" width="100%" height="200px" alt="academy_story">
                        </div>
                        <div class="story_contents" style="left:5%">
                            <div class="story_subtitle">어려워진 미술 입시, 걱정마세요!</div>
                            <div class="story_title">미술학원 보러 가기</div>
                        </div>
                    </a>
                </div>

            </div>



            <!-- 스토리 -------------------------------------------------------------------------------------------->
            <div class="index_content_cource">

                <div class="content_title_wrap">
                    <h2 class="title">학원 스토리</h2>
                    <a class="button_service_guide" href="./membership/index.php">상품안내 ></a>
                </div>

                <!-- 스토리 리스트 -->
                <div class="content_cource_list">
                    <ul class="content_cource_unorder_list">

                        <?php
                        // 스토리 등록일자 기준 조회순으로 정렬
                        $sql = "select S.parent, S.no, S.acd_name, S.title, S.subtitle, S.file_copy as s_file_copy, A.file_copy, A.no as academy_no from acd_story S INNER JOIN academy A ON S.parent=A.no order by regist_day desc limit 4;";
                        $result = mysqli_query($conn, $sql);

                        for ($i = 0; $i < 4; $i++) {
                            mysqli_data_seek($result, $i);
                            $row = mysqli_fetch_array($result);

                            $story_no = $row['no'];
                            $academy_no = $row['academy_no'];
                            $acd_name = $row['acd_name'];
                            $title = $row['title'];
                            $subtitle = $row['subtitle'];
                            $file_copy = $row['file_copy'];
                            $s_file_copy = $row['s_file_copy'];

                        ?>
                            <li>
                                <div class="cource_column">

                                    <a href="/eduplanet/academy/acd_story.php?no=<?= $academy_no ?>">
                                        <!-- 학원 로고 & 학원 이름 -->
                                        <div class="cource_column_title">
                                            <div class="academy_small_logo">

                                                <?php
                                                if ($file_copy != "") {
                                                    echo "<img src='/eduplanet/data/acd_logo/$file_copy' alt='academy_small_logo'>";
                                                } else {
                                                    echo "<img src='/eduplanet/img/acd_logo.png' alt='academy_small_logo'>";
                                                }
                                                ?>

                                            </div>

                                            <span id="academy_title_span"><?= $acd_name ?></span>
                                        </div>
                                    </a>

                                    <a href="/eduplanet/acd_story/view.php?story_no=<?= $story_no ?>">
                                        <!-- 스토리 이미지 & 글 -->
                                        <div class="cource_column_box">
                                            <div class="academy_img_box">
                                                <img src="/eduplanet/data/acd_story/<?= $s_file_copy ?>" alt="academy_img_box">
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
                </div>
            </div>

            <!-- 리뷰 --------------------------------------------------------------------------------------------------->
            <div class="index_content_review">

                <div class="content_title_wrap_review">
                    <p class="review_title">수강생들이 직접 평가한</p>
                    <h2 class="title">"생생 학원 리뷰"</h2>
                </div>

                <!-- 리뷰 리스트 -->
                <div class="content_review_list">
                    <ul>

                        <?php
                        // 리뷰 등록일자 기준 최신순으로 정렬
                        $sql = "select R.one_line, R.total_star, R.regist_day, A.no, A.si_name, A.acd_name, A.class, A.file_copy
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
                            $file_copy = $row['file_copy'];

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
                                    <a href="/eduplanet/academy/review.php?no=<?= $no ?>">
                                        <div class="review_column_title">
                                            <div class="academy_small_logo">

                                                <?php
                                                if ($file_copy != "") {
                                                    echo "<img src='/eduplanet/data/acd_logo/$file_copy' alt='academy_small_logo'>";
                                                } else {
                                                    echo "<img src='/eduplanet/img/acd_logo.png' alt='academy_small_logo'>";
                                                }
                                                ?>

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

                                                // 학원 정보에 class 가 없는 곳은 기본값 넣어주기
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