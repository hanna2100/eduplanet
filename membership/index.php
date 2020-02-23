<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="utf-8">
    <title>멤버십 인덱스</title>
     <script src="http://code.jquery.com/jquery-1.12.4.min.js" charset="utf-8"></script>
     <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR&amp;display=swap" rel="stylesheet">
     <link rel="stylesheet" href="./css/index.css">
  </head>
  <body>
    <header>
       <?php
       // include "../index_header.php";
       ?>
    </header>

    <section>
        <div class="membership_container">
          <div class="membership_section top_banner">
              top_banner
          </div>

          <div class="membership_section mid_contents">
            <h2>프리미엄</h2>
            <div class="mid_sub_title">결제를 해야 학원 리뷰를 볼 수 있답니다!! 우하하</div>
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
            include "../lib/db_connector.php";
            $sql = "select * from product where prdct_name='프리미엄'";
            $result = mysqli_query($conn, $sql);
            $num_of_records = mysqli_num_rows($result);

            for ($i=0;$i<$num_of_records;$i++){
            mysqli_data_seek($result, $i);
            $row = mysqli_fetch_array($result);
            $month = $row["month"];
            $discount = $row["discount"];
            $price = $row["price"];
            $total_price = $price*(100-$discount)*0.01;
          ?>
                <button type="button" class="membership_card" onclick="loginCheck();">
                  <div class="card_wrap">
                    <div class="card_header">
                      <div class="membership_card_title">
                        <span class="month"><?=$month?>개월</span><span class="membership_tag">BEST</span>
                      </div>
                      <dl class="price_info clearfix">
                        <dt class="hide">가격</dt>
                          <dd class="discount">-<?=$discount?>%</dd>
                          <dd class="price_by_month">월<?=$total_price/$month?>원</dd>
                      </dl>
                    </div>
                    <div class="card_content">
                      <dl class="price_info clearfix">
                        <dt class="hide">원가</dt>
                         <dd class="original_price"><del><?=$price?>원</del></dd>
                        <dt class="hide">할인가</dt>
                         <dd class="discount_price">총 <?=$total_price?>원</dd>
                       </dl>
                     </div>
                     <div class="card_bottom">
                       <span class="btn_membership">구매하기</span>
                     </div>
                   </div>
                 </button>

               <?php
             }
             mysqli_close($conn);
             ?>

              </div> <!--  end of whole_card_wrapper -->

          </div> <!--  end of mid_contents -->

          <div class="membership_section bottom_info">
            <p>
              [이용 안내] <br>
              * 표시된 금액은 부가가치세(VAT) 별도 금액입니다.<br>
              * 구매 기간동안 무제한으로 콘텐츠 열람이 가능합니다.<br>
              * 이용 기간 중 PC, 모바일웹, 스마트폰(앱)에서 이용 가능합니다.<br>
              * 구매 내역 및 정기권은 "My-결제/정기결제"에서 확인할 수 있습니다.<br>
              * 콘텐츠 특성상 실사용 도중 해지 및 이에 따른 환불이 불가능합니다.<br>
            </p>
          </div>


        </div>   <!-- end of container  -->

    </section>

    <footer>

    </footer>
    <script>

      function loginCheck(){
        // 아이디 세션값 있는지 체크
        var $gm_no=3;
        var $am_no;

        var month = '<?=$month?>';
        var discount = '<?=$discount?>';
        var price = '<?=$price?>';

        if($gm_no){
          location.href="./payment.php?month="+month+"&discount="+discount+"&price="+price
        }else if($am_no){
          alert('해당 멤버십은 일반 회원 전용입니다. 일반회원으로 로그인 하시거나 기업회원 멤버십을 이용해주세요.');
        }else {
          alert('멤버십 서비스는 로그인 후 이용하실 수 있습니다.');
          location.href='../login.php';
        }
      }
    </script>
  </body>
</html>
