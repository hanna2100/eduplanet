<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>에듀플래닛</title>

    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/eduplanet/mypage/css/myinfo.css">

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
                    <a href="/eduplanet/mypage/am_myinfo.php">
                        <li id="mypage_user_myinfo">내 정보</li>
                    </a>
                    <a href="/eduplanet/mypage/am_membership_pay.php">
                        <li id="mypage_user_membership">멤버십/결제</li>
                    </a>

                    <!-- 학원 바로가기 / 경로수정 -->
                    <a href="#">
                        <li id="mypage_user_review">My Academy</li>
                    </a>
                </ul>
            </div>
        </div>

        <div class="mypage_content_wrap">

            <div class="mypage_content">

            </div>

        </div>





        <footer>
            <?php include "../index/footer.php"; ?>
        </footer>

        
    </div>
        
</body>

</html>