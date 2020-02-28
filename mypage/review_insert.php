<?php

    include_once $_SERVER["DOCUMENT_ROOT"]."/eduplanet/lib/session_start.php";
    
    $user_no = $gm_no;

    date_default_timezone_set('Asia/Seoul');

    include_once $_SERVER["DOCUMENT_ROOT"]."/eduplanet/lib/db_connector.php";

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

    // 리뷰 INSERT
    $sql = "INSERT INTO review(parent, user_no, one_line, total_star, facility, acsbl, teacher, cost_efct, achievement, benefit, drawback, regist_day)";
    $sql .= "VALUES('$no', '$user_no', '$one_line', '$total_star', '$facility_star', '$acsbl_star', '$teacher_star', '$cost_efct_star', '$achievement_star', '$benefit', '$drawback', '$regist_day')";

    mysqli_query($conn, $sql);

    // 작성한 리뷰가 있는지 점검
    $sql = "SELECT * FROM review WHERE user_no='$user_no'";
    $result_review = mysqli_query($conn, $sql);
    $total_review = mysqli_num_rows($result_review);

    // 작성한 리뷰가 없을 때 (무료 이용권 발급)
    if ($total_review == 1) {
        
        // 무료 이용권 발급
        $sql = "INSERT INTO gm_order(gm_no, prdct_name_month, price, pay_method, status, date)";
        $sql .= "VALUES('$user_no', '무료 이용권 (7일)', 0, '-', '발급완료', '$regist_day')";

        mysqli_query($conn, $sql);

        // 만료날짜 업데이트
        $expiry_day = strtotime($regist_day."+ 7 day");
        $expiry_day = date("Y-m-d", $expiry_day);

        $sql = "UPDATE g_members SET expiry_day='$expiry_day' WHERE no='$user_no'";

        mysqli_query($conn, $sql);

        // 멤버십 회원 세션 주기
        $_SESSION["pgm_no"] = $user_no;

        mysqli_close($conn);

        echo "
            <script>
                alert('학원 리뷰 등록이 완료되었습니다.');
                alert('무료 이용권 (7일) 이 발급되었습니다.');
                location.href = '/eduplanet/mypage/review_mylist.php';
            </script>
        ";

    // 작성한 리뷰가 있을 때
    } else {

        mysqli_close($conn);

        echo "
            <script>
                alert('학원 리뷰 등록이 완료되었습니다.');
                location.href = '/eduplanet/mypage/review_mylist.php';
            </script>
        ";

    }
    

    

?>