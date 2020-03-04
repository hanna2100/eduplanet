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
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" charset="utf-8"></script>

    <!-- 폰트 -->
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR&amp;display=swap" rel="stylesheet">

    <!-- 아이콘 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="/eduplanet/index/index_header_searchbar_in.css">
    <link rel="stylesheet" href="/eduplanet/index/footer.css">
    <link rel="stylesheet" href="/eduplanet/mypage/css/mypage_header.css">
    <link rel="stylesheet" href="/eduplanet/mypage/css/review_write_popup.css">
    <link rel="stylesheet" href="/eduplanet/mypage/css/myinfo.css">

    <!-- 스크립트 -->
    <script src="/eduplanet/searchbar/searchbar_in.js"></script>
    <script src="/eduplanet/mypage/js/review_write.js"></script>
    <script src="/eduplanet/mypage/js/myinfo_modify.js"></script>

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

                $(this).prop('src', 'data:image/png;base64,' + new Identicon($.md5($(this).data("user")), 80)).show();
            });
        });
    </script>

    <script>
        // 탈퇴완료 버튼을 눌렀을 때
        function delete_member_check() {

            // 비밀번호를 입력하지 않았을 때
            if (document.getElementById("inputPw1").value === "") {

                alert("비밀번호가 입력되지 않았습니다.");

            } else {

                var deleteConf = confirm('정말 탈퇴하시겠습니까? \n이용중인 멤버십은 모두 삭제됩니다.');

                if (deleteConf === true) {
                    document.delete_member.submit();

                } else {
                    alert("회원 탈퇴가 취소되었습니다.");
                }
            }
        }
    </script>

</head>

<body>

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

    $sql = "SELECT * FROM g_members WHERE no='$user_no'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $id = $row["id"];

    ?>

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

        <div class="mypage_content_wrap">

            <div class="mypage_content">

                <div class="myinfo_title">
                    <h2>회원탈퇴</h2>
                    <div class="member_delete_title">
                        <span>* 탈퇴 시 이용중인 멤버십은 모두 삭제됩니다.</span>
                        <span>* 회원 탈퇴를 원하시면 비밀번호를 입력해 주세요.</span>
                    </div>
                </div>

                <div class="myinfo_content">

                    <div class="myinfo_content_form">

                        <form id="form_member" name="delete_member" action="/eduplanet/mypage/member_delete.php" method="post" autocomplete="on">
                            <div class="formBox">
                                <label for="inputId">아이디</label>
                                <input type="text" class="formInput" id="inputId" name="inputId" value="<?= $id ?>" readonly>
                            </div>
                            <div class="formBox_last">
                                <label for="inputPw1">비밀번호</label>
                                <input type="password" class="formInput" id="inputPw1" name="inputPw1" placeholder="비밀번호를 입력해 주세요" required>
                            </div>
                    </div>

                    <div class="button_div">
                        <input type="button" id="btnFormSubmit" value="탈퇴완료" onclick="delete_member_check();">
                    </div>

                    </form>
                </div>
            </div>
        </div>

        <footer>
            <?php include_once $_SERVER["DOCUMENT_ROOT"] . "/eduplanet/index/footer.php"; ?>
        </footer>

    </div>
</body>

</html>