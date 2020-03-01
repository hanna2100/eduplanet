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
                    `id` CHAR(80) NOT NULL,
                    `pw` CHAR(50) NOT NULL,
                    `phone` CHAR(12) NOT NULL,
                    `age` int NOT NULL,
                    `intres` CHAR(10) NOT NULL,
                    `hash` CHAR(40),
                    `temp_pw` CHAR(10),
                    `expiry_day` DATE DEFAULT '0000-00-00',
                    `regist_day` DATE NOT NULL,
                    PRIMARY KEY (`no`),
                    UNIQUE KEY(`id`)
                  );";
            break;
          case 'a_members' : //학원회원(academy members)
            $sql = "CREATE TABLE `a_members` (
                    `no` INT NOT NULL AUTO_INCREMENT,
                    `acd_no` INT DEFAULT 0,
                    `id` CHAR(80) NOT NULL,
                    `pw` CHAR(50) NOT NULL,
                    `acd_name` VARCHAR(40) NOT NULL,
                    `rprsn` VARCHAR(20) NOT NULL,
                    `file_copy` VARCHAR(50) NOT NULL,
                    `approval` CHAR(1) DEFAULT 'N',
                    `hash` CHAR(40),
                    `temp_pw` CHAR(10),
                    `expiry_day` DATE DEFAULT '0000-00-00',
                    `regist_day` DATE NOT NULL,
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
                    `website` CHAR(50) DEFAULT NULL,
                    `schoolbus` VARCHAR(50) DEFAULT NULL,
                    `introduce` VARCHAR(200) DEFAULT NULL,
                    `file_copy` VARCHAR(50),
                    PRIMARY KEY(`no`)
                  );";
            break;
          case 'academy_temp' : //api데이터를 저장해서 기존 데이터와 비교하기위한 임시테이블
            $sql = "CREATE TABLE `academy_temp` (
                    `no` INT NOT NULL AUTO_INCREMENT,
                    `si_name` CHAR(10) NOT NULL,
                    `dong_name` CHAR(10),
                    `sector` CHAR(10) NOT NULL,
                    `acd_name` VARCHAR(40) NOT NULL,
                    `rprsn` VARCHAR(40),
                    `class` VARCHAR(50),
                    `tel` CHAR(15),
                    `address` VARCHAR(80),
                    PRIMARY KEY(`no`)
                  );";
            break;
          case 'teacher' : //학원에서 작성한 선생님정보
            $sql = "CREATE TABLE `teacher` (
                    `no` INT NOT NULL AUTO_INCREMENT,
                    `parent` INT NOT NULL,
                    `name` VARCHAR(20) NOT NULL,
                    `subject` CHAR(10) NOT NULL,
                    `content` VARCHAR(50) NOT NULL,
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
                    `one_line` VARCHAR(80) NOT NULL,
                    `total_star` INT NOT NULL,
                    `facility` INT NOT NULL,
                    `acsbl` INT NOT NULL,
                    `teacher` INT NOT NULL,
                    `cost_efct` INT NOT NULL,
                    `achievement` INT NOT NULL,
                    `benefit` VARCHAR(250) NOT NULL,
                    `drawback` VARCHAR(250) NOT NULL,
                    `regist_day` DATE NOT NULL,
                    PRIMARY KEY(`no`),
                    FOREIGN KEY(`parent`) REFERENCES academy(`no`) 
                    ON DELETE CASCADE
                  );";
            break;
          case 'acd_story' : //학원에서 올리는 포스팅
            $sql = "CREATE TABLE `acd_story` (
                    `no` INT NOT NULL AUTO_INCREMENT,
                    `parent` INT NOT NULL,
                    `acd_name` VARCHAR(30) NOT NULL,
                    `title` VARCHAR(30) NOT NULL,
                    `subtitle` VARCHAR(30) NOT NULL,
                    `subject1` VARCHAR(30) NOT NULL,
                    `content1` VARCHAR(500) NOT NULL,
                    `subject2` VARCHAR(30),
                    `content2` VARCHAR(500),
                    `subject3` VARCHAR(30),
                    `content3` VARCHAR(500),
                    `hit` INT DEFAULT 0,
                    `regist_day` DATE NOT NULL,
                    `file_name` VARCHAR(50) NOT NULL,
                    `file_copy` VARCHAR(50) NOT NULL,
                    PRIMARY KEY(`no`),
                    FOREIGN KEY(`parent`) REFERENCES academy(`no`) 
                    ON DELETE CASCADE
                  );";
            break;
            case 'product' : //멤버십제품 (일반, 학원 통합)
              $sql = "CREATE TABLE `product` (
                      `no` INT NOT NULL AUTO_INCREMENT,
                      `prdct_name` VARCHAR(30) NOT NULL,
                      `month`INT NOT NULL,
                      `price` INT UNSIGNED NOT NULL,
                      `discount` INT DEFAULT 0,
                      PRIMARY KEY(`no`)
                    );";
            break;
            case 'gm_order' : //일반회원 주문테이블(기본키,회원넘버,제품명,가격,결제방식,상태,결제일)
              $sql = "CREATE TABLE `gm_order` (
                      `no` INT NOT NULL AUTO_INCREMENT,
                      `gm_no` INT NOT NULL,
                      `prdct_name_month` VARCHAR(30) NOT NULL,
	                    `price` INT UNSIGNED NOT NULL,
                      `pay_method` VARCHAR(20) DEFAULT NULL,
                      `status` CHAR(10) NOT NULL,
                      `date` DATE NOT NULL,
                      PRIMARY KEY(`no`)
                    );";
            break;
            case 'am_order' : //학원회원 주문테이블
              $sql = "CREATE TABLE `am_order` (
                      `no` INT NOT NULL AUTO_INCREMENT,
                      `am_no` INT NOT NULL,
                      `prdct_name_month` VARCHAR(30) NOT NULL,
	                    `price` INT UNSIGNED NOT NULL,
                      `pay_method` VARCHAR(20) NOT NULL,
                      `status` CHAR(10) NOT NULL,
                      `date` DATE NOT NULL,
                      PRIMARY KEY(`no`)
                    );";
            break;
            case 'follow' : //팔로우(찜)테이블
              $sql = "CREATE TABLE `follow` (
                      `no` INT NOT NULL AUTO_INCREMENT,
                      `user_no` INT NOT NULL,
	                    `acd_no` INT NOT NULL,
                      PRIMARY KEY(`no`)
                    );";
            break;
            case 'withdrawal' : //회원탈퇴 테이블
              $sql = "CREATE TABLE `withdrawal` (
                      `no` INT NOT NULL AUTO_INCREMENT,
                      `type` CHAR(1) NOT NULL,
	                    `mmbr_no` INT NOT NULL,
	                    `join_date` DATE NOT NULL,
	                    `wthd_date` DATE NOT NULL,
                      PRIMARY KEY(`no`)
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