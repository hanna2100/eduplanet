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

//리뷰데이터 가져오기
$review_cnt = array();

$sql = "CALL get_day_reivew_for_one_month($y, $m)";
$result = mysqli_query($conn, $sql);

for($i=0; $i<mysqli_num_rows($result); $i++){
    mysqli_data_seek($result, $i);
    $row = mysqli_fetch_array($result);
    //row0번이 일, 1번이 갯수
    $data = $row[1];
    $data = $data==NULL? 0: $data;
    array_push($review_cnt, $data);
}
mysqli_close($conn);
echo json_encode($review_cnt);


?>

