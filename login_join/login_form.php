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

             <div class="formBox">
               <label for="inputId">아이디&nbsp;&nbsp;&nbsp;</label><p class="subMsg" id="idSubMsg"></p>
               <input type="text" class="formInput" id="inputId" name="inputId" required>

             </div>
             <div class="formBox">
               <label for="inputPw">비밀번호&nbsp;&nbsp;&nbsp;</label><p class="subMsg" id="pwSubMsg"></p>
               <input type="password" class="formInput" id="inputPw" name="inputPw" required>

             </div>
             <input type="button" id="btnFormSubmit" value="LOGIN" onclick="document.getElementById('form_login').submit()" disabled>

           </form>

           <p class="fieldset">
						<input type="checkbox" id="remember-me" checked>
						<label for="remember-me"> 로그인 상태 유지</label>
					</p>

           <hr>
           <div class="form_bottom_wrapper">
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
     }
   </script>

   <script src="./login.js"></script>

  </body>
</html>
