<?php
  @session_start();
  include "../lib/db_connector.php";

  $today = date("yy-m-d");
  $mode = $_GET['mode'];
  $id = test_input($_POST['inputId']);
  $pw = test_input($_POST['inputPw1']);
  $email = test_input($_POST['inputEmail']);

  if($mode == "gm"){
    $tel = test_input($_POST['inputTel']);
    $age = test_input($_POST['inputAge']);
    $intres = test_input($_POST['inputIntres']);

    $sql_insert = "insert into g_members values
            (null, '$id', '$pw', '$email', '$tel', $age, '$intres', '0000-00-00', '$today');";
    $sql_select = "select * from g_members where id='$id'";
    $no = "gm_no";

  }else if($mode == "am"){
    $acdName = test_input($_POST['inputAcdName']);
    $rprsn = test_input($_POST['inputRprsn']);
    $license = test_input($_POST['inputLicense']);

    $sql_insert = "insert into a_members values
            (null, 0, '$id', '$pw', '$email', '$acdName', '$rprsn', 'file_copy.jpg', 'N', '0000-00-00', '$today');";
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

        </script>
      ";

  // location.href = '/eduplanet/index.php';

 ?>
