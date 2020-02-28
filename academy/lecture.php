<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>lecture test</title>
    <!-- index_header_searchbar_in -->
    <!-- 제이쿼리 -->
    <script src="http://code.jquery.com/jquery-1.12.4.min.js" charset="utf-8"></script>

    <!-- 자동완성 -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <!-- CSS -->
    <link rel="stylesheet" href="/eduplanet/index/index_header_searchbar_in.css">

    <!-- 스크립트 -->
    <script src="/eduplanet/searchbar/searchbar_in.js"></script>

    <link rel="stylesheet" href="/eduplanet/academy/header/academy_header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR&amp;display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="/eduplanet/img/favicon.png">
    <link rel="stylesheet" href="/eduplanet/mypage/css/review_write_popup.css">
    <script src="/eduplanet/mypage/js/review_write.js"></script>
    <link rel="stylesheet" href="./header/academy_header.css">
    <link rel="stylesheet" href="../index/footer.css">
    <!-- 나의 css -->
    <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="./js/slide.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.css">
    <link rel="stylesheet" href="./css/lecture.css">
    <link rel="stylesheet" href="./css/slide.css">
    <script src="./js/lecture.js"></script>
    <title></title>
  </head>
  <body>
    <header>
    <?php
      include "../index/index_header_searchbar_in.php";
      include "./header/academy_header.php";
    ?>
    </header>
    <section>
      <div class="container-fluid">
        <h1 class="text-center mb-3">강의 정보</h1>
      <?php
        include "../lib/db_connector.php";
        $parent = 1;
        $sql = "select * from teacher where parent='$parent'";
        $result = mysqli_query($conn, $sql);
        $row_num = mysqli_num_rows($result);
      ?>
      <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner row w-100 mx-auto">
          <?php
            for ($i=0; $i < $row_num; $i++) {
              mysqli_data_seek($result, $i);
              $row = mysqli_fetch_array($result);
              $no = $row["no"];
              $parent = $row["parent"];
              $name = $row["name"];
              $subject = $row["subject"];
              $content = $row["content"];
              $teacher_name[$i] = $name;
              if ($i==0) {
          ?>
          <div class="carousel-item col-md-4 active">
            <div class="card" onclick="getinfo(<?=$no?>)">
              <img class="card-img-top img-fluid" src="../img/teacher_img<?=$i?>.jpg" style="width: 100%; height: 140px;" alt="Card image cap">
              <div class="card-body">
                <h4 class="card-title"><?=$name?> 선생님</h4>
                <p class="card-text">수업 과목 : <?=$subject?></p>
                <p class="card-text">경력 사항 : <?=$content?></p>
              </div>
            </div>
          </div>
          <?php
            }else{
          ?>
          <div class="carousel-item col-md-4">
            <div class="card" onclick="getinfo(<?=$no?>)">
              <img class="card-img-top img-fluid" src="../img/teacher_img<?=$i?>.jpg" style="width: 100%; height: 140px;" alt="Card image cap">
              <div class="card-body">
                <h4 class="card-title"><?=$name?> 선생님</h4>
                <p class="card-text">수업 과목 : <?=$subject?></p>
                <p class="card-text">경력 사항 : <?=$content?></p>
              </div>
            </div>
          </div>
          <?php
              }
            }
          ?>
          <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
        <div id="teacher_schedule">
          <h1>강의 시간표</h1>
          <table id="table">
          </table>
        </div>
      </div>
    </section>
    <footer>
      <?php include "../index/footer.php"; ?>
    </footer>
  </body>
</html>
