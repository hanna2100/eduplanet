<?php
  include "../lib/db_connector.php";
  $teacher_name = $_POST[];
  $teacher_subject = $_POST[];
  $teacher_content = $_POST[];
  $teacher_img = $_POST[];

  $sql = "INSERT INTO `teacher` VALUES (,,`$teacher_name`,`$teacher_subject`,`$teacher_content`,,`$teacher_img`);";
?>
