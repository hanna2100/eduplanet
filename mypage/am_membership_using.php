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
    <link rel="stylesheet" href="/eduplanet/mypage/css/membership_using.css">

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
                    <a href="/eduplanet/mypage/am_myinfo.php">
                        <li id="mypage_user_myinfo">내 정보</li>
                    </a>

                    <a href="/eduplanet/mypage/am_membership_pay.php">
                        <li id="mypage_user_membership">멤버십/결제</li>
                    </a>

                    <a href="/eduplanet/academy/index.php?no=<?= $am_no ?>">
                        <li id="mypage_user_review">My Academy</li>
                    </a>
                </ul>
            </div>
        </div>

        <div class="content_wrap">

            <div class="mypage_content_wrap">
                <div class="mypage_content_aside_menu">

                    <div class="mypage_content_aside_menu_title">
                        <h3>&nbsp;멤버십/결제</h3>

                        <ul>
                            <a href="/eduplanet/mypage/am_membership_pay.php">
                                <li>결제 내역</li>
                            </a>
                            <a href="/eduplanet/mypage/am_membership_using.php">
                                <li id="select_aside_menu">이용중인 멤버십</li>
                            </a>
                        </ul>
                    </div>
                </div>

                <div class="mypage_content">

                    <div class="mypage_content_title">
                        <h4>이용중인 멤버십</h4>
                        <p>∗ 현재 이용 가능한 멤버십이 표시됩니다.</p>
                        <p>∗ 이용권에 대한 문의는 고객문의 페이지를 이용해 주시기 바랍니다.</p>
                    </div>

                    <?php

                    $user_no = $am_no;

                    if (!$user_no) {
                        echo "
                            <script>
                                alert('잘못된 접근입니다.');
                                history.go(-1)
                            </script>
                        ";
                    }

                    include_once $_SERVER["DOCUMENT_ROOT"] . "/eduplanet/lib/db_connector.php";

                    $sql = "SELECT * from am_order WHERE am_no='$user_no'";

                    $result = mysqli_query($conn, $sql);
                    $total_record = mysqli_num_rows($result);

                    if (!$result) {

                    ?>
                        <!-- 이용 내역이 없을 때 -->
                        <div class="mypage_content_list_none">
                            <h4>이용중인 멤버십이 없습니다.</h4>
                            <p>에듀 플래닛 멤버십을 이용하시면 모든 학원의 리뷰를 보실 수 있습니다.</p>
                            <p>현명한 학원 선택, 에듀 플래닛과 함께해 보세요.</p>
                            <button id="button_membership_go" onclick="">멤버십 둘러보기</button>
                        </div>

                    <?php
                    } else {
                    ?>

                        <!-- 이용 내역이 있을 때 -->
                        <div class="mypage_content_list">

                            <div class="membership_table_header">
                                <ul>
                                    <li id="header_membership_name">멤버십</li>
                                    <li id="header_membership_start_day">등록일자</li>
                                    <li id="header_membership_end_day">만료일자</li>
                                    <li id="header_membership_valid_day">남은일자</li>
                                </ul>
                            </div>

                            <?php
                            for ($i = 0; $i < $total_record; $i++) {

                                mysqli_data_seek($result, $i);
                                $row = mysqli_fetch_array($result);

                                $prdct_name_month = $row["prdct_name_month"];
                                $date = $row["date"];

                                $sql = "SELECT expiry_day FROM a_members WHERE no='$user_no'";
                                $result_exp = mysqli_query($conn, $sql);
                                $row = mysqli_fetch_array($result_exp);

                                $expiry_day = $row["expiry_day"];

                                // 남은일자 계산
                                $expiry_day_num = substr($expiry_day, 0, 4) . substr($expiry_day, 5, 2) . substr($expiry_day, 8, 2);
                                $today = date("Ymd");
                                $membership_day = (strtotime($expiry_day_num) - strtotime($today)) / 60 / 60 / 24;

                            ?>

                                <div class="membership_table_list">
                                    <ul>
                                        <li id="membership_name"><?= $prdct_name_month ?></li>
                                        <li id="membership_start_day"><?= $date ?></li>
                                        <li id="membership_end_day"><?= $expiry_day ?></li>
                                        <li id="membership_valid_day"><?= $membership_day ?> 일</li>
                                    </ul>
                                </div>


                        </div>

                <?php
                            }
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