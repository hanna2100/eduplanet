<?php

    include_once $_SERVER["DOCUMENT_ROOT"]."/eduplanet/lib/session_start.php";

    include_once $_SERVER["DOCUMENT_ROOT"]."/eduplanet/lib/db_connector.php";

    if (isset($_POST["inputId"])) {
        $inputId = $_POST["inputId"];
    }

    if (isset($_POST["inputPw1"])) {
        $inputPw = $_POST["inputPw1"];
    }

    if ($gm_no) {
        $table = "g_members";

    } else if ($am_no) {
        $table = "a_members";

    } else {
        echo "
            <script>
                alert('잘못된 접근입니다.');
                history.go(-1)
            </script>
            ";
    }

    // 비밀번호 가져오기
    $sql = "SELECT * FROM $table WHERE id='$inputId'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $password = $row["pw"];

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

        // 삭제 쿼리문 실행
        $sql = "DELETE FROM $table WHERE id='$inputId'";
        mysqli_query($conn, $sql);

        // session_start();
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
