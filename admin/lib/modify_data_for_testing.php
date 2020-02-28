<?php
    include $_SERVER['DOCUMENT_ROOT'] . "/eduplanet/lib/session_start.php";

    if ($admin== "" ){
    echo("
        <script>
        alert('관리자 전용 페이지 입니다.');
        history.go(-1)
        </script>
    ");
    exit;
    }

    include_once '../../lib/db_connector.php';

    $sql = "CALL modify_data_for_testing()";
    
    if(mysqli_query($conn, $sql)){

        mysqli_close($conn);

        echo "1";

    }else{
        
         mysqli_close($conn);

    }

    
    

?>

