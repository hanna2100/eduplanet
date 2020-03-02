
<?php

// session =============================
// 세션 unset

session_start();
unset($_SESSION["am_no"]);
unset($_SESSION["gm_no"]);
unset($_SESSION["pam_no"]);
unset($_SESSION["pgm_no"]);
unset($_SESSION["admin"]);

// 쿠키 unset
if(isset($_COOKIE["user_id_cookie"]) && isset($_COOKIE["user_hash_cookie"])){
  setcookie("user_id_cookie", "", time()-3600);
  setcookie("user_hash_cookie", "", time()-3600);
}

// unset($_COOKIE["user_id_cookie"]);
// unset($_COOKIE["user_hash_cookie"]);

echo "
        <script>
           alert('로그아웃이 완료되었습니다.');
        </script>
     ";


// session =============================

echo ("
       <script>
          location.href = '/eduplanet/index.php';
         </script>
       ");
?>
