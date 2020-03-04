<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>에듀플래닛</title>

  <!-- favicon -->
  <link rel="shortcut icon" href="/eduplanet/img/favicon.png">

  <script src="https://code.jquery.com/jquery-latest.min.js" charset="utf-8"></script>

  <!-- 폰트 -->
  <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR&amp;display=swap" rel="stylesheet">

  <!-- 아이콘 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css">

  <!-- 자동완성 -->
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

  <!-- CSS -->
  <link rel="stylesheet" href="/eduplanet/index/index_header.css">
  <link rel="stylesheet" href="/eduplanet/mypage/css/review_write_popup.css">
  <link rel="stylesheet" href="./join.css">

</head>

<body onload='setDateBox()'>

  <!-- 카카오 로그인 시 정보 가져오기 -->
  <?php

  if (isset($_POST["kakao_id"])) {
    $kakao_id = $_POST["kakao_id"];
  }

  if (isset($_POST["kakao_email"])) {
    $kakao_email = $_POST["kakao_email"];
  }
  if (isset($_POST["naver_id"])) {
    $naver_id = $_POST["naver_id"];
  }

  ?>

  <header>
    <?php
    include_once $_SERVER["DOCUMENT_ROOT"] . "/eduplanet/index/index_header.php";
    ?>
  </header>

  <main>
    <section>
      <div id="main">

        <?php

        $mode = isset($_GET['mode']) ? $_GET['mode'] : "gm";

        if ($mode == "gm") {
          echo
            "<h2>일반 회원 가입</h2>
              <p class='join_mode_p'>사업자 회원이신가요?</p>
              <a href='/eduplanet/login_join/join_form.php?mode=am'><p class='join_mode_a'>사업자 회원 가입</p></a>
              <form id='form_member' action='join_member_mailing.php?mode=gm' method='post' autocomplete='on'>
              ";
        } else if ($mode == "am") {
          echo
            "<h2>사업자 회원 가입</h2>
              <p class='join_mode_p'>일반 회원이신가요?</p>
              <a href='/eduplanet/login_join/join_form.php'><p class='join_mode_a'>일반 회원 가입</p></a>
              <form id='form_member' action='a_members_insert.php?mode=am' method='post' autocomplete='on' enctype='multipart/form-data'>
              ";
        }
        ?>

        <div class="formBox">
          <label for="inputId">아이디 (이메일)</label>

          <!-- 카카오에서 받아온 이메일이 있을 때 셋팅 -->
          <?php

          if (isset($kakao_email)) {
          ?>
            <input type="email" class="formInput" id="inputId" name="inputId" placeholder="이메일을 입력해주세요" value="<?= $kakao_email ?>" readonly>

          <?php
          } else if(isset($naver_id)){
          ?>
            <input type="email" class="formInput" id="inputId" name="inputId" placeholder="이메일을 입력해주세요" value="<?= $naver_id ?>" readonly>
          <?php
          }else {
          ?>
            <input type="email" class="formInput" id="inputId" name="inputId" placeholder="이메일을 입력해주세요" required>
          <?php
          }
          ?>
          <p class="subMsg" id="idSubMsg"></p>
        </div>

        <div class="formBox">
          <label for="inputPw1">비밀번호</label>
          <input type="password" class="formInput" id="inputPw1" name="inputPw1" placeholder="비밀번호를 입력해주세요" required>
        </div>

        <div class="formBox">
          <label for="inputPw2">비밀번호 확인</label>
          <input type="password" class="formInput" id="inputPw2" name="inputPw2" placeholder="비밀번호를 확인해주세요" required>
          <p class="subMsg" id="pwSubMsg"></p>
        </div>

        <!-- mode:gm이면 전화번호 입력, mode:am이면 학원명 입력(학원명은 검색해서 입력받는 것으로 수정하기 : 일단은 인풋으로) -->
        <div class="formBox">
          <?php
          if ($mode == "gm") {
            echo "<label for='inputTel'>전화번호</label>
                      <input type='tel' class='formInput' id='inputTel' name='inputTel' placeholder='전화번호를 -없이 입력해주세요' required>
                      <p class='subMsg' id='telSubMsg'></p>
                     ";
          } else if ($mode == "am") {
            echo "<label for='inputAcdName'>학원/교습소 이름</label>
                      <input type='text' class='formInput' id='acd_name_join' name='acd_name_join' placeholder='학원/교습소 이름을 띄어쓰기없이 입력해주세요' required>
                      <input type='hidden' id='si_name_join' name='si_name_join'>
                      <input type='hidden' id='dong_name_join' name='dong_name_join'>
                      <p class='subMsg' id='AcdNameSubMsg'></p>
                     ";
          }
          ?>
        </div>

        <!-- mode:gm이면 관심번호 입력, mode:am이면 대표자명 입력 -->
        <div class="formBox">
          <?php
          if ($mode == "gm") {
            echo "<label for='inputIntres'>관심과목</label>
                      <input type='text' class='formInput' id='inputIntres' name='inputIntres' placeholder='관심과목을 입력해주세요' required>
                      <p class='subMsg' id='intresSubMsg'></p>
                     ";
          } else if ($mode == "am") {
            echo "<label for='inputRprsn'>대표자명</label>
                      <input type='text' class='formInput' id='inputRprsn' name='inputRprsn' placeholder='대표자명을 입력해주세요' required>
                      <p class='subMsg' id='RprsnSubMsg'></p>
                     ";
          }
          ?>
        </div>

        <!-- mode:gm이면 출생년도 선택, mode:am이면 사업자등록증 업로드 -->
        <div class="formBox">
          <?php
          if ($mode == "gm") {
            echo "<label for='inputAge'>출생년도&nbsp;&nbsp;&nbsp;</label>
                      <select id='inputAge' name='inputAge' title='year' required></select>
                     ";
          } else if ($mode == "am") {
            echo "<label for='inputLicense'>사업자등록증</label>
                      <input type='file' class='formInput' id='inputLicense' name='inputLicense' placeholder='사업자등록증을 업로드 해주세요' required>
                      <p class='subMsg' id='LicenseSubMsg'></p>
                     ";
          }
          ?>
        </div>

        <div id="form_member_bottom">
          <h5>에듀플래닛의 <a href="#">이용약관</a>및 <a href="#">개인정보 취급방침</a>에 동의합니다.</h5>
        </div>
        <input type="button" id="btnFormSubmit" value="회원가입" onclick="document.getElementById('form_member').submit()" disabled>
        </form>
      </div>
    </section>
  </main>

  <script>
    var mode = '<?= $mode ?>';
  </script>

  <script src="./join.js"></script>

</body>

</html>
