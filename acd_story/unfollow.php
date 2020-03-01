<?php

    include_once $_SERVER["DOCUMENT_ROOT"]."/eduplanet/lib/session_start.php";

    include_once $_SERVER["DOCUMENT_ROOT"]."/eduplanet/lib/db_connector.php";

    if (!$gm_no) {
        echo "
            <script>
                alert('일반회원만 이용 가능합니다.');
                history.go(-1)
            </script>
        ";
    
    } else {

    // 찜목록 글번호
    $acd_no = $_GET["no"];

    $sql = "DELETE FROM follow WHERE acd_no=$acd_no AND user_no=$gm_no";

    mysqli_query($conn, $sql);

    mysqli_close($conn);

    echo "
        <script>
            alert('찜목록에서 삭제되었습니다.');
            history.go(-1)
        </script>
        ";
    }

?>