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
    <script src="/eduplanet/admin/js/am_members_waiting.js"></script>
    <!-- css -->
    <link rel="stylesheet" href="/eduplanet/admin/css/am_members_waiting.css">
    <link rel="stylesheet" href="/eduplanet/admin/css/nav.css">
    <!-- 폰트 -->
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Do+Hyeon|Jua|Montserrat&display=swap" rel="stylesheet">
    <!-- 아이콘 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css">

    <title>Document</title>
</head>
<body>
<?php
  include_once '../lib/db_connector.php';
  
  $page = isset($_GET["page"])? $_GET["page"]: 1 ;
  $col = isset($_GET["col"])? $_GET["col"]: '' ;
  $search = isset($_GET["search"])? $_GET["search"]: '' ;

?>
<!-- php 변수를 자바스크립트로 넘겨줌 -->
<script>
  var page = "<?=$page?>";
  var col = "<?=$col?>";
  var search = "<?=$search?>";
</script>
<div id="g_members_list_wrap">
      <div id="g_members_list">
        <h4>
          <i class="fas fa-chart-line"></i>&nbsp;&nbsp;&nbsp;Waiting list
          <div class="selectbox">
            <select id="search_select">
              <option>회원번호</option>
              <option>아이디</option>
              <option>이메일</option>
              <option>학원번호</option>
              <option>학원명</option>
              <option>대표자명</option>
              <option>가입일</option>
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
          <button onclick="submitApproval()">승인</button>
          <button onclick="submitDeny()">거절</button>
        </div>
        <ul id="member_list">
				<li>
					<span class="col1">No</span>
					<span class="col3">아이디</span>
					<span class="col4">이메일</span>
					<span class="col5">학원번호</span>
					<span class="col6">학원명</span>
					<span class="col7">대표자명</span>
          <span class="col8">가입일</span>
					<span class="col2">첨부파일</span>
					<span class="col9">선택</span>
				</li>
<?php
        $sql='';

        if($col!='' && $search !=''){
          $sql = "SELECT * FROM a_members WHERE $col LIKE '%$search%' AND approval = 'N' ORDER BY regist_day DESC";
        }else{
          $sql = "SELECT * FROM a_members WHERE approval = 'N' ORDER BY regist_day DESC";
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
          $id          = $row["id"];
          $email        = $row["email"];
          $acd_no       = $row["acd_no"];
          $acd_name       = $row["acd_name"];
          $rprsn       = $row["rprsn"];
          $file_copy       = $row["file_copy"];
          $regist_day  = $row["regist_day"];
?>
        <li class="list_row">
        <form method="post" action="#">
          <span class="col1"><?=$number?></span>
          <span class="col3"><?=$id?></span>
          <span class="col4"><?=$email?></span>
          <span class="col5"><?=$acd_no?></span>
          <span class="col6"><?=$acd_name?></span>
          <span class="col7"><?=$rprsn?></span>
          <span class="col8"><?=$regist_day?></span>
          <span class="col2"><i class="far fa-address-card" onclick="showPopupLayer('<?=$file_copy?>')"></i></span>
          <span class="col9"><input type="checkbox" name="no[]" id="item<?=$i?>" value="<?=$no?>">
          <label for="item<?=$i?>"></label></span>
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

            $next = $last_page + 1;// > 버튼 누를때 나올 페이지
            $prev = $first_page - 1;// < 버튼 누를때 나올 페이지

            $url = "/eduplanet/admin/am_members_waiting.php?";
            if($search!=''){
              $url .= "col=$col&search=$search";
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
    <div id="overlay"></div>
    <div id="popupLayer">
      <center>
        <img id ="bsns_lic_img" src="/eduplanet/img/no_bsns_lic.png" onerror="setDefaultImg()" alt="사업자등록증" width=600>
      </center>
    </div>
</body>
</html>