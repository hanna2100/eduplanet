<?php

$y   = $_POST['y'];
$m   = $_POST['m'];
$y2   = $_POST['y2'];
$m2   = $_POST['m2'];

include_once $_SERVER['DOCUMENT_ROOT'] . "/eduplanet/lib/db_connector.php";
if($m<10){
    $m = "0".$m;
}

//연결실패 에러점검
if(!mysqli_affected_rows($conn)){
    mysqli_close($conn);
    echo ('Could not update data - ' . mysqli_error($conn));
}

//회원가입 수 가져오기
$sql_arr = array();
array_push($sql_arr,"CALL get_join_g_members($y, $y2, $m, $m2)" );
array_push($sql_arr,"CALL get_wthdr_g_members($y, $y2, $m, $m2)" );

$total_arr = array();
$total_arr = execute_multi($conn, $sql_arr);

mysqli_close($conn);

echo json_encode($total_arr);


function execute_multi($conn, $sql_arr){
    $total_arr = array();
    $join_arr = array();
    $wthdr_arr = array();

    $sql = implode(';', $sql_arr) . ';';

    if (mysqli_multi_query($conn, $sql)) {
        // $result = mysqli_store_result($conn);
        // $total_record = mysqli_num_rows($result);
        // var_dump($total_record);
        // var_dump($result);
        $flag = false;
        do {
            if ($result = mysqli_store_result($conn)) {
                $total_record = mysqli_num_rows($result);
                while ($row = mysqli_fetch_row($result)) {
                    //row0번이 날짜, 1번이 카운트
                    $obj = $row[1];
                    $obj = $obj==NULL? 0: $obj;
                    

                    if($flag==false){
                        array_push($join_arr, $obj);
                    }else{
                        array_push($wthdr_arr, $obj);
                    }

                }
                mysqli_free_result($result);
                $flag = true;
            }
    
        } while (mysqli_next_result($conn));

        array_push($total_arr, $join_arr);
        array_push($total_arr, $wthdr_arr);
        return $total_arr;

    
        
    }

}

?>

