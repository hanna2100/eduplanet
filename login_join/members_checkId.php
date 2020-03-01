<?php
 include_once $_SERVER["DOCUMENT_ROOT"]."/eduplanet/lib/db_connector.php";

  $id = $_GET["id"];
  $mode = $_GET["mode"];

  if($mode == "gm"){
    $sql = "select * from g_members where id = '$id';";
  }else if($mode == "am"){
    $sql = "select * from a_members where id = '$id';";
  }

  $result = mysqli_query($conn, $sql);
  $result_record = mysqli_num_rows($result);

  if($result_record){
    echo "1";
  }else{
    echo "0";
  }

  mysqli_close($conn);


?>
