<?php include_once $_SERVER["DOCUMENT_ROOT"] . "/eduplanet/lib/session_start.php"; ?>

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
    <link rel="stylesheet" href="/eduplanet/index/index_header_searchbar_in.css">
    <link rel="stylesheet" href="/eduplanet/index/footer.css">
    <link rel="stylesheet" href="/eduplanet/mypage/css/mypage_header.css">
    <link rel="stylesheet" href="/eduplanet/mypage/css/review_write_popup.css">
    <link rel="stylesheet" href="/eduplanet/mypage/css/follow.css">

    <!-- 스크립트 -->
    <script src="/eduplanet/searchbar/searchbar_in.js"></script>
    <script src="/eduplanet/mypage/js/review_write.js"></script>

    <!-- 자동완성 -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <!-- identicon (프로필 이미지) -->
    <script src="//cdn.rawgit.com/placemarker/jQuery-MD5/master/jquery.md5.js"></script>
    <script src="//rawgit.com/stewartlord/identicon.js/master/pnglib.js"></script>
    <script src="//rawgit.com/stewartlord/identicon.js/master/identicon.js"></script>

    <script>
        $(document).ready(function() {

            // 아이디에 따라 생성되는 프로필 이미지 만드는 함수 (세션에서 userid를 받아온다)
            $(".user_img").each(function() {

                $(this).prop('src', 'data:image/png;base64,' + new Identicon($.md5($(this).data("userid")), 80)).show();
            });
        });
    </script>

    <script>
        function deleteFollow(follow_no) {

            var deleteConf = confirm('찜하기를 취소하시겠습니까?');

            if (deleteConf === true) {
                location.href = "/eduplanet/mypage/follow_delete.php?no=" + follow_no;

            } else {
                alert("삭제가 취소되었습니다.");
            }
        }

        function selectOption() {

            selectDis = document.getElementById("follow_list_select_district").value;
            selectSort = document.getElementById("follow_list_select_mode").value;

            location.href = "/eduplanet/mypage/follow.php?district=" + selectDis + "&sort=" + selectSort;
        }
    </script>

</head>

