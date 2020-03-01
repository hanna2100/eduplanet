<?php
  include_once "../lib/db_connector.php";
  $parent = $_POST["parent"];
  $teacher_name = $_POST["teacher_name"];
  $teacher_subject = $_POST["teacher_subject"];
  $teacher_content = $_POST["teacher_content"];

	$upload_dir = '../data/teacher_img/';

	$upfile_name	 = $_FILES["upfile"]["name"];
	$upfile_tmp_name = $_FILES["upfile"]["tmp_name"];//파일 임시이름
	$upfile_type     = $_FILES["upfile"]["type"];//파일 형식
	$upfile_size     = $_FILES["upfile"]["size"];
	$upfile_error    = $_FILES["upfile"]["error"];


	if ($upfile_name && !$upfile_error){

		$file = explode(".", $upfile_name);
		$file_name = $file[0]; //파일명
		$file_ext  = $file[1]; //확장자

		$new_file_name = date("Y_m_d_H_i_s");
		$new_file_name = $new_file_name;
		$copied_file_name = $new_file_name.".".$file_ext; //실제 서버에 저장될 파일명      
		$uploaded_file = $upload_dir.$copied_file_name; //파일을 폴더에 복사

		if( $upfile_size  > 3000000 ) {
			echo("업로드 파일 크기가 3M를 초과합니다.");
			exit;
		}

		if (!move_uploaded_file($upfile_tmp_name, $uploaded_file) ){
			echo("서버에 업로드를 실패했습니다.");
			exit;
    }
    
	}else{
		$upfile_name      = "";
		$upfile_type      = "";
		$copied_file_name = "";
	}
	
  $sql = "INSERT INTO `teacher` VALUES (null, $parent, '$teacher_name', '$teacher_subject', '$teacher_content', '$copied_file_name')";
  if(!mysqli_query($conn, $sql)){
    echo "DB 등록실패";
  }else{
    echo "1";
  }
  mysqli_close($conn);


?>
