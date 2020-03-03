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

    $sql = "SELECT * FROM acd_story WHERE no='$no'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $file_copy = $row["file_copy"];

    // 사진 파일 삭제
    if($file_copy){
        unlink($_SERVER['DOCUMENT_ROOT'] ."/eduplanet/data/acd_story/".$file_copy);
    }

    $sql = "DELETE FROM acd_story WHERE no='$no'";
    mysqli_query($conn, $sql);
    mysqli_close($conn);

    echo "
        <script>
            alert('삭제가 완료되었습니다.');

        </script>
        ";
