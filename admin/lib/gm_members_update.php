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

    $no   = $_GET["no"];
    $page   = $_GET["page"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $intres = $_POST["intres"];
    $expiry_day = $_POST["expiry_day"];

    include_once '../../lib/db_connector.php';


    $sql = "update g_members set email='$email', phone='$phone', intres='$intres', expiry_day='$expiry_day' where no=$no";

    $retval = mysqli_query($conn, $sql);
    if(! $retval ){
        die('Could not update data: ' . mysqli_error($conn));
    }

    mysql_close($conn);

    echo "
	     <script>
            console.log('$sql');
	     </script>
	   ";
?>

