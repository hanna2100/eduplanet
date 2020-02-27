<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ACD_STORY</title>
    <!-- favicon -->
    <link rel="shortcut icon" href="/eduplanet/img/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR&amp;display=swap" rel="stylesheet">
    <script src="http://code.jquery.com/jquery-1.12.4.min.js" charset="utf-8"></script>
    <!-- 자동완성 -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- 스크립트 -->
    <script src="/eduplanet/mypage/js/review_write.js"></script>
    <script src="/eduplanet/searchbar/searchbar_in.js"></script>
    <!-- CSS -->
    <link rel="stylesheet" href="/eduplanet/mypage/css/review_write_popup.css">
    <link rel="stylesheet" href="/eduplanet/index/index_header_searchbar_in.css">
    <link rel="stylesheet" href="/eduplanet/academy/header/academy_header.css">
    <link rel="stylesheet" href="../index/index_content.css">
    <link rel="stylesheet" href="./css/acd_story.css">
    <link rel="stylesheet" href="/eduplanet/index/footer.css">
  </head>
  <body>
    <header>
        <?php
         include_once $_SERVER["DOCUMENT_ROOT"]."/eduplanet/lib/session_start.php";
         include_once $_SERVER["DOCUMENT_ROOT"]."/eduplanet/index/index_header_searchbar_in.php";
         include_once $_SERVER["DOCUMENT_ROOT"]."/eduplanet/academy/header/academy_header.php";
        ?>
    </header>

    <section>
      <?php
         include "../lib/db_connector.php";
         $no = isset($_GET["no"]) ?  $_GET["no"] : 7; // academy 넘버

         // 해당 학원의 스토리 조회순 정렬
         $sql_hit = "select no, subtitle, title, file_copy from acd_story where parent='$no' order by hit desc limit 4;";
         $result = mysqli_query($conn, $sql_hit);
         $story_no_arr = [];
         $subtitle_arr = [];
         $title_arr = [];
         $file_copy_arr = [];

         for ($i = 0; $i < 4; $i++) {
             mysqli_data_seek($result, $i);
             $row = mysqli_fetch_array($result);

             $story_no = $row['no'];
             $subtitle = $row['subtitle'];
             $title = $row['title'];
             $file_copy = $row['file_copy'];
             if ($file_copy != "") {
                 $file_copy = "/eduplanet/img/'$file_copy'";
             } else {
                 $file_copy = "/eduplanet/img/books.jpg";
             }

             array_push($story_no_arr, $story_no);
             array_push($subtitle_arr, $subtitle);
             array_push($title_arr, $title);
             array_push($file_copy_arr, $file_copy);
             // print_r($subtitle_array);
           }

         ?>

      <div class="inner_section">
        <div class="story_container">

          <div class="story_card a1">
            <div class="story_img">
              <a href="/eduplanet/acd_story/view.php?story_no=<?=$story_no_arr[0]?>"><img src="../img/books.jpg" width="100%" height="200px" alt="academy_story"></a>
            </div>
            <div class="story_contents">
              <div class="story_subtitle"><?=$subtitle_arr[0]?></div>
              <div class="story_title"><?=$title_arr[0]?></div>
            </div>
          </div>

          <div class="story_card a2">
            <div class="story_img">
            <a href="/eduplanet/acd_story/view.php?story_no=<?=$story_no_arr[1]?>"><img src="../img/books.jpg" width="100%" height="200px" alt="academy_story"></a>
            </div>
            <div class="story_contents">
              <div class="story_subtitle"><?=$subtitle_arr[1]?></div>
              <div class="story_title"><?=$title_arr[1]?></div>
            </div>
          </div>

          <div class="story_card a3">
            <!-- <div class="story_img"> -->
              <a href="/eduplanet/acd_story/view.php?story_no=<?=$story_no_arr[2]?>"><img src="../img/books.jpg" width="100%" height="100%" alt="academy_story"></a>
            <!-- </div> -->
            <div class="story_contents" style="top:75%">
              <div class="story_subtitle"><?=$subtitle_arr[2]?></div>
              <div class="story_title"><?=$title_arr[2]?></div>
            </div>
          </div>

          <div class="story_card a4">
            <div class="story_img" id="story_img_wrap" style="">
              <a href="/eduplanet/acd_story/view.php?story_no=<?=$story_no_arr[3]?>"><img id="story_img" src="../img/books.jpg" alt="academy_story"></a>
            </div>
            <div class="story_contents" style="left:5%">
              <div class="story_subtitle"><?=$subtitle_arr[3]?></div>
              <div class="story_title"><?=$title_arr[3]?></div>
            </div>
          </div>

        </div>   <!-- end of story_container -->


          <!-- 하단 다른 스토리 -->
        <div class="academy_other_story_list_wrap">
            <div class="academy_other_story_list">

                <div class="content_title_wrap">
                    <h2 class="title">스토리 더보기</h2>
                </div>

                <ul class="content_cource_unorder_list">

                    <?php

                    $sql = "SELECT S.no as story_no, S.* FROM acd_story S inner join academy A on S.parent=A.no
                            where parent=(select parent from acd_story where acd_story.no=$story_no) order by hit desc";
                    $result = mysqli_query($conn, $sql);
                    $rows_num = mysqli_num_rows($result);

                    for ($i = 0; $i < $rows_num; $i++) {

                        mysqli_data_seek($result, $i);
                        $row = mysqli_fetch_array($result);

                        $story_no = $row['story_no'];
                        $acd_name = $row['acd_name'];
                        $title = $row['title'];
                        $subtitle = $row['subtitle'];
                        $file_copy = $row['file_copy'];

                    ?>

                        <li>
                            <div class="cource_column">
                                <a href="/eduplanet/acd_story/view.php?story_no=<?= $story_no ?>">
                                    <div class="cource_column_box">

                                        <div class="academy_img_box">
                                            <img src="/eduplanet/acd_story/<?= $file_copy ?>" alt="academy_sto">
                                        </div>

                                        <div class="academy_introduce">
                                            <h3 id="academy_introduce_title"><?= $title ?></h3>
                                            <p id="academy_introduce_content"><?= $subtitle ?></p>
                                        </div>

                                    </div>
                                </a>
                            </div>
                        </li>

                        <span class="span_padding"></span>

                    <?php
                    }
                    ?>

                </ul>

            </div>
        </div>
      </div>
    </section>



     <footer>
       <?php include_once $_SERVER["DOCUMENT_ROOT"]."/eduplanet/index/footer.php"; ?>
     </footer>

     <script>
      var div = document.getElementById("story_img_wrap"); // 이미지를 감싸는 div
      var img = document.getElementById("story_img"); // 이미지
      var divAspect = 200 / 700; // div의 가로세로비는 알고 있는 값이다
      var imgAspect = img.height / img.width;
      console.log(img.height, img.width);

      if (imgAspect <= divAspect) {
          // 이미지가 div보다 납작한 경우 세로를 div에 맞추고 가로는 잘라낸다
          var imgWidthActual = div.offsetHeight / imgAspect;
          var imgWidthToBe = div.offsetHeight / divAspect;
          var marginLeft = -Math.round((imgWidthActual - imgWidthToBe) / 2);
          img.style.cssText = 'width: auto; height: 100%; margin-left: '
                            + marginLeft + 'px;'
      } else {
          // 이미지가 div보다 길쭉한 경우 가로를 div에 맞추고 세로를 잘라낸다
          img.style.cssText = 'width: 100%; height: auto; margin-left: 0;';
      }

     </script>

  </body>
 </html>
