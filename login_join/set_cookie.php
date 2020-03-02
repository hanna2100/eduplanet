<?php
  if(isset($_GET['id']) && isset($_GET['hash'])){
    $id = $_GET['id'];
    $hash = $_GET['hash'];
    if(headers_sent($file, $line)){
      echo "쿠키를 생성할 수 없습니다.";
    }else {
      setcookie("user_id_cookie", $id, time()+180, "/");  // 테스트를 위해 3분(180초)만 유지
      setcookie("user_hash_cookie", $hash, time()+180, "/");
  ?>
    <script>location.href = "/eduplanet/index.php";</script>
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
