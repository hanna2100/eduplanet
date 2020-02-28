<?php include_once $_SERVER["DOCUMENT_ROOT"]."/eduplanet/lib/session_start.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>에듀플래닛</title>

    <!-- favicon -->
    <link rel="shortcut icon" href="/eduplanet/img/favicon.png">

    <!-- 제이쿼리 -->
    <script src="http://code.jquery.com/jquery-1.12.4.min.js" charset="utf-8"></script>

    <!-- 폰트 -->
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR&amp;display=swap" rel="stylesheet">

    <!-- 아이콘 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="/eduplanet/index/index_header_searchbar_out.css">
    <link rel="stylesheet" href="/eduplanet/index/footer.css">
    <link rel="stylesheet" href="/eduplanet/mypage/css/review_write_popup.css">
    <link rel="stylesheet" href="/eduplanet/acd_story/css/index.css">

    <!-- 스크립트 -->
    <script src="/eduplanet/searchbar/searchbar_out.js"></script>
    <script src="/eduplanet/mypage/js/review_write.js"></script>

    <!-- 자동완성 -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <script>
        function selectOption() {

            selectDis = document.getElementById("story_list_select_district").value;
            selectSort = document.getElementById("story_list_select_mode").value;

            location.href = "/eduplanet/acd_story/index.php?district=" + selectDis + "&sort=" + selectSort;
        }
    </script>


</head>

