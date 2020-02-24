<?php
    // session_start();
    // $is_admin = isset($_SESSION["admin"])? $_SESSION["admin"]: 0 ;

    // if ( $is_admin != 1 ){
    //     echo("
    //         <script>
    //         alert('관리자 전용 페이지 입니다.');
    //         history.go(-1)
    //         </script>
    //     ");
    //     exit;
    // }

    $mode   = isset($_POST['mode'])? $_POST['mode'] : 0;

    
  //api받아오기
  include_once $_SERVER["DOCUMENT_ROOT"]."/eduplanet/lib/db_connector.php";
  include_once $_SERVER["DOCUMENT_ROOT"]."/eduplanet/lib/api_connector.php";
  
  //연결실패 에러점검
  if(!mysqli_affected_rows($conn)){
    mysqli_close($conn);
    echo ('Could not update data - ' . mysqli_error($conn));
  }

  //기존 temp 학원 데이터 삭제
  $sql = "DELETE FROM `academy_temp`";
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
  mysqli_query($conn, $sql);

  //테스트를 위한 데이터 수정 작업
  $sql = "CALL modify_data_for_testing()";
  mysqli_query($conn, $sql);

  $sql_arr = array();
  //api와 기존 db를 비교하여 새로운 데이터가 있는경우
  array_push($sql_arr,"CALL get_new_academy_serialize()" );
  //api와 기존 db를 비교하여 변경 or 삭제된 학원 데이터 가져오기(db엔 있는데 api엔 없는경우)
  array_push($sql_arr,"CALL get_empty_academy_serialize()" );

  $total_arr = array();
  $total_arr = execute_multi($conn, $sql_arr);
  
  //기존에서 변경된 학원 데이터 찾기
  $new_acd = $total_arr[0]; //생기거나 변경된(new데이터) 학원
  $drop_acd = $total_arr[1]; //없어지거나 변경된(old데이터) 학원

  $edit_acd_new = array(); //기존에서 변경된 학원의 새데이터가 들어갈 배열
  $edit_acd_old = array(); //기존에서 변경된 학원의 기존데이터가 들어갈 배열

  for($i=0; $i<sizeof($new_acd); $i++){
    
    for($j=0; $j<sizeof($drop_acd); $j++){
      
      $intersection = array_intersect($new_acd[$i], $drop_acd[$j]);

      if(count($intersection)>=5){
        array_push($edit_acd_new, $new_acd[$i]);
        array_push($edit_acd_old, $drop_acd[$j]);
        //인덱스를 유지하기위해 slice보다는 해당값을 빈배열로 만들고 array_flilter를 쓸 예정
        $new_acd[$i] = [];
        $drop_acd[$j] = [];
        break;
      }
    }//end of inner for

  }//end of outer for;

  $new_acd = array_filter($new_acd);
  $new_acd = array_values($new_acd);
  $del_acd = array_filter($drop_acd);
  $del_acd = array_values($del_acd);

  //신규학원수
  $new_acd_count = sizeof($new_acd);
  //폐업학원수
  $drop_acd_count = sizeof($del_acd);
  //수정된 학원수
  $edit_acd_count = sizeof($edit_acd_old);
  //혹은 이거 > sizeof($edit_acd_new);

//   if(strcmp($mode, "new")){
//     // echo json_encode($new_acd);

//   }else if(strcmp($mode, "drop")){
//     echo json_encode($del_acd);

//   }else if(strcmp($mode, "edit")){
//     $edit_acd = array();
//     array_push($edit_acd, $edit_acd_old);
//     array_push($edit_acd, $edit_acd_new);
//     echo json_encode($edit_acd);
//   }else{
//     die;    
//   }


  function execute_multi($conn, $sql_arr){
    $total_arr = array();
    $new_acd_array = array(); //새로 생긴(혹은 기존에서 변경된) 학원들 (api엔 있는데 Db엔 없는경우)
    $empty_acd_array = array(); //이젠 없어진(혹은 기존에서 변경된) 학원들 (db엔 있는데 api엔 없는경우)

    $sql = implode(';', $sql_arr) . ';';

    if (mysqli_multi_query($conn, $sql)) {
      $flag = false;
      do {
        if ($result = mysqli_store_result($conn)) {
          $total_record = mysqli_num_rows($result);

          while ($row = mysqli_fetch_row($result)) {

            if($flag==false){ // 첫번째 쿼리문 결과시
              $temp_srl = $row[1];
              //직렬화된 데이터를 잘라서 배열로 저장
              $srl_array = explode('$', $temp_srl);
              array_push($new_acd_array, $srl_array);

            }else{// 두번째 쿼리문 결과시
              $acd_srl = $row[1];

              //직렬화된 데이터를 잘라서 배열로 저장
              $srl_array = explode('$', $acd_srl);
              array_push($empty_acd_array, $srl_array);

            }//end of if
          }//end of while
          mysqli_free_result($result);
          $flag = true;
        }//end of if
      } while (mysqli_next_result($conn));

      array_push($total_arr, $new_acd_array );
      array_push($total_arr,$empty_acd_array );
      return $total_arr;
    }//end of if
  }//end of function
?>

