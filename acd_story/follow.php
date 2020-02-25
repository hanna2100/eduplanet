<?php

include_once $_SERVER["DOCUMENT_ROOT"]."/eduplanet/lib/session_start.php";

if (!$gm_no) {
    echo "
        <script>
            alert('일반회원만 이용 가능합니다.');
            history.go(-1)
        </script>
    ";
}

$acd_no = $_GET["no"];

include_once $_SERVER["DOCUMENT_ROOT"]."/eduplanet/lib/db_connector.php";

$sql = "insert into follow(user_no, acd_no)";
$sql .= "values('$gm_no', '$acd_no')";

mysqli_query($conn, $sql);
mysqli_close($conn);

echo "
<script>
    alert('찜목록에 추가되었습니다.');
    history.go(-1)
</script>
";

?>