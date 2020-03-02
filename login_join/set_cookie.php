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
