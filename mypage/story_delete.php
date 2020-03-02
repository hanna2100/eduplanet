<?php

    include_once $_SERVER["DOCUMENT_ROOT"] . "/eduplanet/lib/session_start.php";
    
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

    if(isset($_GET["no"])) {
        $no = $_GET["no"];
    }

    $sql = "DELETE FROM acd_story WHERE no='$no'";
    mysqli_query($conn, $sql);
    mysqli_close($conn);

    echo "
        <script>
            alert('삭제가 완료되었습니다.');
            history.go(-1)
        </script>
        ";

?>