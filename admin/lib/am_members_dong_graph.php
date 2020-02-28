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

//지역데이터 가져오기
$sql = "SELECT 
        concat(si_name, ' ', dong_name) as dong , COUNT(a.dong_name) AS cnt
        FROM
        academy AS a
            INNER JOIN
        a_members AS m ON a.no = m.acd_no
        WHERE
        m.regist_day>='$y-$m-01' AND m.regist_day<=LAST_DAY('$y-$m-01')
        GROUP BY dong
        ORDER BY cnt DESC LIMIT 5";

$dong_arr = array();
$count_arr = array();
$total_arr = array();

$result = mysqli_query($conn, $sql);

for($i=0; $i<5; $i++){
    mysqli_data_seek($result, $i);
    $row = mysqli_fetch_array($result);

    array_push($dong_arr, $row[0]);
    array_push($count_arr, $row[1]);
}
array_push($total_arr, $dong_arr);
array_push($total_arr, $count_arr);

mysqli_close($conn);

echo json_encode($total_arr);


?>

