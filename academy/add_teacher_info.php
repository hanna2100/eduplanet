<?php
  include "../lib/db_connector.php";
  $parent = $_POST["parent"];
  $teacher_img = $_POST["teacher_img"];
  $teacher_name = $_POST["teacher_name"];
  $teacher_subject = $_POST["teacher_subject"];
  $teacher_content = $_POST["teacher_content"];
  
  $sql = "INSERT INTO `teacher` VALUES (`$parent`, `$teacher_name`, `$teacher_subject`, `$teacher_content`, `$teacher_img`)";
  mysqli_query($conn, $sql);
  mysqli_close($conn);
?>
