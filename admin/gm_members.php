<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- jquery -->
  <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="/eduplanet/admin/js/admin.js"></script>
  <script src="/eduplanet/admin/js/gm_members.js"></script>
  <!-- css -->
  <link rel="stylesheet" href="/eduplanet/admin/css/gm_members.css">
  <link rel="stylesheet" href="/eduplanet/admin/css/nav.css">
  <!-- 폰트 -->
  <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR&amp;display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Do+Hyeon|Jua|Montserrat&display=swap" rel="stylesheet">
  <!-- 아이콘 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css">
  <!-- 차트 -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
  <title>에듀플래닛 관리자페이지 - 회원관리</title>
</head>
<body>
<main>
<?php
  include_once 'nav.php';
  include_once '../lib/db_connector.php';

  $page = isset($_GET["page"])? $_GET["page"]: 1 ;
?>
<!-- 페이지 변수를 자바스크립트로 넘겨줌 -->
<script>
  var page = "<?=$page?>";
</script>
<section>
  <div class="sec_top">
    <span><i class="fas fa-angle-left"></i></span>
    <select id="top_select_year" dir="rtl" onchange="topSelect_init_Setting()"></select>
    <span>년 </span>
    <select id="top_select_month" dir="rtl"></select>
    <span>월 </span>
    <span><i class="fas fa-angle-right"></i></span>
  </div>
  <!--end of 년 월 선택바 -->

  <div class="sec_content">
    <div id="dash_topline">
      <div>
        <span>전체 일반회원</span><br>
        <span class="dash_topline_i"><i class="fas fa-user-friends"></i>&nbsp;123</span>
        <span class="caret up"><i class="fas fa-caret-up"></i></span>
      </div>
      <div>
        <span>신규회원</span><br>
        <span class="dash_topline_i"><i class="fas fa-user-plus"></i>&nbsp;23</span>
        <span class="caret up"><i class="fas fa-caret-up"></i></span>
      </div>
      <div>
        <span>탈퇴회원</span><br>
        <span class="dash_topline_i"><i class="fas fa-user-minus"></i>&nbsp;11</span>
        <span class="caret down"><i class="fas fa-caret-down"></i></span>
      </div>
    </div>
    <!--end of 상단 회원수 변화-->

    <div id="g_members_totalGraph_wrap">
      <div id="g_members_totalGraph_cell1">
        <h4><i class="fas fa-chart-line"></i>&nbsp;&nbsp;&nbsp;General member Graph<span>단위: 명</span></h4>
        <canvas id="g_members_totalGraph"></canvas>
        <div class="btn_hide">
          <button>숨기기</button>
        </div>
      </div>
    </div>
    <!-- end of 회원수 변화 그래프 -->

    <div id="g_members_list_wrap">
      <div id="g_members_list">
        <h4>
          <i class="fas fa-chart-line"></i>&nbsp;&nbsp;&nbsp;General member Management
          <div class='search-box'>
            <form class='search-form'>
              <input class='form-control' placeholder='검색어를 입력하세요' type='text'>
              <button class='btn btn-link search-btn'>
              <i class="fas fa-search"></i>
              </button>
            </form>
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
					<span class="col2">회원번호</span>
					<span class="col3">아이디</span>
					<span class="col4">이메일</span>
					<span class="col5">연락처</span>
					<span class="col6">나이</span>
					<span class="col7">관심사</span>
					<span class="col8">유료만료일</span>
					<span class="col9">가입일</span>
				</li>
<?php
        $sql = "select * from g_members order by no desc";
        $result = mysqli_query($conn, $sql);
        $total_record = mysqli_num_rows($result); // 전체 회원 수

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
          $id          = $row["id"];
          $email        = $row["email"];
          $phone       = $row["phone"];
          $age       = $row["age"];
          $intres       = $row["intres"];
          $expiry_day       = $row["expiry_day"];
          $regist_day  = $row["regist_day"];
?>
        <li class="list_row">
        <form method="post" action="./lib/gm_members_update.php?no=<?=$no?>">
          <span class="col1"><?=$number?></span>
          <span class="col2"><?=$no?></span>
          <span class="col3"><?=$id?></span>
          <span class="col4"><input type="text" name="email" value="<?=$email?>" disabled></span>
          <span class="col5"><input type="text" name="phone" value="<?=$phone?>" disabled></span>
          <span class="col6"><?=$age?></span>
          <span class="col7"><input type="text" name="intres" value="<?=$intres?>" disabled></span>
          <span class="col8"><input type="text" name="expiry_day" value="<?=$expiry_day?>" disabled></span>
          <span class="col9"><?=$regist_day?></span>
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
              $first_page = $total_page - ($total_page % $page_scale)+1;
            }
            
            $next = $last_page + 1;// > 버튼 누를때 나올 페이지
            $prev = $first_page - 1;// < 버튼 누를때 나올 페이지

            // 첫번째 페이지일 때 앵커 비활성화
            if ($first_page == 1) {
              if($page!=1)
                echo "<li><a href='/eduplanet/admin/gm_members.php?page=1'><span class='page_num_direction'><i class='fas fa-angle-double-left'></i></span></a></li>";
              else
                echo "<li><a><span class='page_num_direction'><i class='fas fa-angle-double-left'></i></span></a></li>";
              
              echo "<li><a><span class='page_num_direction'><i class='fas fa-angle-left'></i></span></a></li>";
            } else {
              echo "<li><a href='/eduplanet/admin/gm_members.php?page=1'><span class='page_num_direction'><i class='fas fa-angle-double-left'></i></span></a></li>";
              echo "<li><a href='/eduplanet/admin/gm_members.php?page=$prev'><span class='page_num_direction'><i class='fas fa-angle-left'></i></span></a></li>";
            }

            //페이지 번호 매기기
            for($i= $first_page ; $i <= $last_page ; $i++){
              if ($page == $i) {
                echo "<li><span class='page_num_set'><b style='color:#2E89FF'> $i </b></span></li>";
              } else {
                echo "<li><a href='/eduplanet/admin/gm_members.php?page=$i'><span class='page_num_set'> &nbsp$i&nbsp </span></a></li>";
              }
            }

            // 마지막 페이지일 때 앵커 비활성화
            if ($last_page == $total_page) {
              echo "<li><a><span class='page_num_direction'><i class='fas fa-angle-right'></i></span></a></li>";   
              
              if($page !=$total_page)
                echo "<li><a href='/eduplanet/admin/gm_members.php?page=$total_page'><span class='page_num_direction_last'><i class='fas fa-angle-double-right'></i></span></a></li>";
              else
                echo "<li><a><span class='page_num_direction_last'><i class='fas fa-angle-double-right'></i></span></a></li>";
              
            } else {
                echo "<li><a href='/eduplanet/admin/gm_members.php?page=$next'><span class='page_num_direction'><i class='fas fa-angle-right'></i></span></a></li>";
                echo "<li><a href='/eduplanet/admin/gm_members.php?page=$total_page'><span class='page_num_direction_last'><i class='fas fa-angle-double-right'></i></span></a></li>";
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