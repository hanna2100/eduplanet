<?php

include $_SERVER['DOCUMENT_ROOT'] . "/eduplanet/lib/session_start.php";

if ($admin== "" ){
  echo("
      <script>
      alert('관리자 전용 페이지 입니다.');
      history.go(-1)
      </script>
  ");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- favicon -->
  <link rel="shortcut icon" href="/eduplanet/img/favicon.png">
  <!-- jquery -->
  <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="/eduplanet/admin/js/admin.js"></script>
  <script src="/eduplanet/admin/js/rvnSttst.js"></script>
  <!-- css -->
  <link rel="stylesheet" href="/eduplanet/admin/css/rvnSttst.css">
  <link rel="stylesheet" href="/eduplanet/admin/css/nav.css">
  <!-- 폰트 -->
  <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR&amp;display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Do+Hyeon|Jua|Montserrat&display=swap" rel="stylesheet">
  <!-- 아이콘 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css">
  <!-- 차트 -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
  <title>에듀플래닛 관리자페이지 - 수익관리</title>
  <!-- Date 라이브러리 -->
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery.min.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
</head>
<body>
<main>
<?php
  include_once 'nav.php';
  include_once '../lib/db_connector.php';

  $y = isset($_GET["y"])? $_GET["y"]: date("Y") ;
  $m = isset($_GET["m"])? $_GET["m"]: date("n") ;
  $page = isset($_GET["page"])? $_GET["page"]: 1 ;
  $col = isset($_GET["col"])? $_GET["col"]: '' ;
  $search = isset($_GET["search"])? $_GET["search"]: '' ;

?>
<!-- php 변수를 자바스크립트로 넘겨줌 -->
<script>
  var y = <?=$y?>;
  var m = <?=$m?>;
  var page = "<?=$page?>";
  var col = "<?=$col?>";
  var search = "<?=$search?>";
</script>

<section>
  <div class="sec_top">
    <span onclick="prevDateChange('rvnSttst')"><i class="fas fa-angle-left"></i></span>
    <select id="top_select_year" dir="rtl" onchange="topSelect_init_Setting('rvnSttst')">
<?php
    for($i = 2018; $i<=date("Y"); $i++){
      echo "<option>$i</option>";
    }
?>
    </select>
    <span>년 </span>
    <select id="top_select_month" dir="rtl" onchange="hrefDateChange('rvnSttst')">
<?php
    $last_m = $y==date("Y")? date("n"): 12;
    for($i = 1; $i<=$last_m ; $i++){
      echo "<option>$i</option>";
    }
?>
    </select>
    <span>월 </span>
    <span onclick="nextDateChange('rvnSttst')"><i class="fas fa-angle-right"></i></span>
  </div>
  <!--end of 년 월 선택바 -->

<?php
  $m2 = $m <10? "0".$m : $m;

  //매출데이터 가져오기
  $sql_arr = array();
  array_push($sql_arr,"CALL get_gm_sales($y, $y, $m2, $m2)" );
  array_push($sql_arr,"CALL get_am_sales($y, $y, $m2, $m2)" );

  $total_arr = array();
  $total_arr = execute_multi($conn, $sql_arr);

  $gm_sales = $total_arr[0]; //일반회원 일별 매출
  $am_sales = $total_arr[1]; //학원회원 일별 매출
  $total_sales = array(); //전체 일별 매출

  for($i=0; $i<sizeof($gm_sales); $i++){
    $day_sales = $gm_sales[$i] + $am_sales[$i];
    array_push($total_sales, $day_sales);

  }

  function execute_multi($conn, $sql_arr){
    $total_arr = array();
    $am_sales = array();
    $gm_sales = array();

    $sql = implode(';', $sql_arr) . ';';

    if (mysqli_multi_query($conn, $sql)) {

        $flag = false;
        do {
            if ($result = mysqli_store_result($conn)) {
                $total_record = mysqli_num_rows($result);
                while ($row = mysqli_fetch_row($result)) {
                  //row0번이 날짜, 1번이 매출
                  $data = $row[1];
                  $data = $data==NULL? 0: $data;

                  if($flag==false){
                      array_push($am_sales, $data);
                  }else{
                      array_push($gm_sales, $data);
                  }
                }
                mysqli_free_result($result);
                $flag = true;
            }
        } while (mysqli_next_result($conn));

        array_push($total_arr, $am_sales);
        array_push($total_arr, $gm_sales);
        return $total_arr;
    }
  }

  $sql = "SELECT
          COUNT(IF(prdct_name_month = '학원관리 1개월',
              1,
              NULL)) AS one,
          COUNT(IF(prdct_name_month = '학원관리 2개월',
              1,
              NULL)) AS two,
          COUNT(IF(prdct_name_month = '학원관리 3개월',
              1,
              NULL)) AS three
        FROM
          am_order
        WHERE
          date >= '$y-$m2-01' AND date <= LAST_DAY('$y-$m2-01')";

  $result = mysqli_query($conn, $sql);
  if($result){
    $row = mysqli_fetch_array($result);
    $am_prdct_one = $row['one'];
    $am_prdct_two = $row['two'];
    $am_prdct_thr = $row['three'];
  }else{
    $am_prdct_one = 0;
    $am_prdct_two = 0;
    $am_prdct_thr = 0;

  }


  $sql = "SELECT
          COUNT(IF(prdct_name_month = '프리미엄 1개월',
              1,
              NULL)) AS one,
          COUNT(IF(prdct_name_month = '프리미엄 2개월',
              1,
              NULL)) AS two,
          COUNT(IF(prdct_name_month = '프리미엄 3개월',
              1,
              NULL)) AS three
        FROM
          gm_order
        WHERE
          date >= '$y-$m2-01' AND date <= LAST_DAY('$y-$m2-01')";

  $result = mysqli_query($conn, $sql);
  if($result){
    $row = mysqli_fetch_array($result);
    $gm_prdct_one = $row['one'];
    $gm_prdct_two = $row['two'];
    $gm_prdct_thr = $row['three'];
  }else{
    $gm_prdct_one = 0;
    $gm_prdct_two = 0;
    $gm_prdct_thr = 0;
  }

  $sql = "SELECT sum(if(pay_method = '스마일페이',1,0)) smile, sum(if(pay_method = '카카오페이',1,0)) kakao, sum(if(pay_method = '페이코',1,0)) payco
        FROM (
        (SELECT pay_method FROM am_order WHERE
          date >= '$y-$m2-01' AND date <= LAST_DAY('$y-$m2-01'))
        union all
        (SELECT pay_method FROM gm_order WHERE
          date >= '$y-$m2-01' AND date <= LAST_DAY('$y-$m2-01'))
        )tbl";
  $result = mysqli_query($conn, $sql);
  if($result){
    $row = mysqli_fetch_array($result);
    $kakao = $row['kakao'];
    $smile = $row['smile'];
    $payco = $row['payco'];
  }else{
    $kakao = 0;
    $smile = 0;
    $payco = 0;
  }

?>
<script>

var gm_sales = <?= json_encode($gm_sales);?>;
var am_sales = <?= json_encode($am_sales);?>;

var am_prdct_one = <?=$am_prdct_one?>;
var am_prdct_two = <?=$am_prdct_two?>;
var am_prdct_thr = <?=$am_prdct_thr?>;

var gm_prdct_one = <?=$gm_prdct_one?>;
var gm_prdct_two = <?=$gm_prdct_two?>;
var gm_prdct_thr = <?=$gm_prdct_thr?>;

var kakao = <?=$kakao?>;
var smile = <?=$smile?>;
var payco = <?=$payco?>;

</script>

<!--end of 총 회원수 가져오기 -->
  <div class="sec_content">
    <div id="dash_topline">
      <div>
        <span>월 총 수익</span><br>
        <span class="dash_topline_i"><i class="fas fa-money-bill-wave"></i>&nbsp;<span id="total_rvn"><?=number_format(array_sum($total_sales))?></span></span>
        <span class="caret up"> </i></span>
      </div>
      <div>
        <span>일반회원 수익</span><br>
        <span class="dash_topline_i"><i class="fas fa-user"></i>&nbsp;<span id="gm_rvn"><?=number_format(array_sum($gm_sales))?></span></span>
        <span class="caret up"> </i></span>
      </div>
      <div>
        <span>사업자회원 수익</span><br>
        <span class="dash_topline_i"><i class="fas fa-user-tie"></i>&nbsp;<span id="am_rvn"><?=number_format(array_sum($am_sales))?></span></span>
        <span class="caret down"> </i></span>
      </div>
    </div>
    <!--end of 상단 수익 정보-->

    <div id="g_members_totalGraph_wrap">
      <div id="g_members_totalGraph_cell1">
        <h4><i class="fas fa-chart-line"></i>&nbsp;&nbsp;&nbsp;Sales Graph<span>단위: 만원</span></h4>
        <canvas id="g_members_totalGraph"></canvas>
        <div class="btn_hide">
          <button>숨기기</button>
        </div>
      </div>
    </div>
    <!-- end of 수익 변화 그래프 -->

    <div style="display:flex; width:960px; margin-bottom: 50px;">
      <div id="dash_pm_ratio_wrap">
        <h4><i class="fas fa-chart-line"></i>&nbsp;&nbsp;&nbsp;일반회원 구매품목</h4>
        <canvas id="dash_prcd1_ratio"></canvas>
      </div>
      <div id="dash_pm_ratio_wrap">
        <h4><i class="fas fa-chart-line"></i>&nbsp;&nbsp;&nbsp;사업자회원 구매품목</h4>
        <canvas id="dash_prcd2_ratio"></canvas>
      </div>
      <div id="dash_postGraph_wrap">
      <h4><i class="fas fa-chart-line"></i>&nbsp;&nbsp;&nbsp;주요 결제수단</h4>
        <canvas id="dash_method_ratio"></canvas>
      </div>
    </div>
    <!-- end of 그래프 3개 -->

    <div id="g_members_list_wrap">
      <div id="g_members_list">
        <h4>
          <i class="fas fa-chart-line"></i>&nbsp;&nbsp;&nbsp;Daily sales
        </h4>
        <ul id="member_list">
				<li>
					<span class="col1">날짜</span>
					<span class="col2">Prm-1</span>
					<span class="col3">Prm-2</span>
					<span class="col4">Prm-3</span>
					<span class="col5">Acd-1</span>
					<span class="col6">Acd-2</span>
					<span class="col7">Acd-3</span>
					<span class="col8">프리미엄 매출</span>
					<span class="col9">학원관리 매출</span>
					<span class="col10">총합</span>
				</li>
<?php
        $sql="SELECT
              a.date,
              SUM(IF(a.prdct_name_month = '프리미엄 1개월',
                  1,
                  NULL)) AS gm1,
              SUM(IF(a.prdct_name_month = '프리미엄 2개월',
                  1,
                  NULL)) AS gm2,
              SUM(IF(a.prdct_name_month = '프리미엄 3개월',
                  1,
                  NULL)) AS gm3,
              SUM(IF(a.prdct_name_month = '학원관리 1개월',
                  1,
                  NULL)) AS am1,
              SUM(IF(a.prdct_name_month = '학원관리 2개월',
                  1,
                  NULL)) AS am2,
              SUM(IF(a.prdct_name_month = '학원관리 3개월',
                  1,
                  NULL)) AS am3,
              SUM(IF(a.prdct_name_month LIKE '프리미엄%',
                  a.price,
                  NULL)) AS go_sales,
              SUM(IF(a.prdct_name_month LIKE '학원관리%',
                  a.price,
                  NULL)) AS ao_sales,
              SUM(a.price) AS total_sales
          FROM
              ((SELECT
                  gm_order.date, gm_order.prdct_name_month, gm_order.price
              FROM
                  gm_order) UNION ALL (SELECT
                  am_order.date, am_order.prdct_name_month, am_order.price
              FROM
                  am_order)) a
          WHERE
              a.date >= '$y-$m2-01'
                  AND a.date <= LAST_DAY('$y-$m2-01')
          GROUP BY a.date
          ORDER BY a.date DESC;
          ";

        $result = mysqli_query($conn, $sql);
        $total_record = mysqli_num_rows($result);

        $scale = 10; // 가져올 글 수

        // 전체 페이지 수($total_page) 계산
        if ($total_record % $scale == 0)
          $total_page = floor($total_record/$scale);
        else
          $total_page = floor($total_record/$scale)+1;

        // 표시할 페이지($page)에 따라 $truncated_num(한페이지에서 10개 리스트 보여지고 그 뒤 짤리는 넘버) 계산
        $truncated_num = ($page - 1) * $scale;
        $start_num = $total_record - $truncated_num;

        //게시판 맨 상단 번호
        $number = $total_record - $truncated_num;

        for ($i=$truncated_num; $i < $truncated_num+$scale && $i < $total_record; $i++){
          // 가져올 레코드로 위치(포인터) 이동
          mysqli_data_seek($result, $i);
          $row = mysqli_fetch_array($result);

          $date         = $row["date"];
          $gm1          = $row["gm1"];
          $gm2        = $row["gm2"];
          $gm3       = $row["gm3"];
          $am1       = $row["am1"];
          $am2       = $row["am2"];
          $am3       = $row["am3"];
          $go_sales  = $row["go_sales"];
          $ao_sales  = $row["ao_sales"];
          $total_sales  = $row["total_sales"];
?>
        <li class="list_row">
          <span class="col1"><?=$date?></span>
          <span class="col2"><?=$gm1?></span>
          <span class="col3"><?=$gm2?></span>
          <span class="col4"><?=$gm3?></span>
          <span class="col5"><?=$am1?></span>
          <span class="col6"><?=$am2?></span>
          <span class="col7"><?=$am3?></span>
          <span class="col8"><?=$go_sales?></span>
          <span class="col9"><?=$ao_sales?></span>
          <span class="col10"><?=$total_sales?></span>
        </li>

<?php
   	    $number--;
      }
      mysqli_close($conn);
?>
      </ul>
      <!-- end of ul 회원리스트 -->

      <div class="page_num_wrap">
        <div class="page_num">
          <ul class="page_num_ul">
<?php
            $page_scale = 5; // 페이지 쪽수 표시 량 (5 페이지씩 표기)
            $pageGroup = ceil($page/$page_scale); // 페이지 그룹번호(페이지 5개가 1그룹)

            $last_page = $pageGroup * $page_scale; //그룹번호 안에서의 마지막 페이지 숫자
            //그룹번호의 마지막 페이지는 전체 페이지보다 클 수 없음
            if($total_page < $page_scale){
              $last_page = $total_page;
            }else if($last_page > $total_page){
              $last_page = $total_page;
            }

            //그룹번호의 첫번째 페이지 숫자
            $first_page = $last_page - ($page_scale-1);
            //그룹번호의 첫번째 페이지는 1페이지보다 작을 수 없음
            if($first_page < 1){
              $first_page = 1;
            }else if($last_page == $total_page){ //마지막 그룹번호일때 첫번째 페이지값 결정
              if($total_page % $page_scale==0){
                $first_page = $total_page - $page_scale+1;
              }else{
                $first_page = $total_page - ($total_page % $page_scale)+1;
              }
            }
            echo "<script>console.log($first_page, $last_page)</script>";

            $next = $last_page + 1;// > 버튼 누를때 나올 페이지
            $prev = $first_page - 1;// < 버튼 누를때 나올 페이지

            $url = "/eduplanet/admin/rvnSttst.php?y=$y&m=$m";

            // 첫번째 페이지일 때 앵커 비활성화
            if ($first_page == 1) {
              if($page!=1)
                echo "<li><a href='$url&page=1'><span class='page_num_direction'><i class='fas fa-angle-double-left'></i></span></a></li>";
              else
                echo "<li><a><span class='page_num_direction'><i class='fas fa-angle-double-left'></i></span></a></li>";

              echo "<li><a><span class='page_num_direction'><i class='fas fa-angle-left'></i></span></a></li>";
            } else {
              echo "<li><a href='$url&page=1'><span class='page_num_direction'><i class='fas fa-angle-double-left'></i></span></a></li>";
              echo "<li><a href='$url&page=$prev'><span class='page_num_direction'><i class='fas fa-angle-left'></i></span></a></li>";
            }


            //페이지 번호 매기기
            for($i= $first_page ; $i <= $last_page ; $i++){
              if ($page == $i) {
                echo "<li><span class='page_num_set'><b style='color:#2E89FF'> $i </b></span></li>";
              } else {
                echo "<li><a href='$url&page=$i'><span class='page_num_set'> &nbsp$i&nbsp </span></a></li>";
              }
            }

            // 마지막 페이지일 때 앵커 비활성화
            if ($last_page == $total_page) {
              echo "<li><a><span class='page_num_direction'><i class='fas fa-angle-right'></i></span></a></li>";

              if($page !=$total_page)
                echo "<li><a href='$url&page=$total_page'><span class='page_num_direction_last'><i class='fas fa-angle-double-right'></i></span></a></li>";
              else
                echo "<li><a><span class='page_num_direction_last'><i class='fas fa-angle-double-right'></i></span></a></li>";

            } else {
                echo "<li><a href='$url&page=$next'><span class='page_num_direction'><i class='fas fa-angle-right'></i></span></a></li>";
                echo "<li><a href='$url&page=$total_page'><span class='page_num_direction_last'><i class='fas fa-angle-double-right'></i></span></a></li>";
            }
?>
          </ul>
        </div>
      </div>
      </div>
    </div>
  </div>
</section>
</main>
</body>
</html>
