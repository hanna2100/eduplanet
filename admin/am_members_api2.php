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
    <script src="/eduplanet/admin/js/am_members_api2.js"></script>
    <!-- css -->
    <link rel="stylesheet" href="/eduplanet/admin/css/am_members_api2.css">
    <link rel="stylesheet" href="/eduplanet/admin/css/nav.css">
    <!-- 폰트 -->
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Do+Hyeon|Jua|Montserrat&display=swap" rel="stylesheet">
    <!-- 아이콘 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css">

    <title>학원 데이터 업데이트</title>
</head>
<body>
<?php
  $page = isset($_GET["page"])? $_GET["page"]: 1 ;
  $url = "/eduplanet/admin/am_members_api2.php?";
  include_once './lib/get_academy_data.php';

?>
<!-- php 변수를 자바스크립트로 넘겨줌 -->
<script>
var page = "<?=$page?>";
</script>
<!-- ------------------------------ -->
<div class="tap_wrap">
  <button onclick="updateAcdFromApi()">
    API 업데이트
    <p>새로운 학원 데이터를 받아옵니다</p>
  </button>
  <button onclick="location.replace('/eduplanet/admin/am_members_api.php?')">
    신규 학원 추가[<?=$new_acd_count?>]
    <p>새로운 학원이 <?=$new_acd_count?>개 발견되었습니다</p>
  </button>
  <button onclick="location.replace('/eduplanet/admin/am_members_api2.php?')">
    기존 학원 변경[<?=$edit_acd_count?>]
    <p>기존 학원이 <?=$edit_acd_count?>개 변경되었습니다</p>
  </button>
  <button onclick="location.replace('/eduplanet/admin/am_members_api3.php?')">
    기존 학원 삭제[<?=$drop_acd_count?>]
    <p>기존 학원이 <?=$drop_acd_count?>개 폐업되었습니다</p>
  </button>
</div>
<div id="g_members_list_wrap">
  <div class="list_edit_delete_wrap">
    <button onclick="submitUpdateAcd()">변경</button>
    <button onclick="submitUpdateTotalAcd()">전체변경</button>
  </div>
  <div id="g_members_list">
    <h4>
      <i class="fas fa-download"></i>&nbsp;&nbsp;&nbsp;기존 학원 변경
    </h4>
    
    <ul class="member_list">
		<li>
      <span class="col1">No</span>
			<span class="col2">구분</span>
			<span class="col3">학원명</span>
			<span class="col4">대표자명</span>
			<span class="col5">업종</span>
			<span class="col6">전화번호</span>
			<span class="col7">주소</span>
			<span class="col8">선택</span>
		</li>
<?php

    if($edit_acd_count==0){
      echo "<p id='no_academy'>변경이력이 없습니다</p>";

    }else{
      
      //기존 학원데이터
      $sql = "SELECT * FROM academy WHERE ";


      for($i = 0; $i<sizeof($edit_acd_old); $i++){

        $no = $edit_acd_old[$i][8];
        $sql .= "no = $no ";

        if($i!=sizeof($edit_acd_old)-1){
          $sql.= "OR ";
        }
        
      }
  
      $result = mysqli_query($conn, $sql);
      $total_record = mysqli_num_rows($result); 


      //바뀐 학원 데이터 가져오기
      $sql = "SELECT * FROM academy_temp WHERE ";

      for($i = 0; $i<sizeof($edit_acd_new); $i++){

        $no = $edit_acd_new[$i][8];
        $sql .= "no = $no ";

        if($i!=sizeof($edit_acd_new)-1){
          $sql.= "OR ";
        }
        
      }
  
      $result2 = mysqli_query($conn, $sql);
      $total_record2 = mysqli_num_rows($result2); 

      $scale = 5; // 가져올 글 수

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
        $sector          = $row["sector"];
        $sector = $sector=="학교교과교습학원"? "학원" : "교습소";
        $acd_name        = $row["acd_name"];
        $rprsn       = $row["rprsn"];
        $class       = $row["class"];
        $tel       = $row["tel"];
        $address       = $row["address"];

        mysqli_data_seek($result2, $i);
        $row = mysqli_fetch_array($result2);
        $no2         = $row["no"];
        $si_name2         = $row["si_name"];
        $dong_name2         = $row["dong_name"];
        $sector2          = $row["sector"];
        $sector3 = ($sector2=="학교교과교습학원")? "학원" : "교습소";
        $acd_name2        = $row["acd_name"];
        $rprsn2       = $row["rprsn"];
        $class2       = $row["class"];
        $tel2       = $row["tel"];
        $address2       = $row["address"];
?>
        <li class="list_row old_data">
        <form method="post" action="#">
          <!-- 업데이트 누르면 넘겨야할 새 학원데이터 정보들(no2는 temp테이블에서 삭제하기위한것) -->
          <input type="hidden" name="new_no[]" value="<?=$no2?>">
          <input type="hidden" name="new_si_name[]" value="<?=$si_name2?>">
          <input type="hidden" name="new_dong_name[]" value="<?=$dong_name2?>">
          <input type="hidden" name="new_sector[]" value="<?=$sector2?>">
          <input type="hidden" name="new_acd_name[]" value="<?=$acd_name2?>">
          <input type="hidden" name="new_rprsn[]" value="<?=$rprsn2?>">
          <input type="hidden" name="new_class[]" value="<?=$class2?>">
          <input type="hidden" name="new_tel[]" value="<?=$tel2?>">
          <input type="hidden" name="new_address[]" value="<?=$address2?>">
          <!-- ------------------------------------------- -->
          <span class="col1"><?=$number?></span>
          <span class="col2"><?=$sector?></span>
          <span class="col3"><?=$acd_name?></span>
          <span class="col4"><?=$rprsn?></span>
          <span class="col5"><?=$class?></span>
          <span class="col6"><?=$tel?></span>
          <span class="col7"><?=$address?></span>
          <span class="col8"><input type="checkbox" name="no[]" id="item<?=$i?>" value="<?=$no?>">
          <label for="item<?=$i?>"></label></span>
        </form>
        </li>
        <li class="list_row">
          <span class="col1">&nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-level-up-alt fa-rotate-90"></i></span>
          <span class="col2"><?=$sector3?></span>
          <span class="col3"><?=$acd_name2?></span>
          <span class="col4"><?=$rprsn2?></span>
          <span class="col5"><?=$class2?></span>
          <span class="col6"><?=$tel2?></span>
          <span class="col7"><?=$address2?></span>
          <span class="col8"></span>
        </li>	
			
<?php
   	    $number--;
      }
    }
      mysqli_close($conn);
?>
      </ul>
      <!-- end of ul 회원리스트 -->

      <div class="page_num_wrap">
        <div class="page_num">
          <ul class="page_num_ul">
<?php
          if(isset($total_page)){
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
          }
?> 
          </ul>
        </div>
      </div>
      </div>
    </div>
</body>
</html>