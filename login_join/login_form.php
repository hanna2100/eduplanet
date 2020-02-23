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
    <main>
     <center>

       <div id="main">
         <h2>로 그 인</h2>
         <form id="form_login" action="./login.php" method="post">
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
         </form>
       </div>
     </center>
   </main>

   <script src="./login.js"></script>
  </body>
</html>
