<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>review test</title>
    <!-- 나의 css -->

    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.css">
    <link rel="stylesheet" href="./css/lecture.css">
    <link rel="stylesheet" href="./css/slide.css">
    <script src="./js/lecture.js"></script>
    <title></title>
  </head>
  <body>
    <header>
      <!-- <?php
      // include "./header/academy_header_include.php";
       ?> -->
    </header>
    <section>
      <div class="container-fluid">
        <h1 class="text-center mb-3">강의 정보</h1>
      <?php
        include "../lib/db_connector.php";
        $sql = "select * from teacher where parent=1";
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
              $file_name = $row["file_name"];
              $teacher_name[$i] = $name;
              if ($i==0) {
          ?>
          <div class="carousel-item col-md-4 active">
            <div class="card" onclick="getinfo(<?=$no?>)">
              <img class="card-img-top img-fluid" src="../img/teacher_img<?=$i?>.jpg" style="width: 100%; height: 400px;" alt="Card image cap">
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
              <img class="card-img-top img-fluid" src="../img/teacher_img<?=$i?>.jpg" style="width: 100%; height: 400px;" alt="Card image cap">
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
