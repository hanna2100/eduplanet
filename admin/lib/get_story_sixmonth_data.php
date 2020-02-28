<?php

$y   = $_POST['y'];
$m   = $_POST['m'];

include_once '../../lib/db_connector.php';

//연결실패 에러점검
if(!mysqli_affected_rows($conn)){
    mysqli_close($conn);
    echo ('Could not update data - ' . mysqli_error($conn));
}

//리뷰데이터 가져오기
$story_cnt = array();
$month_arr = array();
$total = array();

$sql = "CALL get_story_sixmonth_data($y, $m)";
$result = mysqli_query($conn, $sql);

for($i=0; $i<mysqli_num_rows($result); $i++){
    mysqli_data_seek($result, $i);
    $row = mysqli_fetch_array($result);
    //row0번이 월, 1번이 갯수
    $month = $row[0]."월";
    $data = $row[1];
    $data = $data==NULL? 0: $data;
    array_push($month_arr, $month);
    array_push($story_cnt, $data);
}
mysqli_close($conn);

array_push($total, $month_arr);
array_push($total, $story_cnt);

echo json_encode($total);


?>

