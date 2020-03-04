<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>에듀플래닛</title>

  <!-- favicon -->
  <link rel="shortcut icon" href="/eduplanet/img/favicon.png">

  <script src="http://code.jquery.com/jquery-latest.min.js" charset="utf-8"></script>

  <!-- 폰트 -->
  <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR&amp;display=swap" rel="stylesheet">

  <!-- 아이콘 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css">

  <!-- 자동완성 -->
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

  <!-- CSS -->
  <link rel="stylesheet" href="/eduplanet/index/index_header.css">
  <link rel="stylesheet" href="/eduplanet/mypage/css/review_write_popup.css">
  <link rel="stylesheet" href="./join.css">

</head>

<body>

<header>
  <?php
  include_once $_SERVER["DOCUMENT_ROOT"] . "/eduplanet/index/index_header.php";
  ?>
</header>

<section>
  <div class="">
    <h1> </h1>
  </div>
</section>

</body>

</html>






<?php
  // openssl관련 에러 나는 경우 : php.ini 파일에서 openssl.dil 주석 해제하고 아파치 재실행하기!
  include_once '../lib/PHPMailer/PHPMailerAutoload.php';
  include_once $_SERVER["DOCUMENT_ROOT"] . "/eduplanet/lib/db_connector.php";

  date_default_timezone_set('Asia/Seoul');
  $today = date("Y-m-d");

  srand((double)microtime()*1000000); //난수값 초기화
  $code = rand(100000,999999);

  $mode = $_GET['mode'];
  $id_email = test_input($_POST['inputId']);
  $pw = test_input($_POST['inputPw1']);

  $id = base64_encode($id_email);
  $pw = base64_encode($pw);

  if($mode == "gm"){

      $tel = test_input($_POST['inputTel']);
      $age = test_input($_POST['inputAge']);
      $intres = test_input($_POST['inputIntres']);

      $tel = base64_encode($tel);
      $age = base64_encode($age);
      $intres = base64_encode($intres);

      $url = "http://localhost/eduplanet/login_join/join_member_code_insert.php?code=$code&mode=$mode&id=$id&pw=$pw&tel=$tel&age=$age&intres=$intres";

  }


        $to=$id_email;      
        $from="eduplanet 관리자";
        $subject="eduplanet 회원가입 인증 확인 메일";
        $body="\n\n안녕하세요!
               \n\n에듀플래닛에 가입해 주셔서 감사합니다!
               \n\n아래 링크를 클릭하여 인증번호를 입력해 주시면 회원가입이 완료 됩니다.
               \n\n인증 번호 : ".$code."
               \n\n".$url."";

               mailer($from,"iamashley44@naver.com", $to, $subject, $body);



    function join_mailing_success(){

      echo "
        <script>
            alert('회원가입 인증 메일을 보냈습니다! 메일을 확인해주세요.');
            self.close();
        </script>
      ";
    }

    function join_mailing_fail(){

      echo "
        <script>
            alert('이메일 전송에 실패했습니다. 다시 시도해주세요.');
            location.href='./join_form.php';
        </script>
      ";
    }






    function mailer($fname, $fmail, $to, $subject, $content, $type=0, $file="", $cc="", $bcc="")
    {
          if ($type != 1) $content = nl2br($content);

          // type : text=0, html=1, text+html=2
          $mail = new PHPMailer(); // defaults to using php "mail()"

          // 디버그 모드(production 환경에서는 주석 처리한다.)
          // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
          // $mail->SMTPDebug = 2;
          // $mail->SMTPDebug = 4;

          $mail->IsSMTP();

          $mail->SMTPSecure = "ssl";
          $mail->SMTPAuth = true;
          $mail->Host = "smtp.naver.com";
          $mail->Port = 465;
          $mail->Username = "iamashley44@naver.com";
          $mail->Password = "249EYBG2KCJX";
          $mail->CharSet = 'UTF-8';
          $mail->From = $fmail;
          $mail->FromName = $fname;
          $mail->Subject = $subject;
          $mail->AltBody = ""; // optional, comment out and test
          $mail->msgHTML($content);
          $mail->addAddress($to);
          if ($cc)
                $mail->addCC($cc);
          if ($bcc)
                $mail->addBCC($bcc);
          if ($file != "") {
                foreach ($file as $f) {
                      $mail->addAttachment($f['path'], $f['name']);
                }
          }
          if ( $mail->send() ){
            join_mailing_success();
          }else{
            join_mailing_fail();
            // echo "실패....";
          }
    }
 ?>
