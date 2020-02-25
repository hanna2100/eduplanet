
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <title>review test</title>
     <!-- <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR&amp;display=swap" rel="stylesheet">\ -->
     <script src="http://code.jquery.com/jquery-1.12.4.min.js" charset="utf-8"></script>
     <!--  star rating -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     <!-- 리뷰 하단 페이징 아이콘 -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css">
     <!-- radar chart -->
     <script src="https://cdn.anychart.com/releases/8.7.1/js/anychart-core.min.js"></script>
     <script src="https://cdn.anychart.com/releases/8.7.1/js/anychart-radar.min.js"></script>
     <!-- word cloud  -->
     <script src="https://cdn.anychart.com/releases/v8/js/anychart-base.min.js"></script>
     <script src="https://cdn.anychart.com/releases/v8/js/anychart-tag-cloud.min.js"></script>
     <!-- 나의 css -->
     <link rel="stylesheet" href="./css/review.css">
   </head>
   <body>
     <header>
         <?php
           include "../index/index_header_searchbar_in.php";
           include "./header/academy_header.php";
         ?>
     </header>

     <?php
        include "../lib/db_connector.php";
        if (isset($_GET["page"])) {
            $page = $_GET["page"];
        } else {
            $page = 1;
        }

        if(isset($_SESSION["id"])){
            $id = $_SESSION["id"];
        }else{
          // 테스트하는 동안 쓸 임시 아이디
            $id = "비회원";
        }
        // content_top
          // parent="현재 리뷰를 보고 있는 학원 넘버"
        $sql_top = "select avg(total_star), avg(facility), avg(acsbl), avg(teacher), avg(cost_efct), avg(achievement) from review where parent=21;";
        $result_top = mysqli_query($conn, $sql_top);
        $row_top = mysqli_fetch_array($result_top);

        $rate_point = round($row_top[0],1);
        $rate_bar_facility = round($row_top[1],1);
        $rate_bar_acsbl = round($row_top[2],1);
        $rate_bar_teacher = round($row_top[3],1);
        $rate_bar_cost_efct = round($row_top[4],1);
        $rate_bar_achievement = round($row_top[5],1);
    ?>

    <section>
      <div class="inner_section">
        <div id="content_top" class="content">
          <h2 class="txt_title">전체 리뷰 통계</h2>
          <div class="inner_content_top top_rating">
            <div class="rate_star_wrap">
              <span id="rate_point" class="rate_point"><?=$rate_point?></span>
              <div class="rate_star_ty1">
                <span class="fa fa-star total_star"></span>
                <span class="fa fa-star total_star"></span>
                <span class="fa fa-star total_star"></span>
                <span class="fa fa-star total_star"></span>
                <span class="fa fa-star total_star"></span>
                <div class="rate_txt">총 만족도</div>
              </div>
            </div>
            <div class="rate_bar_wrap">
              <p> 시설 </p>
                <div class="inner_rate_bar">
                  <div class="rate_bar first"></div>
                </div>
              <p> 교통편의성 </p>
                <div class="inner_rate_bar">
                  <div class="rate_bar second"></div>
                </div>
              <p> 강사 </p>
                <div class="inner_rate_bar">
                  <div class="rate_bar third"></div>
                </div>
              <p> 수강료 만족도 </p>
                <div class="inner_rate_bar">
                  <div class="rate_bar four"></div>
                </div>
              <p> 학업성취도 </p>
                <div class="inner_rate_bar">
                  <div class="rate_bar five"></div>
                </div>
                <script>
                // 전체 리뷰 5가지 항목 rating bar
                $rate_bar_facility = 20*"<?=$rate_bar_facility?>";
                $rate_bar_acsbl = 20*"<?=$rate_bar_acsbl?>";
                $rate_bar_teacher = 20*"<?=$rate_bar_teacher?>";
                $rate_bar_cost_efct = 20*"<?=$rate_bar_cost_efct?>";
                $rate_bar_achievement = 20*"<?=$rate_bar_achievement?>";
                $('.first').css({'width': $rate_bar_facility+'%'});
                $('.second').css({'width': $rate_bar_acsbl+'%'});
                $('.third').css({'width': $rate_bar_teacher+'%'});
                $('.four').css({'width': $rate_bar_cost_efct+'%'});
                $('.five').css({'width': $rate_bar_achievement+'%'});
                </script>
            </div>
          </div>
          <div class="inner_content_top top_radar">
            <div id="radarChart"></div>
          </div>
        </div>

        <div id="content_mid" class="content">
            <h2 class="txt_title">장단점 키워드</h2>
            <div id="container"></div>
        </div>
    <?php
        // content_bottom
        $sql_bottom = "select review.*, g_members.age from review inner join g_members on review.user_no=g_members.no where parent=21 order by regist_day desc;";
        $result_bottom = mysqli_query($conn, $sql_bottom);
        // 1. 전체 리뷰의 갯수
        $total_record = mysqli_num_rows($result_bottom);
        // 2. 한 페이지에 보여질 글의 갯수
        define("SCALE", 5);
        // 3. 전체 페이지 수
        $total_pages = ($total_record % SCALE == 0)?($total_record/SCALE):(ceil($total_record/SCALE));
        // 4. 현재 페이지의 제일 첫 게시글 번호 구하기
        $set_page_amount = ($page - 1) * SCALE;
        $record_number = $total_record - $set_page_amount;

        // 5. 현재 페이지에 게시글 목록 출력하기
        for($i=$set_page_amount ; $i<$set_page_amount+SCALE && $i<$total_record ; $i++){
          mysqli_data_seek($result_bottom, $i);
          $row = mysqli_fetch_array($result_bottom);

          $num = $row["no"];
          $user_no = $row["user_no"];
          $one_line = $row["one_line"];
    	    $individual_star = floor($row["total_star"]);
    	    $facility = $row["facility"]*20;
    	    $acsbl = $row["acsbl"]*20;
    	    $teacher = $row["teacher"]*20;
    	    $cost_efct = $row["cost_efct"]*20;
    	    $achievement = $row["achievement"]*20;
    	    $benefit = $row["benefit"];
    	    $drawback = $row["drawback"];
          $regist_day = $row["regist_day"];
          $age = date("yy")-$row["age"];
          if($age<14){
            $grade = "유초등";
          }else if($age>=14 && $age<17){
            $grade = "중등";
          }else if($age>=17 && $age<20){
            $grade = "고등";
          }else {$grade = "성인";}
    ?>

         <div id="content_bottom" class="content">
             <h2 class="txt_title">멤버십 전용 리뷰</h2>
             <div class="review_head">
               <img src="../img/member_basic.png" alt="" width="50px" height="50px">
                 <div class="review_member_info">
                   <span> <?=$grade?> </span><span> | </span><span> <?=$regist_day?> </span>
                 </div>
             </div>
             <hr>

             <div class="review_body_wrap">
               <div class="review_body_left review_body">
                 <div id="rate_5_things">
                    <span class="fa fa-star star0"></span>
                    <span class="fa fa-star star1"></span>
                    <span class="fa fa-star star2"></span>
                    <span class="fa fa-star star3"></span>
                    <span class="fa fa-star star4"></span>

                    <script>
                    // 각 리뷰의 별점(총만족도) 표시
                      var star0 = document.getElementsByClassName("star0");
                      var star1 = document.getElementsByClassName("star1");
                      var star2 = document.getElementsByClassName("star2");
                      var star3 = document.getElementsByClassName("star3");
                      var star4 = document.getElementsByClassName("star4");
                      var star = [star0, star1, star2, star3, star4];

                      var i = <?=$i?>;
                      var scale = <?=SCALE?>;
                      var i = i - (scale*(<?=$page?>-1));
                      var individual_star = <?= $individual_star ?>;

                      for(var j=0;j<individual_star;j++){
                        star[j][i].style.color="orange";
                      }
                    </script>
                 </div>

                   <!-- 개별 리뷰 5가지 항목 -->
                    <div class="row">
                      <div class="side">시설</div>
                      <div class="middle">
                       <div class="bar-container">
                         <div class="bar-5" style="width:<?=$facility?>% !important"><?=$facility?></div>
                       </div>
                      </div>
                      <div class="side">교통편의성</div>
                      <div class="middle">
                       <div class="bar-container">
                         <div class="bar-4" style="width:<?=$acsbl?>% !important"><?=$acsbl?></div>
                       </div>
                      </div>
                      <div class="side">강사</div>
                      <div class="middle">
                       <div class="bar-container">
                         <div class="bar-3" style="width:<?=$teacher?>% !important"><?=$teacher?></div>
                       </div>
                      </div>
                      <div class="side">수강료만족도</div>
                      <div class="middle">
                       <div class="bar-container">
                         <div class="bar-2" style="width:<?=$cost_efct?>% !important"><?=$cost_efct?></div>
                       </div>
                      </div>
                      <div class="side">학업성취도</div>
                      <div class="middle">
                       <div class="bar-container">
                         <div class="bar-1" style="width:<?=$achievement?>% !important"><?=$achievement?></div>
                       </div>
                      </div>
                    </div>
               </div>

               <div class="review_body_right review_body">
                 <p class="one_line">"<?=$one_line?>"</p>
                 <div class="review_txt">
                   <p class="review_title" style="font-size:17px; color:tomato; font-weight:bold;"> 장점</p>
                   <p class="review_content positive"><?=$benefit?></p>
                   <p class="review_title" style="font-size:17px; color:#00bcd4; font-weight:bold;"> 단점</p>
                   <p class="review_content negative"><?=$drawback?></p>
                 </div>

                 <div class="overlay"></div>
                 <div id="myModal" class="modal">
                   <button type="button" name="button" class="btn_modal btn_membership" onclick="location.href='../membership/index.php'">멤버십 가입하고 전체보기</button>
                   <button type="button" name="button" class="btn_modal btn_review" onclick="location.href='/eduplanet/acd_story/index.php'">학원리뷰 작성하고 전체보기</button>
                 </div>
               </div>


               <script>
                  var id = '<?= $id ?>';
                  var overlay = document.getElementsByClassName("overlay");
                  var modal = document.getElementsByClassName("modal");

                  if(id === "비회원"){
                    overlay[i].style.display = "block";
                    modal[i].style.display = "block";
                  }else {
                    overlay[i].style.display = "none";
                    modal[i].style.display = "none";
                  }
                </script>

             </div>
         </div>
    <?php
        $record_number--;
      } // end of for
        mysqli_close($conn);
    ?>

