<?php

        // login 에서 세션값 가져오기

        // session_start();

        if (isset($_SESSION["gm_no"])) {
            $gm_no = $_SESSION["gm_no"];
        } else {
            $gm_no = "";
        } 
        
        if (isset($_SESSION["am_no"])) {
            $am_no = $_SESSION["am_no"];
        } else {
            $am_no = "";
        }
        
        // session test ============================================

        // 일반회원 세션 테스트
        $gm_no = 1;

        // 기업회원 세션 테스트
        // $am_no = 1;

        // 세션을 주지 않으면 비회원 테스트

        // session ==================================================
?>

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
    <link rel="stylesheet" href="/eduplanet/index/index_header_searchbar_in.css">

    <!-- 스크립트 -->
    <script src="/eduplanet/searchbar/searchbar_in.js"></script>

</head>

<body>

    <div class="body_wrap">
        <div class="index_header_wrap">

            <!-- 헤더 메뉴 -->
            <div class="index_header_menu">

                <ul class="index_header_menu_ul_left">
                    <li>
                        <a href="/eduplanet/index.php">
                            <div class="index_header_logo_img">
                                <img src="/eduplanet/img/eduplanet_logo.png" alt="index_header_logo_img">
                            </div>

                        </a>
                    </li>

                    <li>
                        <a href="#">
                            <span>학원</span>
                            <div class="index_header_menu_hover">
                                <img src="/eduplanet/img/index_header_hover.png" alt="index_header_menu_hover">
                            </div>
                        </a>
                    </li>

                    <li>
                        <a href="/eduplanet/acd_story/index.php">
                            <span>스토리</span>
                            <div class="index_header_menu_hover">
                                <img src="/eduplanet/img/index_header_hover.png" alt="index_header_menu_hover">
                            </div>
                        </a>
                    </li>

                    <li>
                        <a href="#">
                            <span>멤버십</span>
                            <div class="index_header_menu_hover">
                                <img src="/eduplanet/img/index_header_hover.png" alt="index_header_menu_hover">
                            </div>
                        </a>
                    </li>

                </ul>

                <form name="search_academy_form" action="#" method="post">
                    <div class="index_header_searchbar_in">
                        <input placeholder="학원 이름으로 검색" type="text" name="acd_name" id="acd_name_in">
                        <button id="button_main_search" type="button">검색</button>
                    </div>
                </form>

                <ul class="index_header_menu_ul_right">

                    <li>
                        <!-- 리뷰쓰기 -->
                        <div class="index_header_review_img">
                            <img src="/eduplanet/img/index_header_review.png" alt="index_header_review">
                        </div>

                        <div class="index_header_menu_hover_detail">
                            <img src="/eduplanet/img/index_header_hover.png" alt="index_header_menu_hover">

                            <div class="index_header_menu_hover_detail_review">
                                <ul>

                                    <?php
                                    // 일반 회원
                                    if ($gm_no) {
                                    ?>
                                    <li id="review_write" onclick="showPopup(1);">리뷰 작성</li>

                                    <?php
                                    // 학원 회원
                                    } else if ($am_no) {
                                    ?>
                                    <a href="javascript:alert('리뷰 작성은 일반 회원만 이용 가능합니다.')"><li id="review_write">리뷰 작성</li></a>

                                    <?php
                                    // 로그인 안했을 때
                                    } else {
                                    ?>
                                    <a href="javascript:alert('로그인 후 이용 가능합니다.')"><li id="review_write">리뷰 작성</li></a>
                                    <?php
                                    }
                                    ?>

                                </ul>

                            </div>
                        </div>
                    </li>

                    <li>
                        <!-- 내정보 -->
                        <div class="index_header_profile_img">
                            <img src="/eduplanet/img/index_header_profile.png" alt="index_header_profile">
                        </div>

                        <div class="index_header_menu_hover_detail">
                            <img src="/eduplanet/img/index_header_hover.png" alt="index_header_menu_hover">

                            <div class="index_header_menu_hover_detail_profile">
                                <ul>
                                        <?php
                                        // 일반회원 메뉴
                                        if ($gm_no) {
                                        ?>

                                        <a href="/eduplanet/mypage/myinfo.php"><li>내 정보</li></a>
                                        <a href="/eduplanet/mypage/follow.php"><li>찜목록</li></a>
                                        <a href="/eduplanet/mypage/membership_pay.php"><li>멤버십/결제</li></a>
                                        <a href="/eduplanet/mypage/review_mylist.php"><li>리뷰</li></a>
                                        <a href="/eduplanet/index/logout.php"><li>로그아웃</li></a>
                                            
                                        <?php
                                       // 학원회원 메뉴
                                        } else if ($am_no) {
                                        ?>
                                    
                                        <a href="/eduplanet/mypage/am_myinfo.php"><li>내 정보</li></a>
                                        <a href="/eduplanet/mypage/am_membership_pay.php"><li>멤버십/결제</li></a>

                                        <!-- 경로수정하기 -->
                                        <a href="#"><li>My Academy</li></a>
                                        <a href="/eduplanet/index/logout.php"><li>로그아웃</li></a>

                                        <script>
                                                document.getElementsByClassName("index_header_menu_hover_detail_profile")[0].style.height = "175px";
                                        </script>

<?php
                                        // 로그인 안했을 때
                                        } else {
                                        ?>
                                            <!-- <a id="not_mem" href="javascript:alert('로그인 후 이용 가능합니다.')"><li>로그인 해주세요.</li></a> -->
                                            <a id="not_mem" href="/eduplanet/login_join/login_form.php"><li>로그인</li></a>
                                            <a id="not_mem" href="/eduplanet/login_join/join_form.php"><li>회원가입</li></a>
                                            <script>
                                                document.getElementsByClassName("index_header_menu_hover_detail_profile")[0].style.height = "95px";
                                            </script>
                                        <?php
                                        }
                                        ?>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>

            </div>

        </div>
    </div>

    <?php include "../mypage/review_write_popup.php"; ?>

</body>

</html>