<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="utf-8">
    <title>멤버십 인덱스</title>
     <script src="http://code.jquery.com/jquery-1.12.4.min.js" charset="utf-8"></script>
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
              <div class="whole_card_wrapper">
                    <button type="button" class="membership_card" onclick="location.href='./payment.php?title=1&percent=0.3&price=21300'">
                      <div class="card_wrap">
                        <div class="card_header">
                          <div class="membership_card_title">
                            <span class="title">1개월</span><span class="membership_tag tag_red">BEST</span>
                          </div>
                          <dl class="price_info clearfix">
                            <dt class="hide">가격</dt>
                              <dd class="percent">-30%</dd>
                              <dd class="price_by_month">14,900원</dd>
                          </dl>
                        </div>
                        <div class="card_content">
                          <dl class="price_info clearfix">
                            <dt class="hide">원가</dt>
                             <dd class="original_price"><del>21,300원</del></dd>
                            <dt class="hide">할인가</dt>
                             <dd class="discount_price">총 14,900원</dd>
                           </dl>
                         </div>
                         <div class="card_bottom">
                           <span class="btn_membership false">구매하기</span>
                         </div>
                       </div>
                     </button>

                    <button type="button" class="membership_card" onclick="location.href='./payment.php?title=3&percent=0.46&price=44700'">
                      <div class="card_wrap">
                        <div class="card_header">
                          <div class="membership_card_title">
                            <span class="title">3개월</span><span class="membership_tag tag_red">BEST</span>
                          </div>
                          <dl class="price_info clearfix">
                            <dt class="hide">가격</dt>
                              <dd class="percent">-46%</dd>
                              <dd class="price_by_month">월 8,000원</dd>
                          </dl>
                        </div>
                        <div class="card_content">
                          <dl class="price_info clearfix">
                            <dt class="hide">원가</dt>
                             <dd class="original_price"><del>44,700원</del></dd>
                            <dt class="hide">할인가</dt>
                             <dd class="discount_price">총 24,000원</dd>
                           </dl>
                         </div>
                         <div class="card_bottom">
                           <span class="btn_membership false">구매하기</span>
                         </div>
                       </div>
                     </button>

                    <button type="button" class="membership_card" onclick="location.href='./payment.php?title=6&percent=0.7&price=89400'">
                      <div class="card_wrap">
                        <div class="card_header">
                          <div class="membership_card_title">
                            <span class="title">6개월</span><span class="membership_tag tag_red">HIT</span>
                          </div>
                          <dl class="price_info clearfix">
                            <dt class="hide">가격</dt>
                              <dd class="percent">-70%</dd>
                              <dd class="price_by_month">월 4,500원</dd>
                          </dl>
                        </div>
                        <div class="card_content">
                          <dl class="price_info clearfix">
                            <dt class="hide">원가</dt>
                             <dd class="original_price"><del>89,400원</del></dd>
                            <dt class="hide">할인가</dt>
                             <dd class="discount_price">총 27,000원</dd>
                           </dl>
                         </div>
                         <div class="card_bottom">
                           <span class="btn_membership false">구매하기</span>
                         </div>
                       </div>
                     </button>

                    <!-- <button type="button" class="membership_card" onclick="location.href='./payment.php'">
                      <div class="card_wrap">
                        <div class="card_header">
                          <div class="membership_card_title">
                            <span class="title">정기권</span><span class="membership_tag tag_red">BEST</span>
                          </div>
                          <dl class="price_info clearfix">
                            <dt class="hide">가격</dt>
                              <dd class="percent">-46%</dd>
                              <dd class="price_by_month">월 8,000원</dd>
                          </dl>
                        </div>
                        <div class="card_content">
                          <dl class="price_info clearfix">
                            <dt class="hide">원가</dt>
                             <dd class="original_price"><del>44,700원</del></dd>
                            <dt class="hide">할인가</dt>
                             <dd class="discount_price">총 24,000원</dd>
                           </dl>
                         </div>
                         <div class="card_bottom">
                           <span class="btn_membership false">구매하기</span>
                         </div>
                       </div>
                     </button> -->


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
  </body>
</html>
