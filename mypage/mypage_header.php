<?php
    // test
    // session_start();

    $_SESSION["user_no"] = 2;

    $user_no = $_SESSION["user_no"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>에듀플래닛</title>

    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR&amp;display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/eduplanet/mypage/css/mypage_header.css">

    <!-- <script src="//code.jquery.com/jquery-3.2.1.min.js"></script> -->

    <!-- 자동완성 -->
    <script src="http://code.jquery.com/jquery-1.12.4.min.js" charset="utf-8"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <!-- identicon (프로필 이미지) -->
    <script src="//cdn.rawgit.com/placemarker/jQuery-MD5/master/jquery.md5.js"></script>
    <script src="//rawgit.com/stewartlord/identicon.js/master/pnglib.js"></script>
    <script src="//rawgit.com/stewartlord/identicon.js/master/identicon.js"></script>

    <script>

        $(document).ready(function () {

            // 아이디에 따라 생성되는 프로필 이미지 만드는 함수 (세션에서 userid를 받아온다)
            $(".user_img").each(function() {

                $(this).prop('src','data:image/png;base64,'+new Identicon($.md5($(this).data("userid")),80)).show();
            });
        });

    </script>

</head>

<body>

    <div class="body_wrap">

        <div class="mypage_user_info_background">
            <div class="mypage_user_info">
                    <!-- 아이디에 따라 생성되는 프로필 이미지 -->
                    <img  class="user_img" data-user="<?=$userid?>" alt="img">
                <div class="user_info">


                    <div class="user_info_id">
                        <span>soyoung123</span>
                    </div>

                    <div class="user_info_membership">

                        <?php

                            $con = mysqli_connect("127.0.0.1", "root", "123456", "eduplanet");
                            $sql = "SELECT expiry_day FROM g_members WHERE no='$user_no'";
                            $result = mysqli_query($con, $sql);
                            $row = mysqli_fetch_array($result);

                            $expiry_day = $row["expiry_day"];
                            $expiry_day = substr($expiry_day, 0, 4).substr($expiry_day, 5, 2).substr($expiry_day, 8, 2);

                            // 만료날짜 계산 후 보여주기 // 만료날짜 없으면 다른 문구 보여주기
                            if($expiry_day == "") {
                                echo "<span class='user_info_membership_span'>리뷰를 작성하시면 모든 리뷰를 조회하실 수 있습니다. </span>";

                            } else {

                                $today = date("Ymd");    
                                $review_day = (strtotime($expiry_day) - strtotime($today))/60/60/24;

                                echo "<span class='user_info_membership_span'>리뷰 조회 기간이 <span class='user_info_membership_span_blue'>$review_day</span> 일 남았습니다. </span>";
                                
                            }

                        ?>

                    </div>
                </div>
            </div>
        </div>

    </div>
</body>

</html>