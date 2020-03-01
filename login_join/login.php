 <?php

  @session_start();

  include_once $_SERVER["DOCUMENT_ROOT"] . "/eduplanet/lib/db_connector.php";

  // 관리자 아이디, 비밀번호 선언
  define('ADMIN_ID', "admin");
  define('ADMIN_PW', "admin_12");

  $input_id = test_input($_POST['inputId']);
  $input_pw = test_input($_POST['inputPw']);

  $mode = $_GET['mode'];

  // 관리자 아이디, 비밀번호 입력 시 mode 설정
  if ($input_id == ADMIN_ID && $input_pw == ADMIN_PW) {
    $mode = "admin";
  }

  // URL에 담긴 mode에 따라 세션에 줄 값을 정해줌
  switch ($mode) {

    case "gm":
      $mode_no = "gm_no";
      $pay = "pgm_no";
      $table_members = "g_members";
      $table_order = "gm_order";
      break;

    case "am":
      $mode_no = "am_no";
      $pay = "pam_no";
      $table_members = "a_members";
      $table_order = "am_order";
      break;

    case "admin":
      $_SESSION["admin"] = "admin";
      mysqli_close($conn);
      header('Location: /eduplanet/admin/index.php');
      break;
  }

  $sql = "SELECT * FROM $table_members WHERE id='$input_id'";

  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_array($result);
  $id_exist = mysqli_num_rows($result);
  $no = $row["no"];
  $pw = $row["pw"];
  $expiry_day = $row["expiry_day"];

  $sql_order = "SELECT EXISTS (SELECT date FROM $table_order WHERE $mode_no='$no' order by date desc) as success;";


  // DB 에서 가져온 아이디가 없을 때
  if (!$id_exist) {

    alert_back('아이디가 존재하지 않습니다.');
    $input_id = "";

  // DB 에서 가져온 아이디가 있을 때, 비밀번호 검사 후 세션값 주기
  } else {

    if ($input_pw != $pw) {
      alert_back('비밀번호가 일치하지 않습니다.');

    } else {

      // 만료날짜가 없을 때 (유료회원이 아닐 때)
      if ($expiry_day == "0000-00-00") {

        // 기존에 멤버십 구입을 한번도 하지 않은 경우
        $result_order = mysqli_query($conn, $sql_order);
        $row_order = mysqli_fetch_array($result_order);
        $latest_order_date = $row_order['success'];

        if(!$latest_order_date){

          // gm_no, am_no 세션 값 주기
          $_SESSION[$mode_no] = $no;
          alert_move('에듀플래닛에 오신 것을 환영합니다.', '/eduplanet/index.php');

        }
        // 기존에 멤버십 구입을 했으나 만료된 경우
        else{

          // gm_no, am_no 세션 값 주기
          $_SESSION[$mode_no] = $no;
          alert_move('에듀플래닛에 오신 것을 환영합니다. \n멤버십 이용기간이 만료되어 멤버십 페이지로 이동합니다.', '/eduplanet/membership/index.php');
        }


      // 만료날짜가 있을 때 (유료회원일 때)
      } else {

         // 해당 아이디의 만료날짜와 현재날짜를 비교하기
        date_default_timezone_set('Asia/Seoul');
        $today = date("Y-m-d");
        $today = strtotime($today);
        $expiry_day = strtotime($expiry_day);

        // 만료날짜가 현재날짜보다 이전일 때 (멤버십이 끝났을 때)
        if ($expiry_day < $today) {

          // 테이블 만료날짜를 0000-00-00 으로 업데이트
          $sql_exp = "UPDATE $table_members SET expiry_day='0000-00-00' WHERE no=$no";
          mysqli_query($conn, $sql_exp);

          if (!mysqli_query($conn, $sql_exp)) {
            echo "오류ㅠ.ㅠ : ".mysqli_error($conn);
          }

          $_SESSION[$mode_no] = $no;
          alert_move('에듀플래닛에 오신 것을 환영합니다. \n멤버십 이용기간이 만료되어 멤버십 페이지로 이동합니다.', '/eduplanet/membership/index.php');

        // 만료날짜가 현재날짜보다 이후거나 같을 때 (멤버십이 이용중일 때)
        } else if ($expiry_day >= $today) {

          $_SESSION[$mode_no] = $no;
          $_SESSION[$pay] = $no;
          alert_move('에듀플래닛에 오신 것을 환영합니다.', '/eduplanet/index.php');

        }
      }

      mysqli_close($conn);

    }
  }

  function alert_move($msg, $url){
    echo "
          <script>
              alert('$msg');
              location.href = '$url';
          </script>
        ";
        exit;
  };


  ?>
