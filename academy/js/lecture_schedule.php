<?php
  include "../lib/db_connector.php";

  $parent = $_POST["teacher_no"];
  $sql_schedule = "select * from lecture where parent='$parent' order by day asc, `order` asc;";
  $result_schedule = mysqli_query($conn, $sql_schedule);
  $row_schedule_num = mysqli_num_rows($result_schedule);
  $row_teacher = mysqli_fetch_array($result_schedule);
  $schedule_array = array();

  for ($i=0; $i < $row_schedule_num; $i++) {

    mysqli_data_seek($result_schedule, $i);
    $row = mysqli_fetch_array($result_schedule);

    $temp = array();

    $sc_day = $row["day"];
    $sc_order = $row["order"];
    $sc_subject = $row["subject"];
    array_push($temp, $sc_day, $sc_order, $sc_subject);
    array_push($schedule_array, $temp);
  }
  echo json_encode($schedule_array);
?>
