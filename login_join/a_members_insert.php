<?php
      include_once $_SERVER["DOCUMENT_ROOT"]."/eduplanet/lib/db_connector.php";

      date_default_timezone_set('Asia/Seoul');
      $today = date("Y-m-d");

      $mode = $_GET['mode'];
      $id = $_POST['inputId'];
      $pw = $_POST['inputPw1'];
      $acdName = $_POST['acd_name_join'];
      $rprsn = $_POST['inputRprsn'];


      $upload_dir = '../data/bsnsLic/';
      $upfile_name = $_FILES["inputLicense"]["name"]; // 사용자가 실제 올린 파일 이름
      $upfile_tmp_name = $_FILES["inputLicense"]["tmp_name"];  // 서버가 임의로 준 임시 파일 이름
      $upfile_type = $_FILES["inputLicense"]["type"];
      $upfile_size = $_FILES["inputLicense"]["size"];
      $upfile_error = $_FILES["inputLicense"]["error"];

      if ($upfile_name && !$upfile_error) {
        $file = explode(".", $upfile_name); // 사용자가 올린 파일을 이름과 확장자로 나눈다
        $file_name = $file[0];
        $file_ext = $file[1];
        $new_file_name = date("y_m_d_h_i_s");
        $new_file_name = $new_file_name . "_" . $file_name;  // 현재 시간과 파일 이름을 붙여서 새로운 임시 이름을 만든다
        $copied_file_name = $new_file_name . "." . $file_ext;  // 새로 만든 임시 이름에 확장자를 붙인다
        $uploaded_file = $upload_dir . $copied_file_name;  // 파일을 저장할 경로를 앞에 붙인다

        if ($upfile_size > 1000000) {
          alert_back('업로드 파일 크기가 지정된 용량(1MB)을 초과합니다!<br>파일 크기를 체크해주세요!');
        }
        if (!move_uploaded_file($upfile_tmp_name, $uploaded_file)) {
          alert_back('파일을 지정한 디렉토리에 복사하는데 실패했습니다.');
        }
      } else {
        echo ("<script>alert('파일없음');</script>");
        $real_file_name = "";
        $real_file_type = "";
        $copied_file_name = "";
      }



      $sql_search = "SELECT no from academy where acd_name='$acdName'";
      $result_search = mysqli_query($conn, $sql_search);
      $row = mysqli_fetch_array($result_search);
      $acdNo = $row[0];

      $sql_insert = "INSERT into a_members values
                    (null, '$acdNo', '$id', '$pw', '$acdName', '$rprsn', '$copied_file_name', 'N', '', '', '0000-00-00', '$today');";
      $sql_select = "select * from a_members where id='$id'";
      $no = "am_no";



       mysqli_query($conn, $sql_insert);
       mysqli_close($conn);

       echo ('
            <script>
                alert("사업자 회원가입이 완료되었습니다. \n로그인 해주세요.");
                location.href = "/eduplanet/login_join/login_form.php?mode=am";
            </script>
          ');



?>
