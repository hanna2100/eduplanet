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

  <!-- 아이콘 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css">

  <!-- CSS -->
  <link rel="stylesheet" href="/eduplanet/index/index_header.css">
  <link rel="stylesheet" href="/eduplanet/mypage/css/review_write_popup.css">
  <link rel="stylesheet" href="./login.css">

  <!-- 스크립트 -->
  <script src="/eduplanet/mypage/js/review_write.js"></script>



</head>
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
            <label for="inputId">아이디 (이메일)</label>
            <input type="text" class="formInput" id="inputId" name="inputId" placeholder="이메일을 입력해 주세요." required>
            <p class="subMsg" id="idSubMsg"></p>
          </div>
          <div class="formBox">
            <label for="inputPw">비밀번호</label>
            <input type="password" class="formInput" id="inputPw" name="inputPw" placeholder="비밀번호를 입력해 주세요." required>
            <p class="subMsg" id="pwSubMsg"></p>
          </div>

          <p class="fieldset">
            <input type="checkbox" id="remember-me" name="auto_login" value="2">
            <label for="remember-me"> 로그인 상태 유지</label>
            <a id="find_password" href="./find_password.php?mode=<?=$mode?>" style="color:black">비밀번호 찾기</a>
          </p>

          <input type="button" id="btnFormSubmit" class="btnForm" value="LOGIN" onclick="document.getElementById('form_login').submit()" disabled>

        </form>


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
            <?php
              // 네이버 로그인 접근토큰 요청 예제
              $client_id = "bVUclMb7FkFxQxcyDJLm";
              $redirectURI = urlencode("http://localhost/eduplanet/login_join/login_form.php");
              $state = "RAMDOM_STATE";
              $apiURL = "https://nid.naver.com/oauth2.0/authorize?response_type=code&client_id=".$client_id."&redirect_uri=".$redirectURI."&state=".$state;
            ?>

          </table>
          <div class="social_button">
            <div id="kakao_login_button" onclick="kakaoConn();"><img src="/eduplanet/img/kakao_login_button.png" alt="kakao_login_button"></div>
            <div id="naver_id_login"></div>
            <a href="<?php echo $apiURL ?>"><img height="46" src="../img/naver_login_button.png"/></a>
          </div>

        </div>
      </div>
    </div>

  </section>

  <!-- 카카오 로그인 ------------------------------------------------------------------------------------------->

  <!-- 일반회원 / 사업자 회원 구분해서 form 전송 -->
  <?php
  include_once $_SERVER["DOCUMENT_ROOT"] . "/eduplanet/lib/db_connector.php";

  $mode = isset($_GET['mode']) ? $_GET['mode'] : "gm";
  $action = "/eduplanet/login_join/join_form.php?mode=" . $mode;
  ?>

  <!-- 카카오 로그인 정보를 담는 form (회원가입)-->
  <form name="kakao_form" action=<?= $action ?> method="POST">
    <input id="kakao_id" name="kakao_id" type="hidden">
    <input id="kakao_email" name="kakao_email" type="hidden">
  </form>

  <!-- 카카오 로그인 정보를 담는 form (로그인)-->
  <form name="kakao_login_form" action="/eduplanet/login_join/kakao_login.php?mode=<?= $mode ?>" method="POST">
    <input id="kakao_id_login" name="kakao_id_login" type="hidden">
    <input id="kakao_email_login" name="kakao_email_login" type="hidden">
  </form>

  <script>
    // 사용할 앱의 JavaScript 키 설정
    Kakao.init('c0edd7bb36cbb280cb4e498b294c87be');

    function kakaoConn() {

      Kakao.Auth.logout();

    // 카카오 로그인 버튼 생성
    Kakao.Auth.loginForm({

      success: function(authObj) {

        // 로그인 성공 시, API 호출
        Kakao.API.request({

          url: '/v2/user/me',

          success: function(res) {

            //alert(JSON.stringify(res)); // kakao.api.request 에서 불러온 결과값 json형태로 출력
            //alert(JSON.stringify(authObj)); // Kakao.Auth.createLoginButton에서 불러온 결과값 json형태로 출력
            console.log(res.id); // id 정보 출력
            console.log(res.kakao_account.email); // 이메일 정보 출력
            console.log(authObj.access_token); // 토큰 값 출력

            // 카카오 로그인해서 가져온 값 변수에 저장
            var kakao_no = res.id;
            var kakao_email = res.kakao_account.email;

            // DB에 같은 아이디가 있는지 검사
            var url = "members_checkId.php?id=" + kakao_email + "&mode=" + mode;

            $.ajax({

              url: url,
              type: "GET",
              success: function(data) {

                // 이미 이메일이 가입되어 있을 때 --> 카카오 로그인
                if (data == 1) {

                  document.getElementById("kakao_id_login").value = kakao_no;
                  document.getElementById("kakao_email_login").value = kakao_email;

                  document.kakao_login_form.submit();

                  // 이메일이 가입되어 있지 않을 때 --> form 으로 이메일을 넘겨서 회원가입
                } else {
                  document.getElementById("kakao_id").value = kakao_no;
                  document.getElementById("kakao_email").value = kakao_email;

                  document.kakao_form.submit();
                  alert("아이디가 등록되어 있지 않아, 회원가입 페이지로 이동합니다.");
                }
              },
              error: function() {
                console.log("이메일 가입확인 ajax 실패");
              }
            });
          },
          fail: function(error) {
            alert(JSON.stringify(error));
          }
        });
      },
      fail: function(err) {
        alert(JSON.stringify(err));
      }
    });
  } // end of kakaoConn();
  </script>

  <!-- 카카오 로그인 ------------------------------------------------------------------------------------------->

  <!-- 네이버 로그인 ------------------------------------------------------------------------------------------->

  <!-- naver -->
  <script type="text/javascript" src="https://static.nid.naver.com/js/naverLogin_implicit-1.0.3.js" charset="utf-8"></script>
  <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
  <script type="text/javascript" src="https://static.nid.naver.com/js/naveridlogin_js_sdk_2.0.0.js" charset="utf-8"></script>

  <?php
    define( 'NAVER_OAUTH_AUTHORIZE_URL', 'https://nid.naver.com/oauth2.0/authorize' );
	  define( 'NAVER_OAUTH_TOKEN_URL', 'https://nid.naver.com/oauth2.0/token' );
	  define( 'NAVER_GET_USERINFO_URL', 'https://apis.naver.com/nidlogin/nid/getUserProfile.xml');

    $token = "AAAAOUoBq0kF4D87SvdAD2MS_iJYh2w7BEKPc3ayDU9nRtmwEuRTdwbvEkqn76gwgZNo5gQ1n8YwS7ZLCd98agAPmDo";
    $header = "Bearer ".$token; // Bearer 다음에 공백 추가
    $url = "https://openapi.naver.com/v1/nid/me";
    $is_post = false;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, $is_post);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $headers = array();
    $headers[] = "Authorization: ".$header;
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $response = curl_exec ($ch);
    $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    echo "status_code:".$status_code."<br>";
    curl_close ($ch);
    if($status_code == 200) {
      echo $response;
    } else {
      echo "Error 내용:".$response;
    }
  ?>

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

  <!-- 네이버 로그인 ------------------------------------------------------------------------------------------->


<script>
    var mode = '<?= $mode ?>';

    if (mode == "am") {
      $("#main h2").html("사업자 회원 LOGIN");
      $(".join").html("<a href='./join_form.php?mode=am'>사업자 회원 가입</a>");
      $(".login").prev().html("일반 회원이시라면");
      $(".login").html("<a href='./login_form.php?mode=gm'>일반 회원 LOGIN</a>");
    }
  </script>

  <script src="./login.js"></script>
</body>

</html>
