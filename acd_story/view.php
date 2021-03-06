<?php include_once $_SERVER["DOCUMENT_ROOT"] . "/eduplanet/lib/session_start.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>에듀플래닛</title>

    <!-- favicon -->
    <link rel="shortcut icon" href="/eduplanet/img/favicon.png">

    <!-- 제이쿼리 -->
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" charset="utf-8"></script>

    <!-- 폰트 -->
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR&amp;display=swap" rel="stylesheet">

    <!-- 아이콘 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="/eduplanet/index/index_header_searchbar_in.css">
    <link rel="stylesheet" href="/eduplanet/index/footer.css">
    <link rel="stylesheet" href="/eduplanet/mypage/css/review_write_popup.css">
    <link rel="stylesheet" href="/eduplanet/acd_story/css/view.css">

    <!-- 스크립트 -->
    <script src="/eduplanet/searchbar/searchbar_in.js"></script>
    <script src="/eduplanet/mypage/js/review_write.js"></script>

    <!-- 자동완성 -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

</head>

<body>

    <header>
        <?php include_once $_SERVER["DOCUMENT_ROOT"] . "/eduplanet/index/index_header_searchbar_in.php"; ?>
    </header>

    <?php

    $story_no = $_GET["story_no"];

    include_once $_SERVER["DOCUMENT_ROOT"] . "/eduplanet/lib/db_connector.php";

    $sql = "SELECT A.no as acd_no, S.*, A.si_name, R.total_star, A.file_copy as logo_file_copy FROM acd_story S INNER JOIN academy A ON S.parent = A.no INNER JOIN review R ON A.no = R.parent WHERE S.no=$story_no";

    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);

    $acd_no = $row["acd_no"];
    $si_name = $row["si_name"];
    $total_star = $row["total_star"];

    $acd_name = $row["acd_name"];
    $parent = $row["parent"];
    $title = $row["title"];
    $subtitle = $row["subtitle"];

    $subject1 = $row["subject1"];
    $subject2 = $row["subject2"];
    $subject3 = $row["subject3"];

    $content1 = $row["content1"];
    $content2 = $row["content2"];
    $content3 = $row["content3"];

    $file_name = $row["file_name"];
    $file_copy = $row["file_copy"];
    $file_path = "/eduplanet/data/acd_story/" . $file_copy;
    $logo_file_copy = $row["logo_file_copy"];

    $hit = $row["hit"];

    $new_hit = $hit + 1;

    $sql = "update acd_story set hit=$new_hit where no=$story_no";
    mysqli_query($conn, $sql);

    ?>


    <div class="body_wrap">

        <!-- 상단 fixed 타이틀바 ------------------------------------------------------------------------------>
        <div class="story_academy_title_wrap">

            <div class="story_academy_title">

                <!-- 1. 로고이미지 & 학원 이름 -->
                <div class="cource_column_title">

                    <div class="academy_small_logo">

                        <?php
                        if ($logo_file_copy != "") {
                            echo "<img src='/eduplanet/data/acd_logo/$logo_file_copy' alt='academy_small_logo'>";
                        } else {
                            echo "<img src='/eduplanet/img/acd_logo.png' alt='academy_small_logo'>";
                        }
                        ?>

                    </div>

                    <a href="/eduplanet/academy/index.php?no=<?= $acd_no ?>"><span id="academy_title_span"><?= $acd_name ?></span></a>
                    <span id="academy_district"><?= $si_name ?></span>

                    <div class="academy_small_star">
                        <img src="/eduplanet/img/review_star_one.png" alt="academy_small_star">
                        <span id="academt_review_star_score"><?= $total_star ?></span>
                    </div>

                    <?php
                    if ($gm_no) {
                    ?>

                        <a href="/eduplanet/acd_story/follow.php?no=<?= $parent ?>"><button type="button" id="button_add_like">찜하기</button></a>

                    <?php
                    } else {
                    ?>

                        <a href="javascript:alert('일반회원만 이용 가능합니다.')"><button type="button" id="button_add_like">찜하기</button></a>

                    <?php
                    }
                    ?>

                </div>
            </div>
        </div>

        <!-- 스토리 ------------------------------------------------------------------------------------------>

        <div class="story_academy_content_wrap">
            <div class="story_academy_content">

                <div class="story_academy_content_text">
                    <div class="story_academy_content_text_header">
                        <p id="story_mini_p">스토리</p>
                        <h1 id="story_text_title"><?= $title ?></h1>
                        <p id="story_text_title_sub"><?= $subtitle ?></p>
                    </div>

                    <div class="story_content_image">
                        <img src=<?= $file_path ?> alt="story_content_image">
                    </div>

                    <div class="story_subject">
                        <div class="subtitle"><?= $subject1 ?></div>
                        <div class="description"><?= $content1 ?></div>
                    </div>

                    <?php
                    if (isset($subject2) && isset($content2)) {

                        echo "
                            <div class='story_subject'>
                                <div class='subtitle'>$subject2</div>
                                <div class='description'>$content2</div>
                            </div>
                            ";
                    }
                    ?>

                    <?php
                    if (isset($subject3) && isset($content3)) {

                        echo "
                            <div class='story_subject'>
                                <div class='subtitle'>$subject3</div>
                                <div class='description'>$content3</div>
                            </div>
                            ";
                    }
                    ?>

                </div>
            </div>
        </div>

        <!-- 하단 다른 스토리 ----------------------------------------------------------------------------------------->

        <div class="academy_other_story_list_wrap">
            <div class="academy_other_story_list">

                <div class="content_title_wrap">
                    <h2 class="title">학원 스토리</h2>
                </div>

                <ul class="content_cource_unorder_list">

                    <?php

                    $sql = "SELECT S.no as story_no, S.* FROM acd_story S inner join academy A on S.parent=A.no
                            where parent=(select parent from acd_story where acd_story.no=$story_no) order by hit desc";
                    $result = mysqli_query($conn, $sql);
                    $total_record = mysqli_num_rows($result);

                    for ($i = 0; $i < $total_record & $i < 4; $i++) {

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

    <footer>
        <?php include_once $_SERVER["DOCUMENT_ROOT"] . "/eduplanet/index/footer.php"; ?>
    </footer>

</body>

</html>