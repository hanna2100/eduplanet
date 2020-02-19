<?php
include_once 'init_data.php';

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
            $sql = g_members_init_data();
            break;
          case 'a_members' :
            $sql = a_members_init_data();
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
            $sql = review_init_data();
            break;
        case 'acd_story' :
          $sql = acd_story_init_data();
          break;
        case 'product' :
          $sql = "INSERT INTO `product` VALUES (1, '프리미엄', 1, 5000, 10),
                                                  (2, '프리미엄', 2, 10000, 20),
                                                  (3, '프리미엄', 3, 15000, 30),
                                                  (4, '학원관리', 1, 50000, 10),
                                                  (5, '학원관리', 2, 100000, 20),
                                                  (6, '학원관리', 3, 150000, 30);";
          break;
        case 'gm_order' :
          $sql = gm_order_init_data();
          break;
        case 'am_order' :
          $sql = am_order_init_data();
          break;
        case 'sales' :
          $sql = "INSERT INTO `sales` VALUES (1, '2019-02-12', 1, 3, 4),
                                              (2, '2019-03-12', 2, 1, 3),
                                              (3, '2019-04-12', 3, 5, 8),
                                              (4, '2019-05-12', 3, 2, 6);";
          break; 
        case 'follow' :
          $sql = "INSERT INTO `follow` VALUES (1, 1, 1),
                                              (2, 1, 2),
                                              (3, 1, 3),
                                              (4, 1, 4);";
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


?>
