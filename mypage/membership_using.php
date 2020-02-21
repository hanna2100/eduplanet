<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>에듀플래닛</title>

    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/eduplanet/mypage/css/membership_using.css">

</head>

<body>
    <div class="body_wrap">

        <header>
            <div class="header_searchbar_fix">
                <?php include '../index/index_header_searchbar_in.php'; ?>
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

        <div class="content_wrap">

            <div class="mypage_content_wrap">
                <div class="mypage_content_aside_menu">

                    <div class="mypage_content_aside_menu_title">
                        <h3>&nbsp;멤버십/결제</h3>

                        <ul>
                            <a href="/eduplanet/mypage/membership_pay.php">
                                <li>결제 내역</li>
                            </a>
                            <a href="/eduplanet/mypage/membership_using.php">
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

                    // 이용중인 멤버십 test ============================================================

                     // user_no 가 gm_no 랑 같은가?
                     $user_no = 2;

                     include "../lib/db_connector.php";
 
                     $sql = "SELECT * from gm_order WHERE gm_no='$user_no'";
 
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

                                $sql = "SELECT expiry_day FROM g_members WHERE no='$user_no'";
                                $result_exp = mysqli_query($conn, $sql);
                                $row = mysqli_fetch_array($result_exp);

                                $expiry_day = $row["expiry_day"];

                                // 남은일자 계산
                                $expiry_day_num = substr($expiry_day, 0, 4).substr($expiry_day, 5, 2).substr($expiry_day, 8, 2);
                                $today = date("Ymd");
                                $membership_day = (strtotime($expiry_day_num) - strtotime($today))/60/60/24;

                            ?>

                            <div class="membership_table_list">
                                <ul>
                                    <li id="membership_name"><?=$prdct_name_month?></li>
                                    <li id="membership_start_day"><?=$date?></li>
                                    <li id="membership_end_day"><?=$expiry_day?></li>
                                    <li id="membership_valid_day"><?=$membership_day?> 일</li>
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
            <?php include "../index/footer.php"; ?>
        </footer>

    </div>

</body>

</html>