<body onload="setSelectDis(); setSelectSort();">

    <header>
        <?php include_once $_SERVER["DOCUMENT_ROOT"] . "/eduplanet/index/index_header_searchbar_out.php"; ?>
    </header>

    <div class="story_list_wrap">
        <div class="story_list_background">

            <?php

            // 페이지 수 체크
            if (isset($_GET["page"])) {
                $page = $_GET["page"];
            } else {
                $page = 1;
            }

            // 지역 선택 체크
            if (isset($_GET["district"])) {
                $selectDis = $_GET["district"];
                echo "
                    <script>
                        function setSelectDis() {
                            document.getElementById('story_list_select_district').value = '$selectDis';
                        }
                    </script>
                    ";

            } else {
                $selectDis = "";
            }

            // 정렬방법 선택 체크
            if (isset($_GET["sort"])) {
                $selectSort = $_GET["sort"];
                echo "
                <script>
                    function setSelectSort() {
                        document.getElementById('story_list_select_mode').value = '$selectSort';
                    }
                </script>
                ";
                
            } else {
                $selectSort = "";
            }

            include_once $_SERVER["DOCUMENT_ROOT"] . "/eduplanet/lib/db_connector.php";

            // 지역 옵션이 선택되어 있을 때
            if ($selectDis != "") {

                if ($selectSort == "star_max") {
                    $sql = "SELECT academy.no as acd_no, acd_story.no, acd_story.parent, acd_story.acd_name, acd_story.title, acd_story.subtitle, acd_story.regist_day, acd_story.file_name, acd_story.file_copy, acd_story.hit, academy.si_name, review.total_star FROM acd_story INNER JOIN academy ON acd_story.parent = academy.no INNER JOIN review ON academy.no = review.parent WHERE academy.si_name='$selectDis' GROUP BY acd_story.no ORDER BY review.total_star DESC";
                } else if ($selectSort == "hit_max") {
                    $sql = "SELECT academy.no as acd_no, acd_story.no, acd_story.parent, acd_story.acd_name, acd_story.title, acd_story.subtitle, acd_story.regist_day, acd_story.file_name, acd_story.file_copy, acd_story.hit, academy.si_name, review.total_star FROM acd_story INNER JOIN academy ON acd_story.parent = academy.no INNER JOIN review ON academy.no = review.parent WHERE academy.si_name='$selectDis' GROUP BY acd_story.no ORDER BY acd_story.hit DESC";

                    // 기본 셋팅은 최근 등록순
                } else {
                    $sql = "SELECT academy.no as acd_no, acd_story.no, acd_story.parent, acd_story.acd_name, acd_story.title, acd_story.subtitle, acd_story.regist_day, acd_story.file_name, acd_story.file_copy, acd_story.hit, academy.si_name, review.total_star FROM acd_story INNER JOIN academy ON acd_story.parent = academy.no INNER JOIN review ON academy.no = review.parent WHERE academy.si_name='$selectDis' GROUP BY acd_story.no ORDER BY acd_story.no DESC";
                }

                // 지역 옵션이 선택되지 않았을 때
            } else if ($selectDis == "") {

                if ($selectSort == "star_max") {
                    $sql = "SELECT academy.no as acd_no, acd_story.no, acd_story.parent, acd_story.acd_name, acd_story.title, acd_story.subtitle, acd_story.regist_day, acd_story.file_name, acd_story.file_copy, acd_story.hit, academy.si_name, review.total_star FROM acd_story INNER JOIN academy ON acd_story.parent = academy.no INNER JOIN review ON academy.no = review.parent GROUP BY acd_story.no ORDER BY review.total_star DESC";
                } else if ($selectSort == "hit_max") {
                    $sql = "SELECT academy.no as acd_no, acd_story.no, acd_story.parent, acd_story.acd_name, acd_story.title, acd_story.subtitle, acd_story.regist_day, acd_story.file_name, acd_story.file_copy, acd_story.hit, academy.si_name, review.total_star FROM acd_story INNER JOIN academy ON acd_story.parent = academy.no INNER JOIN review ON academy.no = review.parent GROUP BY acd_story.no ORDER BY acd_story.hit DESC";

                    // 기본 셋팅은 최근 등록순
                } else {
                    $sql = "SELECT academy.no as acd_no, acd_story.no, acd_story.parent, acd_story.acd_name, acd_story.title, acd_story.subtitle, acd_story.regist_day, acd_story.file_name, acd_story.file_copy, acd_story.hit, academy.si_name, review.total_star FROM acd_story INNER JOIN academy ON acd_story.parent = academy.no INNER JOIN review ON academy.no = review.parent GROUP BY acd_story.no ORDER BY acd_story.no DESC";
                }
            }

            $result = mysqli_query($conn, $sql);
            $total_record = mysqli_num_rows($result);

            ?>

            <!-- select box -------------------------------------------------------------------------------------->
            <div class="story_list_select">

                <h2>
                    학원 스토리

                    <?php
                        if ($am_no && $pam_no) {
                    ?>

                    <button id="button_write_story" onclick="location.href='/eduplanet/acd_story/post.php'">스토리 등록</button>
                    
                    <?php
                        } else if ($am_no && !$pam_no) {
                    ?>        

                    <a href="javascript:alert('멤버십 회원만 이용 가능합니다.');"><button id="button_write_story">스토리 등록</button></a>
                    
                    <?php
                        } else {
                    ?>

                    <a href="javascript:alert('사업자회원만 이용 가능합니다.');"><button id="button_write_story">스토리 등록</button></a>
                
                    <?php
                        }
                    ?>
                        
                </h2>
                <span id="story_total_span">총 <span id="story_total_num"><?= $total_record ?></span> 개의 스토리가 있습니다.</span>

                <div class="story_select">
                    <select name="story_list_select_district" id="story_list_select_district" onchange="selectOption();">
                        <option value="" selected>시/군 선택</option>
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

                    <select name="story_list_select_mode" id="story_list_select_mode" onchange="selectOption();">
                        <option value="star_max" selected>총 만족도 순</option>
                        <option value="hit_max">조회수 순</option>
                        <option value="regist_day">최근 등록 순</option>
                    </select>
                </div>
            </div>

            <!-- start of ul ------------------------------------------------------------------------------------->

            <ul class="story_unorder_list">

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

                    $no = $row["no"];
                    $acd_no = $row["acd_no"];
                    $parent = $row["parent"];
                    $acd_name = $row["acd_name"];
                    $title = $row["title"];
                    $subtitle = $row["subtitle"];
                    $regist_day = $row["regist_day"];
                    $file_name = $row["file_name"];
                    $file_copy = $row["file_copy"];
                    $hit = $row["hit"];
                    $si_name = $row["si_name"];

                    $sql = "SELECT AVG(total_star) as total_star FROM review WHERE parent='$parent'";
                    $result_total_star = mysqli_query($conn, $sql);
                    $row_total_star = mysqli_fetch_array($result_total_star);
                    $total_star = $row_total_star["total_star"];
                    $total_star = sprintf('%0.1f', $total_star);

                    if ($row["file_name"]) {
                        $file_image = "<img src='./img/file.gif' height='13'>";
                    } else {
                        $file_image = "";
                    }
                ?>

                    <li>
                        <!-- 하나의 스토리 -->
                        <div class="story_list_column">

                            <a href="/eduplanet/acd_story/view.php?no=<?= $no ?>">
                                <div class="story_list_column_img">
                                    <img src="/eduplanet/data/acd_story/<?= $file_copy ?>" alt="story_list_column_img">
                                </div>

                                <div class="story_list_column_text">
                                    <h1 id="story_text_title"><?= $title ?>
                            </a>

                            <div class="story_academy_heart">
                                <span>학원 찜하기</span>

                                <?php 
                                    if ($gm_no) {
                                ?>

                                <a href="/eduplanet/acd_story/follow.php?no=<?= $parent ?>"><button type="button" id="button_academy_heart">like</button></a>
                                
                                <?php
                                    } else {
                                ?>

                                <a href="javascript:alert('일반회원만 이용 가능합니다.')"><button type="button" id="button_academy_heart">like</button></a>

                                <?php
                                    }
                                ?>

                            </div>

                            </h1>
                            <p id="story_text_title_sub"><?= $subtitle ?></p>

                            <div class="story_list_column_academy_info">
                                <a href="/eduplanet/academy/index.php?no=<?=$acd_no?>"><span id="academy_title_span"><?= $acd_name ?></span></a>
                                <span id="academy_district"><?= $si_name ?></span>

                                <div class="academy_small_star">
                                    <img src="/eduplanet/img/review_star_one.png" alt="academy_small_star">
                                    <span id="academt_review_star_score"><?= $total_star ?></span>
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
                        $first_page = $last_page - ($page_scale - 1);

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
                                echo "<li><a href='/eduplanet/acd_story/index.php?page=1'><span class='page_num_direction'><i class='fas fa-angle-double-left'></i></span></a></li>";
                            } else {
                                echo "<li><a><span class='page_num_direction'><i class='fas fa-angle-double-left'></i></span></a></li>";
                            }

                            echo "<li><a><span class='page_num_direction'><i class='fas fa-angle-left'></i></span></a></li>";
                        } else {
                            echo "<li><a href='/eduplanet/acd_story/index.php?page=1'><span class='page_num_direction'><i class='fas fa-angle-double-left'></i></span></a></li>";
                            echo "<li><a href='/eduplanet/acd_story/index.php?page=$prev'><span class='page_num_direction'><i class='fas fa-angle-left'></i></span></a></li>";
                        }

                        //페이지 번호 매기기
                        for ($i = $first_page; $i <= $last_page; $i++) {

                            if ($page == $i) {
                                echo "<li><span class='page_num_set'><b style='color:#2E89FF'> $i </b></span></li>";
                            } else {
                                echo "<li><a href='/eduplanet/acd_story/index.php?page=$i'><span class='page_num_set'> &nbsp$i&nbsp </span></a></li>";
                            }
                        }

                        // 마지막 페이지일 때 앵커 비활성화
                        if ($last_page == $total_page) {
                            echo "<li><a><span class='page_num_direction'><i class='fas fa-angle-right'></i></span></a></li>";

                            if ($page != $total_page) {
                                echo "<li><a href='/eduplanet/acd_story/index.php?page=$total_page'><span class='page_num_direction_last'><i class='fas fa-angle-double-right'></i></span></a></li>";
                            } else {
                                echo "<li><a><span class='page_num_direction_last'><i class='fas fa-angle-double-right'></i></span></a></li>";
                            }
                        } else {
                            echo "<li><a href='/eduplanet/acd_story/index.php?page=$next'><span class='page_num_direction'><i class='fas fa-angle-right'></i></span></a></li>";
                            echo "<li><a href='/eduplanet/acd_story/index.php?page=$total_page'><span class='page_num_direction_last'><i class='fas fa-angle-double-right'></i></span></a></li>";
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <!-- end of page_num_wrap -------------------------------------------------------->

        </div>
    </div>

    <footer>
        <?php include_once $_SERVER["DOCUMENT_ROOT"] . "/eduplanet/index/footer.php"; ?>
    </footer>

</body>

</html>