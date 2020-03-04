<?php
  if(isset($_GET['id']) && isset($_GET['hash'])){
    $id = $_GET['id'];
    $hash = $_GET['hash'];

    if(headers_sent($file, $line)){
      echo "쿠키를 생성할 수 없습니다.";
    }else {
      $aa = setcookie("user_id_cookie", $id, time()+60*60, "/");
      // if($aa) echo "쿠키 생성 완료";
      setcookie("user_hash_cookie", $hash, time()+60*60, "/");

      // 멤버십이 끝난 고객이 로그인 하면 결제를 위해 멤버십 페이지로 이동
        if(isset($_GET['expiry'])){
          $expiry = $_GET['expiry'];

          if($expiry == 'Y'){
  ?>
            <script>location.href = "/eduplanet/membership/index.php";</script>

  <?php
          }
        }else {
  ?>
          <script>location.href = "/eduplanet/index.php";</script>
  <?php

        }
  ?>

  <?php
    }
  }else{
 ?>
   <script>
      alert("쿠키 못구움");
      location.href = "/eduplanet/login_join/login_form.php";
   </script>
  <?php
  }
 ?>
