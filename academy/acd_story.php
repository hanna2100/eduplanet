<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>에듀플래닛</title>

  <!-- favicon -->
  <link rel="shortcut icon" href="/eduplanet/img/favicon.png">
  <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR&amp;display=swap" rel="stylesheet">
  <script src="http://code.jquery.com/jquery-1.12.4.min.js" charset="utf-8"></script>

  <!-- CSS -->
  <link rel="stylesheet" href="../index/index_content.css">
  <link rel="stylesheet" href="./css/acd_story.css">
  <link rel="stylesheet" href="/eduplanet/mypage/css/review_write_popup.css">
  <link rel="stylesheet" href="/eduplanet/index/index_header_searchbar_in.css">
  <link rel="stylesheet" href="/eduplanet/academy/header/academy_header.css">
  <link rel="stylesheet" href="/eduplanet/index/footer.css">
  <link rel="stylesheet" href="/eduplanet/acd_story/css/view.css">

  <!-- 자동완성 -->
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

  <!-- 스크립트 -->
  <script src="/eduplanet/mypage/js/review_write.js"></script>
  <script src="/eduplanet/searchbar/searchbar_in.js"></script>

</head>

<body>

  <header>
    <?php
    include_once $_SERVER["DOCUMENT_ROOT"] . "/eduplanet/lib/session_start.php";
    include_once $_SERVER["DOCUMENT_ROOT"] . "/eduplanet/lib/db_connector.php";
    include_once $_SERVER["DOCUMENT_ROOT"] . "/eduplanet/index/index_header_searchbar_in.php";
    include_once $_SERVER["DOCUMENT_ROOT"] . "/eduplanet/academy/header/academy_header.php";
    ?>
  </header>

  <section>

    <?php
    $no = isset($_GET["no"]) ?  $_GET["no"] : ""; // academy 넘버
    ?>

    <div class="academy_other_story_list_wrap">
      <div class="academy_other_story_list">

        <div class="content_title_wrap">
          <h2 class="title">학원 스토리</h2>
        </div>

        <ul class="content_cource_unorder_list">

          <?php

          $sql = "SELECT S.no as story_no, S.* FROM acd_story S inner join academy A on S.parent=A.no
                            where parent='$no' order by hit desc";
          $result = mysqli_query($conn, $sql);
          $total_record = mysqli_num_rows($result);

          for ($i = 0; $i < $total_record; $i++) {

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
                      <img src="/eduplanet/data/acd_story/<?= $file_copy ?>" alt="academy_sto">
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
    <?php include_once $_SERVER["DOCUMENT_ROOT"] . "/eduplanet/index/footer.php"; ?>
  </footer>

</body>

</html>