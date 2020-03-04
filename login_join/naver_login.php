<?php

@session_start();

include_once $_SERVER["DOCUMENT_ROOT"] . "/eduplanet/lib/db_connector.php";

if(isset($_POST['naver_login'])){

  $input_id = $_POST['naver_login'];

}

$mode = $_GET['mode'];

// URL에 담긴 mode에 따라 세션에 줄 값을 정해줌
switch ($mode) {

    case "gm":
        $mode_no = "gm_no";
        $pay = "pgm_no";
        $table_members = "g_members";
        $table_order = "gm_order";
        break;

    case "am":
        $mode_no = "am_no";
        $pay = "pam_no";
        $table_members = "a_members";
        $table_order = "am_order";
        break;
}

$sql = "SELECT * FROM $table_members WHERE id='$input_id'";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$id_exist = mysqli_num_rows($result);
$no = $row["no"];
$expiry_day = $row["expiry_day"];

// 사업자 승인여부 검사
if ($mode == "am") {

    $acd_no = $row["acd_no"];

    $sql_approval = "SELECT approval FROM a_members WHERE acd_no=$acd_no; ";
    $result_approval = mysqli_query($conn, $sql_approval);
    $row_approval = mysqli_fetch_array($result_approval);

    $approval = $row_approval['approval'];
}

if ($mode == "am" && $approval == "N"){

    alert_move('현재 승인절차가 진행중입니다. 승인 후 로그인 가능합니다.', '/eduplanet/index.php');

}

$sql_order = "SELECT EXISTS (SELECT date FROM $table_order WHERE $mode_no='$no' order by date desc) as success;";

// 만료날짜가 없을 때 (유료회원이 아닐 때)
if ($expiry_day == "0000-00-00") {

    $_SESSION[$mode_no] = $no;
    alert_move('에듀플래닛에 오신 것을 환영합니다.', '/eduplanet/index.php');

// 만료날짜가 있을 때 (유료회원일 때)
} else {

    // 해당 아이디의 만료날짜와 현재날짜를 비교하기
    date_default_timezone_set('Asia/Seoul');
    $today = date("Y-m-d");
    $today = strtotime($today);
    $expiry_day = strtotime($expiry_day);

    // 만료날짜가 현재날짜보다 이전일 때 (멤버십이 끝났을 때)
    if ($expiry_day < $today) {

        // 테이블 만료날짜를 0000-00-00 으로 업데이트
        $sql_exp = "UPDATE $table_members SET expiry_day='0000-00-00' WHERE no=$no";
        mysqli_query($conn, $sql_exp);

        $_SESSION[$mode_no] = $no;
        unset($_SESSION[$pay]);

        alert_move('에듀플래닛에 오신 것을 환영합니다. \n멤버십 이용기간이 만료되어 멤버십 페이지로 이동합니다.', '/eduplanet/membership/index.php');

    // 만료날짜가 현재날짜보다 이후거나 같을 때 (멤버십이 이용중일 때)
    } else if ($expiry_day >= $today) {

        $_SESSION[$mode_no] = $no;
        $_SESSION[$pay] = $no;

        alert_move('에듀플래닛에 오신 것을 환영합니다.', '/eduplanet/index.php');
    }
}

mysqli_close($conn);

function alert_move($msg, $url) {

    echo "
        <script>
            alert('$msg');
            location.href = '$url';
        </script>
      ";

    exit;
};

?>
