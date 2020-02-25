<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <!-- favicon -->
    <link rel="shortcut icon" href="/eduplanet/img/favicon.png">
    <script src="http://code.jquery.com/jquery-latest.min.js" charset="utf-8"></script>
    <!-- 자동완성 -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./join.css">
  </head>

  <body onload='setDateBox()'>
    <header>

    </header>


    <main>
      <section>
        <div id="main">
         <?php
           $mode = isset($_GET['mode']) ? $_GET['mode'] : "gm";
             $action = "members_insert.php?mode=".$mode;
             if($mode == "gm") {
               echo "<h2>회원가입</h2>
                       <form id='form_member' action=$action method='post' autocomplete='on'>
                    ";
             }else if($mode == "am") {
               echo "<h2>학원회원 가입</h2>
                      <form id='form_member' action=$action method='post' autocomplete='on' enctype='multipart/form-data'>
                    ";
             }
          ?>

              <div class="formBox">
                <label for="inputId">아이디&nbsp;&nbsp;&nbsp;</label>
                <input type="text" class="formInput" id="inputId" name="inputId" placeholder="아이디를 입력해주세요" required>
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
              <div class="formBox">
                <label for="inputEmail">이메일</label>
                <input type="email" class="formInput" id="inputEmail" name="inputEmail" placeholder="이메일을 입력해주세요" required>
                <p class="subMsg" id="emailSubMsg"></p>
              </div>

              <!-- mode:gm이면 전화번호 입력, mode:am이면 학원명 입력(학원명은 검색해서 입력받는 것으로 수정하기 : 일단은 인풋으로) -->
              <div class="formBox">
              <?php
              if($mode == "gm") {
                echo "<label for='inputTel'>전화번호</label>
                      <input type='tel' class='formInput' id='inputTel' name='inputTel' placeholder='전화번호를 -없이 입력해주세요' required>
                      <p class='subMsg' id='telSubMsg'></p>
                     ";
              }else if($mode == "am") {
                echo "<label for='inputAcdName'>학원/교습소 이름</label>
                      <input type='text' class='formInput' id='acd_name' name='acd_name' placeholder='학원/교습소 이름을 띄어쓰기없이 입력해주세요' required>
                      <input type='hidden' id='si_name' name='si_name'>
                      <input type='hidden' id='dong_name' name='dong_name'>
                      <p class='subMsg' id='AcdNameSubMsg'></p>
                     ";
              }
               ?>
              </div>

              <!-- mode:gm이면 관심번호 입력, mode:am이면 대표자명 입력 -->
              <div class="formBox">
              <?php
              if($mode == "gm") {
                echo "<label for='inputIntres'>관심과목</label>
                      <input type='text' class='formInput' id='inputIntres' name='inputIntres' placeholder='관심과목을 입력해주세요' required>
                      <p class='subMsg' id='intresSubMsg'></p>
                     ";
              }else if($mode == "am") {
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
              if($mode == "gm") {
                echo "<label for='inputAge'>출생년도&nbsp;&nbsp;&nbsp;</label>
                      <select id='inputAge' name='inputAge' title='year' required></select>
                     ";
              }else if($mode == "am") {
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




    <footer></footer>
    <script>
      var mode = '<?=$mode?>';
      // if(mode == "am"){
      //   $("#main h2").html("학원회원 가입");
      //   $(".join").html("<a href='./join_form.php?mode=am'>학원회원 가입</a>");
      //   $(".login").prev().html("일반 회원이시라면");
      //   $(".login").html("<a href='./login_form.php?mode=gm'>일반회원 로그인</a>");
      // }
    </script>
  <script src="./join.js"></script>

  </body>
</html>
