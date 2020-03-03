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

  if (isset($_GET["no"])) {
    $no = $_GET["no"];
  }

  include_once $_SERVER["DOCUMENT_ROOT"] . "/eduplanet/lib/db_connector.php";

  $webSite = $_POST["website"];
  $introduce = $_POST["introduce"];
  $schoolbus = $_POST["schoolbus"];

  if (isset($_POST["old_file_copy"])) {
    $old_file_copy = $_POST["old_file_copy"];
  } else {
    $old_file_copy = "";
  }

  $upload_dir = "../data/acd_logo/";

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
    
    $sql = "UPDATE academy SET website = '$webSite', schoolbus = '$schoolbus', introduce = '$introduce' WHERE no='$no'";
    mysqli_query($conn, $sql);
    mysqli_close($conn);
    
    echo "
    <script>
      alert('학원 정보 수정이 완료되었습니다.');
      history.go(-1);
    </script>
    ";
    
    // 새로 첨부한 사진이 있을 때
  } else if ($upfile_name != "") {
    

    $sql = "UPDATE academy SET website = '$webSite', schoolbus = '$schoolbus', introduce = '$introduce', file_copy='$copied_file_name' WHERE no='$no'";
    mysqli_query($conn, $sql);

    // 기존 사진 삭제
    if ($old_file_copy) {
        unlink($_SERVER['DOCUMENT_ROOT'] . "/eduplanet/data/acd_logo/" . $old_file_copy);
    }

    mysqli_close($conn);

    echo "
      <script>
        alert('학원 정보 수정이 완료되었습니다.');
        history.go(-1);
      </script>
    ";
  }
?>