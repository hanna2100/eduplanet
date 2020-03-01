<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/eduplanet/lib/db_connector.php";


    $table = $_POST["table"];
    $hash = $_POST["hash"];
    $temp_pw = $_POST["temp_pw"];
    $new_pw = $_POST["new_pw"];

    $sql = "SELECT * FROM $table WHERE hash='$hash';";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);

    if($row['temp_pw'] == $temp_pw){
      $sql_update = "UPDATE $table SET pw='$new_pw' WHERE hash='$hash';";
      mysqli_query($conn, $sql_update);
      echo "1";
    }else{
      echo "0";
    }

    mysqli_close($conn);
?>
