<?php
    // session_start();
    // $is_admin = isset($_SESSION["admin"])? $_SESSION["admin"]: 0 ;

    // if ( $is_admin != 1 ){
    //     echo("
    //         <script>
    //         alert('관리자 전용 페이지 입니다.');
    //         history.go(-1)
    //         </script>
    //     ");
    //     exit;
    // }

    include_once '../../lib/db_connector.php';

    $sql = "CALL modify_data_for_testing()";
    
    if(mysqli_query($conn, $sql)){

        mysqli_close($conn);

        echo "1";

    }else{
        
         mysqli_close($conn);

    }

    
    

?>

