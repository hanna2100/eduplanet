<?php
  // openssl관련 에러 나는 경우 : php.ini 파일에서 openssl.dil 주석 해제하고 아파치 재실행하기!
  include_once '../lib/PHPMailer/PHPMailerAutoload.php';
  include_once $_SERVER["DOCUMENT_ROOT"] . "/eduplanet/lib/db_connector.php";

  $email = $_POST["email"];
  $mode = $_POST["mode"];

  if($mode == "gm"){
    $sql="SELECT * FROM g_members where email = '$email'";
  }else if($mode == "am"){
    $sql="SELECT * FROM a_members where email = '$email'";
  }

      $result = mysqli_query($conn,$sql);

      if (!$result) {
        die('Error: ' . mysqli_error($conn));
      }

      $rowcount=mysqli_num_rows($result);

      if($rowcount){
        srand((double)microtime()*1000000); //난수값 초기화
        $code=rand(100000,999999);
        echo $code;
        //   $count=1;
        $to=$email;
        $from="eduplanet 관리자";
        $subject="eduplanet 비밀번호 변경 확인 메일";
        $body="안녕하세요, \n 임시 비밀번호 입니다.\n임시 비밀번호 : ".$code."\n정확히 입력해주세요.";

        mailer($from,"eduplanet_ad@naver.com", $to, $subject, $body);
        } else {
          echo "0";
          // echo "unregistered";
          return false;
        }

    mysqli_close($conn);

    function mailer($fname, $fmail, $to, $subject, $content, $type=0, $file="", $cc="", $bcc="")
    {
          if ($type != 1) $content = nl2br($content);

          // type : text=0, html=1, text+html=2
          $mail = new PHPMailer(); // defaults to using php "mail()"

          // 디버그 모드(production 환경에서는 주석 처리한다.)
          $mail->SMTPDebug = SMTP::DEBUG_SERVER;

          $mail->IsSMTP();
             //   $mail->SMTPDebug = 2;
          $mail->SMTPSecure = "ssl";
          $mail->SMTPAuth = true;
          $mail->Host = "smtp.naver.com";
          $mail->Port = 465;
          $mail->Username = "eduplanet_ad@naver.com";
          $mail->Password = "eduedu123!!";
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
          if ( $mail->send() ) echo "성공";
          else echo "실패....";
    }
 ?>
