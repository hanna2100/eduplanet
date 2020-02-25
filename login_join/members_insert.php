<?php
  @session_start();
  include "../lib/db_connector.php";

  $today = date("yy-m-d");
  $mode = $_GET['mode'];
  $id = test_input($_POST['inputId']);
  $pw = test_input($_POST['inputPw1']);
  $email = test_input($_POST['inputEmail']);

// 일반회원 모드
  if($mode == "gm"){
    $tel = test_input($_POST['inputTel']);
    $age = test_input($_POST['inputAge']);
    $intres = test_input($_POST['inputIntres']);

    $sql_insert = "insert into g_members values
            (null, '$id', '$pw', '$email', '$tel', $age, '$intres', '0000-00-00', '$today');";
    $sql_select = "select * from g_members where id='$id'";
    $no = "gm_no";

// 학원회원 모드
  }else if($mode == "am"){
    $upload_dir = '../data/bsnsLic/';
    $upfile_name = $_FILES["inputLicense"]["name"]; // 사용자가 실제 올린 파일 이름
    $upfile_tmp_name = $_FILES["inputLicense"]["tmp_name"];  // 서버가 임의로 준 임시 파일 이름
    $upfile_type = $_FILES["inputLicense"]["type"];
    $upfile_size = $_FILES["inputLicense"]["size"];
    $upfile_error = $_FILES["inputLicense"]["error"];

    if($upfile_name && !$upfile_error){
      $file = explode(".", $upfile_name); // 사용자가 올린 파일을 이름과 확장자로 나눈다
      $file_name = $file[0];
      $file_ext = $file[1];
      $new_file_name = date("y_m_d_h_i_s");
      $new_file_name = $new_file_name."_".$file_name;  // 현재 시간과 파일 이름을 붙여서 새로운 임시 이름을 만든다
      $copied_file_name = $new_file_name.".".$file_ext;  // 새로 만든 임시 이름에 확장자를 붙인다
      $uploaded_file = $upload_dir.$copied_file_name;  // 파일을 저장할 경로를 앞에 붙인다

      if($upfile_size > 1000000){
        alert_back('업로드 파일 크기가 지정된 용량(1MB)을 초과합니다!<br>파일 크기를 체크해주세요!');
      }
      if(!move_uploaded_file($upfile_tmp_name, $uploaded_file)){
        alert_back('파일을 지정한 디렉토리에 복사하는데 실패했습니다.');
      }
    }else{
          echo ("<script>alert('파일없음');</script>");
      $real_file_name = "";
      $real_file_type = "";
      $copied_file_name = "";
    }

    $acdName = test_input($_POST['acd_name']);
    $rprsn = test_input($_POST['inputRprsn']);

    $sql_search = "select no from academy where acd_name='$acdName'";
    $result_search = mysqli_query($conn, $sql_search);
    $row = mysqli_fetch_array($result_search);
    $acdNo = $row[0];

    $sql_insert = "insert into a_members values
            (null, '$acdNo', '$id', '$pw', '$email', '$acdName', '$rprsn', '$copied_file_name', 'N', '0000-00-00', '$today');";
    $sql_select = "select * from a_members where id='$id'";
    $no = "am_no";
  }

  mysqli_query($conn, $sql_insert);
  $result = mysqli_query($conn, $sql_select);
  $row = mysqli_fetch_array($result);
  $_SESSION[$no] = $row["no"];

  mysqli_close($conn);

  echo "
        <script>
            alert('에듀플래닛에 오신 것을 환영합니다!');
            location.href = '/eduplanet/index.php';
        </script>
      ";



 ?>
