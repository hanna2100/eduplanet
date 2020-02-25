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

    $no   = $_POST['no'];

    include_once '../../lib/db_connector.php';

    for($i = 0; $i < count($no); $i++){

        $n = $no[$i];
        $sql = "INSERT INTO academy (si_name, dong_name, sector, acd_name, rprsn, class, tel, address) 
        (SELECT si_name, dong_name, sector, acd_name, rprsn, class, tel, address FROM academy_temp WHERE no = $n)";

        mysqli_query($conn, $sql);

        //$sql = "DELETE FROM academy_temp WHERE no = $n";
        //mysqli_query($conn, $sql);
    
    }

    mysqli_close($conn);
    
    echo "1";

?>

