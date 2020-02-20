<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="utf-8">
    <title>멤버십 결제페이지</title>
     <script src="http://code.jquery.com/jquery-1.12.4.min.js" charset="utf-8"></script>
     <script type="text/javascript" src="https://cdn.iamport.kr/js/iamport.payment-1.1.5.js"></script>
     <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR&amp;display=swap" rel="stylesheet">
     <link rel="stylesheet" href="./css/payment.css">
  </head>
  <body>
    <header>
       <?php
       // include "../index_header.php";
       ?>
    </header>


    <section>
      <?php
        include "../lib/db_connector.php";
        if(isset($_GET['month']) && isset($_GET['discount']) && isset($_GET['price'])){
          $month = $_GET['month'];
          $discount = $_GET['discount'];
          $price = $_GET['price'];
        }else {
          echo "값이 안들어옴 ";
        }
        // 이용기간
          $today = date('yy.m.d');
          $expired_date = strtotime("+".$month." month");
        // 할인가
          $discounted_price = $price * $discount*0.01;
        // 구매 가격 +부가세 = 최종 실제 카드에서 빠져나가는 금액
          $final_price = $price-$discounted_price+(($price-$discounted_price)*0.1);

       ?>

      <form id="paypaygo" onsubmit="return paymentCheck()" action="./receipt.php?month=<?=$month?>&final_price=<?=$final_price?>&expired_date=<?=$expired_date?>" method="post">
        <div class="inner_section">
          <div class="payment_wrap">

            <div class="grid payment_header">
              <h2>프리미엄 - <span><?=$month?></span>개월 결제</h2>
              <div class="period">이용기간 <span><?=$today?></span> ~ <span><?=date("yy.m.d", $expired_date)?></span></div>
            </div>

            <div class="grid payment_contents">
              <table>
                <tr>
                  <td class="payment_key">상품 가격</td>
                  <td class="payment_value"><?=number_format($price)?>원</td>
                </tr>
                <tr>
                  <td class="payment_key">할인가 <span id="discount_tag"> <?=$discount?>%할인</span></td>
                  <td class="payment_value">-<?=number_format($discounted_price)?>원</td>
                </tr>
                <tr>
                  <td class="payment_key">구매 가격</td>
                  <td class="payment_value discounted_price"><?=number_format($price-$discounted_price)?>원</td>
                </tr>
                <tr>
                  <td class="payment_key">부가세(10%)</td>
                  <td class="payment_value"><?=number_format(($price-$discounted_price)*0.1)?>원</td>
                </tr>
                <tr id="payment_sum">
                  <td class="payment_key">총 결제금액</td>
                  <td class="payment_value"><?=number_format($final_price)?>원</td>
                </tr>
              </table>
            </div>

            <div class="grid payment_method">
              <h3>결제 수단</h3>
              <div class="method_wrap">
                <ul class="button_ty_radio_list">
                  <li>
                    <label class="button_payMethod_box" value="credit_card">
                      <input type="radio" class="jply_radio_item" name="payMethod" value="html5_inicis.INIpayTest">
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
                      <input type="radio" class="jply_radio_item" name="payMethod" value="danal">
                      <span class="radio_icon"></span>
                      <span class="radio_text">휴대폰 소액결제</span>
                    </label>
                  </li> -->
                  <li>
                    <label class="button_payMethod_box" value="kakaopay">
                      <input type="radio" class="jply_radio_item" name="payMethod" value="kakaopay">
                      <span class="radio_icon"></span>
                      <span class="radio_text icon_text">카카오페이</span>
                    </label>
                  </li>
                  <li>
                    <label class="button_payMethod_box" value="payco">
                      <input type="radio" class="jply_radio_item" name="payMethod" value="payco">
                      <span class="radio_icon"></span>
                      <span class="radio_text icon_text">페이코</span>
                    </label>
                  </li>
                  <li>
                    <label class="button_payMethod_box" value="smilepay">
                      <input type="radio" class="jply_radio_item" name="payMethod" value="smilepay">
                      <span class="radio_icon"></span>
                      <span class="radio_text icon_text">스마일페이</span>
                    </label>
                  </li>
                </ul>
                <span id="payMethod_info"></span>
              </div> <!-- end of method_wrap -->
            </div> <!-- end of payment_method -->

            <div class="grid payment_member_info">
              <h3>구매자 정보</h3>
              <div class="member_info_wrap">
                <div class="member_info_box">
                  <div class="member_info_title">결제자 이름</div>
                  <input type="text" name="name" id="input_name" class="member_info_input" placeholder="결제자, 입금자 이름" value="">
                </div>
                <div class="member_info_box">
                  <div class="member_info_title">연락처</div>
                  <input type="tel" name="phone_num" id="input_tel" class="member_info_input" placeholder="'-'제외. 예) 01011112222" value="">
                </div>
                <div class="member_info_box">
                  <div class="member_info_title">결제알림 이메일</div>
                  <input type="email" name="email" id="input_email" class="member_info_input" placeholder="예) user@email.com" value="">
                </div>
              </div>
            </div>

            <div class="grid payment_agree">
              <label class="payment_agree_head">
                <input type="checkbox" name="agree_checkbox" id="agree">
                <span class="checkbox_icon"></span>
                <span class="checkbox_text">이용약관 및 유의사항에 동의합니다.</span>
              </label>
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
              <button type="button" name="button" onclick="alert_back('결제를 취소합니다.');">취소</button>
              <button type="button" name="button" id="pay_commit" onclick="paymentCheck();">결제</button>
            </div>

          </div> <!-- end of payment_wrap -->
        </div> <!-- end of inner_section -->
      </form>

    </section>

    <footer>

    </footer>
    <script>
      var label = document.getElementsByClassName("button_payMethod_box");
      var payMethod_info = document.getElementById("payMethod_info");
      var kakao_info = "[KaKaoPay 이용 안내] 지원카드사 : 삼성카드, 하나카드, KB국민카드, 신한카드, 현대카드, 롯데카드, BC카드(씨티카드 제외)";
      var payco_info = "[Payco 이용 안내] PAYCO는 NHN엔터테인먼트가 만든 안전한 간편결제 서비스입니다.";
      var smile_info = "[SmilePay 이용 안내] 지원카드사 : KB국민카드, 광주은행BC카드, 전북은행BC카드, 현대카드, 롯데카드, BC카드";

      var payment_button = document.getElementsByClassName("payment_button");
      var pay_commit = document.getElementById("pay_commit");

      function addInfo(label, value, content){
        let isSelected = false;
        label.addEventListener("click", function(){
        //   if(isSelected === false){
        //     label.classList.remove("selected");
        //     isSelected = true;
        //     return;
        //   }else if(isSelected === true){
        //     label.classList.add("selected");
        //     isSelected = false;
        //   }

         // if(label.classList.contains("selected")){
         //   label.classList.remove("selected");
         // }else{
         //   label.classList.add("selected");
         // }

           console.log(label);
          payMethod_info.innerHTML = "";
          payMethod_info.appendChild(document.createTextNode(content));
        });
      };

      // 신용카드 클릭시 설명 삭제
      addInfo(label[0], "credit_card", "");

      // 카카오페이 상세 설명
      addInfo(label[1], "kakaopay", kakao_info);

      // 페이코 상세 설명
      addInfo(label[2], this.value, payco_info);

      // 스마일페이 상세 설명
      addInfo(label[3], this.value, smile_info);

      function paymentCheck(){
        var agree = document.getElementById("agree");
        var agreeChecked = $(agree).prop("checked");
        var MethodChecked = $("input:radio[name='payMethod']").is(":checked");
        var input_name = document.getElementById("input_name");
        var input_tel = document.getElementById("input_tel");
        var input_email = document.getElementById("input_email");

        if(MethodChecked === false) {
          alert("결제수단을 선택해주세요.");
          return false;
        }else if(input_name.value === "") {
          alert("이름을 입력해주세요.");
          return false;
        }else if(input_tel.value === "") {
          alert("연락처를 입력해주세요.");
          return false;
        }else if(input_email.value === "") {
          alert("이메일을 입력해주세요.");
          return false;
        }else if(agreeChecked === false) {
          alert("반드시 이용약관 및 유의사항에 동의해주세요.");
          return false;
        }
           document.getElementById("paypaygo").submit();
      }


    </script>
  </body>
</html>
