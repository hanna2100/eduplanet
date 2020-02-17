<meta charset="UTF-8">

<?php

// 테이블 수정 후 추가예정
// 세션값으로 학원id를 받아서 학원명, parent 가져오기

    // 시간 셋팅하기
	date_default_timezone_set('Asia/Seoul');

    include "../lib/db_connector.php";

    $title = $_POST["story_post_title"];
    $subtitle = $_POST["story_post_content"];

    $subject1 = $_POST["story_post_subtitle_1"];
    $subject2= $_POST["story_post_subtitle_2"];
    $subject3 = $_POST["story_post_subtitle_3"];

    $content1 = $_POST["story_post_description_1"];
    $content2 = $_POST["story_post_description_2"];
    $content3 = $_POST["story_post_description_3"];

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
    

    // 세션값 받아오기 전에 테스트로 parent 넣음
    $sql = "insert into acd_story(parent, acd_name, title, subtitle, subject1, content1, subject2, content2, subject3, content3, hit, regist_day, file_name, file_copy)";
    $sql .= "values('2', '냥냥학원', '$title', '$subtitle', '$subject1', '$content1', '$subject2', '$content2', '$subject3', '$content3', 0, '$regist_day', '$upfile_name', '$copied_file_name')";

    mysqli_query($conn, $sql);
    mysqli_close($conn);

    echo "
        <script>
            alert('작성이 완료되었습니다. 관리자 승인 후 등록이 완료됩니다.');
            location.href = '/eduplanet/acd_story/index.php';
        </script>
    ";

?>