<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="utf-8">
    <title>멤버십 결제페이지</title>
     <script src="http://code.jquery.com/jquery-1.12.4.min.js" charset="utf-8"></script>
     <link rel="stylesheet" href="./css/payment.css">
  </head>
  <body>
    <header>
       <?php
       // include "../index_header.php";
       ?>
    </header>


    <section>
      <form class="" action="./receipt.php" method="post">
        <div class="inner_section">
          <div class="payment_wrap">

            <div class="grid payment_header">
              <h2>프리미엄 - 3개월 결제</h2>
              <div class="period">이용기간 2020.02.16 ~ 2020.05.20</div>
            </div>

            <div class="grid payment_contents">
              <table>
                <tr>
                  <td class="payment_key">상품 가격</td>
                  <td class="payment_value">44,700원</td>
                </tr>
                <tr>
                  <td class="payment_key">할인가</td>
                  <!-- <td id="discount_tag">46% 할인</td> -->
                  <td class="payment_value">-20,700원</td>
                </tr>
                <tr>
                  <td class="payment_key">구매 가격</td>
                  <td class="payment_value">24,000원</td>
                </tr>
                <tr>
                  <td class="payment_key">부가세(10%)</td>
                  <td class="payment_value">2,400원</td>
                </tr>
                <tr id="payment_sum">
                  <td class="payment_key">총 결제금액</td>
                  <td class="payment_value">26,400원</td>
                </tr>
              </table>
            </div>

            <div class="grid payment_method">
              <h3>결제 수단</h3>
              <div class="method_wrap">
                <ul class="button_ty_radio_list">
                  <li>
                    <label class="button_ty_radio_box jply_btn_lg">
                      <input type="radio" class="jply_radio_item" name="payMethod" value="card">
                      <span class="radio_icon"></span>
                      <span class="radio_text">신용카드</span>
                    </label>
                  </li>
                  <!-- <li>
                    <label class="button_ty_radio_box jply_btn_lg">
                      <input type="radio" class="jply_radio_item" name="payMethod" value="trans">
                      <span class="radio_icon"></span>
                      <span class="radio_text">실시간 계좌이체</span>
                    </label>
                  </li>
                  <li>
                    <label class="button_ty_radio_box jply_btn_lg">
                      <input type="radio" class="jply_radio_item" name="payMethod" value="phone">
                      <span class="radio_icon"></span>
                      <span class="radio_text">휴대폰 소액결제</span>
                    </label>
                  </li> -->
                  <li>
                    <label class="button_ty_radio_box jply_btn_lg">
                      <input type="radio" class="jply_radio_item" name="payMethod" value="samsung">
                      <span class="radio_icon"></span>
                      <span class="radio_text icon_text ico_samsung">삼성페이</span>
                    </label>
                  </li>
                  <li>
                    <label class="button_ty_radio_box jply_btn_lg">
                      <input type="radio" class="jply_radio_item" name="payMethod" value="payco">
                      <span class="radio_icon"></span>
                      <span class="radio_text icon_text ico_payco">페이코</span>
                    </label>
                  </li>
                  <li>
                    <label class="button_ty_radio_box jply_btn_lg">
                      <input type="radio" class="jply_radio_item" name="payMethod" value="ssgpay">
                      <span class="radio_icon"></span>
                      <span class="radio_text icon_text ico_ssgpay">SSG페이</span>
                    </label>
                  </li>
                </ul>
              </div> <!-- end of method_wrap -->
            </div> <!-- end of payment_method -->

            <div class="grid payment_member_info">
              <h3>구매자 정보</h3>
              <div class="member_info_wrap">
                <div class="member_info_box">
                  <div class="member_info_title">결제자 이름</div>
                  <input type="text" name="name" class="member_info_input" placeholder="결제자, 입금자 이름" value="">
                </div>
                <div class="member_info_box">
                  <div class="member_info_title">연락처</div>
                  <input type="text" name="name" class="member_info_input" placeholder="'-'제외. 예) 01011112222" value="">
                </div>
                <div class="member_info_box">
                  <div class="member_info_title">결제알림 이메일</div>
                  <input type="text" name="name" class="member_info_input" placeholder="예) user@email.com" value="">
                </div>
              </div>
            </div>

            <div class="grid payment_agree">
              <div class="payment_agree_head">
                <input type="checkbox" name="" value="">
                <span class="checkbox_icon"></span>
                <span class="checkbox_text">이용약관 및 유의사항에 동의합니다.</span>
              </div>
              <div class="payment_agree_body">
                <div class="inline_scroll">
                  <span class="dd_b">[이용안내]</span><br>
                  <span class="dd_b">
                  - 멤버십 상품은 구매일로부터 이용 기간 내에 이용 가능한 상품입니다.<br>
                  - 멤버십 상품은 결제가 완료되는 즉시 이용 가능합니다.<br>
                  - 이용 기간 중 PC, 모바일웹, 스마트폰(앱)에서 이용가능합니다.<br>
                  - 일부 콘텐츠는 기업 및 작성자의 요청에 따라 열람이 거부될 수 있습니다.<br>
                  - 콘텐츠 특성상 실사용 도중 해지 및 이에 따른 환불이 불가능합니다.<br>
                    단, 결제일로부터 7일 이내에 콘텐츠(텍스트, 영상 등 일체)를 시청하지 않은 경우에만 전액 환불이 가능합니다.(환불 수수료 없음)<br>
                  - 아이디 공유가 적발 될 경우, 이용 자격이 박탈되며 환불이 불가능합니다.<br>
                  - 기타 불법 공유 행위가 적발될 경우, 형사 고발 조치가 진행될 수 있습니다.<br>
                  - 결제에 따른 개인 정보는 '개인정보처리방침'에 근거하여 관리됩니다.
                </span>
               </div>
              </div>
            </div>
            <div class="grid payment_button">
              <button type="button" name="button">취소</button>
              <button type="button" name="button">결제</button>
            </div>

          </div> <!-- end of payment_wrap -->
        </div> <!-- end of inner_section -->
      </form>

    </section>

    <footer>

    </footer>
  </body>
</html>
