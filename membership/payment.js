
$(function () {
// function requestPay(){
   var IMP = window.IMP; // 생략가능
   IMP.init('imp62882300'); // 가맹점 식별코드 :imp62882300
   var msg;

   IMP.request_pay({
       pg : payMethod,
       pay_method : 'card',
       merchant_uid : 'merchant_' + new Date().getTime(), // 이걸 주문번호로 쓰면 된다
       name : '프리미엄'+ month + '개월',
       amount : final_price,
      // amount : <?= $final_price ?>,
      buyer_email : email,
      buyer_name : name,
      buyer_tel : phone_num,
       m_redirect_url : 'http://www.naver.com' // 모바일 결제시 사용
   }, function(rsp) {
       if ( rsp.success ) {
           //[1] 서버단에서 결제정보 조회를 위해 jQuery ajax로 imp_uid 전달하기
           jQuery.ajax({
               url: '/payments/complete', //cross-domain error가 발생하지 않도록 주의해주세요
               type: 'POST',
               dataType: 'json',
               data: {
                   imp_uid : rsp.imp_uid
                   // pg : rsp.pg,

                   //기타 필요한 데이터가 있으면 추가 전달
               }
           }).done(function(data) {
              console.log(rsp);
               //[2] 서버에서 REST API로 결제정보확인 및 서비스루틴이 정상적인 경우
               if ( everythings_fine ) {
                   msg = '결제가 정상적으로 완료되었습니다.';
                   msg += '\n고유ID : ' + rsp.imp_uid;
                   msg += '\n상점 거래ID : ' + rsp.merchant_uid;
                   msg += '\n결제 금액 : ' + rsp.paid_amount;
                   msg += '카드 승인번호 : ' + rsp.apply_num;

                   alert(msg);
               } else {
                   //[3] 아직 제대로 결제가 되지 않았습니다.
                   //[4] 결제된 금액이 요청한 금액과 달라 결제를 자동취소처리하였습니다.
               }
           });
           //성공시 이동할 페이지
           location.href='../index.php';
       } else {
           msg = '결제에 실패하였습니다.';
           msg += '에러내용 : ' + rsp.error_msg;
           //실패시 이동할 페이지
           // location.href='./index.php';
           alert('실패다냥?',rsp.error_msg);
       }
   });

// }
});
