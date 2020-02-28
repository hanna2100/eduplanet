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

  //api받아오기
  include_once $_SERVER["DOCUMENT_ROOT"]."/eduplanet/lib/db_connector.php";
  include_once $_SERVER["DOCUMENT_ROOT"]."/eduplanet/lib/api_connector.php";
  
  //연결실패 에러점검
  if(!mysqli_affected_rows($conn)){
    mysqli_close($conn);
    echo ('Could not update data - ' . mysqli_error($conn));
  }

  //기존 temp 학원 데이터 삭제
  $sql = "DELETE FROM academy_temp";
  mysqli_query($conn, $sql);

  //새로운 temp 데이터 가져오기
  $sql ="INSERT INTO `academy_temp` VALUES "; //리턴할 sql문장

  set_api_index(1);
  set_api_scale(100);

  $acd_array = get_academy_from_api("가평군", "가평읍");

  for($i=0; $i<sizeof($acd_array); $i++){
    $si_name = $acd_array[$i]->si_name;
    $dong_name = $acd_array[$i]->dong_name;
    $sector = $acd_array[$i]->sector;
    $acd_name = $acd_array[$i]->acd_name;
    $rprsn = $acd_array[$i]->rprsn;
    $class = $acd_array[$i]->class;
    $tel = $acd_array[$i]->tel;
    $address = $acd_array[$i]->address;

    $no = $i+1;

    $sql .= "($no, '$si_name','$dong_name','$sector','$acd_name','$rprsn','$class','$tel','$address')";

    if($i != sizeof($acd_array)-1){
      $sql .=", ";
    }
  }
  $sql .= ";";
  $result = mysqli_query($conn, $sql);
  mysqli_close($conn);
  
  if($result){
    echo "1";
  }


?>