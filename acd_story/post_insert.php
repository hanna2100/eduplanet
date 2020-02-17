<?php

// 테이블 수정 후 추가예정

    // 시간 셋팅하기
	date_default_timezone_set('Asia/Seoul');

    include "../lib/db_connector.php";

    $title = $_POST["story_post_title"];
    $content = $_POST["story_post_content"];

    $subtitle_1 = $_POST["story_post_subtitle_1"];
    $description_1 = $_POST["story_post_description_1"];

    $regist_day = date("Y-m-d (H:i)");
    $upload_dir = '/eduplanet/data/';

    $upfile_name = $_FILES["story_post_img"]["name"];
    $upfile_tmp_name = $_FILES["story_post_img"]["tmp_name"];
    $upfile_size = $_FILES["story_post_img"]["size"];
    $upfile_error = $_FILES["story_post_img"]["error"];

    if ($upfile_name && !$upfile_error) {

        $file = explode(".", $upfile_name);
        $file_name = $file[0];
        $file_ext = $file[1];

        $new_file_name = date("Y_m_d_H_i_s");
        // $new_file_name = $new_file_name;
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


    // if-else 로 sql 쿼리문 구분하기
    if (isset($_POST["story_post_subtitle_2"]) && isset($_POST["story_post_description_2"])) {
        
        if (isset($_POST["story_post_subtitle_3"]) && isset($_POST["story_post_description_3"])) {

            // 주제1,2,3 내용1,2,3 insert
            $subtitle_3 = $_POST["story_post_subtitle_3"];
            $description_3 = $_POST["story_post_description_3"];





        } else {

            // 주제1,2 내용1,2 insert
            $subtitle_2 = $_POST["story_post_subtitle_2"];
            $description_2 = $_POST["story_post_description_2"];




        }
        
    
    } else {

        // 주제1, 내용1 insert

    }

    // $sql = "insert into acd_story(id, pass, name, birth, email, phone, addnum, address, animal, regist_day, level, point, email_check, sms_check)";
    // $sql .= "values('$id', '$pass', '$name', '$birth', '$email', '$phone', '$addnum', '$address', '$animal', '$regist_day', 9, 0, '$email_check', '$sms_check')";

    mysqli_query($conn, $sql);
    mysqli_close($conn);

    echo "
        <script>
            alert('작성이 완료되었습니다. 관리자 승인 후 등록이 완료됩니다.');
            location.href = '/eduplanet/acd_story/index.php';
        </script>
    ";

?>