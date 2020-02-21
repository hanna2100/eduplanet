
$(function () {
// function requestPay(){
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
         location.replace("./bill.php?product=프리미엄"+month+"개월&price="+final_price+"&payMethod="+payMethod+"&expired_date="+expired_date);          
       } else {
           msg = '결제에 실패하였습니다.';
           msg += '에러내용 : ' + rsp.error_msg;
           //실패시 이동할 페이지
           location.href='./index.php';
           alert('실패다냥?',rsp.error_msg);
       }
   });

// }
});
