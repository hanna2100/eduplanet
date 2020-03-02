
<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="https://static.nid.naver.com/js/naverLogin_implicit-1.0.3.js" charset="utf-8"></script>
<?php
  include_once $_SERVER["DOCUMENT_ROOT"] . "/eduplanet/lib/db_connector.php";

  $mode = isset($_GET['mode']) ? $_GET['mode'] : "gm";
  $action = "/eduplanet/login_join/join_form.php?mode=" . $mode;
?>
<script type="text/javascript">
var naver_id_login = new naver_id_login("bVUclMb7FkFxQxcyDJLm", "http://localhost/eduplanet/login_join/login_form.php");
// 접근 토큰 값 출력
// 네이버 사용자 프로필 조회
  naver_id_login.get_naver_userprofile("naverSignInCallback()");
// 네이버 사용자 프로필 조회 이후 프로필 정보를 처리할 callback function
function naverSignInCallback() {
  var naver_id = naver_id_login.getProfileData('id');

  document.login_form.join_id.value = id;
  document.login_form.submit();
  naverConn(naver_id);
}
function naverConn(id) {
  var naver_id = id;
  var url = "members_checkId.php?id=" + naver_id + "&mode=" + mode;
  $.ajax({
    url: url,
    type: "POST",
    success: function(data){
      if(data == 1){
        document.getElementById("naver_id_login").value = kakao_no;
        document.getElementById("naver_email_login").value = kakao_email;

        document.naver_login_form.submit();
      } else {
        document.getElementById("naver_id").value = kakao_no;
        document.getElementById("naver_email").value = kakao_email;

        document.naver_form.submit();
        alert("아이디가 등록되어 있지 않아, 회원가입 페이지로 이동합니다.");
      }
    }
  });
}
</script>
<!-- 네이버 로그인 정보를 담는 form (회원가입)-->
<form name="naver_form" action=<?= $action ?> method="POST">
  <input id="naver_id" name="naver_id" type="hidden">
  <input id="naver_email" name="naver_email" type="hidden">
</form>
<!-- 네이버 로그인 정보를 담는 form (로그인)-->
<form name="naver_login_form" action="/eduplanet/login_join/naver_login.php?mode=<?= $mode ?>" method="POST">
  <input id="naver_id_login" name="naver_id_login" type="hidden">
  <input id="naver_email_login" name="naver_email_login" type="hidden">
</form>
