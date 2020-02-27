<?php

    session_start();

    // 일반 회원
    if (isset($_SESSION["gm_no"])) {
        $gm_no = $_SESSION["gm_no"];
    } else {
        $gm_no = "";
    }

    // 기업 회원
    if (isset($_SESSION["am_no"])) {
        $am_no = $_SESSION["am_no"];
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