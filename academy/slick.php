<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <meta name="csrf-param" content="authenticity_token" />
    <meta name="csrf-token" content="D/AjPvc/Mc2fKrSApMJcvL6JHATulWW+me9//N4+HyTu25a6xt4uRTV67OX6F15532HZFlDGf0QWrV2Fdq0VYQ==" />
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick-theme.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick.min.js"></script>
    <title></title>
  </head>
  <body>
    <?php
      include "../lib/db_connector.php";
      $sql = "select * from teacher where parent=1";
      $result = mysqli_query($conn, $sql);
      $row_num = mysqli_num_rows($result);
    ?>
    <div class="teacher_info">
      <?php
      for ($i=0; $i < $row_num; $i++) {
        mysqli_data_seek($result, $i);
        $row = mysqli_fetch_array($result);
        $no = $row["no"];
        $parent = $row["parent"];
        $name = $row["name"];
        $subject = $row["subject"];
        $content = $row["content"];
        $file_name = $row["file_name"];
        $teacher_name[$i] = $name;
      ?>
      <div class="teacer_card slider-for">
        <img src="../img/teacher_img<?=$i?>.jpg" alt="">
        <ul>
          <li><?=$name?></li>
          <li><?=$subject?></li>
          <li><?=$content?></li>
        </ul>
      </div>
      <?php
      }
      ?>
      <div class="slider slider-nav">
      <?php
        for ($i=0; $i < $row_num; $i++) {
      ?>
      <div><h3><?=$i?></h3></div>
      <?php } ?>
      </div>
    </div>
  </body>
</html>
