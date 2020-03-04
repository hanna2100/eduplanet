<?php

include_once $_SERVER["DOCUMENT_ROOT"] . "/eduplanet/lib/session_start.php";

$user_no = $am_no;

if (!$user_no) {
    echo "
                <script>
                    alert('잘못된 접근입니다.');
                    history.go(-1)
                </script>
            ";
}

include_once $_SERVER["DOCUMENT_ROOT"] . "/eduplanet/lib/db_connector.php";

if (isset($_GET["no"])) {
    $no = $_GET["no"];
}

$title = $_POST["story_post_title"];
$subtitle = $_POST["story_post_content"];

$subject1 = $_POST["story_post_subtitle_1"];
$content1 = $_POST["story_post_description_1"];

if (isset($_POST["story_post_subtitle_2"]) && isset($_POST["story_post_description_2"])) {
    $subject2 = $_POST["story_post_subtitle_2"];
    $content2 = $_POST["story_post_description_2"];
} else {
    $subject2 = "";
    $content2 = "";
}

if (isset($_POST["story_post_subtitle_3"]) && isset($_POST["story_post_description_3"])) {
    $subject3 = $_POST["story_post_subtitle_3"];
    $content3 = $_POST["story_post_description_3"];
} else {
    $subject3 = "";
    $content3 = "";
}

$old_file_copy = $_POST["old_file_copy"];

$upload_dir = "../data/acd_story/";

$upfile_name = $_FILES["upfile"]["name"];
$upfile_tmp_name = $_FILES["upfile"]["tmp_name"];
$upfile_size = $_FILES["upfile"]["size"];
$upfile_error = $_FILES["upfile"]["error"];

if ($upfile_name && !$upfile_error) {

    $file = explode(".", $upfile_name);
    $file_name = $file[0];
    $file_ext = $file[1];

    $new_file_name = date("Y_m_d_H_i_s");
    $copied_file_name = $new_file_name . "." . $file_ext;
    $uploaded_file = $upload_dir . $copied_file_name;

    if ($upfile_size > 1000000) {

        echo "
                    <script>
                        alert('사진 크기는 1MB 이하만 가능합니다.');
                        history.go(-1)
                    </script>
                    ";

        exit;
    }

    if (!move_uploaded_file($upfile_tmp_name, $uploaded_file)) {

        echo "
                    <script>
                        alert('오류가 발생했습니다. 다시 시도해 주세요.');
                        history.go(-1)
                    </script>
                    ";

        exit;
    }
} else {

    $upfile_name = "";
    $copied_file_name = "";
}

// 새로 첨부한 사진이 없을 때
if ($upfile_name == "") {

    $sql = "UPDATE acd_story SET title='$title', subtitle='$subtitle', subject2='$subject2', subject3='$subject3', content1='$content1', content2='$content2', content3='$content3' WHERE no='$no'";
    mysqli_query($conn, $sql);
    mysqli_close($conn);

    echo "
                <script>
                    alert('스토리 수정이 완료되었습니다.');
                    location.href = '/eduplanet/mypage/story.php';
                </script>
                ";

    // 새로 첨부한 사진이 있을 때
} else if ($upfile_name != "") {

    $sql = "UPDATE acd_story SET title='$title', subtitle='$subtitle', subject2='$subject2', subject3='$subject3', content1='$content1', content2='$content2', content3='$content3', file_name='$upfile_name', file_copy='$copied_file_name' WHERE no='$no'";
    mysqli_query($conn, $sql);

    // 테스트 시연용
    if ($old_file_copy != "test_acd_story_img.jpg") {

        // 기존 사진 삭제
        if ($old_file_copy) {
            unlink($_SERVER['DOCUMENT_ROOT'] . "/eduplanet/data/acd_story/" . $old_file_copy);
        }
    }

    mysqli_close($conn);

    echo "
                <script>
                    alert('스토리 수정이 완료되었습니다.');
                    location.href = '/eduplanet/mypage/story.php';
                </script>
                ";
}
?>