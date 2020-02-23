<?php

        // login 에서 세션값 가져오기

        session_start();

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

        // $gm_no = 1;
        $am_no = 1;

        // session ==================================================
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>에듀플래닛</title>

    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/eduplanet/index/index_header.css">

</head>

<body>

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
                                    <li id="review_write"><a href="javascript:alert('리뷰 작성은 일반 회원만 이용 가능합니다.')">리뷰 작성</a></li>

                                    <?php
                                    // 로그인 안했을 때
                                    } else {
                                    ?>
                                    <li id="review_write"><a href="javascript:alert('로그인 후 이용 가능합니다.')">리뷰 작성</a></li>
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
                                            <a id="not_mem" href="javascript:alert('로그인 후 이용 가능합니다.')"><li>로그인 해주세요.</li></a>
                                            <script>
                                                document.getElementsByClassName("index_header_menu_hover_detail_profile")[0].style.height = "55px";
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

    <?php include "./mypage/review_write_popup.php"; ?>

</body>

</html>