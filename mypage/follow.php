<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>에듀플래닛</title>

    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/eduplanet/mypage/css/follow.css">

    <!-- 아이콘 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css">

</head>

<body>
    <div class="body_wrap">

        <header>
            <div class="header_searchbar_fix">
                <?php include '../index_header_searchbar_in.php'; ?>
            </div>

            <div class="header_mypage">
                <?php include './mypage_header.php'; ?>
            </div>
        </header>

        <div class="mypage_user_menu_background">
            <div class="mypage_user_menu">
                <ul>
                    <a href="/eduplanet/mypage/myinfo.php">
                        <li id="mypage_user_myinfo">내 정보</li>
                    </a>
                    <a href="/eduplanet/mypage/follow.php">
                        <li id="mypage_user_follow">찜목록</li>
                    </a>
                    <a href="/eduplanet/mypage/membership_pay.php">
                        <li id="mypage_user_membership">멤버십/결제</li>
                    </a>
                    <a href="/eduplanet/mypage/review_mylist.php">
                        <li id="mypage_user_review">리뷰</li>
                    </a>
                </ul>
            </div>
        </div>

        <div class="follow_list_wrap">
            <div class="follow_list_background">


            
                <?php

                // 찜목록 test ============================================================

                // test용
                $user_no = 1;

                if (isset($_GET["page"])) {
                    $page = $_GET["page"];
                } else {
                    $page = 1;
                }

                include "../lib/db_connector.php";

                $sql = "SELECT acd_name, si_name, acd_no FROM follow INNER JOIN academy ON follow.acd_no = academy.no WHERE user_no='$user_no'";

                $result = mysqli_query($conn, $sql);
                $total_record = mysqli_num_rows($result);

                ?>

                <!-- select box -------------------------------------------------------------------------------------->
                <div class="follow_list_select">

                    <h2>
                        내 찜목록
                        <!-- <button id="button_write_follow" onclick="location.href='/eduplanet/acd_story/post.php'">스토리 등록</button> -->
                    </h2>
                    <span id="follow_total_span">총 <span id="follow_total_num"><?= $total_record ?></span> 개의 찜한 학원이 있습니다.</span>

                    <div class="follow_select">
                        <select name="follow_list_select_district" id="follow_list_select_district">
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

                        <select name="follow_list_select_mode" id="follow_list_select_mode">
                            <option value="star_max">총 만족도 순</option>
                            <!-- <option value="hit_max">조회수 순</option> -->
                            <option value="hit_max">최근 찜한 순</option>
                        </select>
                    </div>
                </div>

                <!-- start of ul ------------------------------------------------------------------------------------->

                <ul class="follow_unorder_list">

                    <?php

                    $scale = 10;

                    if ($total_record % $scale == 0) {
                        $total_page = floor($total_record / $scale);
                    } else {
                        $total_page = floor($total_record / $scale) + 1;
                    }

                    $page_setting = ($page - 1) * $scale;

                    $page_start = $total_record - $page_setting;


                    for ($i = $page_setting; $i < $page_setting + $scale && $i < $total_record; $i++) {

                        mysqli_data_seek($result, $i);

                        $row = mysqli_fetch_array($result);

                        $acd_name = $row["acd_name"];
                        $si_name = $row["si_name"];
                        $acd_no = $row["acd_no"];
        
                        $sql = "SELECT total_star FROM review WHERE parent='$acd_no'";
                        $result_total_star = mysqli_query($conn, $sql);
                        $total_record_review = mysqli_num_rows($result_total_star);
        
                        $row = mysqli_fetch_array($result_total_star);
        
                        $total_star = $row["total_star"]; 
        
                        $sql = "SELECT * FROM acd_story WHERE parent='$acd_no'";
                        $result_story = mysqli_query($conn, $sql);
                        $total_record_story = mysqli_num_rows($result_story);

                        // 아직 사진 컬럼이 없어서 못가져옴
                        // if ($row["file_name"]) {
                        //     $file_image = "<img src='./img/file.gif' height='13'>";
                        // } else {
                        //     $file_image = "";
                        // }

                    ?>

                        <li>
                            <!-- 하나의 찜목록 -->
                            <div class="follow_list_column">

                               <!-- 왼쪽 학원 로고 및 정보  -->
                                <!-- 클릭 시 href=학원페이지 -->
                                <a href="/eduplanet/acd_story/view.php?no=<?= $no ?>&parent=<?= $parent ?>&acd_name=<?= $acd_name ?>">
                                    <div class="follow_list_column_img">
                                        <img src="/eduplanet/test_img/academy_big_logo.jpg" alt="follow_list_column_img">
                                    </div>

                                    <div class="follow_list_column_text">
                                        <h1 id="follow_text_academy"><?=$acd_name?>
                                </a>

                                </h1>
                                <p id="follow_text_district"><?=$si_name?></p>

                                <div class="follow_list_column_review">
                                    <a href="#"><span id="academy_review_span">학원리뷰 <span id="academy_review_num"><?=$total_record_review?></span></span></a>
                                    <a href="#"><span id="academy_review_span">스토리 <span id="academy_review_num"><?=$total_record_story?></span></span></a>

                                    <!-- <div class="academy_small_star">
                                        <img src="/eduplanet/img/review_star_one.png" alt="academy_small_star">
                                        <span id="academt_review_star_score"><?= $total_star ?></span>
                                    </div> -->

                                </div>
                            </div>

                            <!-- 오른쪽 별점 & 삭제버튼 -->
                            <div class="follow_list_column_sub">

                                <div class="follow_academy_heart">
                                    <span>학원 삭제</span>
                                    <button id="button_academy_heart">like</button>
                                </div>

                                <div class="follow_academy_star_wrap">
                                    <span class="follow_academy_star_span">총 만족도</span>
                                    
                                    <div class="follow_academy_star">
                                        <img id="acd_star_1" class="acd_star_class" src="/eduplanet/img/common_sprite.png" alt="follow_academy_star">
                                        <img id="acd_star_2"class="acd_star_class" src="/eduplanet/img/common_sprite.png" alt="follow_academy_star">
                                        <img id="acd_star_3"class="acd_star_class" src="/eduplanet/img/common_sprite.png" alt="follow_academy_star">
                                        <img id="acd_star_4"class="acd_star_class" src="/eduplanet/img/common_sprite.png" alt="follow_academy_star">
                                        <img id="acd_star_5"class="acd_star_class" src="/eduplanet/img/common_sprite.png" alt="follow_academy_star">
                                    </div>

                                    <span class="follow_academy_star_num"><?=$total_star?></span>

                                </div>


                            </div>

                                
                            </div>
                        </li>

                    <?php
                        $page_start--;
                    }
                    mysqli_close($conn);
                    ?>

                </ul>
                <!-- end of ul ------------------------------------------------------------------>

                <div class="page_num_wrap">
                    <div class="page_num">
                        <ul class="page_num_ul">

                            <?php

                            // 페이지 쪽수 표시 량 (5 페이지씩 표기)
                            $page_scale = 5;

                            // 페이지 그룹번호(페이지 5개가 1그룹)
                            $pageGroup = ceil($page / $page_scale);

                            //그룹번호 안에서의 마지막 페이지 숫자
                            $last_page = $pageGroup * $page_scale;

                            // 그룹번호의 마지막 페이지는 전체 페이지보다 클 수 없음
                            if ($total_page < $page_scale) {
                                $last_page = $total_page;
                            } else if ($last_page > $total_page) {
                                $last_page = $total_page;
                            }

                            //그룹번호의 첫번째 페이지 숫자
                            $first_page = $last_page - ($page_scale-1);

                            //그룹번호의 첫번째 페이지는 1페이지보다 작을 수 없음
                            if ($first_page < 1) {
                                $first_page = 1;

                            //마지막 그룹번호일때 첫번째 페이지값 결정
                            } else if ($last_page == $total_page) { 

                                if ($total_page % $page_scale == 0) {
                                    $first_page = $total_page - $page_scale + 1;

                                } else {
                                    $first_page = $total_page - ($total_page % $page_scale) + 1;
                                }
                            }

                            $next = $last_page + 1; // > 버튼 누를때 나올 페이지
                            $prev = $first_page - 1; // < 버튼 누를때 나올 페이지

                            // 첫번째 페이지일 때 앵커 비활성화
                            if ($first_page == 1) {

                                if ($page != 1) {
                                    echo "<li><a href='/eduplanet/mypage/follow.php?page=1'><span class='page_num_direction'><i class='fas fa-angle-double-left'></i></span></a></li>";
                                } else {
                                    echo "<li><a><span class='page_num_direction'><i class='fas fa-angle-double-left'></i></span></a></li>";
                                }

                                echo "<li><a><span class='page_num_direction'><i class='fas fa-angle-left'></i></span></a></li>";
                            } else {
                                echo "<li><a href='/eduplanet/mypage/follow.php?page=1'><span class='page_num_direction'><i class='fas fa-angle-double-left'></i></span></a></li>";
                                echo "<li><a href='/eduplanet/mypage/follow.php?page=$prev'><span class='page_num_direction'><i class='fas fa-angle-left'></i></span></a></li>";
                            }

                            //페이지 번호 매기기
                            for ($i = $first_page; $i <= $last_page; $i++) {

                                if ($page == $i) {
                                    echo "<li><span class='page_num_set'><b style='color:#2E89FF'> $i </b></span></li>";
                                } else {
                                    echo "<li><a href='/eduplanet/mypage/follow.php?page=$i'><span class='page_num_set'> &nbsp$i&nbsp </span></a></li>";
                                }
                            }

                            // 마지막 페이지일 때 앵커 비활성화
                            if ($last_page == $total_page) {
                                echo "<li><a><span class='page_num_direction'><i class='fas fa-angle-right'></i></span></a></li>";

                                if ($page != $total_page) {
                                    echo "<li><a href='/eduplanet/mypage/follow.php?page=$total_page'><span class='page_num_direction_last'><i class='fas fa-angle-double-right'></i></span></a></li>";
                                } else {
                                    echo "<li><a><span class='page_num_direction_last'><i class='fas fa-angle-double-right'></i></span></a></li>";
                                }
                            } else {
                                echo "<li><a href='/eduplanet/mypage/follow.php?page=$next'><span class='page_num_direction'><i class='fas fa-angle-right'></i></span></a></li>";
                                echo "<li><a href='/eduplanet/mypage/follow.php?page=$total_page'><span class='page_num_direction_last'><i class='fas fa-angle-double-right'></i></span></a></li>";
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <!-- end of page_num_wrap -------------------------------------------------------->

            </div>
        </div>





        <footer>
            <?php include "../footer.php"; ?>
        </footer>


    </div>

</body>

</html>