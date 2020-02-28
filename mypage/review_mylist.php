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
    <link rel="stylesheet" href="/eduplanet/mypage/css/review_mylist.css">

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

</head>

<body>
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

        <div class="content_wrap">

            <div class="mypage_content_wrap">
                <div class="mypage_content_aside_menu">

                    <div class="mypage_content_aside_menu_title">
                        <h3>&nbsp;리뷰</h3>

                        <ul>
                            <a href="/eduplanet/mypage/review_mylist.php">
                                <li id="select_aside_menu">작성한 리뷰</li>
                            </a>
                            <a href="#">
                                <li id="review_write" onclick="showPopup(1);">리뷰 작성하기</li>
                            </a>
                        </ul>
                    </div>
                </div>

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

                include_once $_SERVER["DOCUMENT_ROOT"] . "/eduplanet/lib/db_connector.php";

                // $sql = "SELECT review.no, acd_name, total_star, one_line, facility, acsbl, teacher, cost_efct, achievement, benefit, drawback FROM review INNER JOIN academy ON review.parent = academy.no WHERE user_no='$user_no'";
                $sql = "SELECT review.no, acd_name, total_star, regist_day FROM review INNER JOIN academy ON review.parent = academy.no WHERE user_no='$user_no'";

                $result = mysqli_query($conn, $sql);
                $total_record = mysqli_num_rows($result);
                ?>

                <div class="mypage_content">

                    <div class="mypage_content_title">
                        <h4>작성한 리뷰</h4>
                        <p>총 <span id="review_list_num"><?= $total_record ?></span> 개의 리뷰를 작성하셨습니다.</p>
                        <span id="review_delete_p">* 리뷰 삭제는 작성일로부터 30일 이후에 가능합니다.</span>
                    </div>

                    <?php
                    if ($total_record == 0) {
                    ?>
                        <!-- 작성한 리뷰가 없을 때 -->
                        <div class="mypage_content_list_none">
                            <h4>작성한 리뷰가 없습니다.</h4>
                            <p>리뷰를 작성하시면 리뷰를 조회할 수 있는 <b>무료 이용권 (7일)</b> 을 드립니다.</p>
                            <p>지금 작성하시고 무료 혜택을 받아 보세요.</p>
                            <button id="button_review_write" onclick="showPopup(1);">리뷰 작성하기</button>
                        </div>


                    <?php
                    } else {
                    ?>

                        <!-- 작성한 리뷰가 있을 때 -->
                        <div class="mypage_content_list">

                            <div class="review_table_header">
                                <ul>
                                    <li id="header_review_acd_name">학원명</li>
                                    <li id="header_review_regist_day">작성일</li>
                                    <li id="header_review_status">등록상태</li>
                                    <li id="header_review_total_star">총 별점</li>
                                    <li id="header_review_edit_delete">수정/삭제</li>
                                </ul>
                            </div>

                            <?php
                            for ($i = 0; $i < $total_record; $i++) {

                                mysqli_data_seek($result, $i);

                                $row = mysqli_fetch_array($result);

                                $acd_name = $row["acd_name"];
                                $regist_day = $row["regist_day"];
                                $total_star = $row["total_star"];

                                $no = $row["no"];

                            ?>

                                <div class="review_table_list">
                                    <ul>
                                        <li id="update_review_no" style="display: none"><?= $no ?></li>

                                        <li id="review_acd_name"><?= $acd_name ?></li>
                                        <li id="review_regist_day"><?= $regist_day ?></li>
                                        <li id="review_status">등록완료</li>
                                        <li id="review_total_star"><?= $total_star ?></li>

                                        <li id="review_edit_delete">
                                            <a id="review_update" href="#" onclick="showPopup(2, <?= $no ?>);">수정 |</a>
                                            <a href="#" onclick="deleteReview(<?= $no ?>);"> 삭제</a>
                                        </li>

                                    </ul>
                                </div>

                            <?php
                            }
                            mysqli_close($conn);
                            ?>


                        </div>

                    <?php
                    }
                    ?>

                </div>
            </div>

        </div>

        <footer>
            <?php include_once $_SERVER["DOCUMENT_ROOT"] . "/eduplanet/index/footer.php"; ?>
        </footer>

    </div>

</body>

</html>