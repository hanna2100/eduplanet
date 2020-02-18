<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>에듀플래닛</title>

    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/eduplanet/acd_story/css/index.css">

    <!-- 아이콘 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css">

</head>

<body>

    <header>
        <?php include "../index_header_searchbar_out.php"; ?>
    </header>

    <div class="story_list_wrap">
        <div class="story_list_background">

            <?php
            if (isset($_GET["page"])) {
                $page = $_GET["page"];
            } else {
                $page = 1;
            }

            // $con = mysqli_connect("127.0.0.1", "root", "123456", "eduplanet");

            include "../lib/db_connector.php";

            $sql = "select * from acd_story order by no desc";

            $result = mysqli_query($conn, $sql);
            $total_record = mysqli_num_rows($result);

            ?>

            <!-- select box -------------------------------------------------------------------------------------->
            <div class="story_list_select">

                <h2>
                    학원 스토리
                    <button id="button_write_story" onclick="location.href='/eduplanet/acd_story/post.php'">스토리 등록</button>
                </h2>
                <span id="story_total_span">총 <span id="story_total_num"><?= $total_record ?></span> 개의 스토리가 있습니다.</span>

                <div class="story_select">
                    <select name="story_list_select_district" id="story_list_select_district">
                        <option selected>시/군 선택</option>
                        <option value="district_01">가평군</option>
                        <option value="district_02">고양시</option>
                        <option value="district_03">과천시</option>
                        <option value="district_04">광명시</option>
                        <option value="district_05">광주시</option>
                        <option value="district_06">구리시</option>
                        <option value="district_07">군포시</option>
                        <option value="district_08">김포시</option>
                        <option value="district_09">남양주시</option>
                        <option value="district_10">동두천시</option>
                        <option value="district_11">부천시</option>
                        <option value="district_12">성남시</option>
                        <option value="district_13">수원시</option>
                        <option value="district_14">시흥시</option>
                        <option value="district_15">안산시</option>
                        <option value="district_16">안성시</option>
                        <option value="district_17">안양시</option>
                        <option value="district_18">양주시</option>
                        <option value="district_19">양평군</option>
                        <option value="district_20">여주시</option>
                        <option value="district_21">연천군</option>
                        <option value="district_22">오산시</option>
                        <option value="district_23">용인시</option>
                        <option value="district_24">의왕시</option>
                        <option value="district_25">의정부시</option>
                        <option value="district_26">이천시</option>
                        <option value="district_27">파주시</option>
                        <option value="district_28">평택시</option>
                        <option value="district_29">포천시</option>
                        <option value="district_30">하남시</option>
                        <option value="district_31">화성시</option>
                    </select>

                    <select name="story_list_select_mode" id="story_list_select_mode">
                        <option value="star_max">총 만족도 순</option>
                        <option value="hit_max">조회수 순</option>
                        <option value="hit_max">최근 등록 순</option>
                    </select>
                </div>
            </div>

            <!-- start of ul ------------------------------------------------------------------------------------->

            <ul class="story_unorder_list">

                <?php

                $scale = 10;

                if ($total_record % $scale == 0) {
                    $total_page = floor($total_record / $scale);
                } else {
                    $total_page = floor($total_record / $scale) + 1;
                }

                $page_setting = ($page - 1) * $scale;

                $page_start = $total_record - $page_setting;


                for ($i = $page_setting; $i < $page_setting + $scale && $i < $total_record; $i++) {

                    mysqli_data_seek($result, $i);

                    $row = mysqli_fetch_array($result);

                    $no = $row["no"];
                    $parent = $row["parent"];
                    $acd_name = $row["acd_name"];
                    $title = $row["title"];
                    $subtitle = $row["subtitle"];
                    $regist_day = $row["regist_day"];
                    $file_name = $row["file_name"];
                    $file_copy = $row["file_copy"];
                    $hit = $row["hit"];

                    if ($row["file_name"]) {
                        $file_image = "<img src='./img/file.gif' height='13'>";
                    } else {
                        $file_image = "";
                    }

                    // 지역
                    $sql_district = "select si_name from academy where acd_name = '$acd_name'";

                    $result_district = mysqli_query($conn, $sql_district);
                    $row_district = mysqli_fetch_array($result_district);

                    $si_name = $row_district["si_name"];

                    // 별점
                    $sql_star = "select total_star from review where parent = $parent";

                    $result_star = mysqli_query($conn, $sql_star);
                    $row_star = mysqli_fetch_array($result_star);

                    $total_star = $row_star["total_star"];

                ?>

                    <li>
                        <!-- 하나의 스토리 -->
                        <div class="story_list_column">

                            <!-- <a href="/eduplanet/acd_story/view.php?no=<//?=$no?>&si_name=<//?=$si_name?>&total_star=<//?$total_star?>"> -->
                            <a href="/eduplanet/acd_story/view.php?no=<?= $no ?>&parent=<?= $parent ?>&acd_name=<?= $acd_name ?>">
                                <div class="story_list_column_img">
                                    <img src="/eduplanet/data/<?= $file_copy ?>" alt="story_list_column_img">
                                </div>

                                <div class="story_list_column_text">
                                    <h1 id="story_text_title"><?= $title ?>
                            </a>

                            <div class="story_academy_heart">
                                <span>학원 찜하기</span>
                                <button id="button_academy_heart">like</button>
                            </div>

                            </h1>
                            <p id="story_text_title_sub"><?= $subtitle ?></p>

                            <div class="story_list_column_academy_info">
                                <span id="academy_title_span"><?= $acd_name ?></span>
                                <span id="academy_district"><?= $si_name ?></span>

                                <div class="academy_small_star">
                                    <img src="/eduplanet/img/review_star_one.png" alt="academy_small_star">
                                    <span id="academt_review_star_score"><?= $total_star ?></span>
                                </div>
                            </div>
                        </div>
                    </li>

                <?php
                    $page_start--;
                }
                mysqli_close($conn);
                ?>

            </ul>
            <!-- end of ul ------------------------------------------------------------------>

            <div class="page_num_wrap">
                <div class="page_num">
                    <ul class="page_num_ul">

                        <?php

                            // 페이지 쪽수 표시 량 (5 페이지씩 표기)
                            $page_scale = 5;

                            // 페이지 그룹번호(페이지 5개가 1그룹)
                            $pageGroup = ceil($page / $page_scale); 

                            //그룹번호 안에서의 마지막 페이지 숫자
                            $last_page = $pageGroup * $page_scale; 

                            // 그룹번호의 마지막 페이지는 전체 페이지보다 클 수 없음
                            if ($total_page < $page_scale) {
                                $last_page = $total_page;

                            } else if ($last_page > $total_page) {
                                $last_page = $total_page;
                            }

                            // 그룹번호의 첫번째 페이지 숫자
                            $first_page = $last_page - ($page_scale - 1);

                            // 그룹번호의 첫번째 페이지는 1페이지보다 작을 수 없음
                            if ($first_page < 1) {
                                $first_page = 1;

                            // 마지막 그룹번호일때 첫번째 페이지값 결정
                            } else if ($last_page == $total_page) { 
                                $first_page = $total_page - ($total_page % $page_scale) + 1;
                            }

                            $next = $last_page + 1; // > 버튼 누를때 나올 페이지
                            $prev = $first_page - 1; // < 버튼 누를때 나올 페이지

                            // 첫번째 페이지일 때 앵커 비활성화
                            if ($first_page == 1) {

                                if ($page != 1) {
                                    echo "<li><a href='/eduplanet/acd_story/index.php?page=1'><span class='page_num_direction'><i class='fas fa-angle-double-left'></i></span></a></li>";
                                
                                } else {
                                    echo "<li><a><span class='page_num_direction'><i class='fas fa-angle-double-left'></i></span></a></li>";
                                }

                                echo "<li><a><span class='page_num_direction'><i class='fas fa-angle-left'></i></span></a></li>";

                            } else {
                                echo "<li><a href='/eduplanet/acd_story/index.php?page=1'><span class='page_num_direction'><i class='fas fa-angle-double-left'></i></span></a></li>";
                                echo "<li><a href='/eduplanet/acd_story/index.php?page=$prev'><span class='page_num_direction'><i class='fas fa-angle-left'></i></span></a></li>";
                            }

                            //페이지 번호 매기기
                            for ($i = $first_page; $i <= $last_page; $i++) {

                                if ($page == $i) {
                                    echo "<li><span class='page_num_set'><b style='color:#2E89FF'> $i </b></span></li>";

                                } else {
                                    echo "<li><a href='/eduplanet/acd_story/index.php?page=$i'><span class='page_num_set'> &nbsp$i&nbsp </span></a></li>";
                                }
                            }

                            // 마지막 페이지일 때 앵커 비활성화
                            if ($last_page == $total_page) {
                                echo "<li><a><span class='page_num_direction'><i class='fas fa-angle-right'></i></span></a></li>";

                                if ($page != $total_page) {
                                    echo "<li><a href='/eduplanet/acd_story/index.php?page=$total_page'><span class='page_num_direction_last'><i class='fas fa-angle-double-right'></i></span></a></li>";

                                } else {
                                    echo "<li><a><span class='page_num_direction_last'><i class='fas fa-angle-double-right'></i></span></a></li>";
                                }
                                
                            } else {
                                echo "<li><a href='/eduplanet/acd_story/index.php?page=$next'><span class='page_num_direction'><i class='fas fa-angle-right'></i></span></a></li>";
                                echo "<li><a href='/eduplanet/acd_story/index.php?page=$total_page'><span class='page_num_direction_last'><i class='fas fa-angle-double-right'></i></span></a></li>";
                            }
                        ?>
                    </ul>
                </div>
            </div>
            <!-- end of page_num_wrap -------------------------------------------------------->

        </div>
    </div>

    <footer>
        <?php include "../footer.php"; ?>
    </footer>

</body>

</html>