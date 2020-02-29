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
        intres, COUNT(intres) AS count
        FROM
        g_members
        WHERE
        regist_day BETWEEN '$y-$m-01' AND LAST_DAY('$y-$m-01')
        GROUP BY intres
        ORDER BY count desc
        LIMIT 5;";

$intres_arr = array();
$count_arr = array();
$total_arr = array();

$result = mysqli_query($conn, $sql);

for($i=0; $i<5; $i++){
    mysqli_data_seek($result, $i);
    $row = mysqli_fetch_array($result);

    array_push($intres_arr, $row['intres']);
    array_push($count_arr, $row['count']);
}
array_push($total_arr, $intres_arr);
array_push($total_arr, $count_arr);

mysqli_close($conn);

echo json_encode($total_arr);


?>

