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
    <link rel="stylesheet" href="/eduplanet/mypage/css/am_myinfo.css">

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

</head>

<body>

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

    $sql = "SELECT * FROM a_members WHERE no='$user_no'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);

    $id = $row["id"];
    $acd_name = $row["acd_name"];
    $rprsn = $row["rprsn"];

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

        <?php
                
            if ($am_no) {

                include_once $_SERVER["DOCUMENT_ROOT"] . "/eduplanet/lib/db_connector.php";
                
                $sql = "SELECT acd_no FROM a_members WHERE no=$am_no;";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_array($result);
                $acd_no = $row["acd_no"];
            }
        ?>

        <div class="mypage_user_menu_background">
            <div class="mypage_user_menu">
                <ul>
                    <a href="/eduplanet/mypage/am_myinfo.php">
                        <li id="mypage_user_myinfo">내 정보</li>
                    </a>

                    <a href="/eduplanet/mypage/am_membership_pay.php">
                        <li id="mypage_user_membership">멤버십/결제</li>
                    </a>

                    <a href="/eduplanet/mypage/story.php">
                        <li id="mypage_user_story">스토리 관리</li>
                    </a>

                    <a href="/eduplanet/academy/index.php?no=<?= $acd_no ?>">
                        <li id="mypage_user_review">My Academy</li>
                    </a>
                </ul>
            </div>
        </div>

        <div class="mypage_content_wrap">

            <div class="mypage_content">

                <div class="myinfo_title">
                    <h2>내 정보</h2>
                    <p>* 정보를 수정하신 후 수정완료 버튼을 눌러 주세요.</p>
                </div>

                <div class="myinfo_content">

                    <div class="myinfo_content_form">

                        <form id="form_member" action="/eduplanet/mypage/am_myinfo_update.php" method="post" autocomplete="on">
                            <div class="formBox">
                                <label for="inputId">아이디</label>
                                <input type="text" class="formInput" id="inputId" name="id" value="<?= $id ?>" disabled>
                                <p class="subMsg" id="idSubMsg"></p>
                            </div>
                            <div class="formBox">
                                <label for="inputPw1">비밀번호</label>
                                <input type="password" class="formInput" id="inputPw1" name="pw1" placeholder="비밀번호를 입력해 주세요" required>
                            </div>
                            <div class="formBox">
                                <label for="inputPw2">비밀번호 확인</label>
                                <input type="password" class="formInput" id="inputPw2" name="pw2" placeholder="비밀번호를 확인해 주세요" required>
                                <p class="subMsg" id="pwSubMsg"></p>
                            </div>
                            <div class="formBox">
                                <label for='inputAcdName'>학원/교습소 이름</label>
                                <input type='text' class='formInput' id='inputAcdName' name='acd_name' value="<?= $acd_name ?>" disabled>
                                <p class='subMsg' id='AcdNameSubMsg'></p>
                            </div>
                            <div class="formBox">
                                <label for='inputRprsn'>대표자명</label>
                                <input type='text' class='formInput' id='inputRprsn' name='rprsn' value="<?= $rprsn ?>" disabled>
                                <p class='subMsg' id='RprsnSubMsg'></p>
                            </div>
                            <!-- <div class="formBox">
                                <label for='inputLicense'>사업자등록증</label>
                                <input type='file' class='formInput' id='inputLicense' name='inputLicense' placeholder='사업자등록증을 업로드 해주세요' required>
                                <p class='subMsg' id='LicenseSubMsg'></p>
                            </div> -->
                    </div>

                    <div class="button_div">
                        <input type="button" id="btnFormSubmit" value="수정완료" onclick="isAmAllPass();">
                    </div>
                    </form>
                </div>
            </div>

            <a href="/eduplanet/mypage/am_member_delete_form.php" id="member_delete">회원탈퇴</a>
        </div>

        <footer>
            <?php include_once $_SERVER["DOCUMENT_ROOT"] . "/eduplanet/index/footer.php"; ?>
        </footer>

    </div>
</body>

</html>