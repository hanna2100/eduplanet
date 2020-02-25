
<html lang="en">
<head>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <title>CSS Only Slider</title>
  <meta name="description" content="CSS Only Slider">
  <meta name="author" content="Significa">

  <link rel="stylesheet" href="./index.css">
  <link rel="stylesheet" href="./css/lecture.css">

</head>
<body id="gradient">

  <section class="section slider">
    <h1>강사 정보</h1>
    <div class="section__entry section__entry--center">

    </div>

  	<input type="radio" name="slider" id="slide-1" class="slider__radio" checked>
  	<input type="radio" name="slider" id="slide-2" class="slider__radio">
  	<input type="radio" name="slider" id="slide-3" class="slider__radio">
  	<input type="radio" name="slider" id="slide-4" class="slider__radio">
  	<input type="radio" name="slider" id="slide-5" class="slider__radio">

  	<div class="slider__holder">
      <?php
      include "../lib/db_connector.php";
      if (isset($_GET["parent"])) {
          $parent = $_GET["parent"];
      } else {
          $parent = 1;
      }

      $sql = "select * from teacher where parent=$parent;";
      $result = mysqli_query($conn, $sql);
      $row_num = mysqli_num_rows($result);

      for ($i=0; $i < $row_num; $i++) {
        mysqli_data_seek($result, $i);
        $row = mysqli_fetch_array($result);
        $name = $row["name"];
        $no = $row["no"];
        $subject = $row["subject"];
        $content = $row["content"];
        $teacher_name[$i] = $name;
        $file_name = $row["file_name"];
        ?>
        <label for="slide-<?=$no?>" class="slider__item slider__item--1 card">
        <div class="slideshow_slides">
          <a>
            <div class='teacher_card' onclick="getinfo(<?=$no?>)">
              <h3><span><?=$name?> 선생님</span></h3>
              <img class='teacher_img' src='../img/teacher_img<?=$i?>.jpg'>
              <div class="slider__item-content">
                <p class="heading-3 heading-3--light">과목 : <?=$subject?></p>
                <p class="heading-3">경력 : <?=$content?></p>
                <p class="slider__item-text serif">선생님 별명 : <?=$file_name?></p>
              </div>
            </div>
          </a>
        </div>
        </label>
        <?php
      }
      ?>
  	</div> <!-- Slider Holder -->



  </section> <!-- Section Slider -->
</body>
</html>
