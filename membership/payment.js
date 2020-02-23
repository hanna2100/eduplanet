
// 사용자가 입력하지 않는 내용이 있을 경우 결제 불가
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
    return requestPay();
}

// 결제수단 선택시 css 변화 및 하단에 이용 안내
  var label = document.getElementsByClassName("button_payMethod_box");
  var payMethod_info = document.getElementById("payMethod_info");
  var kakao_info = "[KaKaoPay 이용 안내] 지원카드사 : 삼성카드, 하나카드, KB국민카드, 신한카드, 현대카드, 롯데카드, BC카드(씨티카드 제외)";
  var payco_info = "[Payco 이용 안내] PAYCO는 NHN엔터테인먼트가 만든 안전한 간편결제 서비스입니다.";
  var smile_info = "[SmilePay 이용 안내] 지원카드사 : KB국민카드, 광주은행BC카드, 전북은행BC카드, 현대카드, 롯데카드, BC카드";

  var payment_button = document.getElementsByClassName("payment_button");
  var pay_commit = document.getElementById("pay_commit");

  // 신용카드 클릭시 설명 삭제
  addInfo(label[0], "");

  // 카카오페이 상세 설명
  addInfo(label[1], kakao_info);

  // 페이코 상세 설명
  addInfo(label[2], payco_info);

  // 스마일페이 상세 설명
  addInfo(label[3], smile_info);

  function addInfo(label, content){
    label.addEventListener("click", function(){
        label.classList.add("selected");
        $(this).parent().siblings().children().removeClass("selected");
        payMethod_info.innerHTML = "";
        payMethod_info.appendChild(document.createTextNode(content));
    });
  };


  // 결제 처리
  function requestPay(){
     var payMethod = $("input:radio[name='payMethod']:checked").val();
     var name = input_name.value;
     var phone_num = input_tel.value;
     var email = input_email.value;

     var IMP = window.IMP; // 생략가능
     IMP.init('imp62882300'); // 가맹점 식별코드 :imp62882300
     var msg;

     IMP.request_pay({
         pg : payMethod,
         pay_method : 'card',
         expired_date : expired_date,
         merchant_uid : 'merchant_' + new Date().getTime(), // 이걸 주문번호로 쓰면 된다
         name : '프리미엄'+ month + '개월',
         amount : final_price,
         buyer_email : email,
         buyer_name : name,
         buyer_tel : phone_num,
         m_redirect_url : 'http://www.naver.com' // 모바일 결제시 사용
     }, function(rsp) {
         if ( rsp.success ) {
           location.replace("./receipt.php?product=프리미엄"+month+"개월&price="+final_price+"&payMethod="+payMethod+"&expired_date="+expired_date);
         } else {
             location.href='#';  //실패시 이동할 페이지
             console.log(rsp.error_msg);
             alert('결제에 실패하였습니다.',rsp.error_msg);
         }
     });

}
