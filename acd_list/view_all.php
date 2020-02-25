<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>에듀플래닛</title>

    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR&amp;display=swap" rel="stylesheet">
    <!-- <link rel="stylesheet" href="/eduplanet/mypage/css/follow.css"> -->
    <link rel="stylesheet" href="./css/view_all.css">

    <script>
        // function deleteFollow(follow_no) {
        //
        //     var deleteConf = confirm('찜하기를 취소하시겠습니까?');
        //
        //     if (deleteConf === true) {
        //         location.href = "/eduplanet/mypage/follow_delete.php?no=" + follow_no;
        //
        //     } else {
        //         alert("삭제가 취소되었습니다.");
        //     }
        // }

        // function selectDistrict() {

        //     selectDis = document.getElementById("follow_list_select_district").value;

        //     $.ajax({
        //         type: 'post',
        //         url: "/eduplanet/mypage/select_district.php",
        //         dataType: "json",
        //         data: {
        //             review_no: no
        //         },

        //         success: function (data) {
        //             $("#acd_name").val(data[0]['acd_name']);
        //         }
        //     })
        // }
    </script>

    <!-- 아이콘 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css">

</head>

<body>
    <div class="body_wrap">

        <header>
            <div class="header_searchbar_fix">
                <?php include_once '../index/index_header_searchbar_in.php'; ?>
            </div>


        </header>



        <div class="follow_list_wrap">
            <div class="follow_list_background">



                <?php

                // 찜목록 test ============================================================

                if (isset($_GET["page"])) {
                    $page = $_GET["page"];
                } else {
                    $page = 1;
                }

                $user_no = $gm_no;

                include_once "../lib/db_connector.php";
                // $sql = "select academy.no,academy.acd_name,academy.file_copy,avg(review.total_star),acd_story.parent from academy join review on academy.no = review.parent join acd_story on review.parent = acd_story.parent group by review.parent";
                $sql = "SELECT
                            academy.no,
                            academy.acd_name,
                            academy.address,
                            academy.file_copy,
                            total_star,
                            str_cnt,
                            rv_cnt
                        FROM
                            academy
                              left  JOIN
                            (SELECT parent, AVG(total_star) as total_star, COUNT(*)as rv_cnt FROM review group by parent) review ON academy.no = review.parent
                              left JOIN
                            (SELECT parent, COUNT(*)as str_cnt FROM acd_story group by parent) acd_story ON academy.no = acd_story.parent
                        GROUP BY academy.no";

                $result = mysqli_query($conn, $sql);
                $total_record = mysqli_num_rows($result);


                ?>

                <!-- select box -------------------------------------------------------------------------------------->
                <div class="follow_list_select">
                  <script type="text/javascript">
                    console.log(<?= $total_record ?>);
                  </script>
                    <h2>
                        우리동네학원
                        <!-- <button id="button_write_follow" onclick="location.href='/eduplanet/acd_story/post.php'">스토리 등록</button> -->
                    </h2>
                    <span id="follow_total_span">총 <span id="follow_total_num"><?= $total_record ?></span> 개의 학원이 있습니다.</span>

                    <div class="follow_select">
                        <select name="follow_list_select_district" id="follow_list_select_district" onchange="selectDistrict();">
                            <option selected>시/군 선택</option>
                            <option value="가평군">가평군</option>
                            <option value="고양시">고양시</option>
                            <option value="과천시">과천시</option>
                            <option value="광명시">광명시</option>
                            <option value="광주시">광주시</option>
                            <option value="구리시">구리시</option>
                            <option value="군포시">군포시</option>
                            <option value="김포시">김포시</option>
                            <option value="남양주시">남양주시</option>
                            <option value="동두천시">동두천시</option>
                            <option value="부천시">부천시</option>
                            <option value="성남시">성남시</option>
                            <option value="수원시">수원시</option>
                            <option value="시흥시">시흥시</option>
                            <option value="안산시">안산시</option>
                            <option value="안성시">안성시</option>
                            <option value="안양시">안양시</option>
                            <option value="양주시">양주시</option>
                            <option value="양평군">양평군</option>
                            <option value="여주시">여주시</option>
                            <option value="연천군">연천군</option>
                            <option value="오산시">오산시</option>
                            <option value="용인시">용인시</option>
                            <option value="의왕시">의왕시</option>
                            <option value="의정부시">의정부시</option>
                            <option value="이천시">이천시</option>
                            <option value="파주시">파주시</option>
                            <option value="평택시">평택시</option>
                            <option value="포천시">포천시</option>
                            <option value="하남시">하남시</option>
                            <option value="화성시">화성시</option>
                            <!-- <option value="district_01">가평군</option>
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
                            <option value="district_31">화성시</option> -->
                        </select>

                        <select name="follow_list_select_mode" id="follow_list_select_mode">
                            <option value="star_max">총 만족도 순</option>
                            <!-- <option value="hit_max">조회수 순</option> -->
                            <option value="hit_max">최근 찜한 순</option>
                        </select>
                    </div>
                </div>

                <!-- start of ul ------------------------------------------------------------------------------------->

                <ul class="follow_unorder_list">

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
                        $no = $row["no"]; //넘
                        $acd_name = $row["acd_name"]; //학원명
                        $address = $row["address"]; //주소
                        $file_copy = $row["file_copy"]; //학원로고
                        $total_star = $row["total_star"]; //평점
                        $review_count = $row["rv_cnt"]; // 리뷰 수
                        $story_count = $row["str_cnt"]; //스토리 수

                        $total_star = sprintf('%0.1f',$total_star);

                        // if(is_float($total_star)===true){
                        //   $total_star = $total_star;
                        //
                        // }else{
                        //   $total_star = $total_star.'.0';
                        // }
                        // else {
                        //   $total_star= round($total_star,1).'.0';
                        // }


                        // $acd_no = $row["acd_no"];
                        // $follow_no = $row["no"];
                        //
                        // $sql = "SELECT total_star FROM review WHERE parent='$acd_no'";
                        // $result_total_star = mysqli_query($conn, $sql);
                        // $total_record_review = mysqli_num_rows($result_total_star);
                        //
                        // $row = mysqli_fetch_array($result_total_star);
                        //
                        // $total_star = $row["total_star"];
                        //
                        // $sql = "SELECT * FROM acd_story WHERE parent='$acd_no'";
                        // $result_story = mysqli_query($conn, $sql);
                        // $total_record_story = mysqli_num_rows($result_story);

                        // 아직 사진 컬럼이 없어서 못가져옴
                        // if ($row["file_name"]) {
                        //     $file_image = "<img src='./img/file.gif' height='13'>";
                        // } else {
                        //     $file_image = "";
                        // }

                    ?>

                        <li>
                            <!-- 하나의 학원목록 -->
                            <div class="follow_list_column">

                               <!-- 왼쪽 학원 로고 및 정보  -->
                                <!-- 클릭 시 href=학원페이지                           parent=<?= $parent ?>&acd_name=<?= $acd_name ?>     -->
                                <a href="/eduplanet/academy/index.php?no=<?= $no ?>">
                                    <div class="follow_list_column_img">
                                        <img src="/eduplanet/data/acd_logo/travel.png" alt="academy_list_column_img">
                                    </div>

                                    <div class="follow_list_column_text">
                                        <h1 id="follow_text_academy"><?=$acd_name?>
                                </a>

                                </h1>
                                <p id="follow_text_district"><?=$address?></p>

                                <div class="follow_list_column_review">
                                    <a href="#"><span id="academy_review_span">학원리뷰 <span id="academy_review_num"><?= $review_count ?></span></span></a>
                                    <a href="#"><span id="academy_review_span">스토리 <span id="academy_review_num"><?= $story_count ?></span></span></a>

                                    <!-- <div class="academy_small_star">
                                        <img src="/eduplanet/img/review_star_one.png" alt="academy_small_star">
                                        <span id="academt_review_star_score"><?= $total_star ?></span>
                                    </div> -->

                                </div>
                            </div>

                            <!-- 오른쪽 별점 & 삭제버튼 -->
                            <div class="follow_list_column_sub">

                                <div class="follow_academy_heart">
                                    <span>학원 찜하기</span>
                                    <button type="button" id="button_academy_heart" onclick="deleteFollow(<?=$follow_no?>);">like</button>
                                </div>

                                <div class="follow_academy_star_wrap">
                                    <span class="follow_academy_star_span">총 만족도</span>

                                    <div class="follow_academy_star">
                                        <img id="acd_star_1" class="acd_star_class" src="/eduplanet/img/common_sprite.png" alt="follow_academy_star">
                                        <img id="acd_star_2"class="acd_star_class" src="/eduplanet/img/common_sprite.png" alt="follow_academy_star">
                                        <img id="acd_star_3"class="acd_star_class" src="/eduplanet/img/common_sprite.png" alt="follow_academy_star">
                                        <img id="acd_star_4"class="acd_star_class" src="/eduplanet/img/common_sprite.png" alt="follow_academy_star">
                                        <img id="acd_star_5"class="acd_star_class" src="/eduplanet/img/common_sprite.png" alt="follow_academy_star">
                                    </div>

                                    <span class="follow_academy_star_num"><?= $total_star

                                      // echo "
                                      //   <script>
                                      //   document.getElementsByClassName('follow_academy_star_num')[$no].innerHTML = $total_star;
                                      //
                                      //
                                      //   </script>
                                      //
                                      // ";

                                      // if ($total_star%1===0) {
                                      //   $total_star.0;
                                      // }else{
                                      //   round($total_star,1)
                                      // }
                                      ?>
                                    </span>

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

                            //그룹번호의 첫번째 페이지 숫자
                            $first_page = $last_page - ($page_scale-1);

                            //그룹번호의 첫번째 페이지는 1페이지보다 작을 수 없음
                            if ($first_page < 1) {
                                $first_page = 1;

                            //마지막 그룹번호일때 첫번째 페이지값 결정
                            } else if ($last_page == $total_page) {

                                if ($total_page % $page_scale == 0) {
                                    $first_page = $total_page - $page_scale + 1;

                                } else {
                                    $first_page = $total_page - ($total_page % $page_scale) + 1;
                                }
                            }

                            $next = $last_page + 1; // > 버튼 누를때 나올 페이지
                            $prev = $first_page - 1; // < 버튼 누를때 나올 페이지

                            // 첫번째 페이지일 때 앵커 비활성화
                            if ($first_page == 1) {

                                if ($page != 1) {
                                    echo "<li><a href='/eduplanet/acd_list/view_all.php?page=1'><span class='page_num_direction'><i class='fas fa-angle-double-left'></i></span></a></li>";
                                } else {
                                    echo "<li><a><span class='page_num_direction'><i class='fas fa-angle-double-left'></i></span></a></li>";
                                }

                                echo "<li><a><span class='page_num_direction'><i class='fas fa-angle-left'></i></span></a></li>";
                            } else {
                                echo "<li><a href='/eduplanet/acd_list/view_all.php?page=1'><span class='page_num_direction'><i class='fas fa-angle-double-left'></i></span></a></li>";
                                echo "<li><a href='/eduplanet/acd_list/view_all.php?page=$prev'><span class='page_num_direction'><i class='fas fa-angle-left'></i></span></a></li>";
                            }

                            //페이지 번호 매기기
                            for ($i = $first_page; $i <= $last_page; $i++) {

                                if ($page == $i) {
                                    echo "<li><span class='page_num_set'><b style='color:#2E89FF'> $i </b></span></li>";
                                } else {
                                    echo "<li><a href='/eduplanet/acd_list/view_all.php?page=$i'><span class='page_num_set'> &nbsp$i&nbsp </span></a></li>";
                                }
                            }

                            // 마지막 페이지일 때 앵커 비활성화
                            if ($last_page == $total_page) {
                                echo "<li><a><span class='page_num_direction'><i class='fas fa-angle-right'></i></span></a></li>";

                                if ($page != $total_page) {
                                    echo "<li><a href='/eduplanet/acd_list/view_all.php?page=$total_page'><span class='page_num_direction_last'><i class='fas fa-angle-double-right'></i></span></a></li>";
                                } else {
                                    echo "<li><a><span class='page_num_direction_last'><i class='fas fa-angle-double-right'></i></span></a></li>";
                                }
                            } else {
                                echo "<li><a href='/eduplanet/acd_list/view_all.php?page=$next'><span class='page_num_direction'><i class='fas fa-angle-right'></i></span></a></li>";
                                echo "<li><a href='/eduplanet/acd_list/view_all.php?page=$total_page'><span class='page_num_direction_last'><i class='fas fa-angle-double-right'></i></span></a></li>";
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <!-- end of page_num_wrap -------------------------------------------------------->

            </div>
        </div>





        <footer>
            <?php include "../index/footer.php"; ?>
        </footer>


    </div>

</body>

</html>
