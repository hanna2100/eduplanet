<?php include_once $_SERVER["DOCUMENT_ROOT"] . "/eduplanet/lib/session_start.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>에듀플래닛</title>

  <!-- 폰트 -->
  <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR&amp;display=swap" rel="stylesheet">

  <!-- 파비콘 -->
  <link rel="shortcut icon" href="/eduplanet/img/favicon.png">

  <!-- css -->
  <link rel="stylesheet" href="/eduplanet/mypage/css/review_write_popup.css">
  <link rel="stylesheet" href="/eduplanet/index/index_header_searchbar_out.css">
  <link rel="stylesheet" href="/eduplanet/index/footer.css">
  <link rel="stylesheet" href="./css/view_all.css">


  <!-- 자동완성 -->
  <script src="https://code.jquery.com/jquery-1.12.4.min.js" charset="utf-8"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="/eduplanet/searchbar/searchbar_out.js"></script>
  <!-- 스크립트 -->
  <script src="/eduplanet/mypage/js/review_write.js"></script>

  <!-- 아이콘 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css">

  <?php
  if (isset($_GET["search"])) {
    $search = $_GET["search"];
    $deco = '"';

    echo "
          <script>
            function setSelectSear() {

              document.getElementById('view_all_search').innerHTML = '$deco$search$deco 검색결과';
              document.getElementById('view_all_review').innerHTML = '';

            }
          </script>
        ";
  } else {
    $search = "";
  }

  ?>

  <script>

    $(function(){
      setSelectDis(); setSelectSort(); setSelectSear();
    });
    var search = "<?= $search ?>";

    function selectOption() {

      selectDistrict = document.getElementById("follow_list_select_district").value;
      selectSort = document.getElementById("follow_list_select_mode").value;
      if (search !== "") {
        location.href = "/eduplanet/acd_list/view_all.php?district=" + selectDistrict + "&sort=" + selectSort + "&search=" + search;
        document.getElementById('view_all_search').innerHTML = '';
      } else if (search === "") {
        location.href = "/eduplanet/acd_list/view_all.php?district=" + selectDistrict + "&sort=" + selectSort;
        document.getElementById('view_all_search').innerHTML = '';
      }

    }

    
  </script>

</head>

