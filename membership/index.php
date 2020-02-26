<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="utf-8">
    <title>멤버십 인덱스</title>
     <!-- favicon -->
     <link rel="shortcut icon" href="/eduplanet/img/favicon.png">
     <script src="http://code.jquery.com/jquery-1.12.4.min.js" charset="utf-8"></script>
     <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR&amp;display=swap" rel="stylesheet">
     <!-- CSS -->
     <link rel="stylesheet" href="/eduplanet/mypage/css/review_write_popup.css">
     <link rel="stylesheet" href="/eduplanet/index/index_header_searchbar_in.css">
     <link rel="stylesheet" href="/eduplanet/index/footer.css">
     <link rel="stylesheet" href="/code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
     <link rel="stylesheet" href="./css/index.css">
     <!-- 스크립트 -->
     <script src="/eduplanet/mypage/js/review_write.js"></script>
     <script src="/eduplanet/searchbar/searchbar_in.js"></script>
     <!-- 자동완성 -->
     <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
     <!-- 아이콘 -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css">


  </head>
  <body>
    <header>
       <?php
        include_once $_SERVER["DOCUMENT_ROOT"]."/eduplanet/index/index_header_searchbar_in.php";
       ?>
    </header>

    <section>
        <?php
          $gm_no = isset($_SESSION["gm_no"]) ?  $_SESSION["gm_no"] : "";
          $am_no = isset($_SESSION["am_no"]) ?  $_SESSION["am_no"] : "";

          include "../lib/db_connector.php";
        ?>

        <div class="membership_container">
          <div class="membership_section top_banner">
              top_banner
          </div>

          <div class="membership_section mid_contents gm_product">
            <h2>프리미엄</h2>
            <div class="mid_sub_title">프리미엄 멤버십에 가입하면 회원들의 상세리뷰를 무제한으로 볼 수 있습니다!</div>
              <div class="membership_icons_wrap">
                <div class="membership_icons">
                  <img src="../img/facilities.png" alt="facilities" width="60%" height="60%">
                  <span class="icon_text">시설</span>
                </div>
                <div class="membership_icons">
                  <img src="../img/budget.png" alt="cost-effective" width="60%" height="60%">
                  <span class="icon_text">수강료만족도</span>
                </div>
                <div class="membership_icons">
                  <img src="../img/bus.png" alt="Traffic convenience" width="60%" height="60%">
                  <span class="icon_text">교통편의성</span>
                </div>
                <div class="membership_icons">
                  <img src="../img/work.png" alt="teacher" width="60%" height="60%">
                  <span class="icon_text">강사</span>
                </div>
                <div class="membership_icons">
                  <img src="../img/book.png" alt="achievement" width="60%" height="60%">
                  <span class="icon_text">학업성취도</span>
                </div>
              </div>


              <div class="whole_card_wrapper">

          <?php
            $sql = "select * from product where prdct_name='프리미엄'";
            $result = mysqli_query($conn, $sql);
            $num_of_records = mysqli_num_rows($result);

            for ($i=0;$i<$num_of_records;$i++){
            mysqli_data_seek($result, $i);
            $row = mysqli_fetch_array($result);
            $gm_month = $row["month"];
            $gm_price = $row["price"];
            $gm_discount = $row["discount"];
            $gm_total_price = $gm_price*(100-$gm_discount)*0.01;
          ?>
                <button type="button" class="membership_card gm_card"
                onclick="location.href='./payment.php?month=<?=$gm_month?>&discount=<?=$gm_discount?>&price=<?=$gm_price?>'" disabled>
                  <div class="card_wrap">
                    <div class="card_header">
                      <div class="membership_card_title">
                        <span class="month"><?=$gm_month?>개월</span><span class="membership_tag">BEST</span>
                      </div>
                      <dl class="price_info clearfix">
                        <dt class="hide">가격</dt>
                          <dd class="discount">-<?=$gm_discount?>%</dd>
                          <dd class="price_by_month">월<?=$gm_total_price/$gm_month?>원</dd>
                      </dl>
                    </div>
                    <div class="card_content">
                      <dl class="price_info clearfix">
                        <dt class="hide">원가</dt>
                         <dd class="original_price"><del><?=$gm_price?>원</del></dd>
                        <dt class="hide">할인가</dt>
                         <dd class="discount_price">총 <?=$gm_total_price?>원</dd>
                       </dl>
                     </div>
                     <div class="card_bottom">
                       <span class="btn_membership">구매하기</span>
                     </div>
                   </div>
                 </button>

               <?php
             } // end of for
             ?>

              </div> <!--  end of whole_card_wrapper -->

          </div> <!--  end of mid_contents -->

          <div class="membership_section mid_contents am_product" >
            <h2>학원관리</h2>
            <div class="mid_sub_title">학원 회원으로 멤버십 가입하면 우리 학원의 스토리를 포스팅 할 수 있습니다!</div>
              <div class="membership_icons_wrap">
                <div class="membership_icons">
                  <img src="../img/advertising.png" alt="facilities" width="60%" height="60%">
                  <span class="icon_text">학원 홍보</span>
                </div>
                <div class="membership_icons">
                  <img src="../img/information.png" alt="cost-effective" width="60%" height="60%">
                  <span class="icon_text">학원 뉴스</span>
                </div>
                <div class="membership_icons">
                  <img src="../img/communication.png" alt="Traffic convenience" width="60%" height="60%">
                  <span class="icon_text">커뮤니케이션</span>
                </div>
                <div class="membership_icons">
                  <img src="../img/blog.png" alt="teacher" width="60%" height="60%">
                  <span class="icon_text">학원스토리</span>
                </div>
                <!-- <div class="membership_icons">
                  <img src="../img/book.png" alt="achievement" width="60%" height="60%">
                  <span class="icon_text">학업성취도</span>
                </div> -->
              </div>


              <div class="whole_card_wrapper">

          <?php
            $sql = "select * from product where prdct_name='학원관리'";
            $result = mysqli_query($conn, $sql);
            $num_of_records = mysqli_num_rows($result);

            for ($i=0;$i<$num_of_records;$i++){
            mysqli_data_seek($result, $i);
            $row = mysqli_fetch_array($result);
            $am_month = $row["month"];
            $am_discount = $row["discount"];
            $am_price = $row["price"];
            $am_total_price = $am_price*(100-$am_discount)*0.01;
          ?>
                <button type="button" class="membership_card am_card"
                onclick="location.href='./payment.php?month=<?=$am_month?>&discount=<?=$am_discount?>&price=<?=$am_price?>'" disabled>
                  <div class="card_wrap">
                    <div class="card_header">
                      <div class="membership_card_title">
                        <span class="month"><?=$am_month?>개월</span><span class="membership_tag">BEST</span>
                      </div>
                      <dl class="price_info clearfix">
                        <dt class="hide">가격</dt>
                          <dd class="discount">-<?=$am_discount?>%</dd>
                          <dd class="price_by_month">월<?=$am_total_price/$am_month?>원</dd>
                      </dl>
                    </div>
                    <div class="card_content">
                      <dl class="price_info clearfix">
                        <dt class="hide">원가</dt>
                         <dd class="original_price"><del><?=$am_price?>원</del></dd>
                        <dt class="hide">할인가</dt>
                         <dd class="discount_price">총 <?=$am_total_price?>원</dd>
                       </dl>
                     </div>
                     <div class="card_bottom">
                       <span class="btn_membership">구매하기</span>
                     </div>
                   </div>
                 </button>

               <?php
             } // end of for
             mysqli_close($conn);
             ?>

              </div> <!--  end of whole_card_wrapper -->

          </div> <!--  end of mid_contents -->

          <div class="membership_section bottom_info">
            <div class="bottom_info_container">
              <p>
                [이용 안내] <br>
                * 표시된 금액은 부가가치세(VAT) 별도 금액입니다.<br>
                * 구매 기간동안 무제한으로 콘텐츠 열람이 가능합니다.<br>
                * 이용 기간 중 PC, 모바일웹, 스마트폰(앱)에서 이용 가능합니다.<br>
                * 구매 내역 및 정기권은 "My-결제/정기결제"에서 확인할 수 있습니다.<br>
                * 콘텐츠 특성상 실사용 도중 해지 및 이에 따른 환불이 불가능합니다.<br>
              </p>
            </div>

          </div>


        </div>   <!-- end of container  -->

    </section>

    <footer>
       <?php include_once $_SERVER["DOCUMENT_ROOT"]."/eduplanet/index/footer.php"; ?>
    </footer>
    <script>
      var $gm_no = '<?=$gm_no?>';
      var $am_no = '<?=$am_no?>';

      if($gm_no){
        $(".am_product").css("display", "none");
        $(".gm_card").attr("disabled", false);
        // $(".am_product").css("background", "rgba(46, 137, 255, 0.13)");
        // $(".am_product").css("cursor", "not-allowed");
      }else if($am_no){
        $(".gm_product").css("display", "none");
        $(".am_card").attr("disabled", false);
        // $(".gm_product").css("background", "rgba(46, 137, 255, 0.13)");
        // $(".gm_product").css("cursor", "not-allowed");
      }else {
        $(".gm_card").attr("disabled", false);
        $(".am_card").attr("disabled", false);
        $(".membership_card").click(function(){
          alert('멤버십 서비스는 로그인 후 이용하실 수 있습니다.');
          location.href='../login_join/login_form.php';
        });
      }

    </script>
  </body>
</html>
