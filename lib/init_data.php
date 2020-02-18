<?php
//academy 테이블 -가평읍의 학원 데이터 31개
function academy_init_data($si_param, $dong_param){
  $sql ="INSERT INTO `academy` VALUES "; //리턴할 sql문장

  set_api_index(1);
  set_api_scale(31);

  $acd_array = get_academy_from_api($si_param, $dong_param);

  
  for($i=0; $i<sizeof($acd_array); $i++){
    $si_name = $acd_array[$i]->si_name;
    $dong_name = $acd_array[$i]->dong_name;
    $sector = $acd_array[$i]->sector;
    $acd_name = $acd_array[$i]->acd_name;
    $rprsn = $acd_array[$i]->rprsn;
    $class = $acd_array[$i]->class;
    $tel = $acd_array[$i]->tel;
    $address = $acd_array[$i]->address;
    $latitude = $acd_array[$i]->latitude;
    $longitude = $acd_array[$i]->longitude;

    $no = $i+1;

    $sql .= "($no, '$si_name','$dong_name','$sector','$acd_name','$rprsn','$class','$tel','$address', '$latitude', '$longitude', '', '', '')";

    if($i != sizeof($acd_array)-1){
      $sql .=", ";
    }
  }
  $sql .= ";";
  return $sql;
}

//일반 회원 테이블 - row 100개 생성
function g_members_init_data(){
  
    $sql = "INSERT INTO `g_members` VALUES ";
    $intres_array = array("국어","영어","수학","미술","음악","과학","태권도","필라테스","IT","바리스타","요가","제빵");

    for($no = 1; $no<= 100 ; $no++){

      //난수생성 rand(최소숫자, 최대숫자)
      $birth = rand(1990, 2015);
      $intres = array_rand($intres_array); //배열의 키값(1~n까지 숫자) 리턴
      $intres = $intres_array[$intres]; //키값으로 배열중 하나 가져오기

      //1월 1일~ 6월 28일 까지 랜덤 날짜 얻기위한 변수들 (2월이 28일까지라 28로함)
      $join_month = rand(1,6);
      $join_day = rand(1,28);
      if($join_day<10){
        $join_day = "0".(string)$join_day;
      }

      //멤버십기간 날짜 설정
      $mbship_period = rand(0,3);
      if($mbship_period==0){
        $membership = "0000-00-00"; //DATE형 데이터에 자꾸 null이 안들어가서(디폴트 null인데도) 기본값을 00~으로 바꿈.
      }else{
        $month = $join_month+$mbship_period;
        $membership = "2019-0".(string)$month."-".$join_day;
      }

      $sql .= "($no, 'test$no', '1234', 'test$no@google.com', '01012345678', '$birth', '$intres', '$membership', '2019-$join_month-$join_day'),";
      
    }
    //마지막 콤마 제거
    $sql = substr($sql, 0, -1);
    $sql .= ";";
    return $sql;
}

//학원회원 테이블 - 31개 row 생성
function a_members_init_data(){
  include_once 'api_connector.php';

  //학원데이터 학원명, 대표자명 가져옴
  $acd_name_arr = array();
  $rprsn_arr = array();

  set_api_index(1);
  set_api_scale(31);
  $acd_array = get_academy_from_api("가평군", "가평읍");
  
  for($i=0; $i<sizeof($acd_array); $i++){
    $acd_name = $acd_array[$i]->acd_name;
    $rprsn = $acd_array[$i]->rprsn;

    array_push($acd_name_arr, $acd_name);
    array_push($rprsn_arr, $rprsn);
  }
  
  $sql = "INSERT INTO `a_members` VALUES ";
  $i = 0;
  for($no = 1; $no<= 31 ; $no++){

    $a_name = $acd_name_arr[$i];
    $r_name = $rprsn_arr[$i];

    $file_copy = $no.".jpg";

    //1월 1일~ 6월 28일 까지 랜덤 날짜 얻기위한 변수들
    $join_month = rand(1,6);
    $join_day = rand(1,28);
    if($join_day<10){
      $join_day = "0".(string)$join_day;
    }

    //멤버십기간 날짜 설정
    $mbship_period = rand(1,3);
    $month = $join_month+$mbship_period;
    $membership = "2019-0".(string)$month."-".$join_day;

    $sql .= "($no, $no,'test$no', '1234', 'test$no@google.com', '$a_name', '$r_name', '$file_copy', '$membership', '2019-$join_month-$join_day'),";
    
    $i++;
  }
  //마지막 콤마 제거
  $sql = substr($sql, 0, -1);
  $sql .= ";";
  return $sql;
}

?>

