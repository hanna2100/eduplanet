<?php

function create_table($conn, $table_name){
  $flag="NO"; //테이블 존재 유무
  $sql = "show tables from eduplanet";
  $result=mysqli_query($conn,$sql) or die('Error: '.mysqli_error($conn));

  while ($row=mysqli_fetch_row($result)) {
    if($row[0] === "$table_name"){//문자열로 넘어오므로 ""으로 처리 ''은 문자열뿐아니라 속성도 반영
      //eduplanet 스키마에 찾는 테이블이 있는 경우
      $flag="OK";
      break;
    }
  }//end of while

  if($flag==="NO"){
    switch($table_name){
          case 'g_members' : //일반회원(general members)
            $sql = "CREATE TABLE `g_members` (
                    `no` INT NOT NULL AUTO_INCREMENT,
                    `id` CHAR(10) NOT NULL,
                    `pw` CHAR(10) NOT NULL,
                    `email` VARCHAR(80),
                    `phone` CHAR(12) NOT NULL,
                    `age` int NOT NULL,
                    `intres` CHAR(10) NOT NULL,
                    PRIMARY KEY (`no`),
                    UNIQUE KEY(`id`)
                  );";
            break;
          case 'a_members' : //학원회원(academy members)
            $sql = "CREATE TABLE `a_members` (
                    `no` INT NOT NULL AUTO_INCREMENT,
                    `id` CHAR(10) NOT NULL,
                    `pw` CHAR(10) NOT NULL,
                    `email` VARCHAR(80) NOT NULL,
                    `acd_name` VARCHAR(40) NOT NULL,
                    `rprsn` VARCHAR(20) NOT NULL,
                    `file_copy` VARCHAR(50) NOT NULL,
                    PRIMARY KEY (`no`),
                    UNIQUE KEY(`id`)
                  );";
            break;
          case 'academy' : //학원데이터
            $sql = "CREATE TABLE `academy` (
                    `no` INT NOT NULL AUTO_INCREMENT,
                    `si_name` CHAR(10) NOT NULL,
                    `dong_name` CHAR(10),
                    `sector` CHAR(10) NOT NULL,
                    `acd_name` VARCHAR(40) NOT NULL,
                    `rprsn` VARCHAR(40),
                    `class` VARCHAR(50),
                    `tel` CHAR(15),
                    `address` VARCHAR(80),
                    `latitude` CHAR(15),
                    `longitude` CHAR(15),
                    `website` CHAR(50) DEFAULT NULL,
                    `schoolbus` VARCHAR(50) DEFAULT NULL,
                    `introduce` VARCHAR(200) DEFAULT NULL,
                    PRIMARY KEY(`no`)
                  );";
            break;
          case 'teacher' : //학원에서 작성한 선생님정보
            $sql = "CREATE TABLE `teacher` (
                    `no` INT NOT NULL AUTO_INCREMENT,
                    `parent` INT NOT NULL,
                    `name` VARCHAR(20) NOT NULL,
                    `subject` CHAR(10) NOT NULL,
                    `content` VARCHAR(20) NOT NULL,
                    `file_name` VARCHAR(50) NOT NULL,
                    `file_copy` VARCHAR(50) NOT NULL,
                    PRIMARY KEY(`no`),
                    FOREIGN KEY(`parent`) REFERENCES academy(`no`) 
                    ON DELETE CASCADE
                  );";
            break;
          case 'lecture' : //선생님의 강의정보
            $sql = "CREATE TABLE `lecture` (
                    `no` INT NOT NULL AUTO_INCREMENT,
                    `parent` INT NOT NULL,
                    `day` INT NOT NULL,
                    `order` INT NOT NULL,
                    `subject` VARCHAR(20) NOT NULL,
                    `teacher_name` VARCHAR(20) NOT NULL,
                    PRIMARY KEY(`no`),
                    FOREIGN KEY(`parent`) REFERENCES teacher(`no`) 
                    ON DELETE CASCADE
                  );";
            break;
          case 'review' : //학원후기
            $sql = "CREATE TABLE `review` (
                    `no` INT NOT NULL AUTO_INCREMENT,
                    `parent` INT NOT NULL,
                    `user_no` INT NOT NULL,
                    `total_star` FLOAT NOT NULL,
                    `facility` FLOAT NOT NULL,
                    `acsbl` FLOAT NOT NULL,
                    `teacher` FLOAT NOT NULL,
                    `cost_efct` FLOAT NOT NULL,
                    `achievement` FLOAT NOT NULL,
                    `benefit` VARCHAR(250) NOT NULL,
                    `drawback` VARCHAR(250) NOT NULL,
                    `regist_day` DATE NOT NULL,
                    PRIMARY KEY(`no`),
                    UNIQUE KEY(`user_no`),
                    FOREIGN KEY(`parent`) REFERENCES academy(`no`) 
                    ON DELETE CASCADE
                  );";
            break;
          case 'acd_story' : //학원에서 올리는 포스팅
            $sql = "CREATE TABLE `acd_story` (
                    `no` INT NOT NULL AUTO_INCREMENT,
                    `parent` INT NOT NULL,
                    `acd_name` VARCHAR(20) NOT NULL,
                    `title` VARCHAR(20) NOT NULL,
                    `subtitle` VARCHAR(20) NOT NULL,
                    `content` VARCHAR(500) NOT NULL,
                    `regist_day` DATE NOT NULL,
                    `file_name` VARCHAR(50) NOT NULL,
                    `file_copy` VARCHAR(50) NOT NULL,
                    PRIMARY KEY(`no`),
                    FOREIGN KEY(`parent`) REFERENCES academy(`no`) 
                    ON DELETE CASCADE
                  );";
            break;
      default:
        echo "<script>alert('해당 테이블이름이 없습니다. ');</script>";
        break;
    }//end of switch

    if(mysqli_query($conn,$sql)){
      echo "<script>alert('$table_name 테이블이 생성되었습니다.');</script>";
    }else{
      echo "테이블 생성 실패 : ".mysqli_error($conn);
    }
  }//end of if flag

}//end of function
?>
