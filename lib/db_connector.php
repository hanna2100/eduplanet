<?php
date_default_timezone_set("Asia/Seoul");

$servername = "localhost";
$username = "root";
$password = "123456";
$dbflag ="NO";//eduplanet db존재여부

// 1 .Create connection mysql -u root -p 123456 -h 192.168.0.230
$conn = mysqli_connect($servername, $username, $password);
if (!$conn){ die("Connection failed: " . mysqli_connect_error());}

$sql = "show databases";
$result=mysqli_query($conn,$sql) or die('Error: '.mysqli_error($conn));

while ($row=mysqli_fetch_row($result)) {
  if($row[0] ==='eduplanet'){
    $dbflag="OK";
    break;
  }
}

if($dbflag==="NO"){
  $sql = "create database eduplanet";
  if(mysqli_query($conn,$sql)){
    echo "<script>alert('eduplanet DB가 생성되었습니다.');</script> ";
  }else{
    echo "eduplanet DB생성실패 : ".mysqli_error($conn);
  }
}

//2. 데이타 베이스 선택
$dbconn = mysqli_select_db($conn,"eduplanet") or die('Error: '.mysqli_error($conn));

//3. 테이블 생성
include_once 'create_table.php';
$table_name = array('academy', 'g_members', 'a_members', 'teacher', 'lecture'
                    , 'review', 'acd_story', 'product', 'gm_order', 'am_order', 'sales', 'follow');

for($i=0; $i<sizeof($table_name); $i++){
  create_table($conn, $table_name[$i]);
}

//4. 초기값 설정
include_once 'api_connector.php';
include_once 'insert_init_data.php';

for($i=0; $i<sizeof($table_name); $i++){
  insert_init_data($conn, $table_name[$i]);
}

function test_input($data) {
  $data = trim($data); //문자열 앞, 뒤 공백제거
  $data = stripslashes($data); //'\'제거
  $data = htmlspecialchars($data); // injection보안, &, ', ", <, > 변환
  return $data;
}

function alert_back($data) {
  echo "<script>alert('$data');history.go(-1);</script>";
  exit;
}
?>
