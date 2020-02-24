<?php
  @session_start();
  include "../lib/db_connector.php";

  $today = date("yy-m-d");

  $gm_id = test_input($_POST['inputId']);
  $gm_pw = test_input($_POST['inputPw1']);
  $gm_email = test_input($_POST['inputEmail']);
  $gm_tel = test_input($_POST['inputTel']);
  $gm_age = test_input($_POST['inputAge']);
  $gm_intres = test_input($_POST['inputIntres']);

  $sql = "insert into g_members values (null, '$gm_id', '$gm_pw', '$gm_email', '$gm_tel', $gm_age, '$gm_intres', '0000-00-00', '$today');";
  mysqli_query($conn, $sql);

  $_SESSION["gm_id"] = $gm_id;
  mysqli_close($conn);
  header('Location: ../index.php');

 ?>
