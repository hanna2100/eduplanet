<?php

    include_once "../lib/db_connector.php";

    // 리뷰 글번호
    $follow_no = $_GET["no"];

    $sql = "DELETE FROM follow WHERE no=$follow_no";

    mysqli_query($conn, $sql);

    mysqli_close($conn);

    echo "
        <script>
            alert('삭제가 완료되었습니다.');
            location.href = '/eduplanet/mypage/follow.php';
        </script>
        ";

?>