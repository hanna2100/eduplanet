 <?php
   @session_start();
   include "../lib/db_connector.php";

   define(ADMIN_ID, "admin");
   define(ADMIN_PW, "admin_12");

   $input_id = test_input($_POST['inputId']);
   $input_pw = test_input($_POST['inputPw']);
   $mode = $_GET['mode'];

   if($input_id == ADMIN_ID && $input_pw == ADMIN_PW){
     $mode = "admin";
   }

   switch($mode){
     case "gm" :
       $sql = "select * from g_members where id='$input_id'";
       $id = "gm_id";
       break;
     case "am" :
       $sql = "select * from a_members where id='$input_id'";
       $id = "am_id";
       break;
     case "admin" :
       $_SESSION["admin_id"] = "admin";
       mysqli_close($conn);
       header('Location: ../admin/index.php');
       break;
   }

   $result = mysqli_query($conn, $sql);
   $num_match = mysqli_num_rows($result);

   if(!$num_match){
     alert_back('가입되지 않은 아이디 입니다. 다시 입력해주세요');
     $input_id="";
   }else{
     $pw_match = mysqli_fetch_array($result);
     if($input_pw != $pw_match['pw']){
       alert_back('비밀번호를 잘못 입력하셨습니다.');
     }else{
       $_SESSION[$id] = $pw_match["id"];

       mysqli_close($conn);
       header('Location: ../index.php');
     }
   }

  ?>
