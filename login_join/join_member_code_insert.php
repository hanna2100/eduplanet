<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>에듀플래닛</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css">
    <link rel="shortcut icon" href="/eduplanet/img/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR&amp;display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-latest.min.js" charset="utf-8"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
    <!-- CSS -->
    <link rel="stylesheet" href="/eduplanet/index/index_header.css">
    <link rel="stylesheet" href="/eduplanet/mypage/css/review_write_popup.css">
    <link rel="stylesheet" href="./login.css">

  </head>
  <body>

    <header>
        <?php
         include_once $_SERVER["DOCUMENT_ROOT"] . "/eduplanet/lib/db_connector.php";
         include_once $_SERVER["DOCUMENT_ROOT"] . "/eduplanet/index/index_header.php";
        ?>
    </header>


    <?php


        $code = $_GET['code'];
        $mode = $_GET['mode'];

        $id = $_GET['id'];
        $pw = $_GET['pw'];
        $tel = $_GET['tel'];
        $age = $_GET['age'];
        $intres = $_GET['intres'];


        $id = base64_decode($id);
        $pw = base64_decode($pw);
        $tel = base64_decode($tel);
        $age = base64_decode($age);
        $intres = base64_decode($intres);


     ?>



   <section>
     <div id="main">
       <div id="form_wrapper">
         <h2>회원가입 인증</h2>

           <div class="formBox">
             <label for="join_code">인증 번호</label>
             <input type="text" class="formInput" id="join_code" name="join_code" placeholder="인증 번호를 입력해주세요.">
             <p class="subMsg" id="joinCodeSubMsg"></p>
           </div>

           <input type="button" id="btn_join_code" class="btnForm" value="인증번호 입력" onclick="join_code_input();">

       </div>
     </div>
   </section>


   <script>

     function join_code_input(){

       var code = "<?=$code?>";
       var mode = "<?=$mode?>";
       var id = "<?=$id?>";
       var pw = "<?=$pw?>";
       var join_code_val = $("#join_code").val(); // 사용자가 입력한 임시 코드

       var tel = "<?=$tel?>";
       var age = "<?=$age?>";
       var intres = "<?=$intres?>";


       if(code == join_code_val){

         $.ajax({
           url : './g_members_insert.php',
           type : 'POST',
           data : {
             mode : mode,
             id : id,
             pw : pw,
             tel : tel,
             age : age,
             intres : intres
           },
           success : function(data) {
               if(data == 0){
                 alert("D/B insert 실패");
               }else{
                 console.log(data);
                 alert('회원가입이 완료되었습니다. \n로그인 해주세요.');
                 location.href = "/eduplanet/login_join/login_form.php?mode=<?=$mode?>";
               }
           },
           error : function() {
             alert("비밀번호 재설정 실패");
           }
         });

       }else{
         alert('인증 번호가 틀립니다. 다시 입력해 주세요');
         $("#join_code").val('');
       }

     };


   </script>



  </body>
</html>
