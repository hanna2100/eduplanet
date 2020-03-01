<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css">
    <link rel="shortcut icon" href="/eduplanet/img/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR&amp;display=swap" rel="stylesheet">
    <script src="http://code.jquery.com/jquery-latest.min.js" charset="utf-8"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
    <!-- CSS -->
    <link rel="stylesheet" href="/eduplanet/index/index_header.css">
    <link rel="stylesheet" href="/eduplanet/mypage/css/review_write_popup.css">
    <link rel="stylesheet" href="./login.css">

  </head>
  <body>

    <?php

      include_once $_SERVER["DOCUMENT_ROOT"] . "/eduplanet/lib/db_connector.php";
      $hash = isset($_GET["hash"]) ? $_GET["hash"] : "";
      $mode = isset($_GET["mode"]) ? $_GET["mode"] : "";

      if($mode == "gm"){
        $table = "g_members";
      }else if($mode == "am"){
        $table = "a_members";
      }

     ?>

   <header>
       <?php
        include_once $_SERVER["DOCUMENT_ROOT"] . "/eduplanet/index/index_header.php";
       ?>
   </header>


   <section>
     <div id="main">
       <div id="form_wrapper">
         <h2>비밀번호 재설정</h2>

           <div class="formBox">
             <label for="temp_pw">임시 번호</label>
             <input type="text" class="formInput" id="temp_pw" name="temp_pw" placeholder="임시 번호를 입력해주세요.">
             <p class="subMsg" id="tempPwSubMsg"></p>
           </div>

           <div class="formBox">
             <label for="inputPw1">비밀번호</label>
             <input type="password" class="formInput" id="inputPw1" name="inputPw1" placeholder=" 새 비밀번호를 입력해주세요" required>
           </div>

           <div class="formBox">
             <label for="inputPw2">비밀번호 확인</label>
             <input type="password" class="formInput" id="inputPw2" name="inputPw2" placeholder="새 비밀번호 확인" required>
             <p class="subMsg" id="pwSubMsg"></p>
           </div>

           <input type="button" id="btn_update_pw" class="btnForm" value="비밀번호 변경" onclick="reset_pw();" disabled>

       </div>
     </div>
   </section>




   <script src="reset_pw.js"></script>

    <script>

      function reset_pw(){
        var hash = "<?=$hash?>";
        var table = "<?=$table?>";
        var temp_pw_val = $("#temp_pw").val();
        var inputPw1_val = $("#inputPw1").val();
        console.log("hash", hash);
        console.log("table", table);
        console.log("input val", temp_pw_val, inputPw1_val);
        $.ajax({
          url : './reset_pw.php',
          type : 'POST',
          data : {
            hash : hash,
            table : table,
            temp_pw : temp_pw_val,
            new_pw : inputPw1_val
          },
          success : function(data) {
              if(data == 0){
                alert("임시번호가 일치하지 않습니다.");
                temp_pw_val = "";
              }else{
                alert("비밀번호가 변경되었습니다.\n 다시 로그인 해주세요.");
                location.href = './login_form.php';
              }
          },
          error : function() {
            alert("비밀번호 재설정 실패");
          }
        });
      }

    </script>


  </body>
</html>
