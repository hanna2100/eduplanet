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
            $sql = academy_init_data();
            break;
          case 'teacher' :
            $sql = "INSERT INTO `teacher` VALUES (1, 1,'고 양희','피아노','국제 냥쿠르 대상',  'test_teacher_1.jpg'),
                                                (2, 1,'너 규리','피아노','피아노 20년 경력', 'test_teacher_2.jpg'),
                                                (3, 1,'Ham Stern','피아노','전 해바라기 피아노 원장', 'test_teacher_3.jpg'),
                                                (4, 1, '도 더지','피아노','서울대 삽질학과 졸업', 'test_teacher_4.jpg'),
                                                (5, 1,'계 미','피아노','계미는 뚠뚠 오늘도 뚠뚠 출~근을 하~네!', 'test_teacher_5.jpg');";
            break;
        case 'lecture' :
            $sql = "INSERT INTO `lecture` VALUES (1, 1, 1, 11,'소나타'),
                                                (2, 1, 1, 12,'소나타'),
                                                (3, 1, 2, 9,'체르니'),
                                                (4, 1, 2, 10,'체르니'),
                                                (5, 1, 5, 15,'소나타'),
                                                (6, 1, 6, 18,'클래식'),
                                                (7, 2, 1, 15,'클래식'),
                                                (8, 2, 1, 16,'클래식'),
                                                (9, 2, 3, 18,'소나타'),
                                                (10, 2, 3, 19,'소나타'),
                                                (11, 2, 4, 19,'체르니'),
                                                (12, 2, 5, 15,'클래식');";
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
    
        case 'follow' :
          $sql = "INSERT INTO `follow` VALUES (1, 1, 1),
                                              (2, 1, 2),
                                              (3, 1, 3),
                                              (4, 1, 4);";
          break;
        case 'withdrawal' :
          $sql = withdrawal_init_data();
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
