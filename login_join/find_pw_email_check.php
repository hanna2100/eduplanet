<?php
  // openssl관련 에러 나는 경우 : php.ini 파일에서 openssl.dil 주석 해제하고 아파치 재실행하기!
  include_once '../lib/PHPMailer/PHPMailerAutoload.php';
  include_once $_SERVER["DOCUMENT_ROOT"] . "/eduplanet/lib/db_connector.php";

  $email = $_POST["email"];
  $mode = $_POST["mode"];

  if($mode == "gm"){
    $table = "g_members";
  }else if($mode == "am"){
    $table = "a_members";
  }
      $sql = "SELECT * FROM $table where id = '$email'";
      $result = mysqli_query($conn,$sql);

      if (!$result) {
        die('Error: ' . mysqli_error($conn));
      }

      $rowcount=mysqli_num_rows($result);

      if($rowcount){
        srand((double)microtime()*1000000); //난수값 초기화
        $code=rand(100000,999999);
        $hash = md5(rand(0,1000)); // 해시 생성 함수
        echo $code;
        //   $count=1;
        $to=$email;
        $from="eduplanet 관리자";
        $subject="eduplanet 비밀번호 변경 확인 메일";
        $body="\n안녕하세요!
               \n\n아래 링크를 클릭하여 임시 비밀번호를 새로운 비밀번호로 설정해주세요.
               \n\n임시 비밀번호 : ".$code."
               \n\nhttp://localhost/eduplanet/login_join/find_pw_code_insert.php?hash=".$hash."&mode=".$mode."";

        mailer($from,"iamashley44@naver.com", $to, $subject, $body);


       $sql_hash = "UPDATE $table SET hash='$hash', temp_pw='$code' WHERE id='$to';";
       // "INSERT INTO $table (hash, temp_pw) VALUES ('$hash', '$code'); ";
       mysqli_query($conn, $sql_hash);

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
          // $mail->SMTPDebug = 4;

          $mail->IsSMTP();
             //   $mail->SMTPDebug = 2;
          $mail->SMTPSecure = "ssl";
          // $mail->SMTPSecure = "tls";
          $mail->SMTPAuth = true;
          $mail->Host = "smtp.naver.com";
          $mail->Port = 465;
          $mail->Username = "iamashley44@naver.com";
          $mail->Password = "wpffktha123!!";
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
