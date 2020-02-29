<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>에듀플래닛</title>

    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/eduplanet/academy/header/academy_header.css">

</head>

<body>
  <?php
    $no = $_GET["no"];
    include_once $_SERVER["DOCUMENT_ROOT"]."/eduplanet/lib/db_connector.php"; //절대경로

    // $servername = "localhost";
    // $username = "root";
    // $password = "123456";
    // $dbflag ="NO";//eduplanet db존재여부
    //
    // // 1 .Create connection mysql -u root -p 123456 -h 192.168.0.230
    // $conn = mysqli_connect($servername, $username, $password);
    $sql = "select academy.no,academy.si_name,academy.acd_name,academy.file_copy,avg(review.total_star),avg(review.facility),avg(review.acsbl),avg(review.teacher),avg(review.cost_efct),avg(review.achievement) from academy join review on academy.no = review.parent where academy.no = $no group by review.parent order by avg(review.total_star) desc";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result);

    $acd_name = $row["acd_name"];
    $si_name = $row["si_name"];
    $file_copy = $row["file_copy"];
    $avg_total = $row["avg(review.total_star)"];
    // $avg_facility = $row["avg(review.facility)"];
    // $avg_acsbl = $row["avg(review.acsbl)"];
    // $avg_teacher = $row["avg(review.teacher)"];
    // $avg_cost_efct = $row["avg(review.cost_efct)"];
    // $avg_achievement = $row["avg(review.achievement)"];

    //if를 사용해서 documents.getElementsByClassName 이걸로 해결해보자.
   ?>

    <div class="body_wrap">

        <div class="academy_header_wrap">

            <div class="academy_header_img">

            </div>
            <script type="text/javascript">

            </script>

            <div class="academy_header_info_wrap">
                <div class="academy_header_info">

                <div class="academy_big_logo">
                    <img src="/eduplanet/img/acd_logo2.png" alt="academy_big_logo">
                    <!-- <img src="/eduplanet/data/acd_logo/<?= $file_copy ?>" alt="academy_big_logo">   db에 이미지 넣으면 위에거 주석 , 이건 주석풀어라~~ -->
                </div>

                <h1 id="academy_title"><?= $acd_name ?></h1>

                    <div class="academy_title_detail">
                        <img src="/eduplanet/img/academy_big_one_star.png" alt="academy_big_one_star">

                        <span id="academy_star_span"><?= round($avg_total,1) ?></span>
                        <?php
                          echo "
                            <script>
                            if($avg_total%1==0){
                              document.getElementById('academy_star_span').innerHTML = $avg_total+'.0';
                            }else{
                              document.getElementById('academy_star_span').innerHTML = round($avg_total,1);
                            }
                            </script>

                          ";
                         ?>
                        <span id="academy_district"><?= $si_name ?></span>

                    </div>
                </div>

            </div>

            <div class="academy_header_menu_wrap">
                <div class="academy_header_menu">
                    <ul class="academy_header_menu_ul">
                        <li>
                            <a href="#">
                                <span class="header_menu_text">소개</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="header_menu_text">리뷰</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="header_menu_text">강의정보</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="header_menu_text">스토리</span>
                            </a>
                        </li>

                        <button id="button_add_like" type="button" onclick="">찜하기</button>
                    </ul>

                </div>

            </div>
        </div>
    </div>
</body>

</html>
