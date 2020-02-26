<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <!-- favicon -->
    <link rel="shortcut icon" href="/eduplanet/img/favicon.png">
    <script src="http://code.jquery.com/jquery-1.12.4.min.js" charset="utf-8"></script>
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR&amp;display=swap" rel="stylesheet">
    <!-- 카카오 로그인 -->
    <script src="//developers.kakao.com/sdk/js/kakao.min.js"></script>
    <link rel="stylesheet" href="./login.css">
  </head>


  <body>
    <header>

    </header>

    <?php
      $mode = isset($_GET['mode']) ? $_GET['mode'] : "gm";
      $action = "login.php?mode=".$mode;
     ?>

    <section>
       <div id="main">
         <h2> 일반회원 로 그 인</h2>
          <div id="form_wrapper">
           <form id="form_login" name="login_form" action="<?=$action?>" method="post">

             <!-- <div id="kakao_btn_changed"> -->
               <!-- <a id="kakao-login-btn"></a> -->
               <!-- <a href="http://developers.kakao.com/logout"></a> -->
              <!-- <a id="custom-login-btn" href="javascript:loginWithKakao()">
              <img src="../img/Kakao_login_btn.png" width="300"/></a> -->
             <!-- </div> -->

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
					</p>

           <hr>
           <div class="form_bottom">
             <table>
               <tr>
                 <td style="border-right: 2px solid #f1f1f1;">
                   아직 회원이 아니신가요?
                   <span class="link join"><a href="./join_form.php?mode=gm">일반회원 가입</a></span>
                 </td>
                 <td>
                   <p>학원 회원이시라면</p>
                   <span class="link login"><a href="./login_form.php?mode=am">학원회원 로그인</a></span>
                 </td>
               </tr>
             </table>
           </div>
         </div>
       </div>

   </section>

   <footer></footer>
   <script>
     var mode = '<?=$mode?>';
     if(mode == "am"){
       $("#main h2").html("학원회원 로그인");
       $(".join").html("<a href='./join_form.php?mode=am'>학원회원 가입</a>");
       $(".login").prev().html("일반 회원이시라면");
       $(".login").html("<a href='./login_form.php?mode=gm'>일반회원 로그인</a>");

       // 카카오 script key 입력
  Kakao.init('03be234663870819293c389394e57405');
  Kakao.Auth.createLoginButton({
    container: '#kakao-login-btn',
    success: function(authObj) {
      Kakao.API.request({
        url : '/v2/user/me',
        success: function(res){
          alert(JSON.stringify(res)); //<---- kakao.api.request 에서 불러온 결과값 json형태로 출력
          alert(JSON.stringify(authObj)); //<----Kakao.Auth.createLoginButton에서 불러온 결과값 json형태로 출력
          // console.log(res.id);//<---- 콘솔 로그에 id 정보 출력(id는 res안에 있기 때문에  res.id 로 불러온다)
          console.log(res.kakao_account.email);//<---- 콘솔 로그에 email 정보 출력 (어딨는지 알겠죠?)
          console.log(res.kakao_account.birthday);//<---- 콘솔 로그에 email 정보 출력 (어딨는지 알겠죠?)
          console.log(res.properties.nickname);//<---- 콘솔 로그에 닉네임 출력(properties에 있는 nickname 접근
      // res.properties.nickname으로도 접근 가능 )
          // console.log(authObj.access_token);//<---- 콘솔 로그에 토큰값 출력
          // console.log(res.properties['birthday']);
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

 // 로그인 처리
// function loginWithKakao(){
//   console.log("eee");
//     Kakao.Auth.cleanup();
//     Kakao.Auth.login({
//         persistAccessToken: true,
//         persistRefreshToken: true,
//         success: function(authObj) {
//           Kakao.API.request({
//             url : '/v2/user/me',
//             success: function(res){
//               alert(JSON.stringify(res)); //<---- kakao.api.request 에서 불러온 결과값 json형태로 출력
//               alert(JSON.stringify(authObj)); //<----Kakao.Auth.createLoginButton에서 불러온 결과값 json형태로 출력
//               // console.log(res.id);//<---- 콘솔 로그에 id 정보 출력(id는 res안에 있기 때문에  res.id 로 불러온다)
//               console.log(res.kakao_account.email);//<---- 콘솔 로그에 email 정보 출력 (어딨는지 알겠죠?)
//               console.log(res.kakao_account.birthday);//<---- 콘솔 로그에 email 정보 출력 (어딨는지 알겠죠?)
//               console.log(res.properties.nickname);//<---- 콘솔 로그에 닉네임 출력(properties에 있는 nickname 접근
//           // res.properties.nickname으로도 접근 가능 )
//               // console.log(authObj.access_token);//<---- 콘솔 로그에 토큰값 출력
//               // console.log(res.properties['birthday']);
//               var id = res.id;
//               var name = res.properties.nickname;
//               console.log(id);
//               // setCookie("kakao_login","done",1); // 쿠키생성 (로그인)
//               //alert(cookiedata);
//               // createLogoutKakao();
//               window.location.href="../index.php";
//             }
//           })
//         },
//             fail: function(err) {
//               alert(JSON.stringify(err));
//         }
//     });
// }



     }
   </script>

   <script src="./login.js"></script>

  </body>
</html>
