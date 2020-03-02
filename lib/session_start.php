<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/eduplanet/lib/db_connector.php";
    session_start();

    // 일반 회원
    if (isset($_SESSION["gm_no"])) {
        $gm_no = $_SESSION["gm_no"];
        $table_members = "g_members";

        if(isset($_COOKIE['user_id_cookie']) && isset($_COOKIE['user_hash_cookie'])){
            $id = $_COOKIE['user_id_cookie'];
            $master_key = 'eduplanet';
            $sql = "SELECT * FROM $table_members WHERE id='$id';";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result);
            $pass = $row['pw'];
            $hash = md5($master_key.$pass);
            if($_COOKIE['user_hash_cookie'] == $hash){
              $_SESSION['id'] = $id;
            }
        }

    } else {
        $gm_no = "";
    }

    // 기업 회원
    if (isset($_SESSION["am_no"])) {
        $am_no = $_SESSION["am_no"];
        $table_members = "a_members";

        if(isset($_COOKIE['user_id_cookie']) && isset($_COOKIE['user_hash_cookie'])){
            $id = $_COOKIE['user_id_cookie'];
            $master_key = 'eduplanet';
            $sql = "SELECT * FROM $table_members WHERE id='$id';";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result);
            $pass = $row['pw'];
            $hash = md5($master_key.$pass);
            if($_COOKIE['user_hash_cookie'] == $hash){
              $_SESSION['id'] = $id;
            }
        }

    } else {
        $am_no = "";
    }

    // 일반 회원 (결제완료)
    if (isset($_SESSION["pgm_no"])) {
        $pgm_no = $_SESSION["pgm_no"];
    } else {
        $pgm_no = "";
    }

    // 기업 회원 (결제완료)
    if (isset($_SESSION["pam_no"])) {
        $pam_no = $_SESSION["pam_no"];
    } else {
        $pam_no = "";
    }

    // 관리자
    if (isset($_SESSION["admin"])) {
        $admin = $_SESSION["admin"];
    } else {
        $admin = "";
    }


?>

<script>
    // 세션 값 점검 콘솔로그
    console.log("gm_no SESSION : <?=$gm_no?>");
    console.log("am_no SESSION : <?=$am_no?>");
    console.log("pgm_no SESSION : <?=$pgm_no?>");
    console.log("pam_no SESSION : <?=$pam_no?>");
    console.log("admin SESSION : <?=$admin?>");
</script>
