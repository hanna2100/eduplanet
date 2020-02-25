<?php

    session_start();

    if (isset($_SESSION["gm_no"])) {
        $gm_no = $_SESSION["gm_no"];
    } else {
        $gm_no = "";
    }

    if (isset($_SESSION["am_no"])) {
        $am_no = $_SESSION["am_no"];
    } else {
        $am_no = "";
    }
?>

<script>
    // 세션 값 점검 콘솔로그
    console.log("gm_no SESSION : <?=$gm_no?>");
    console.log("am_no SESSION : <?=$am_no?>");
</script>