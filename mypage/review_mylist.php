<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>에듀플래닛</title>

    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/eduplanet/mypage/css/review_mylist.css">

</head>

<body>
    <div class="body_wrap">

        <header>
            <div class="header_searchbar_fix">
                <?php include_once '../index/index_header_searchbar_in.php'; ?>
            </div>

            <div class="header_mypage">
                <?php include_once './mypage_header.php'; ?>
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
                    // 리뷰 test ============================================================

                    $user_no = $gm_no;

                    if (!$user_no) {
                        echo "
                            <script>
                                alert('잘못된 접근입니다.');
                                history.go(-1)
                            </script>
                        ";
                    }

                    include_once "../lib/db_connector.php";

                    // $sql = "SELECT review.no, acd_name, total_star, one_line, facility, acsbl, teacher, cost_efct, achievement, benefit, drawback FROM review INNER JOIN academy ON review.parent = academy.no WHERE user_no='$user_no'";
                    $sql = "SELECT review.no, acd_name, total_star, regist_day FROM review INNER JOIN academy ON review.parent = academy.no WHERE user_no='$user_no'";

                    $result = mysqli_query($conn, $sql);
                    $total_record = mysqli_num_rows($result);
                    ?>

                <div class="mypage_content">

                    <div class="mypage_content_title">
                        <h4>작성한 리뷰</h4>
                        <p>총 <span id="review_list_num"><?=$total_record?></span> 개의 리뷰를 작성하셨습니다.</p>
                    </div>

                    <?php
                    if (!$result) {
                    ?>
                        <!-- 작성한 리뷰가 없을 때 -->
                        <div class="mypage_content_list_none">
                            <h4>작성한 리뷰가 없습니다.</h4>
                            <p>리뷰를 작성하시면 무료로 모든 학원 리뷰를 조회하실 수 있습니다.</p>
                            <p>지금 작성하시고 무료 혜택을 받아 보세요.</p>
                            <a href="/eduplanet/mypage/review_write_popup.php"><button id="button_review_write">리뷰 작성하기</button></a>
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
                                for ($i=0; $i < $total_record; $i++) {

                                mysqli_data_seek($result, $i);

                                $row = mysqli_fetch_array($result);
                
                                $acd_name = $row["acd_name"];
                                $regist_day = $row["regist_day"];
                                $total_star = $row["total_star"];
                                
                                $no = $row["no"];
                             
                            ?>

                            <div class="review_table_list">
                                <ul>
                                    <li id="update_review_no" style="display: none"><?=$no?></li>

                                    <li id="review_acd_name"><?=$acd_name?></li>
                                    <li id="review_regist_day"><?=$regist_day?></li>
                                    <li id="review_status">등록완료</li>
                                    <li id="review_total_star"><?=$total_star?></li>

                                    <li id="review_edit_delete">
                                        <a id="review_update" href="#" onclick="showPopup(2, <?=$no?>);">수정 |</a>
                                        <a href="#" onclick="deleteReview(<?=$no?>);"> 삭제</a>
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
            <?php include "../index/footer.php"; ?>
        </footer>
        
    </div>
    
</body>

</html>