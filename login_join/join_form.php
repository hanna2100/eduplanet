<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <script src="http://code.jquery.com/jquery-1.12.4.min.js" charset="utf-8"></script>
    <script src="./join.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./join.css">
  </head>

  <body>
    <header>

    </header>

    <main>
      <section>
        <div id="main">
          <h2>에듀플래닛에 오신 걸 환영합니다</h2>
          <form id="form_member" action="./g_members_insert" method="post" autocomplete="on">
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
            <div class="formBox">
              <label for="inputTel">전화번호</label>
              <input type="tel" class="formInput" id="inputTel" name="inputTel" placeholder="전화번호를 -없이 입력해주세요" required>
              <p class="subMsg" id="telSubMsg"></p>
            </div>
            <div class="formBox">
              <label for="inputIntres">관심과목</label>
              <input type="text" class="formInput" id="inputIntres" name="inputIntres" placeholder="관심과목을 입력해주세요" required>
              <p class="subMsg" id="intresSubMsg"></p>
            </div>
            <div class="formBox">
              <label for="inputAge">출생년도&nbsp;&nbsp;&nbsp;</label>
              <select id="inputAge" name="inputAge" title="year" required></select>
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


  </body>
</html>