<!-- 하단 페이지 번호 인디케이터   -->
    <div class="page_num_wrap">
           <div class="page_num">
             <ul class="page_num_ul">
   <?php

               $pageGroup = ceil($page/SCALE); // 페이지 그룹번호(페이지 5개가 1그룹)

               $last_page = $pageGroup * SCALE; //그룹번호 안에서의 마지막 페이지 숫자
               //그룹번호의 마지막 페이지는 전체 페이지보다 클 수 없음
               if($total_pages < SCALE){
                 $last_page = $total_pages;
               }else if($last_page > $total_pages){
                 $last_page = $total_pages;
               }

               //그룹번호의 첫번째 페이지 숫자
               $first_page = $last_page - (SCALE-1);
               //그룹번호의 첫번째 페이지는 1페이지보다 작을 수 없음
               if($first_page < 1){
                 $first_page = 1;
               }else if($last_page == $total_page){ //마지막 그룹번호일때 첫번째 페이지값 결정
                 if($total_page % SCALE==0){
                   $first_page = $total_page - SCALE+1;
                 }else{
                   $first_page = $total_page - ($total_page % SCALE)+1;
                 }
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
                 echo "<li><a href='/eduplanet/academy/review.php?page=1'><span class='page_num_direction'><i class='fas fa-angle-double-left'></i></span></a></li>";
                 echo "<li><a href='/eduplanet/academy/review.php?page=$prev'><span class='page_num_direction'><i class='fas fa-angle-left'></i></span></a></li>";
               }

               //페이지 번호 매기기
               for($i= $first_page ; $i <= $last_page ; $i++){
                 if ($page == $i) {
                   echo "<li><span class='page_num_set'><b style='color:#2E89FF'> $i </b></span></li>";
                 } else {
                   echo "<li><a href='/eduplanet/academy/review.php?page=$i'><span class='page_num_set'> &nbsp$i&nbsp </span></a></li>";
                 }
               }

               // 마지막 페이지일 때 앵커 비활성화
               if ($last_page == $total_pages) {
                 echo "<li><a><span class='page_num_direction'><i class='fas fa-angle-right'></i></span></a></li>";

                 if($page !=$total_pages)
                   echo "<li><a href='/eduplanet/academy/review.php?page=$total_pages'><span class='page_num_direction_last'><i class='fas fa-angle-double-right'></i></span></a></li>";
                 else
                   echo "<li><a><span class='page_num_direction_last'><i class='fas fa-angle-double-right'></i></span></a></li>";

               } else {
                   echo "<li><a href='/eduplanet/academy/review.php?page=$next'><span class='page_num_direction'><i class='fas fa-angle-right'></i></span></a></li>";
                   echo "<li><a href='/eduplanet/academy/review.php?page=$total_pages'><span class='page_num_direction_last'><i class='fas fa-angle-double-right'></i></span></a></li>";
               }
   ?>
             </ul>
           </div>
         </div>




      </div> <!-- end of inner_section   -->
     </section>

     <footer>
       <?php include "../index/footer.php"; ?>
     </footer>

     <script src="./js/review.js"></script>
     <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
     <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
   </body>
 </html>
