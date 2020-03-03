<?php
      include_once $_SERVER["DOCUMENT_ROOT"]."/eduplanet/lib/db_connector.php";

      date_default_timezone_set('Asia/Seoul');
      $today = date("Y-m-d");

      $mode = $_POST['mode'];
      $id = $_POST['id'];
      $pw = $_POST['pw'];
      $tel = $_POST['tel'];
      $age = $_POST['age'];
      $intres = $_POST['intres'];

      $sql_insert = "INSERT into g_members values
                  (null, '$id', '$pw', '$tel', $age, '$intres', '', '', '0000-00-00', '$today');";
      $sql_select = "select * from g_members where id='$id'";
      $no = "gm_no";

      $result = mysqli_query($conn, $sql_insert);
      if($result){
        echo "1";
      }else{
        echo "0";
      }
      mysqli_close($conn);



?>
