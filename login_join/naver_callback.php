<script type="text/javascript">
  var naver_id_login = new naver_id_login("bVUclMb7FkFxQxcyDJLm", "http://localhost/eduplanet/login_join/login_form.php");
  // 접근 토큰 값 출력 alert(naver_id_login.oauthParams.access_token); 네이버 사용자 프로필 조회
  naver_id_login.get_naver_userprofile("naverSignInCallback()");
  // 네이버 사용자 프로필 조회 이후 프로필 정보를 처리할 callback function
  function naverSignInCallback() {
    var naver_id = naver_id_login.getProfileData('id');
    console.log(naver_id);
    var naver_email = naver_id_login.getProfileData('email');
    console.log(naver_email);
    var naver_email_arr = naver_email.split('@');
    document.getElementById("inputId").value = naver_name;
    document.naver_login_form.submit();
  }
</script>
