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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="./js/lecture.js"></script>
    <script src="./js/slide.js"></script>
    <!-- slick css&lib -->
    <link rel="stylesheet" type="text/css" href="/eduplanet/lib/slick/slick.css">
    <link rel="stylesheet" type="text/css" href="/eduplanet/lib/slick/slick-theme.css">
    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="/eduplanet/lib/slick/slick.min.js"></script>

    <link rel="stylesheet" href="./css/lecture.css">
    <link rel="stylesheet" href="./css/slide.css">

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
      <div id="lecture_container">
        <h1>강의 정보</h1>
      <?php
        include "../lib/db_connector.php";
        $parent = 1;
        $sql = "select * from teacher where parent='$parent'";
        $result = mysqli_query($conn, $sql);
        $row_num = mysqli_num_rows($result);
      ?>
        <div class="teacher_carousel">
          <?php
            for ($i=0; $i < $row_num; $i++) {
              mysqli_data_seek($result, $i);
              $row = mysqli_fetch_array($result);
              $no = $row["no"];
              $parent = $row["parent"];
              $name = $row["name"];
              $subject = $row["subject"];
              $content = $row["content"];
              $file_copy = $row["file_copy"];
          ?>
          <div class="teacher_box">
            <div class="teacher" onclick="getinfo(<?=$no?>)">
              <img class="teacher_img" src="/eduplanet/data/teacher_img/<?=$file_copy?>" alt="teacher_img">
              <div class="card-body">
                <h4><span><?=$subject?></span><?=$name?></h4>
                <p class="card-text"><?=$content?></p>
              </div>
            </div>
          </div>
          <?php
          }
          ?>
        </div>
      </div>
        <div class="teacher_schedule">
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
