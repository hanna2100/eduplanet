<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>에듀플래닛</title>

    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/eduplanet/mypage/css/membership_pay.css">

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
                                <li id="select_aside_menu">결제 내역</li>
                            </a>
                            <a href="/eduplanet/mypage/membership_using.php">
                                <li>이용중인 멤버십</li>
                            </a>
                        </ul>
                    </div>
                </div>

                <div class="mypage_content">

                    <div class="mypage_content_title">
                        <h4>결제 내역</h4>
                        <p>∗ 신용카드, 휴대폰 결제 시 세금계산서가 발행되지 않습니다.</p>
                        <p>∗ 취소 및 환불에 대한 문의는 고객 문의 페이지를 이용해 주시기 바랍니다.</p>
                    </div>

                    <?php
                    // 결제내역 test ============================================================

                    // user_no 가 gm_no 랑 같은가?
                    $user_no = 1;

                    include "../lib/db_connector.php";

                    $sql = "SELECT * from gm_order WHERE gm_no='$user_no'";

                    $result = mysqli_query($conn, $sql);
                    $total_record = mysqli_num_rows($result);


                    if (!$result) {

                    ?>
                        <!-- 결제 내역이 없을 때 -->
                        <div class="mypage_content_list_none">
                            <h4>결제 내역이 없습니다.</h4>
                            <p>에듀 플래닛 멤버십을 이용하시면 모든 학원의 리뷰를 보실 수 있습니다.</p>
                            <p>현명한 학원 선택, 에듀 플래닛과 함께해 보세요.</p>
                            <button id="button_membership_go" onclick="">멤버십 둘러보기</button>
                        </div>


                    <?php
                    } else {
                    ?>

                        <!-- 결제 내역이 있을 때 -->
                        <div class="mypage_content_list">

                            <div class="membership_table_header">
                                <ul>
                                    <li id="header_membership_name">상품명</li>
                                    <li id="header_membership_price">결제금액</li>
                                    <li id="header_membership_method">결제방법</li>
                                    <li id="header_membership_status">결제상태</li>
                                    <li id="header_membership_pay_day">결제일자</li>
                                </ul>
                            </div>

                            <?php
                            for ($i = 0; $i < $total_record; $i++) {

                                mysqli_data_seek($result, $i);

                                $row = mysqli_fetch_array($result);

                                $prdct_name_month = $row["prdct_name_month"];
                                $price = $row["price"];
                                $pay_method = $row["pay_method"];
                                $status = $row["status"];
                                $date = $row["date"];
                            ?>

                                <div class="membership_table_list">
                                    <ul>
                                        <li id="membership_name"><?= $prdct_name_month ?></li>
                                        <li id="membership_price"><?= $price ?> 원</li>
                                        <li id="membership_method"><?= $pay_method ?></li>
                                        <li id="membership_status"><?= $status ?></li>
                                        <li id="membership_pay_day"><?= $date ?></li>
                                    </ul>
                                </div>

                        <?php
                            }
                        }
                        ?>
                        </div>
                </div>
            </div>

        </div>

        <footer>
            <?php include "../index/footer.php"; ?>
        </footer>

    </div>

</body>

</html>