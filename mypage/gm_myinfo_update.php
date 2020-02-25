<?php

    // 기업회원 세션 테스트
    // $user_no = $am_no;
    $user_no = 2;

    include_once "../lib/db_connector.php";

    $pw1 = $_POST["pw1"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $intres = $_POST["intres"];
    $age = $_POST["age"];

    $sql = "UPDATE g_members SET pw='$pw1', email='$email', phone='$phone', intres='$intres', age='$age' WHERE no=$user_no";

    mysqli_query($conn, $sql);
    mysqli_close($conn);

    echo "
        <script>
            alert('내 정보 수정이 완료되었습니다.');
            location.href = '/eduplanet/mypage/myinfo.php';
        </script>
    ";

?>