<body onload="setSelectDis(); setSelectSort();">

    <div class="body_wrap">

        <header>
            <div class="header_searchbar_fix">
                <?php include_once $_SERVER["DOCUMENT_ROOT"] . "/eduplanet/index/index_header_searchbar_in.php"; ?>
            </div>

            <div class="header_mypage">
                <?php include_once $_SERVER["DOCUMENT_ROOT"] . "/eduplanet/mypage/mypage_header.php"; ?>
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

                $user_no = $gm_no;

                if (!$user_no) {
                    echo "
                        <script>
                            alert('잘못된 접근입니다.');
                            history.go(-1)
                        </script>
                    ";
                }

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
                                document.getElementById('follow_list_select_district').value = '$selectDis';
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
                            document.getElementById('follow_list_select_mode').value = '$selectSort';
                        }
                    </script>
                    ";
                } else {
                    $selectSort = "";
                }

                include_once $_SERVER["DOCUMENT_ROOT"] . "/eduplanet/lib/db_connector.php";

                // 지역이 선택되어 있을 때
                if ($selectDis != "") {

                    if ($selectSort == "star_max") {
                        $sql = "SELECT academy.no as acd_no, acd_name, si_name, follow.acd_no as f_acd_no, follow.no, review.total_star FROM follow INNER JOIN academy ON follow.acd_no = academy.no INNER JOIN review ON academy.no = review.parent WHERE follow.user_no='$user_no' and academy.si_name='$selectDis' GROUP BY follow.no ORDER BY review.total_star DESC";
                    } else if ($selectSort == "regist_day") {
                        $sql = "SELECT academy.no as acd_no, acd_name, si_name, follow.acd_no as f_acd_no, follow.no, review.total_star FROM follow INNER JOIN academy ON follow.acd_no = academy.no INNER JOIN review ON academy.no = review.parent WHERE follow.user_no='$user_no' and academy.si_name='$selectDis' GROUP BY follow.no ORDER BY follow.no DESC";
                    }

                    // 지역이 선택되지 않았을 때
                } else if ($selectDis == "") {

                    if ($selectSort == "star_max") {
                        $sql = "SELECT academy.no as acd_no, acd_name, si_name, follow.acd_no as f_acd_no, follow.no, review.total_star FROM follow INNER JOIN academy ON follow.acd_no = academy.no INNER JOIN review ON academy.no = review.parent WHERE follow.user_no='$user_no' GROUP BY follow.no ORDER BY review.total_star DESC";

                        // 기본 셋팅은 최근 등록순
                    } else {
                        $sql = "SELECT academy.no as acd_no, acd_name, si_name, follow.acd_no as f_acd_no, follow.no, review.total_star FROM follow INNER JOIN academy ON follow.acd_no = academy.no INNER JOIN review ON academy.no = review.parent WHERE follow.user_no='$user_no' GROUP BY follow.no ORDER BY follow.no DESC";
                    }
                }

                $result = mysqli_query($conn, $sql);
                $total_record = mysqli_num_rows($result);



                ?>

                <!-- select box -------------------------------------------------------------------------------------->
                <div class="follow_list_select">

                    <h2>
                        내 찜목록
                    </h2>
                    <span id="follow_total_span">총 <span id="follow_total_num"><?= $total_record ?></span> 개의 찜한 학원이 있습니다.</span>

                    <div class="follow_select">
                        <select name="follow_list_select_district" id="follow_list_select_district" onchange="selectOption();">
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

                        <select name="follow_list_select_mode" id="follow_list_select_mode" onchange="selectOption();">
                            <option value="star_max" selected>총 만족도 순</option>
                            <option value="regist_day">최근 찜한 순</option>
                        </select>
                    </div>
                </div>

                <!-- start of ul ------------------------------------------------------------------------------------->

                <?php

                // 찜한 목록이 있을 때
                if ($total_record !== 0) {

                ?>

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
                            $f_acd_no = $row["f_acd_no"];
                            $follow_no = $row["no"];

                            $sql = "SELECT * FROM acd_story WHERE parent='$f_acd_no'";
                            $result_story = mysqli_query($conn, $sql);
                            $total_record_story = mysqli_num_rows($result_story);

                            $sql = "SELECT AVG(total_star) as total_star FROM review WHERE parent='$f_acd_no'";
                            $result_total_star = mysqli_query($conn, $sql);
                            $total_record_review = mysqli_num_rows($result_total_star);

                            $row = mysqli_fetch_array($result_total_star);
                            $total_star = $row["total_star"];
                            $total_star = sprintf('%0.1f', $total_star);

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
                                    <a href="/eduplanet/academy/index.php?no=<?= $acd_no ?>">
                                        <div class="follow_list_column_img">
                                            <img src="/eduplanet/test_img/academy_big_logo.jpg" alt="follow_list_column_img">
                                        </div>

                                        <div class="follow_list_column_text">
                                            <h1 id="follow_text_academy"><?= $acd_name ?>
                                    </a>

                                    </h1>
                                    <p id="follow_text_district"><?= $si_name ?></p>

                                    <div class="follow_list_column_review">
                                        <a href="/eduplanet/academy/review.php?no=<?= $acd_no ?>"><span id="academy_review_span">학원리뷰 <span id="academy_review_num"><?= $total_record_review ?></span></span></a>
                                        <a href="/eduplanet/academy/acd_story.php?no=<?= $acd_no ?>"><span id="academy_review_span">스토리 <span id="academy_review_num"><?= $total_record_story ?></span></span></a>

                                    </div>
                                </div>

                                <!-- 오른쪽 별점 & 삭제버튼 -->
                                <div class="follow_list_column_sub">

                                    <div class="follow_academy_heart">
                                        <span>찜하기 취소</span>
                                        <button type="button" id="button_academy_heart" onclick="deleteFollow(<?= $follow_no ?>);">like</button>
                                    </div>

                                    <div class="follow_academy_star_wrap">
                                        <span class="follow_academy_star_span">총 만족도</span>

                                        <div class="follow_academy_star">

                                            <?php
                                            // 총 만족도 평균에 따라 별 보여주기
                                            for ($j = 1; $j <= 5; $j++) {

                                                if ($j <= round($total_star)) {
                                                    echo "<img class='acd_star_class' src='/eduplanet/img/yellow_star.png' alt='follow_academy_star'>";
                                                } else {
                                                    echo "<img class='acd_star_class' src='/eduplanet/img/yellow_star_empty.png' alt='follow_academy_star'>";
                                                }
                                            }
                                            ?>

                                        </div>

                                        <span class="follow_academy_star_num"><?= $total_star ?></span>

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

                        <?php
                        // 찜한 목록이 없을 때
                    } else {
                        ?>
                            <div class="list_none">
                                <h2>찜한 학원이 없습니다.</h2>
                                <p class="list_none_p">아직 찜한 학원이 없습니다.</p>
                                <p class="list_none_p">찜하기를 하신 후 모든 학원을 한 눈에 비교해 보세요.</p>
                                <a href="/eduplanet/acd_list/index.php"><button type="button">학원 보러 가기</button></a>
                            </div>

                        <?php
                    }
                        ?>
                        </div>
                    </div>
                    <!-- end of page_num_wrap -------------------------------------------------------->

            </div>
        </div>





        <footer>
            <?php include_once $_SERVER["DOCUMENT_ROOT"] . "/eduplanet/index/footer.php"; ?>
        </footer>


    </div>

</body>

</html>
