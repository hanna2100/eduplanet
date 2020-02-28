<script>
  alert("로그아웃이 완료되었습니다.");
</script>


<?php

  // session =============================
  // 세션 unset 

  session_start();
  unset($_SESSION["am_no"]);
  unset($_SESSION["gm_no"]);
  unset($_SESSION["pam_no"]);
  unset($_SESSION["pgm_no"]);
  unset($_SESSION["admin"]);

  // session =============================
  
  echo("
       <script>
          location.href = '/eduplanet/index.php';
         </script>
       ");
?>