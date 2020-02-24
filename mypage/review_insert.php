<?php

    if (isset($_SESSION["gm_no"])) {
        $gm_no = $_SESSION["gm_no"];
    } else {
        $gm_no = "";
    }

    // session test
    $gm_no = 1;

    $user_no = $gm_no;

    date_default_timezone_set('Asia/Seoul');

    include_once "../lib/db_connector.php";

    // hidden input (자동완성 검색창에서 넣어준 값)
    $si_name = $_POST["si_name"];
    $dong_name = $_POST["dong_name"];

    $acd_name = $_POST["acd_name"];
    $total_star = $_POST["total_star"];
    $one_line = $_POST["one_line"];
    $benefit = $_POST["benefit"];
    $drawback = $_POST["drawback"];
    $facility_star = $_POST["facility_star"];
    $acsbl_star = $_POST["acsbl_star"];
    $teacher_star = $_POST["teacher_star"];
    $cost_efct_star = $_POST["cost_efct_star"];
    $achievement_star = $_POST["achievement_star"];

    $regist_day = date("Y-m-d");

    // 학원이름, 시군이름, 동이름을 통해 academy 테이블의 no를 찾아온다 (no = parent)
    $sql = "SELECT * FROM academy WHERE acd_name='$acd_name' and si_name='$si_name' and dong_name='$dong_name'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);

    $no = $row["no"];

    $sql = "insert into review(parent, user_no, one_line, total_star, facility, acsbl, teacher, cost_efct, achievement, benefit, drawback, regist_day)";
    $sql .= "values('$no', '$user_no', '$one_line', '$total_star', '$facility_star', '$acsbl_star', '$teacher_star', '$cost_efct_star', '$achievement_star', '$benefit', '$drawback', '$regist_day')";

    mysqli_query($conn, $sql);
    mysqli_error($conn);
    mysqli_close($conn);

    echo "
        <script>
            alert('학원 리뷰 등록이 완료되었습니다.');
            location.href = '/eduplanet/mypage/review_mylist.php';
        </script>
    ";

?>