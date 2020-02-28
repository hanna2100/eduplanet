<?php

    include_once $_SERVER["DOCUMENT_ROOT"]."/eduplanet/lib/db_connector.php";

    // 리뷰 글번호
    $review_no = $_GET["no"];

    // 작성 후 30일이 지났는지 검사
    $sql = "SELECT regist_day FROM review WHERE no=$review_no";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);

    // 작성 날짜
    $regist_day = $row["regist_day"];

    // 삭제 가능 날짜 (작성일 + 30일)
    $delete_day = strtotime($regist_day."+ 30 day");

    // 현재 날짜
    date_default_timezone_set('Asia/Seoul');
    $today = date("Y-m-d");
    $today = strtotime($today);
    
    //echo "
    //    $regist_day.' 뚜둔 '.$delete_day.' 뚜둔 '.$today
    //";

    // 현재 날짜가 삭제 가능 날짜와 같거나 이후일 때 (삭제 가능)
    if ($today >= $delete_day) {

        $sql = "DELETE FROM review WHERE no=$review_no";

        mysqli_query($conn, $sql);
    
        mysqli_close($conn);
    
        echo "
            <script>
                alert('삭제가 완료되었습니다.');
                location.href = '/eduplanet/mypage/review_mylist.php';
            </script>
            ";

    // 현재 날짜가 삭제 가능 날짜보다 이전일 때 (삭제 불가능)
    } else if ($today < $delete_day) {

        echo "
            <script>
                alert('리뷰 삭제는 작성일로부터 30일 이후에 가능합니다.');
                location.href = '/eduplanet/mypage/review_mylist.php';
            </script>
            ";
    }
    
?>