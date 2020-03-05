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
    $no = isset($_GET["no"]) ? $_GET["no"] : '';

    include_once $_SERVER["DOCUMENT_ROOT"]."/eduplanet/lib/db_connector.php"; //절대경로

    // $servername = "localhost";
    // $username = "root";
    // $password = "123456";
    // $dbflag ="NO";//eduplanet db존재여부
    //
    // // 1 .Create connection mysql -u root -p 123456 -h 192.168.0.230
    // $conn = mysqli_connect($servername, $username, $password);

    $sql = "SELECT 
                academy.no,
                academy.si_name,
                academy.acd_name,
                academy.file_copy,
                AVG(review.total_star) as avg
            FROM
                academy
                    JOIN
                review ON academy.no = review.parent
            WHERE
                academy.no = $no";

    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result);

    $acd_name = $row["acd_name"];
    $si_name = $row["si_name"];
    $file_copy = $row["file_copy"];
    $parent = $no;
    $avg_total = $row['avg'];

    
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
                <?php
                    if($file_copy){
                        echo "<img src='/eduplanet/data/acd_logo/$file_copy' alt='academy_big_logo'>"; 

                    }else{
                        echo '<img src="/eduplanet/img/acd_logo2.png" alt="academy_big_logo">';

                    }
                ?>
                </div>

                <h1 id="academy_title"><?= $acd_name ?></h1>

                    <div class="academy_title_detail">
                        <img src="/eduplanet/img/academy_big_one_star.png" alt="academy_big_one_star">

                        <span id="academy_star_span"><?=$avg_total?></span>
                        <?php
                        $val = round($avg_total,1);
                        if($avg_total){
                            echo "
                            <script>
                            if($avg_total%1==0){
                              document.getElementById('academy_star_span').innerHTML = $avg_total+'.0';
                            }else{
                              document.getElementById('academy_star_span').innerHTML = ".$val.";
                            }
                            </script>

                          ";
                        }else{
                            echo "
                            <script>
                              document.getElementById('academy_star_span').innerHTML = 0;
                            </script>
                          "; 
                        }
                          
                         ?>
                        <span id="academy_district"><?= $si_name ?></span>

                    </div>
                </div>

            </div>

            <div class="academy_header_menu_wrap">
                <div class="academy_header_menu">
                    <ul class="academy_header_menu_ul">
                        <li>
                            <a href="../academy/index.php?no=<?=$parent?>">
                                <span class="header_menu_text">소개</span>
                            </a>
                        </li>
                        <li>
                            <a href="../academy/review.php?no=<?=$parent?>">
                                <span class="header_menu_text">리뷰</span>
                            </a>
                        </li>
                        <li>
                            <a href="../academy/lecture.php?no=<?=$parent?>">
                                <span class="header_menu_text">강의정보</span>
                            </a>
                        </li>
                        <li>
                            <a href="../academy/acd_story.php?no=<?=$parent?>">
                                <span class="header_menu_text">스토리</span>
                            </a>
                        </li>
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


                        <!-- <button id="button_add_like" type="button" onclick="">찜하기</button> -->
                    </ul>

                </div>

            </div>
        </div>
    </div>
</body>

</html>
