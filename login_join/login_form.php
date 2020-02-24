<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <script src="http://code.jquery.com/jquery-1.12.4.min.js" charset="utf-8"></script>
  <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR&amp;display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./login.css">

  <body>
    <header>

    </header>

    <section>
       <div id="main">
         <h2> 로 그 인</h2>
          <div id="form_wrapper">
           <form id="form_login" name="login_form" action="login.php?mode=gm" method="post">
             <div class="formBox">
               <label for="inputId">아이디&nbsp;&nbsp;&nbsp;</label>
               <input type="text" class="formInput" id="inputId" name="inputId" required>
               <p class="subMsg" id="idSubMsg"></p>
             </div>
             <div class="formBox">
               <label for="inputPw">비밀번호</label>
               <input type="text" class="formInput" id="inputPw" name="inputPw" required>
               <p class="subMsg" id="pwSubMsg"></p>
             </div>
             <input type="button" id="btnFormSubmit" value="LOGIN" onclick="document.getElementById('form_login').submit()" disabled>
             <!-- <input type="button" id="btnFormSubmit" value="LOGIN" onclick="loginCheck();" disabled> -->
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
                   <span class="link"><a href="./join_form.php">회원가입</a></span>
                 </td>
                 <td>
                   기업 회원이시라면
                   <span class="link"><a href="./login_form.php?mode=am">기업회원 로그인</a></span>
                 </td>
               </tr>
             </table>
           </div>
         </div>
       </div>

   </section>

   <footer></footer>

   <script src="./login.js"></script>
   <script>
  
   </script>
  </body>
</html>
