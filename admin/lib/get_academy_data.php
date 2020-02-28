<?php

  $mode   = isset($_POST['mode'])? $_POST['mode'] : "none";
    
  //api받아오기
  include_once $_SERVER["DOCUMENT_ROOT"]."/eduplanet/lib/db_connector.php";
  include_once $_SERVER["DOCUMENT_ROOT"]."/eduplanet/lib/api_connector.php";
  
  //연결실패 에러점검
  if(!mysqli_affected_rows($conn)){
    mysqli_close($conn);
    echo ('Could not update data - ' . mysqli_error($conn));
  }


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


  //오직 학원명,대표자명,주소,전화번호,업종 만을 구별하기위해 이 항목만으로 구성된 배열 만들기
  $new_temp = $new_acd;
  $drop_temp = $drop_acd;

  for($i=0; $i<sizeof($new_temp); $i++){
    $new_temp[$i] = array_slice($new_temp[$i], 3, 7);
  }
  for($i=0; $i<sizeof($drop_temp); $i++){
    $drop_temp[$i] = array_slice($drop_temp[$i], 3, 7);
  }

  $edit_acd_new = array(); //변경학원 최신데이터(api 가져온거)
  $edit_acd_old = array(); //변경학원 옛날데이터(기존db있던거)

  for($i=0; $i<sizeof($new_temp); $i++){
    for($j=0; $j<sizeof($drop_temp); $j++){
      //배열을 비교하여 동일한 배열만 반환하는 함수
      $intersection = array_intersect($new_temp[$i], $drop_temp[$j]);

      //5개 항목중 3개 이상이 같으면 같은 학원으로 판단
      if(count($intersection)>=3){
        array_push($edit_acd_new, $new_acd[$i]);
        array_push($edit_acd_old, $drop_acd[$j]);

        //인덱스를 유지하기위해 slice보다는 해당값을 빈배열로 만들고 array_flilter를 쓸 예정
        //new와 drop에는 변경된학원이 아니라 신규 혹은 폐업학원으로만 구성됨
        $new_acd[$i] = [];
        $drop_acd[$j] = [];
        break;
      }
    }//end of inner for

  }//end of outer for;

  $new_acd = array_filter($new_acd);
  $new_acd = array_values($new_acd); //신규학원
  $drop_acd = array_filter($drop_acd);
  $drop_acd = array_values($drop_acd); //폐업학원

  // $sql = "select no, concat( si_name, '$', dong_name, '$', sector, '$', acd_name, '$', rprsn, '$', class, '$', tel, '$', address) as `serial`  from academy";
  // $result = mysqli_query($conn, $sql);


  // //$drop_acd 직렬화
  // $drop_acd_serial_arr = array();
  // for($i=0; $i<sizeof($drop_acd); $i++){
  //   $t = array_slice($drop_acd[$i],1);
  //   // var_dump($t);
  //   $drop_acd_serial_arr[$i] = implode("$", $t);
  //   // var_dump($drop_acd_serial_arr[$i]);
  // }

  // for ($i=0; $i < mysqli_num_rows($result); $i++){
  //   $row = mysqli_fetch_row($result);
  //   $serial = $row[1];
  //   for($j=0; $j<sizeof($drop_acd_serial_arr) ; $j++){
  //     if($drop_acd_serial_arr[$j]==$serial){
  //       $drop_acd[$j]=[];
  //     }
  //   }
  // }
  // $drop_acd = array_filter($drop_acd);
  // $drop_acd = array_values($drop_acd);

  //신규학원수
  $new_acd_count = sizeof($new_acd);
  //폐업학원수
  $drop_acd_count = sizeof($drop_acd);
  //수정된 학원수
  $edit_acd_count = sizeof($edit_acd_old);
  //혹은 이거 > sizeof($edit_acd_new);



  if($mode== "none"){
    return;

  }else if($mode=="drop"){
    echo json_encode($drop_acd);

  }else if($mode=="edit"){
    $edit_acd = array();
    array_push($edit_acd, $edit_acd_old);
    array_push($edit_acd, $edit_acd_new);
    echo json_encode($edit_acd);

  }else if($mode=="new"){
    echo json_encode($new_acd);

  }


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
              $temp_no = $row[2];
              $temp_srl = $row[3];

              //직렬화된 데이터를 잘라서 배열로 저장
              $srl_array = explode('$', $temp_srl);
              array_push($srl_array, $temp_no); //배열 마지막은 no기본키
              array_push($new_acd_array, $srl_array);

            }else{// 두번째 쿼리문 결과시
              $acd_no = $row[2];
              $acd_srl = $row[3];

              //직렬화된 데이터를 잘라서 배열로 저장
              $srl_array = explode('$', $acd_srl);
              array_push($srl_array, $acd_no); //배열 마지막은 no기본키
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

