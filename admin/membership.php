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
  <script src="/eduplanet/admin/js/membership.js"></script>
  <!-- css -->
  <link rel="stylesheet" href="/eduplanet/admin/css/membership.css">
  <link rel="stylesheet" href="/eduplanet/admin/css/nav.css">
  <!-- 폰트 -->
  <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR&amp;display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Do+Hyeon|Jua|Montserrat&display=swap" rel="stylesheet">
  <!-- 아이콘 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css">
  <!-- 차트 -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
  <title>에듀플래닛 관리자페이지 - 멤버십설정</title>
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
  $page = isset($_GET["page"])? $_GET["page"]: 1 ;
  $col = isset($_GET["col"])? $_GET["col"]: '' ;
  $search = isset($_GET["search"])? $_GET["search"]: '' ;
?>
<section>

<?php
  $sql = "SELECT 
            *
          FROM
           product";

  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_array($result);

?>
<!-- 총 회원수 가져오기 -->
  <div class="sec_content">
    <div id="dash_topline">
      <div>
        <span>프리미엄</span><br>
        <div class="prdct_info">
            <p>1개월</p>
            <p>- 10%</p>
            <p>4500</p>
        </div>
        <div class="prdct_info">
            <p>2개월</p>
            <p>- 20%</p>
            <p>9000</p>
        </div>
        <div class="prdct_info">
            <p>3개월</p>
            <p>- 30%</p>
            <p>12000</p>
        </div>
      </div>
      <div>
      <span>학원관리</span><br>
        <div class="prdct_info2">
            <p>1개월</p>
            <p>- 10%</p>
            <p>4500</p>
        </div>
        <div class="prdct_info2">
            <p>2개월</p>
            <p>- 20%</p>
            <p>9000</p>
        </div>
        <div class="prdct_info2">
            <p>3개월</p>
            <p>- 30%</p>
            <p>12000</p>
        </div>
      </div>
    </div>
    <!--end of 상단 회원수 변화-->

    <div id="g_members_list_wrap">
      <div id="g_members_list">
      <h4><i class="fas fa-award"></i>&nbsp;&nbsp;&nbsp;Product Setting
          <div class="selectbox">
            <select id="search_select">
              <option>상품명</option>
              <option>개월</option>
              <option>가격</option>
              <option>할인율</option>
            </select>
          </div>
          <div class='search-box'>
            <div class='search-form'>
              <input class='form-control' placeholder='검색어를 입력하세요' type='text'>
              <button class='btn btn-link search-btn' onclick="onclickSearch()" >
              <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
        </h4>
        <!-- end of 검색창 -->

        <div class="list_edit_delete_wrap">
          <button onclick="submitUpdate()">수정</button>
          <button onclick="submitDelete()">삭제</button>
        </div>
        <ul id="member_list">
				<li>
					<span class="col1">No</span>
					<span class="col2">상품번호</span>
					<span class="col3">상품명</span>
					<span class="col4">개월</span>
					<span class="col5">가격</span>
					<span class="col6">할인율</span>
					<span class="col7">판매가</span>
				</li>
<?php
        $sql='';

        if($col!='' && $search !=''){
          $sql = "SELECT * FROM product WHERE $col LIKE '%$search%' ORDER BY prdct_name ASC";
        }else{
          $sql = "SELECT * FROM product ORDER BY prdct_name ASC";
        }

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
          $no         = $row["no"];
          $prdct_name          = $row["prdct_name"];
          $month        = $row["month"];
          $price       = $row["price"];
          $discount       = $row["discount"];
?>
        <li class="list_row">
        <form method="post" action="#">
          <span class="col1"><?=$number?></span>
          <span class="col2"><input type="text" name="no[]" value="<?=$no?>" readonly></span>
          <span class="col3"><input type="text" name="prdct_name[]" value="<?=$prdct_name?>" disabled maxlength="30" oninput="limitMaxLength(this)"/></span>
          <span class="col4"><input type="number" onkeydown="javascript: return event.keyCode == 69 ? false : true" name="month[]" value="<?=$month?>" disabled maxlength="2" oninput="limitMaxLength(this)"/></span>
          <span class="col5"><input type="number" onkeydown="javascript: return event.keyCode == 69 ? false : true" name="price[]" value="<?=$price?>" disabled maxlength="10" oninput="limitMaxLength(this)"/></span>
          <span class="col6"><input type="number" onkeydown="javascript: return event.keyCode == 69 ? false : true" name="discount[]" value="<?=$discount?>" disabled maxlength="3" oninput="limitMaxLength(this)"/></span>
          <span class="col7"><?=$price-$price*($discount/100)?></span>
        </form>
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

            $url = "/eduplanet/admin/membership.php?";
            if($search!=''){
              $url .= "&col=$col&search=$search";
            }
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