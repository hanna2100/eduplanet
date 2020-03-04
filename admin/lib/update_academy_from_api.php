<?php

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

  $acd_array1 = get_academy_from_api("가평군", "가평읍");
  $acd_array2 = get_academy_from_api("수원시", "영통동");
  $acd_array3 = get_academy_from_api("시흥시", "거모동");
  $acd_array4 = get_academy_from_api("고양시", "성사동");
  $acd_array5 = get_academy_from_api("성남시", "성남동");
  $acd_array6 = get_academy_from_api("광명시", "하안동");

  $acd_array_total = array_merge($acd_array1,$acd_array2,$acd_array3,$acd_array4,$acd_array5,$acd_array6);
  
  for($i=0; $i<sizeof($acd_array_total); $i++){
    $si_name = $acd_array_total[$i]->si_name;
    $dong_name = $acd_array_total[$i]->dong_name;
    $sector = $acd_array_total[$i]->sector;
    $acd_name = $acd_array_total[$i]->acd_name;
    $rprsn = $acd_array_total[$i]->rprsn;
    $class = $acd_array_total[$i]->class;
    $tel = $acd_array_total[$i]->tel;
    $address = $acd_array_total[$i]->address;

    $no = $i+1;

    $sql .= "($no, '$si_name','$dong_name','$sector','$acd_name','$rprsn','$class','$tel','$address')";

    if($i != sizeof($acd_array_total)-1){
      $sql .=", ";
    }
  }
  $sql .= ";";
  $result = mysqli_query($conn, $sql);
  mysqli_close($conn);
  
  if($result){
    echo "1";
  }else{
    echo "0";
  }


?>