<?php

// login 에서 세션값 가져오기

// session_start();

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

// session test ============================================

// 일반회원 테스트
// $gm_no = 1;

// 기업회원 테스트
$am_no = 1;

// session ==================================================

if (!$gm_no && !$am_no) {
    echo "
        <script>
            alert('로그인 후 이용하실 수 있습니다.');
            history.go(-1)
        </script>
    ";
}

?>

<div class="body_wrap">

    <div class="mypage_user_info_background">
        <div class="mypage_user_info">

            <?php
            if ($gm_no) {
                $user_no = $gm_no;
                $table_members = 'g_members';
            } else if ($am_no) {
                $user_no = $am_no;
                $table_members = 'a_members';
            }

            include_once $_SERVER["DOCUMENT_ROOT"]."/eduplanet/lib/db_connector.php";

            $sql = "SELECT id, expiry_day FROM $table_members WHERE no='$user_no'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result);

            $userid = $row["id"];
            $expiry_day = $row["expiry_day"];
            ?>

            <!-- 아이디에 따라 생성되는 프로필 이미지 -->
            <img class="user_img" data-user="<?= $userid ?>" alt="img">
            <div class="user_info">


                <div class="user_info_id">
                    <span><?= $userid ?></span>
                </div>

                <div class="user_info_membership">

                    <?php

                    // $sql = "SELECT expiry_day FROM $table_members WHERE no='$user_no'";
                    // $result = mysqli_query($conn, $sql);
                    // $row = mysqli_fetch_array($result);

                    // $expiry_day = $row["expiry_day"];
                    $expiry_day = substr($expiry_day, 0, 4) . substr($expiry_day, 5, 2) . substr($expiry_day, 8, 2);

                    // 만료날짜 계산 후 보여주기 // 만료날짜 없으면 다른 문구 보여주기
                    if ($expiry_day == "") {

                        if ($gm_no) {
                            echo "<span class='user_info_membership_span'>리뷰를 작성하시면 모든 리뷰를 조회하실 수 있습니다. </span>";
                        } else if ($am_no) {
                            echo "<span class='user_info_membership_span'>멤버십을 등록하시면 모든 기능을 이용하실 수 있습니다. </span>";
                        }
                    } else {

                        $today = date("Ymd");
                        $member_day = (strtotime($expiry_day) - strtotime($today)) / 60 / 60 / 24;

                        if ($gm_no) {
                            echo "<span class='user_info_membership_span'>리뷰 조회 기간이 <span class='user_info_membership_span_blue'>$member_day</span> 일 남았습니다. </span>";
                        } else if ($am_no) {
                            echo "<span class='user_info_membership_span'>멤버십 이용 기간이 <span class='user_info_membership_span_blue'>$member_day</span> 일 남았습니다. </span>";
                        }
                    }

                    // 헤더에서 DB를 닫으면 밑에 컨텐츠부분에서 실행을 못함 
                    // mysqli_close($conn);

                    ?>

                </div>
            </div>
        </div>
    </div>

</div>