<?php
  session_start();
  include "../lib/db_connector.php";

  $gm_id = test_input($_POST['inputId']);
  $gm_pw = test_input($_POST['inputPw']);

  $sql = "select * from g_members where id='$gm_id'";
  $result = mysqli_query($conn, $sql);
  $num_match = mysqli_num_rows($result);

  if(!$num_match){
    alert_back('가입되지 않은 아이디 입니다. 다시 입력해주세요');
    $gm_id="";
  }else{
    $pw_match = mysqli_fetch_array($result);
    if($gm_pw != $pw_match['pw']){
      alert_back('비밀번호를 잘못 입력하셨습니다.');
    }else{
      $_SESSION["gm_id"] = $pw_match["id"];

      mysqli_close($conn);
      header('Location: ../index.php');
    }
  }

 ?>
