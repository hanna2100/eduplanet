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
  </head>
  <body>

    <header>
        <?php
         include_once $_SERVER["DOCUMENT_ROOT"]."/eduplanet/lib/session_start.php";
         // include_once $_SERVER["DOCUMENT_ROOT"]."/eduplanet/index/index_header_searchbar_in.php";
         $mode = $_GET["mode"];
        ?>
    </header>

    <h2>비번 찾기</h2>
    <p>이메일을 입력해주세요</p>
    <input type="email" id="inputEmail" name="inputEmail" value="">
    <p class="subMsg" id="emailSubMsg"></p>
    <input type="button" id="btn_find_pw" value="비밀번호 찾기"  disabled>

    <script>
    var mode = '<?=$mode?>';
    $(document).ready(function(){
      var inputEmail = $("#inputEmail");

      inputEmail.keyup(function(){
        var emailValue = inputEmail.val();
        var exp = /^[\w_\.\-]+@[\w\-]+\.[\w\-]+/;
          if(!exp.test(emailValue)){
            $("#emailSubMsg").text("이메일 형식이 올바르지 않습니다.");
            $("#btn_find_pw").attr("disabled", true);
          }else{
            $("#emailSubMsg").text("");
            $("#btn_find_pw").attr("disabled", false);
          }
      });

      $("#btn_find_pw").click(function(event){
          var emailValue = inputEmail.val();
        $.ajax({
          url : './find_pw_email_check.php',
          type : 'POST',
          data : {
            email : emailValue,
            mode : mode
          },
          success : function(data) {
            code = data;
              if(data == 0){
                console.log("데이터", data);
                alert("등록되지않은 이메일입니다.");
              }else{
                alert("임시 비밀번호가 전송되었습니다!");
              }
          },
          error : function() {
            alert("이메일 체크 실패");
          }
        });
      });
    });

    </script>


  </body>
</html>
