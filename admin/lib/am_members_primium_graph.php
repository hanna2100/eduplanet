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

$y   = $_POST['y'];
$m   = $_POST['m'];

include_once '../../lib/db_connector.php';

if($m<10){
    $m = "0".$m;
}

//연결실패 에러점검
if(!mysqli_affected_rows($conn)){
    mysqli_close($conn);
    echo ('Could not update data - ' . mysqli_error($conn));
}

//멤버십 비율 데이터 가져오기
$sql = "SELECT 
        SUM(IF(expiry_day = 0000 - 00 - 00,
            'Y',
            'N') = 'Y') AS none,
        SUM(IF(expiry_day = 0000 - 00 - 00,
            'Y',
            'N') = 'N') AS primium
        FROM
        a_members
        WHERE
        regist_day BETWEEN '$y-$m-01' AND LAST_DAY('$y-$m-01');";

$total_arr = array();

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

array_push($total_arr, $row['none']);
array_push($total_arr, $row['primium']);

mysqli_close($conn);

echo json_encode($total_arr);


?>

