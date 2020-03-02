<script type="text/javascript">
  var naverLogin = new naver.LoginWithNaverId({
    clientId: "bVUclMb7FkFxQxcyDJLm",
    callbackUrl: "http://localhost/eduplanet/login_join/naver_callback.php",
    isPopup: false, /* 팝업을 통한 연동처리 여부 */
    loginButton: {color: "green", type: 3, height: 60}/* 로그인 버튼의 타입을 지정 */
  });
  naverLogin.init();

  naverLogin.getLoginStatus(function (status) {
    if (status) {
      var email = naverLogin.user.getEmail();
      var name = naverLogin.user.getNickName();
      var profileImage = naverLogin.user.getProfileImage();
      var birthday = naverLogin.user.getBirthday();
      var uniqId = naverLogin.user.getId();
      var age = naverLogin.user.getAge();
      console.log(email);
      console.log(name);


      var array = email.split("@");
      naverLogin.logout();
      location.href="http://<?= $_SERVER['HTTP_HOST'];?>/eduplanet/login_join/join_form.php?userid="+email+"&username="+array[0]+"&usermember_type=sns_log";
    } else {
      console.log("AccessToken이 올바르지 않습니다.");
    }
  });
</script>
