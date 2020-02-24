<?php
  $id = $_GET["id"];
  include "../lib/db_connector.php";
  echo "'$id'";

  $sql = "select * from g_members where id = '$id';";

  $result = mysqli_query($conn, $sql);
  $result_record = mysqli_num_rows($result);
  // mysqli_error($result);

  if($result_record){
    echo "1";
  }else{
    echo "0";
  }

  mysqli_close($conn);


?>
