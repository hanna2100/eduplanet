<?php

    $no   = $_POST['no'];

    include_once $_SERVER['DOCUMENT_ROOT'] . "/eduplanet/lib/db_connector.php";

    $sql = "SELECT file_copy FROM teacher WHERE no = $no";
    $result = mysqli_query($conn, $sql);
    if(!$result){
        echo "DB 삭제실패";
        exit;
    }
    $row = mysqli_fetch_array($result);
    $file_copy = $row['file_copy'];

    unlink("../data/teacher_img/".$file_copy);
    
    $sql = "DELETE FROM teacher WHERE no = $no";

    if(!mysqli_query($conn, $sql)){
        echo "DB 삭제실패";
        exit;
    };

    mysqli_close($conn);
    
    echo "1";

?>

