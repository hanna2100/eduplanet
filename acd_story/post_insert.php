<meta charset="UTF-8">

<?php

    if (isset($_SESSION["am_no"])) {
        $am_no = $_SESSION["am_no"];
    } else {
        $am_no = "";
    }

    // test
    // $am_no = 1;

    // 시간 셋팅하기
	date_default_timezone_set('Asia/Seoul');

    include_once $_SERVER["DOCUMENT_ROOT"]."/eduplanet/lib/db_connector.php";

    $sql_acd = "SELECT acd_name FROM a_members WHERE acd_no=$am_no";
    $result = mysqli_query($conn, $sql_acd);
    $row = mysqli_fetch_array($result);

    $acd_name = $row["acd_name"];

    $title = $_POST["story_post_title"];
    $subtitle = $_POST["story_post_content"];

    $subject1 = $_POST["story_post_subtitle_1"];
    $content1 = $_POST["story_post_description_1"];

    if (isset($_POST["story_post_subtitle_2"]) && isset($_POST["story_post_description_2"])) {
        $subject2= $_POST["story_post_subtitle_2"];
        $content2 = $_POST["story_post_description_2"];
    } else {
        $subject2= "";
        $content2 = "";
    }

    if (isset($_POST["story_post_subtitle_3"]) && isset($_POST["story_post_description_3"])) {
        $subject3= $_POST["story_post_subtitle_3"];
        $content3 = $_POST["story_post_description_3"];
    } else {
        $subject3= "";
        $content3 = "";
    }

    $regist_day = date("Y-m-d (H:i)");
    $upload_dir = '../data/';

    $upfile_name = $_FILES["upfile"]["name"];
    $upfile_tmp_name = $_FILES["upfile"]["tmp_name"];
    $upfile_size = $_FILES["upfile"]["size"];
    $upfile_error = $_FILES["upfile"]["error"];

    if ($upfile_name && !$upfile_error) {

        $file = explode(".", $upfile_name);
        $file_name = $file[0];
        $file_ext = $file[1];

        $new_file_name = date("Y_m_d_H_i_s");
        $copied_file_name = $new_file_name.".".$file_ext;
        $uploaded_file = $upload_dir.$copied_file_name;

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
    
    $sql = "insert into acd_story(parent, acd_name, title, subtitle, subject1, content1, subject2, content2, subject3, content3, hit, regist_day, file_name, file_copy)";
    $sql .= "values('$am_no', '$acd_name', '$title', '$subtitle', '$subject1', '$content1', '$subject2', '$content2', '$subject3', '$content3', 0, '$regist_day', '$upfile_name', '$copied_file_name')";

    mysqli_query($conn, $sql);
    mysqli_close($conn);

    // 파일 권한 설정 바꾸는건데 안먹네요,,,ㅠ

    // 1번째방법
    // $ftp = ftp_connect('127.0.0.1');
    // ftp_login($ftp, 'root', '123456');
    // ftp_chmod($ftp, 0755, $copied_file_name);
    // ftp_close($ftp);


    // 2번째방법
    // chmod($copied_file_name, 755);


    echo "
        <script>
            alert('스토리 등록이 완료되었습니다.');
            location.href = '/eduplanet/acd_story/index.php';
        </script>
    ";

?>