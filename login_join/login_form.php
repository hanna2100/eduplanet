<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>에듀플래닛</title>

  <!-- favicon -->
  <link rel="shortcut icon" href="/eduplanet/img/favicon.png">

  <!-- 제이쿼리 -->
  <script src="http://code.jquery.com/jquery-1.12.4.min.js" charset="utf-8"></script>

  <!-- 카카오 로그인 -->
  <script src="//developers.kakao.com/sdk/js/kakao.min.js"></script>

  <!-- 자동완성 -->
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

  <!-- 폰트 -->
  <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR&amp;display=swap" rel="stylesheet">

  <!-- CSS -->
  <link rel="stylesheet" href="/eduplanet/index/index_header.css">
  <link rel="stylesheet" href="/eduplanet/mypage/css/review_write_popup.css">
  <link rel="stylesheet" href="./login.css">

  <!-- 스크립트 -->
  <script src="/eduplanet/mypage/js/review_write.js"></script>

</head>

<body>

  <header>
    <?php include_once $_SERVER["DOCUMENT_ROOT"] . "/eduplanet/index/index_header.php"; ?>
  </header>

  <?php
  $mode = isset($_GET['mode']) ? $_GET['mode'] : "gm";
  $action = "login.php?mode=" . $mode;
  ?>

  <section>
    <div id="main">
      <div id="form_wrapper">
        <h2> 일반 회원 LOGIN</h2>
        <form id="form_login" name="login_form" action="<?= $action ?>" method="post">

          <div class="formBox">
            <label for="inputId">아이디&nbsp;&nbsp;&nbsp;</label>
            <input type="text" class="formInput" id="inputId" name="inputId" required>
            <p class="subMsg" id="idSubMsg"></p>
          </div>
          <div class="formBox">
            <label for="inputPw">비밀번호</label>
            <input type="password" class="formInput" id="inputPw" name="inputPw" required>
            <p class="subMsg" id="pwSubMsg"></p>
          </div>
          <input type="button" id="btnFormSubmit" value="LOGIN" onclick="document.getElementById('form_login').submit()" disabled>

        </form>

        <p class="fieldset">
          <input type="checkbox" id="remember-me" checked>
          <label for="remember-me"> 로그인 상태 유지</label>
          <a id="find_password" href="./find_password.php?mode=<?=$mode?>" style="color:black">비번 찾기</a>
        </p>

        <hr>
        <div class="form_bottom">
          <table>
            <tr>
              <td style="border-right: 2px solid #f1f1f1;">
                아직 회원이 아니신가요?
                <span class="link join"><a href="./join_form.php?mode=gm">일반 회원 가입</a></span>
              </td>
              <td>
                <p>사업자 회원이시라면</p>
                <span class="link login"><a href="./login_form.php?mode=am">사업자 회원 LOGIN</a></span>
              </td>
            </tr>
          </table>
        </div>
      </div>
    </div>

  </section>

  <script>
    var mode = '<?= $mode ?>';

    if (mode == "am") {
      $("#main h2").html("사업자 회원 LOGIN");
      $(".join").html("<a href='./join_form.php?mode=am'>사업자 회원 가입</a>");
      $(".login").prev().html("일반 회원이시라면");
      $(".login").html("<a href='./login_form.php?mode=gm'>일반 회원 LOGIN</a>");

      // 카카오 script key 입력
      Kakao.init('03be234663870819293c389394e57405');
      Kakao.Auth.createLoginButton({
        container: '#kakao-login-btn',
        success: function(authObj) {
          Kakao.API.request({
            url: '/v2/user/me',
            success: function(res) {
              alert(JSON.stringify(res)); //<---- kakao.api.request 에서 불러온 결과값 json형태로 출력
              alert(JSON.stringify(authObj)); //<----Kakao.Auth.createLoginButton에서 불러온 결과값 json형태로 출력
              console.log(res.kakao_account.email); //<---- 콘솔 로그에 email 정보 출력 (어딨는지 알겠죠?)
              console.log(res.kakao_account.birthday); //<---- 콘솔 로그에 email 정보 출력 (어딨는지 알겠죠?)
              console.log(res.properties.nickname); //<---- 콘솔 로그에 닉네임 출력(properties에 있는 nickname 접근
              var id = res.id;
              var name = res.properties.nickname;
              console.log(id);
            }
          })
        },
        fail: function(err) {
          alert(JSON.stringify(err));
        }
      });

    }
  </script>

  <script src="./login.js"></script>

</body>

</html>
