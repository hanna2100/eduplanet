<?php

$y   = $_POST['y'];
$m   = $_POST['m'];
$mode   = $_POST['mode'];

include_once $_SERVER['DOCUMENT_ROOT'] . "/eduplanet/lib/db_connector.php";
if($m<10){
    $m = "0".$m;
}

//연결실패 에러점검
if(!mysqli_affected_rows($conn)){
    mysqli_close($conn);
    echo ('Could not update data - ' . mysqli_error($conn));
}

//나이데이터 가져오기
$sql = "SELECT 
        SUM(IF(DATE_FORMAT(NOW(), '%Y') - age BETWEEN 0 AND 7,
            1,
            0)) AS child,
        SUM(IF(DATE_FORMAT(NOW(), '%Y') - age BETWEEN 8 AND 13,
            1,
            0)) AS elmnt,
        SUM(IF(DATE_FORMAT(NOW(), '%Y') - age BETWEEN 14 AND 16,
            1,
            0)) AS middle,
        SUM(IF(DATE_FORMAT(NOW(), '%Y') - age BETWEEN 17 AND 19,
            1,
            0)) AS high,
        SUM(IF(DATE_FORMAT(NOW(), '%Y') - age BETWEEN 20 AND 200,
            1,
            0)) AS adult
        FROM
        g_members
        WHERE
        regist_day BETWEEN '$y-$m-01' AND LAST_DAY('$y-$m-01');";

$total_arr = array();

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

array_push($total_arr, $row['child']);
array_push($total_arr, $row['elmnt']);
array_push($total_arr, $row['middle']);
array_push($total_arr, $row['high']);
array_push($total_arr, $row['adult']);

mysqli_close($conn);

echo json_encode($total_arr);


?>