<body>
  <div class="body_wrap">

    <header>
      <div class="header_searchbar_fix">
        <?php include_once $_SERVER["DOCUMENT_ROOT"] . "/eduplanet/index/index_header_searchbar_out.php"; ?>
      </div>
    </header>

    <div class="follow_list_wrap">
      <div class="follow_list_background">

        <?php

        // 찜목록 test ============================================================
        // $star = "시설 만족 순";

        //페이지 수 체크한다.
        if (isset($_GET["page"])) {
          $page = $_GET["page"];
        } else {
          $page = 1;
        }
        // 지역 선택 체크
        if (isset($_GET["district"])) {
          $selectDis = $_GET["district"]; //옵션 선택에 따라서 옵션내용 변경 , 타이틀 변경
          echo "
                    <script>
                      function setSelectDis() {
                        document.getElementById('follow_list_select_district').value = '$selectDis';
                        document.getElementById('view_all_title').innerHTML = '($selectDis)';

                      }
                    </script>
                  ";
        } else {
          $selectDis = "";
          echo "
                    <script>
                      function setSelectDis() {

                      }
                    </script>
                  ";
        }
        $sort = "학원 리스트";
        // 정렬방법 선택 체크
        if (isset($_GET["sort"])) {

          $selectSort = $_GET["sort"];
          if ($selectSort === "star_max") {
            $sort = "학원 총 만족도 순";
          } else if ($selectSort === "facility_max") {
            $sort = "시설 만족도 순";
          } else if ($selectSort === "acsbl_max") {
            $sort = "교통 편의성 순";
          } else if ($selectSort === "teacher_max") {
            $sort = "강사 만족도 순";
          } else if ($selectSort === "cost_efct_max") {
            $sort = "수강료 만족도 순";
          } else if ($selectSort === "achievement_max") {
            $sort = "학업 성취도 순";
          }

          echo "
                    <script>
                      function setSelectSort() {

                        document.getElementById('view_all_review').innerHTML = '$sort';
                        document.getElementById('follow_list_select_mode').value = '$selectSort';
                      }
                    </script>
                  ";
        } else {
          $selectSort = "";
          echo "
                    <script>
                      function setSelectSort() {

                      }
                    </script>
                  ";
        }

        //view_all 에서 전체보기 눌렀을때 그 순으로 나오게하기 위한
        if (isset($_GET["category"])) {
          $category = $_GET["category"];
        } else {
          $category = "";
        }
        if (isset($_GET["search"])) {
          $search = $_GET["search"];
        } else {
          $search = "";
        }


        include_once "../lib/db_connector.php";
        // $sql = "select academy.no,academy.acd_name,academy.file_copy,avg(review.total_star),acd_story.parent from academy join review on academy.no = review.parent join acd_story on review.parent = acd_story.parent group by review.parent";

        //검색어 있을때
        if ($search != "") {

          //지역 옵션이 선택되어 있을 때
          if ($selectDis != "" && $selectDis != "전체") {
            //총 만족도 순
            if ($selectSort == "star_max") {
              echo "
                      <script>
                      console.log('$selectDis');
                      </script>
                    ";

              $sql = " SELECT
                              academy.no,
                              academy.acd_name,
                              academy.address,
                              academy.file_copy,
                              review.parent,
                              total_star,
                              str_cnt,
                              rv_cnt
                          FROM
                              academy
                                  LEFT JOIN
                              (SELECT
                                  parent, AVG(total_star) AS total_star, COUNT(*) AS rv_cnt
                              FROM
                                  review
                              GROUP BY parent) review ON academy.no = review.parent
                                  LEFT JOIN
                              (SELECT
                                  parent, COUNT(*) AS str_cnt
                              FROM
                                  acd_story
                              GROUP BY parent) acd_story ON academy.no = acd_story.parent
                          WHERE
                              academy.si_name = '$selectDis'
                                  AND (academy.acd_name LIKE '%$search%'
                                  OR academy.class LIKE '%$search%')
                          GROUP BY academy.no
                          ORDER BY review.total_star DESC";
            } else if ($selectSort == "bace_max") {
              $sql = "SELECT
                                  academy.no,
                                  academy.acd_name,
                                  academy.address,
                                  academy.file_copy,
                                  review.parent,
                                  total_star,
                                  str_cnt,
                                  rv_cnt
                              FROM
                                  academy
                                    left  JOIN
                                  (SELECT parent, AVG(total_star) as total_star, COUNT(*)as rv_cnt FROM review group by parent) review ON academy.no = review.parent
                                    left JOIN
                                  (SELECT parent, COUNT(*)as str_cnt FROM acd_story group by parent) acd_story ON academy.no = acd_story.parent where academy.si_name = '$selectDis' and (academy.acd_name like '%$search%' or academy.class like '%$search%')
                              GROUP BY academy.no";

              // 시설 만족도 순
            } else if ($selectSort == "facility_max") {

              $sql = "SELECT
                              	academy.no,
                              	academy.acd_name,
                              	academy.address,
                              	academy.file_copy,
                                review.parent,
                                  facility,
                              	total_star,
                              	str_cnt,
                              	rv_cnt
                              FROM
                              	academy
                              	  left  JOIN
                              	(SELECT parent, AVG(facility) as total_star, COUNT(*)as rv_cnt,avg(facility) as facility FROM review group by parent) review ON academy.no = review.parent
                              	  left JOIN
                              	(SELECT parent, COUNT(*)as str_cnt FROM acd_story group by parent) acd_story ON academy.no = acd_story.parent where academy.si_name = '$selectDis' and (academy.acd_name like '%$search%' or academy.class like '%$search%')
                              GROUP BY academy.no order by review.facility desc";
              //교통 편의성 순
            } else if ($selectSort == "acsbl_max") {
              $sql = "SELECT
                              	academy.no,
                              	academy.acd_name,
                              	academy.address,
                              	academy.file_copy,
                                review.parent,
                                  acsbl,
                              	total_star,
                              	str_cnt,
                              	rv_cnt
                              FROM
                              	academy
                              	  left  JOIN
                              	(SELECT parent, AVG(acsbl) as total_star, COUNT(*)as rv_cnt,avg(acsbl) as acsbl FROM review group by parent) review ON academy.no = review.parent
                              	  left JOIN
                              	(SELECT parent, COUNT(*)as str_cnt FROM acd_story group by parent) acd_story ON academy.no = acd_story.parent where academy.si_name = '$selectDis' and (academy.acd_name like '%$search%' or academy.class like '%$search%')
                              GROUP BY academy.no order by review.acsbl desc";
              //강사 만족도 순
            } else if ($selectSort == "teacher_max") {
              $sql = "SELECT
                              	academy.no,
                              	academy.acd_name,
                              	academy.address,
                              	academy.file_copy,
                                review.parent,
                                  teacher,
                              	total_star,
                              	str_cnt,
                              	rv_cnt
                              FROM
                              	academy
                              	  left  JOIN
                              	(SELECT parent, AVG(teacher) as total_star, COUNT(*)as rv_cnt,avg(teacher) as teacher FROM review group by parent) review ON academy.no = review.parent
                              	  left JOIN
                              	(SELECT parent, COUNT(*)as str_cnt FROM acd_story group by parent) acd_story ON academy.no = acd_story.parent where academy.si_name = '$selectDis' and (academy.acd_name like '%$search%' or academy.class like '%$search%')
                              GROUP BY academy.no order by review.teacher desc";
              //수강료 만족도 순
            } else if ($selectSort == "cost_efct_max") {
              $sql = "SELECT
                              	academy.no,
                              	academy.acd_name,
                              	academy.address,
                              	academy.file_copy,
                                review.parent,
                                  cost_efct,
                              	total_star,
                              	str_cnt,
                              	rv_cnt
                              FROM
                              	academy
                              	  left  JOIN
                              	(SELECT parent, AVG(cost_efct) as total_star, COUNT(*)as rv_cnt,avg(cost_efct) as cost_efct FROM review group by parent) review ON academy.no = review.parent
                              	  left JOIN
                              	(SELECT parent, COUNT(*)as str_cnt FROM acd_story group by parent) acd_story ON academy.no = acd_story.parent where academy.si_name = '$selectDis' and (academy.acd_name like '%$search%' or academy.class like '%$search%')
                              GROUP BY academy.no order by review.cost_efct desc;";
            } else if ($selectSort == "achievement_max") {
              $sql = "SELECT
                              	academy.no,
                              	academy.acd_name,
                              	academy.address,
                              	academy.file_copy,
                                review.parent,
                                  achievement,
                              	total_star,
                              	str_cnt,
                              	rv_cnt
                              FROM
                              	academy
                              	  left  JOIN
                              	(SELECT parent, AVG(achievement) as total_star, COUNT(*)as rv_cnt,avg(achievement) as achievement FROM review group by parent) review ON academy.no = review.parent
                              	  left JOIN
                              	(SELECT parent, COUNT(*)as str_cnt FROM acd_story group by parent) acd_story ON academy.no = acd_story.parent where academy.si_name = '$selectDis' and (academy.acd_name like '%$search%' or academy.class like '%$search%')
                              GROUP BY academy.no order by review.achievement desc";
            }
            //기본 셋팅은 no 순서대로
            else {
              $sql = "SELECT
                                academy.no,
                                academy.acd_name,
                                academy.address,
                                academy.file_copy,
                                review.parent,
                                total_star,
                                str_cnt,
                                rv_cnt
                            FROM
                                academy
                                  left  JOIN
                                (SELECT parent, AVG(total_star) as total_star, COUNT(*)as rv_cnt FROM review group by parent) review ON academy.no = review.parent
                                  left JOIN
                                (SELECT parent, COUNT(*)as str_cnt FROM acd_story group by parent) acd_story ON academy.no = acd_story.parent where academy.si_name = '$selectDis' and (academy.acd_name like '%$search%' or academy.class like '%$search%')
                            GROUP BY academy.no";
            }

            //지역 옵션이 선택되지 않았을 때
          } else if ($selectDis == "" || $selectDis == "전체") {
            if ($selectSort == "star_max") {
              $sql = "SELECT
                              	academy.no,
                              	academy.acd_name,
                              	academy.address,
                              	academy.file_copy,
                                review.parent,
                              	total_star,
                              	str_cnt,
                              	rv_cnt
                              FROM
                              	academy
                              	  left  JOIN
                              	(SELECT parent, AVG(total_star) as total_star, COUNT(*)as rv_cnt FROM review group by parent) review ON academy.no = review.parent
                              	  left JOIN
                              	(SELECT parent, COUNT(*)as str_cnt FROM acd_story group by parent) acd_story ON academy.no = acd_story.parent where academy.acd_name like '%$search%' or academy.class like '%$search%' GROUP BY academy.no order by review.total_star desc";
            } else if ($selectSort == "bace_max") {
              $sql = "SELECT
                                  academy.no,
                                  academy.acd_name,
                                  academy.address,
                                  academy.file_copy,
                                  review.parent,
                                  total_star,
                                  str_cnt,
                                  rv_cnt
                              FROM
                                  academy
                                    left  JOIN
                                  (SELECT parent, AVG(total_star) as total_star, COUNT(*)as rv_cnt FROM review group by parent) review ON academy.no = review.parent
                                    left JOIN
                                  (SELECT parent, COUNT(*)as str_cnt FROM acd_story group by parent) acd_story ON academy.no = acd_story.parent where academy.acd_name like '%$search%' or academy.class like '%$search%'
                              GROUP BY academy.no";

              // 시설 만족도 순
            } else if ($selectSort == "facility_max") {
              $sql = "SELECT
                              	academy.no,
                              	academy.acd_name,
                              	academy.address,
                              	academy.file_copy,
                                review.parent,
                                  facility,
                              	total_star,
                              	str_cnt,
                              	rv_cnt
                              FROM
                              	academy
                              	  left  JOIN
                              	(SELECT parent, AVG(facility) as total_star, COUNT(*)as rv_cnt,avg(facility) as facility FROM review group by parent) review ON academy.no = review.parent
                              	  left JOIN
                              	(SELECT parent, COUNT(*)as str_cnt FROM acd_story group by parent) acd_story ON academy.no = acd_story.parent where academy.acd_name like '%$search%' or academy.class like '%$search%' GROUP BY academy.no order by review.facility desc";
              //교통 편의성 순
            } else if ($selectSort == "acsbl_max") {
              $sql = "SELECT
                              	academy.no,
                              	academy.acd_name,
                              	academy.address,
                              	academy.file_copy,
                                review.parent,
                                  acsbl,
                              	total_star,
                              	str_cnt,
                              	rv_cnt
                              FROM
                              	academy
                              	  left  JOIN
                              	(SELECT parent, AVG(acsbl) as total_star, COUNT(*)as rv_cnt,avg(acsbl) as acsbl FROM review group by parent) review ON academy.no = review.parent
                              	  left JOIN
                              	(SELECT parent, COUNT(*)as str_cnt FROM acd_story group by parent) acd_story ON academy.no = acd_story.parent where academy.acd_name like '%$search%' or academy.class like '%$search%' GROUP BY academy.no order by review.acsbl desc";
              //강사 만족도 순
            } else if ($selectSort == "teacher_max") {
              $sql = "SELECT
                              	academy.no,
                              	academy.acd_name,
                              	academy.address,
                              	academy.file_copy,
                                review.parent,
                                  teacher,
                              	total_star,
                              	str_cnt,
                              	rv_cnt
                              FROM
                              	academy
                              	  left  JOIN
                              	(SELECT parent, AVG(teacher) as total_star, COUNT(*)as rv_cnt,avg(teacher) as teacher FROM review group by parent) review ON academy.no = review.parent
                              	  left JOIN
                              	(SELECT parent, COUNT(*)as str_cnt FROM acd_story group by parent) acd_story ON academy.no = acd_story.parent where academy.acd_name like '%$search%' or academy.class like '%$search%' GROUP BY academy.no order by review.teacher desc";
              //수강료 만족도 순
            } else if ($selectSort == "cost_efct_max") {
              $sql = "SELECT
                              	academy.no,
                              	academy.acd_name,
                              	academy.address,
                              	academy.file_copy,
                                review.parent,
                                  cost_efct,
                              	total_star,
                              	str_cnt,
                              	rv_cnt
                              FROM
                              	academy
                              	  left  JOIN
                              	(SELECT parent, AVG(cost_efct) as total_star, COUNT(*)as rv_cnt,avg(cost_efct) as cost_efct FROM review group by parent) review ON academy.no = review.parent
                              	  left JOIN
                              	(SELECT parent, COUNT(*)as str_cnt FROM acd_story group by parent) acd_story ON academy.no = acd_story.parent where academy.acd_name like '%$search%' or academy.class like '%$search%' GROUP BY academy.no order by review.cost_efct desc;";

              //학업 성취도 순
            } else if ($selectSort == "achievement_max") {
              $sql = "SELECT
                              	academy.no,
                              	academy.acd_name,
                              	academy.address,
                              	academy.file_copy,
                                review.parent,
                                  achievement,
                              	total_star,
                              	str_cnt,
                              	rv_cnt
                              FROM
                              	academy
                              	  left  JOIN
                              	(SELECT parent, AVG(achievement) as total_star, COUNT(*)as rv_cnt,avg(achievement) as achievement FROM review group by parent) review ON academy.no = review.parent
                              	  left JOIN
                              	(SELECT parent, COUNT(*)as str_cnt FROM acd_story group by parent) acd_story ON academy.no = acd_story.parent where academy.acd_name like '%$search%' or academy.class like '%$search%' GROUP BY academy.no order by review.achievement desc";
            }
            //기본 셋팅은 no 순서대로
            else {
              $sql = "SELECT
                                academy.no,
                                academy.acd_name,
                                academy.address,
                                academy.file_copy,
                                review.parent,
                                total_star,
                                str_cnt,
                                rv_cnt
                            FROM
                                academy
                                  left  JOIN
                                (SELECT parent, AVG(total_star) as total_star, COUNT(*)as rv_cnt FROM review group by parent) review ON academy.no = review.parent
                                  left JOIN
                                (SELECT parent, COUNT(*)as str_cnt FROM acd_story group by parent) acd_story ON academy.no = acd_story.parent where academy.acd_name like '%$search%' or academy.class like '%$search%'
                            GROUP BY academy.no";
            }
          }
          // else if($selectDis = "" & $selectSort = ""){
          //   $sql = "SELECT
          //               academy.no,
          //               academy.acd_name,
          //               academy.address,
          //               academy.file_copy,
          //               review.parent,
          //               total_star,
          //               str_cnt,
          //               rv_cnt
          //           FROM
          //               academy
          //                 left  JOIN
          //               (SELECT parent, AVG(total_star) as total_star, COUNT(*)as rv_cnt FROM review group by parent) review ON academy.no = review.parent
          //                 left JOIN
          //               (SELECT parent, COUNT(*)as str_cnt FROM acd_story group by parent) acd_story ON academy.no = acd_story.parent where academy.si_name = '$selectDis' and academy.acd_name like '%$search%' or academy.class like '%$search%'
          //           GROUP BY academy.no";
          // }

          //검색어 없을때===============================
        } else if ($search == "") {

          //지역 옵션이 선택되어 있을 때
          if ($selectDis != "" && $selectDis != "전체") {
            //총 만족도 순
            if ($selectSort == "star_max") {

              $sql = "SELECT
                                academy.no,
                                academy.acd_name,
                                academy.address,
                                academy.file_copy,
                                review.parent,
                                total_star,
                                str_cnt,
                                rv_cnt
                              FROM
                                academy
                                  left  JOIN
                                (SELECT parent, AVG(total_star) as total_star, COUNT(*)as rv_cnt FROM review group by parent) review ON academy.no = review.parent
                                  left JOIN
                                (SELECT parent, COUNT(*)as str_cnt FROM acd_story group by parent) acd_story ON academy.no = acd_story.parent where academy.si_name = '$selectDis'
                              GROUP BY academy.no order by review.total_star desc";
            } else if ($selectSort == "bace_max") {
              $sql = "SELECT
                                  academy.no,
                                  academy.acd_name,
                                  academy.address,
                                  academy.file_copy,
                                  review.parent,
                                  total_star,
                                  str_cnt,
                                  rv_cnt
                              FROM
                                  academy
                                    left  JOIN
                                  (SELECT parent, AVG(total_star) as total_star, COUNT(*)as rv_cnt FROM review group by parent) review ON academy.no = review.parent
                                    left JOIN
                                  (SELECT parent, COUNT(*)as str_cnt FROM acd_story group by parent) acd_story ON academy.no = acd_story.parent where academy.si_name = '$selectDis'
                              GROUP BY academy.no";

              // 시설 만족도 순
            } else if ($selectSort == "facility_max") {

              $sql = "SELECT
                                academy.no,
                                academy.acd_name,
                                academy.address,
                                academy.file_copy,
                                review.parent,
                                  facility,
                                total_star,
                                str_cnt,
                                rv_cnt
                              FROM
                                academy
                                  left  JOIN
                                (SELECT parent, AVG(facility) as total_star, COUNT(*)as rv_cnt,avg(facility) as facility FROM review group by parent) review ON academy.no = review.parent
                                  left JOIN
                                (SELECT parent, COUNT(*)as str_cnt FROM acd_story group by parent) acd_story ON academy.no = acd_story.parent where academy.si_name = '$selectDis'
                              GROUP BY academy.no order by review.facility desc";
              //교통 편의성 순
            } else if ($selectSort == "acsbl_max") {
              $sql = "SELECT
                                academy.no,
                                academy.acd_name,
                                academy.address,
                                academy.file_copy,
                                review.parent,
                                  acsbl,
                                total_star,
                                str_cnt,
                                rv_cnt
                              FROM
                                academy
                                  left  JOIN
                                (SELECT parent, AVG(acsbl) as total_star, COUNT(*)as rv_cnt,avg(acsbl) as acsbl FROM review group by parent) review ON academy.no = review.parent
                                  left JOIN
                                (SELECT parent, COUNT(*)as str_cnt FROM acd_story group by parent) acd_story ON academy.no = acd_story.parent where academy.si_name = '$selectDis'
                              GROUP BY academy.no order by review.acsbl desc";
              //강사 만족도 순
            } else if ($selectSort == "teacher_max") {
              $sql = "SELECT
                                academy.no,
                                academy.acd_name,
                                academy.address,
                                academy.file_copy,
                                review.parent,
                                  teacher,
                                total_star,
                                str_cnt,
                                rv_cnt
                              FROM
                                academy
                                  left  JOIN
                                (SELECT parent, AVG(teacher) as total_star, COUNT(*)as rv_cnt,avg(teacher) as teacher FROM review group by parent) review ON academy.no = review.parent
                                  left JOIN
                                (SELECT parent, COUNT(*)as str_cnt FROM acd_story group by parent) acd_story ON academy.no = acd_story.parent where academy.si_name = '$selectDis'
                              GROUP BY academy.no order by review.teacher desc";
              //수강료 만족도 순
            } else if ($selectSort == "cost_efct_max") {
              $sql = "SELECT
                                academy.no,
                                academy.acd_name,
                                academy.address,
                                academy.file_copy,
                                review.parent,
                                  cost_efct,
                                total_star,
                                str_cnt,
                                rv_cnt
                              FROM
                                academy
                                  left  JOIN
                                (SELECT parent, AVG(cost_efct) as total_star, COUNT(*)as rv_cnt,avg(cost_efct) as cost_efct FROM review group by parent) review ON academy.no = review.parent
                                  left JOIN
                                (SELECT parent, COUNT(*)as str_cnt FROM acd_story group by parent) acd_story ON academy.no = acd_story.parent where academy.si_name = '$selectDis'
                              GROUP BY academy.no order by review.cost_efct desc;";
              //학업 성취도 순
            } else if ($selectSort == "achievement_max") {
              $sql = "SELECT
                                academy.no,
                                academy.acd_name,
                                academy.address,
                                academy.file_copy,
                                review.parent,
                                  achievement,
                                total_star,
                                str_cnt,
                                rv_cnt
                              FROM
                                academy
                                  left  JOIN
                                (SELECT parent, AVG(achievement) as total_star, COUNT(*)as rv_cnt,avg(achievement) as achievement FROM review group by parent) review ON academy.no = review.parent
                                  left JOIN
                                (SELECT parent, COUNT(*)as str_cnt FROM acd_story group by parent) acd_story ON academy.no = acd_story.parent where academy.si_name = '$selectDis'
                              GROUP BY academy.no order by review.achievement desc";
            }
            //기본 셋팅은 no 순서대로
            else {
              $sql = "SELECT
                                academy.no,
                                academy.acd_name,
                                academy.address,
                                academy.file_copy,
                                review.parent,
                                total_star,
                                str_cnt,
                                rv_cnt
                            FROM
                                academy
                                  left  JOIN
                                (SELECT parent, AVG(total_star) as total_star, COUNT(*)as rv_cnt FROM review group by parent) review ON academy.no = review.parent
                                  left JOIN
                                (SELECT parent, COUNT(*)as str_cnt FROM acd_story group by parent) acd_story ON academy.no = acd_story.parent where academy.si_name = '$selectDis'
                            GROUP BY academy.no";
            }

            //지역 옵션이 선택되지 않았을 때
          } else if ($selectDis == "" || $selectDis == "전체") {
            if ($selectSort == "star_max") {
              $sql = "SELECT
                                academy.no,
                                academy.acd_name,
                                academy.address,
                                academy.file_copy,
                                review.parent,
                                total_star,
                                str_cnt,
                                rv_cnt
                              FROM
                                academy
                                  left  JOIN
                                (SELECT parent, AVG(total_star) as total_star, COUNT(*)as rv_cnt FROM review group by parent) review ON academy.no = review.parent
                                  left JOIN
                                (SELECT parent, COUNT(*)as str_cnt FROM acd_story group by parent) acd_story ON academy.no = acd_story.parent GROUP BY academy.no order by review.total_star desc";
            } else if ($selectSort == "bace_max") {
              $sql = "SELECT
                                  academy.no,
                                  academy.acd_name,
                                  academy.address,
                                  academy.file_copy,
                                  review.parent,
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

              // 시설 만족도 순
            } else if ($selectSort == "facility_max") {
              $sql = "SELECT
                                academy.no,
                                academy.acd_name,
                                academy.address,
                                academy.file_copy,
                                review.parent,
                                  facility,
                                total_star,
                                str_cnt,
                                rv_cnt
                              FROM
                                academy
                                  left  JOIN
                                (SELECT parent, AVG(facility) as total_star, COUNT(*)as rv_cnt,avg(facility) as facility FROM review group by parent) review ON academy.no = review.parent
                                  left JOIN
                                (SELECT parent, COUNT(*)as str_cnt FROM acd_story group by parent) acd_story ON academy.no = acd_story.parent GROUP BY academy.no order by review.facility desc";
              //교통 편의성 순
            } else if ($selectSort == "acsbl_max") {
              $sql = "SELECT
                                academy.no,
                                academy.acd_name,
                                academy.address,
                                academy.file_copy,
                                review.parent,
                                  acsbl,
                                total_star,
                                str_cnt,
                                rv_cnt
                              FROM
                                academy
                                  left  JOIN
                                (SELECT parent, AVG(acsbl) as total_star, COUNT(*)as rv_cnt,avg(acsbl) as acsbl FROM review group by parent) review ON academy.no = review.parent
                                  left JOIN
                                (SELECT parent, COUNT(*)as str_cnt FROM acd_story group by parent) acd_story ON academy.no = acd_story.parent GROUP BY academy.no order by review.acsbl desc";
              //강사 만족도 순
            } else if ($selectSort == "teacher_max") {
              $sql = "SELECT
                                academy.no,
                                academy.acd_name,
                                academy.address,
                                academy.file_copy,
                                review.parent,
                                  teacher,
                                total_star,
                                str_cnt,
                                rv_cnt
                              FROM
                                academy
                                  left  JOIN
                                (SELECT parent, AVG(teacher) as total_star, COUNT(*)as rv_cnt,avg(teacher) as teacher FROM review group by parent) review ON academy.no = review.parent
                                  left JOIN
                                (SELECT parent, COUNT(*)as str_cnt FROM acd_story group by parent) acd_story ON academy.no = acd_story.parent GROUP BY academy.no order by review.teacher desc";
              //수강료 만족도 순
            } else if ($selectSort == "cost_efct_max") {
              $sql = "SELECT
                                academy.no,
                                academy.acd_name,
                                academy.address,
                                academy.file_copy,
                                review.parent,
                                  cost_efct,
                                total_star,
                                str_cnt,
                                rv_cnt
                              FROM
                                academy
                                  left  JOIN
                                (SELECT parent, AVG(cost_efct) as total_star, COUNT(*)as rv_cnt,avg(cost_efct) as cost_efct FROM review group by parent) review ON academy.no = review.parent
                                  left JOIN
                                (SELECT parent, COUNT(*)as str_cnt FROM acd_story group by parent) acd_story ON academy.no = acd_story.parent GROUP BY academy.no order by review.cost_efct desc;";
              //학업 성취도순
            } else if ($selectSort == "achievement_max") {
              $sql = "SELECT
                                academy.no,
                                academy.acd_name,
                                academy.address,
                                academy.file_copy,
                                review.parent,
                                  achievement,
                                total_star,
                                str_cnt,
                                rv_cnt
                              FROM
                                academy
                                  left  JOIN
                                (SELECT parent, AVG(achievement) as total_star, COUNT(*)as rv_cnt,avg(achievement) as achievement FROM review group by parent) review ON academy.no = review.parent
                                  left JOIN
                                (SELECT parent, COUNT(*)as str_cnt FROM acd_story group by parent) acd_story ON academy.no = acd_story.parent GROUP BY academy.no order by review.achievement desc";
            }
            //기본 셋팅은 no 순서대로
            else {
              $sql = "SELECT
                                academy.no,
                                academy.acd_name,
                                academy.address,
                                academy.file_copy,
                                review.parent,
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
            }
          }
        }

        $result = mysqli_query($conn, $sql);
        $total_record = mysqli_num_rows($result);

        ?>

        <!-- select box -------------------------------------------------------------------------------------->
        <div class="follow_list_select">

          <h2>
            <!-- 검색 학원 정렬 -->
            <span id="view_all_search"></span>
            <span id="view_all_review">학원 리스트 (전체)</span>
            <span id="view_all_title"></span>
          </h2>

          <span id="follow_total_span">총 <span id="follow_total_num"><?= $total_record ?></span> 개의 학원이 있습니다.</span>

          <div class="follow_select">
            <select name="follow_list_select_district" id="follow_list_select_district" onchange="selectOption();">
              <option value="전체" selected>시/군 선택</option>
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

            </select>

            <select name="follow_list_select_mode" id="follow_list_select_mode" onchange="selectOption();">
              <option value="bace_max" selected>정렬/순서 선택</option>
              <option value="star_max">총 만족도 순</option>
              <option value="facility_max">시설 만족도 순</option>
              <option value="acsbl_max">교통 편의성 순</option>
              <option value="teacher_max">강사 만족도 순</option>
              <option value="cost_efct_max">수강료 만족 순</option>
              <option value="achievement_max">학업성취도 순</option>
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
            $parent = $row["parent"];
            $file_copy = $row["file_copy"]; //학원로고
            $total_star = $row["total_star"]; //평점
            $review_count = $row["rv_cnt"]; // 리뷰 수
            $story_count = $row["str_cnt"]; //스토리 수

            $total_star = sprintf('%0.1f', $total_star);


            if ($category == "ctg_star") {
              $category = "총 만족도";
            }
            if ($category == "ctg_facility") {
              $category = "시설 만족도";
            }
            if ($category == "ctg_acsbl") {
              $category = "교통 편의성";
            }
            if ($category == "ctg_acsbl") {
              $category = "강사 만족도";
            }
            if ($category == "ctg_cost_efct") {
              $category = "수강료 만족도";
            }
            if ($category == "ctg_achievement") {
              $category = "학업 성취도";
            }
            if ($category == "ctg_all") {
              $category = "총 만족도";
            }

          ?>

            <li>
              <!-- 하나의 학원목록 -->
              <div class="follow_list_column">

                <!-- 왼쪽 학원 로고 및 정보  -->
                <!-- 클릭 시 href=학원페이지                           parent=<?= $parent ?>&acd_name=<?= $acd_name ?>     -->
                <a href="/eduplanet/academy/index.php?no=<?= $no ?>">
                <div class="follow_list_column_img">
                    <?php
                      if($file_copy==""){

                        ?>
                        <img src="/eduplanet/img/acd_logo2.png" alt="academy_list_column_img">
                        <?php
                      }else{
                      ?>
                        <img src="/eduplanet/data/acd_logo/<?= $file_copy ?>" alt="academy_list_column_img">
                      <?php
                      }
                        ?>
                </div>

                  <div class="follow_list_column_text">
                    <h1 id="follow_text_academy"><?= $acd_name ?>
                </a>

                </h1>
                <p id="follow_text_district"><?= $address ?></p>

                <div class="follow_list_column_review">
                  <a href="/eduplanet/academy/review.php?no=<?= $no ?>"><span id="academy_review_span">학원리뷰 <span id="academy_review_num"><?= $review_count ?></span></span></a>
                  <a href="/eduplanet/academy/acd_story.php?no=<?= $no ?>"><span id="academy_review_span">스토리 <span id="academy_review_num"><?= $story_count ?></span></span></a>

                </div>
              </div>

              <!-- 오른쪽 별점 & 삭제버튼 -->
              <div class="follow_list_column_sub">

                <div class="follow_academy_heart">
                  <span>학원 찜하기</span>
                  <?php
                  if ($gm_no) {


                    $sql7 = "select * from follow where user_no = $gm_no and acd_no = $no ";
                    $result7 = mysqli_query($conn, $sql7);
                    $row7 = mysqli_fetch_array($result7);

                    var_dump($parent);

                    if ($row7) {
                      echo "
                                              <a href='/eduplanet/acd_story/unfollow.php?no=$parent'><button type='button' id='button_academy_heart_on'>like</button></a>
                                            ";
                    } else {
                      echo "
                                              <a href='/eduplanet/acd_story/follow.php?no=$parent'><button type='button' id='button_academy_heart_off'>like</button></a>
                                              ";
                    }

                  ?>

                  <?php
                  } else {
                  ?>


                    <a href="javascript:alert('일반회원만 이용 가능합니다.')"><button type="button" id="button_academy_heart_off">like</button></a>

                  <?php
                  }
                  ?>
                </div>

                <div class="follow_academy_star_wrap">

                  <div class="follow_academy_star">
                    <?php
                    // 총 만족도 평균에 따라 별 보여주기
                    for ($j = 1; $j <= 5; $j++) {

                      if ($j <= round($total_star)) {
                        echo "<img class='acd_star_class' src='/eduplanet/img/yellow_star.png' alt='follow_academy_star'>";
                      } else {
                        echo "<img class='acd_star_class' src='/eduplanet/img/yellow_star_empty.png' alt='follow_academy_star'>";
                      }
                    }
                    ?>
                  </div>

                  <span class="follow_academy_star_num"><?= $total_star ?></span>
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

          $url = '/eduplanet/acd_list/view_all.php?';

          if (isset($_GET["sort"])) {
            $url .= "&sort=$selectSort";
          }
          if (isset($_GET["district"])) {
            $url .= "&district=$selectDis";
          }
          if (isset($_GET["search"])) {
            $url .= "&search=$search";
          }

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
          $first_page = $last_page - ($page_scale - 1);

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

          // $url = "/eduplanet/acd_list/view_all.php?"; 바꾸기 귀찮으니까 써라 나중에
          // 첫번째 페이지일 때 앵커 비활성화
          if ($first_page == 1) {

            if ($page != 1) {
              echo "<li><a href='$url&page=1'><span class='page_num_direction'><i class='fas fa-angle-double-left'></i></span></a></li>";
            } else {
              echo "<li><a><span class='page_num_direction'><i class='fas fa-angle-double-left'></i></span></a></li>";
            }

            echo "<li><a><span class='page_num_direction'><i class='fas fa-angle-left'></i></span></a></li>";
          } else {
            echo "<li><a href='$url&page=1'><span class='page_num_direction'><i class='fas fa-angle-double-left'></i></span></a></li>";
            echo "<li><a href='$url&page=$prev'><span class='page_num_direction'><i class='fas fa-angle-left'></i></span></a></li>";
          }

          //페이지 번호 매기기
          for ($i = $first_page; $i <= $last_page; $i++) {

            if ($page == $i) {
              echo "<li><span class='page_num_set'><b style='color:#2E89FF'> $i </b></span></li>";
            } else {
              echo "<li><a href='$url&page=$i'><span class='page_num_set'> &nbsp$i&nbsp </span></a></li>";
            }
          }

          // 마지막 페이지일 때 앵커 비활성화
          if ($last_page == $total_page) {
            echo "<li><a><span class='page_num_direction'><i class='fas fa-angle-right'></i></span></a></li>";

            if ($page != $total_page) {
              echo "<li><a href='$url&page=$total_page'><span class='page_num_direction_last'><i class='fas fa-angle-double-right'></i></span></a></li>";
            } else {
              echo "<li><a><span class='page_num_direction_last'><i class='fas fa-angle-double-right'></i></span></a></li>";
            }
          } else {
            echo "<li><a href='$url&?page=$next'><span class='page_num_direction'><i class='fas fa-angle-right'></i></span></a></li>";
            echo "<li><a href='$url&page=$total_page'><span class='page_num_direction_last'><i class='fas fa-angle-double-right'></i></span></a></li>";
          }
          ?>
        </ul>
      </div>
    </div>
    <!-- end of page_num_wrap -------------------------------------------------------->

    </div>
  </div>





  <footer>
    <?php include_once $_SERVER["DOCUMENT_ROOT"] . "/eduplanet/index/footer.php"; ?>
  </footer>


  </div>

</body>

</html>