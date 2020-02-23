<?php

    include_once "../lib/db_connector.php";

    // 리뷰 글번호
    $review_no = $_GET["no"];

    // $acd_name = $_POST["acd_name"];
    $total_star = $_POST["total_star"];
    $one_line = $_POST["one_line"];
    $benefit = $_POST["benefit"];
    $drawback = $_POST["drawback"];
    $facility_star = $_POST["facility_star"];
    $acsbl_star = $_POST["acsbl_star"];
    $teacher_star = $_POST["teacher_star"];
    $cost_efct_star = $_POST["cost_efct_star"];
    $achievement_star = $_POST["achievement_star"];

    $sql = "UPDATE review SET one_line='$one_line', total_star=$total_star, facility=$facility_star, acsbl=$acsbl_star, teacher=$teacher_star, cost_efct=$cost_efct_star, achievement=$achievement_star, benefit='$benefit', drawback='$drawback' WHERE no=$review_no";

    mysqli_query($conn, $sql);

    // echo mysqli_error($conn);
    
    mysqli_close($conn);

    echo "
        <script>
            alert('학원 리뷰 수정이 완료되었습니다.');
            location.href = '/eduplanet/mypage/review_mylist.php';
        </script>
    ";

?>