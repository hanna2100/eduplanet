﻿<?php

function insert_init_data($conn, $table_name){
  $flag="NO";
  $sql = "SELECT * from $table_name";
  $result=mysqli_query($conn,$sql) or die('Error: '.mysqli_error($conn));

  $is_set=mysqli_num_rows($result);

  if(!empty($is_set) ){
    $flag="OK";
  }

  if($flag=="NO"){
    switch($table_name){
          case 'g_members' :
            $sql = "INSERT INTO `g_members` VALUES (1,'test','1234', 'hanna0497@naver.com', '01011112222', '1991','수학'),
                                                  (2,'test2','1234', 'hanna0497@naver.com', '01011112222', '1991','국어'),
                                                  (3,'test3','1234', 'hanna0497@naver.com', '01011112222', '1991','수학'),
                                                  (4,'test4','1234', 'hanna0497@naver.com', '01011112222', '1991','영어');";
            break;
          case 'a_members' :
            $sql = "INSERT INTO `a_members` VALUES (1,'test','1234','hanna0497@naver.com','마이피아노교습소', '성미영', '2019_05_29_16_19_19_0.gif');";
            break;
          case 'academy' :
            $sql = academy_init_data("가평군","가평읍");
            break;
          case 'teacher' :
            $sql = "INSERT INTO `teacher` VALUES (1, 1,'고양이','피아노','국제 냥쿠르 대상', '고양이샘', '2019_05_29_16_19_19_1.gif'),
                                                (2, 1,'너구리','피아노','피아노 20년 경력', '너구리샘', '2019_05_29_16_19_19_2.gif'),
                                                (3, 1,'햄스터','피아노','전 해바라기 피아노 원장', '햄스터샘', '2019_05_29_16_19_19_3.gif'),
                                                (4, 1,'패럿','피아노','서울대 패러글라이딩학과 졸업', '패럿샘', '2019_05_29_16_19_19_4.gif');";
            break;
        case 'lecture' :
            $sql = "INSERT INTO `lecture` VALUES (1, 1, 1, 1,'피아노-오전', '고양이샘'),
                                                (2, 1, 1, 2,'피아노-오전', '고양이샘'),
                                                (3, 1, 3, 2,'피아노-오전', '고양이샘'),
                                                (4, 1, 5, 1,'피아노-오전', '고양이샘'),
                                                (5, 1, 5, 2,'피아노-오전', '고양이샘');";
            break;
        case 'review' :
            $sql = "INSERT INTO `review` VALUES (1, 1, 1, 3, 5, 2, 5, 3, 4, '고양이샘 완전 좋아요! 이 세상 귀여움이 아니에요!', '접근성이 좋지 않아요! 교통이 별로에요', '2020-02-02'),
                                                (2, 1, 2, 3, 4, 3, 4, 3, 4, '고양이 선생님 좋아요. 귀여움.', '교통이 너무 안좋아요. 버스가 안와요.', '2020-02-02'),
                                                (3, 1, 3, 4, 4, 3, 5, 3, 3, '햄스터샘 해바라기송 완전 잘쳐요. 실력 쩔어요. 시설이 좋아요.', '교통이 별로에요.', '2020-02-04'),
                                                (4, 1, 4, 4, 4, 3, 5, 3, 5, '고양이샘에게 수업받고 실력이 늘었어요. 시설이 최신식이에요.', '학원에 가려면 왕복 1시간 걸려요. 멀어요.', '2020-02-09');";
            break;
        case 'acd_story' :
          $sql = "INSERT INTO `acd_story` VALUES (1, 1, '마이피아노교습소', '고양이 선생님 냥쿠르 대상 수상', '가평에서 배우는 고오급 피아노', '내용입니다', '2020-02-02', '사진', '2019_05_29_16_19_19_0.gif'),
                                              (2, 1, '마이피아노교습소', '나도 피아노를 칠 수 있다!', '패럿샘에게 배우는 야매피아노', '내용입니다', '2020-02-03', '사진', '2019_05_29_16_19_19_1.gif'),
                                              (3, 1, '마이피아노교습소', '마이피아노를 만나고 내 인생이 달라져', '저도 젓가락 행진곡을 칠 수 있어요', '내용입니다', '2020-02-05', '사진', '2019_05_29_16_19_19_2.gif'),
                                              (4, 1, '마이피아노교습소', '20년 경력 너구리샘', '짬에서 나오는 맬러디', '내용입니다', '2020-02-28', '사진', '2019_05_29_16_19_19_3.gif');";
          break;
            
      default:
        echo "<script>alert('해당 테이블이름이 없습니다. ');</script>";
        break;
    }//end of switch

    if(mysqli_query($conn,$sql)){
      echo "<script>alert('$table_name 테이블 초기값 설정 완료');</script>";
    }else{
      echo "테이블 초기값 설정 실패 : ".mysqli_error($conn);
    }
  }//end of if flag

}//end of function

//가평읍의 학원 데이터 31개를 테스트 데이터로 DB에 저장
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

?>
