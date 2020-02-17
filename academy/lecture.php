<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>review test</title>
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR&amp;display=swap" rel="stylesheet">\ -->
    <script src="http://code.jquery.com/jquery-1.12.4.min.js" charset="utf-8"></script>
    <!--  star rating -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- radar chart -->
    <script src="https://cdn.anychart.com/releases/8.7.1/js/anychart-core.min.js"></script>
    <script src="https://cdn.anychart.com/releases/8.7.1/js/anychart-radar.min.js"></script>
    <!-- word cloud  -->
    <script src="https://cdn.anychart.com/releases/v8/js/anychart-base.min.js"></script>
    <script src="https://cdn.anychart.com/releases/v8/js/anychart-tag-cloud.min.js"></script>
    <!-- 나의 css -->
    <link rel="stylesheet" href="./css/lecture.css">
    <title></title>
  </head>
  <body>
    <header>asdfsadfsadfasfsd
      <?php include "../index_header.php"; ?>
      <?php include "../academy_header_soyoung.php"; ?>
    </header>
    <section>
      <div id="teacher">
        <div id="teacher_info">

        <h1>강사 정보</h1>

    <?php
    include "../lib/db_connector.php";

    $sql = "select * from teacher where parent=1;";
    $result = mysqli_query($conn, $sql);
    $row_num = mysqli_num_rows($result);

    for ($i=0; $i < $row_num; $i++) {
      mysqli_data_seek($result, $i);
      $row = mysqli_fetch_array($result);
      $name = $row["name"];
      $subject = $row["subject"];
      $content = $row["content"];
      $file_name = $row["file_name"];
      ?>
      <div class='teacher_card' onclick="">
      <h3><span><?=$name?> 선생님</span></h3>
      <img class='teacher_img' src='../img/teacher_img<?=$i?>.jpg'>
      <ul class='teacher_card_ul'>
      <li><span>과목 : <?=$subject?></span></li>
      <li><span>경력 : <?=$content?></span></li>
      </ul>
      </div>
      <?php
      }
      ?>
    </div>
    <div id="teacher_schedule">
      <div id="schedule">
        <h1>강의 시간표</h1>
        <?php
        mysqli_data_seek($result, 0);
        $row_teacher = mysqli_fetch_array($result);
        $name = $row_teacher["name"];
        ?>
        <table>
          <tr>
            <td colspan="8"><?=$name?> 선생님 시간표</td>
          </tr>
          <tr>
            <td>&nbsp</td>
            <td>월요일</td>
            <td>화요일</td>
            <td>수요일</td>
            <td>목요일</td>
            <td>금요일</td>
            <td>토요일</td>
            <td>일요일</td>
          </tr>
          <tr>
            <td>1교시</td>
            <?php
              $sql = "select * from lecture where teacher_name='$name'";
              $result_time = mysqli_query($conn, $sql);
              for ($j=0; $j < 7; $j++) {
                mysqli_data_seek($result_time, $j);
                $row_time = mysqli_fetch_array($result_time);
                $subject = $row_time["subject"];
                $day = $row_time["day"];
                $order = $row_time["order"];
                if ($order == 1) {
            ?>
                <td><?=$subject?></td>;
            <?php
                }else{
            ?>
                  <td>&nbsp</td>;
            <?php
                }
              }
            ?>
          </tr>
          <tr>
            <td>2교시</td>
            <?php
            for ($j=0; $j < 7; $j++) {
              mysqli_data_seek($result_time, $j);
              $row_time = mysqli_fetch_array($result_time);
              $subject = $row_time["subject"];
              $day = $row_time["day"];
              $order = $row_time["order"];
              if ($order == 2) {
          ?>
              <td><?=$subject?></td>;
          <?php
              }else{
          ?>
                <td>&nbsp</td>;
          <?php
              }
            }
          ?>
          </tr>
        </table>
      </div>
    </div>
    </div>
    </section>
    <footer>
      <?php include "../footer.php"; ?>
    </footer>
  </body>
</html>
