<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>에듀플래닛</title>

    <script src="http://code.jquery.com/jquery-1.12.4.min.js" charset="utf-8"></script>
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/eduplanet/mypage/css/am_myinfo.css">
    <script src="/eduplanet/mypage/js/myinfo_modify.js"></script>

</head>

<body>

    <?php
        // 기업회원 세션 테스트
        // $user_no = $am_no;

        $user_no = 2;

        if (!$user_no) {
            echo "
                <script>
                    alert('잘못된 접근입니다.');
                    history.go(-1)
                </script>
            ";
        }

        include_once "../lib/db_connector.php";

        $sql = "SELECT * FROM a_members WHERE no='$user_no'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);

        $id = $row["id"];
        $email = $row["email"];
        $acd_name = $row["acd_name"];
        $rprsn = $row["rprsn"];

    ?>

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

                <div class="myinfo_title">
                    <h2>내 정보</h2>
                    <p>* 정보를 수정하신 후 수정완료 버튼을 눌러 주세요.</p>
                </div>

                <div class="myinfo_content">

                    <div class="myinfo_content_form">

                        <form id="form_member" action="/eduplanet/mypage/am_myinfo_update.php" method="post" autocomplete="on">
                            <div class="formBox">
                                <label for="inputId">아이디</label>
                                <input type="text" class="formInput" id="inputId" name="id" value="<?=$id?>" disabled>
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
                                <label for="inputEmail">이메일</label>
                                <input type="email" class="formInput" id="inputEmail" name="email" placeholder="이메일을 입력해 주세요" value="<?=$email?>" required>
                                <p class="subMsg" id="emailSubMsg"></p>
                            </div>
                            <div class="formBox">
                                <label for='inputAcdName'>학원/교습소 이름</label>
                                <input type='text' class='formInput' id='inputAcdName' name='acd_name' placeholder='공백 없이 입력해 주세요.' value="<?=$acd_name?>" required>
                                <p class='subMsg' id='AcdNameSubMsg'></p>
                            </div>
                            <div class="formBox">
                                <label for='inputRprsn'>대표자명</label>
                                <input type='text' class='formInput' id='inputRprsn' name='rprsn' placeholder='대표자명을 입력해 주세요' value="<?=$rprsn?>" required>
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

        </div>





        <footer>
            <?php include "../index/footer.php"; ?>
        </footer>


    </div>

</body>

</html>