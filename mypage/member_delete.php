<?php

    include_once $_SERVER["DOCUMENT_ROOT"]."/eduplanet/lib/session_start.php";

    include_once $_SERVER["DOCUMENT_ROOT"]."/eduplanet/lib/db_connector.php";

    // 아이디 가져오기
    if (isset($_POST["inputId"])) {
        $inputId = $_POST["inputId"];
    }

    // 비밀번호 가져오기
    if (isset($_POST["inputPw1"])) {
        $inputPw = $_POST["inputPw1"];
    }

    // 테이블 설정하기
    if ($gm_no) {
        $table = "g_members";
        $type = "G";

    } else if ($am_no) {
        $table = "a_members";
        $type = "A";

    } else {
        echo "
            <script>
                alert('잘못된 접근입니다.');
                history.go(-1)
            </script>
            ";
    }

    // DB에서 회원정보 가져오기
    $sql = "SELECT * FROM $table WHERE id='$inputId'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);

    $no = $row["no"];
    $password = $row["pw"];
    $regist_day = $row["regist_day"];

    $today = date("Y-m-d");

    // 비밀번호가 일치하지 않을 때
    if ($inputPw != $password) {

        echo "
            <script>
                alert('비밀번호가 일치하지 않습니다.');
                history.go(-1)
            </script>
            ";

        mysqli_close($conn);

    // 비밀번호가 일치할 때
    } else if ($inputPw == $password) {

        // 회원 테이블에서 DELETE
        $sql = "DELETE FROM $table WHERE id='$inputId'";
        mysqli_query($conn, $sql);

        // 탈퇴회원 테이블에 INSERT
        $sql_drawal = "INSERT INTO withdrawal(type, mmbr_no, join_date, wthd_date)";
        $sql_drawal .= "VALUES('$type', '$no', '$regist_day', '$today')";
        mysqli_query($conn, $sql_drawal);

        // 세션 초기화 (자동 로그아웃)
        unset($_SESSION["am_no"]);
        unset($_SESSION["gm_no"]);
        unset($_SESSION["pam_no"]);
        unset($_SESSION["pgm_no"]);
        unset($_SESSION["admin"]);

        alert_move('회원 탈퇴가 완료되었습니다. \n이용해 주셔서 감사합니다.', '/eduplanet/index.php');

        mysqli_close($conn);
    }

    function alert_move($msg, $url) {

        echo "
            <script>
                alert('$msg');
                location.href = '$url';
            </script>
          ";
    
        exit;
    };
