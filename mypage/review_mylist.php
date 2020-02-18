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

        <div class="content_wrap">

            <div class="mypage_content_wrap">
                <div class="mypage_content_aside_menu">

                    <div class="mypage_content_aside_menu_title">
                        <h3>&nbsp;리뷰</h3>

                        <ul>
                            <a href="/eduplanet/mypage/review_mylist.php">
                                <li id="select_aside_menu">작성한 리뷰</li>
                            </a>
                            <a href="/eduplanet/mypage/review_write.php">
                                <li>리뷰 작성하기</li>
                            </a>
                        </ul>
                    </div>
                </div>

                <div class="mypage_content">

                    <div class="mypage_content_title">
                        <h4>작성한 리뷰</h4>
                        <p>총 <span id="review_list_num">0</span> 개의 리뷰를 작성하셨습니다.</p>
                    </div>




                    <?php

                    // 결제내역 test ============================================================

                    $review = 1;

                    if ($review == 0) {

                    ?>
                        <!-- 작성한 리뷰가 없을 때 -->
                        <div class="mypage_content_list_none">
                            <h4>작성한 리뷰가 없습니다.</h4>
                            <p>리뷰를 작성하시면 무료로 모든 학원 리뷰를 조회하실 수 있습니다.</p>
                            <p>지금 작성하시고 무료 혜택을 받아 보세요.</p>
                            <a href="/eduplanet/mypage/review_write.php"><button id="button_review_write">리뷰 작성하기</button></a>
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

                            <div class="review_table_list">
                                <ul>
                                    <li id="review_acd_name">미래고양이개발교육원</li>
                                    <li id="review_regist_day">2020-02-18</li>
                                    <li id="review_status">승인대기</li>
                                    <li id="review_total_star">5.0</li>
                                    <li id="review_edit_delete"><a href="#">수정 </a>|<a href="#"> 삭제</a></li>
                                </ul>
                            </div>

                            
                        </div>

                    <?php
                    }
                    ?>

                </div>
            </div>

        </div>

        <footer>
            <?php include "../footer.php"; ?>
        </footer>

    </div>

</body>

</html>