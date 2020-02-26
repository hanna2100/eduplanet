<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <!-- 제이쿼리 -->
    <script src="http://code.jquery.com/jquery-1.12.4.min.js" charset="utf-8"></script>

    <!-- 자동완성 -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <!-- CSS -->
    <link rel="stylesheet" href="/eduplanet/index/index_header_searchbar_in.css">

    <!-- 스크립트 -->
    <script src="/eduplanet/searchbar/searchbar_in.js"></script>

    <link rel="stylesheet" href="/eduplanet/academy/header/academy_header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR&amp;display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="/eduplanet/img/favicon.png">
    <link rel="stylesheet" href="/eduplanet/mypage/css/review_write_popup.css">
    <script src="/eduplanet/mypage/js/review_write.js"></script>
    <link rel="stylesheet" href="./header/academy_header.css">
    <link rel="stylesheet" href="../index/footer.css">
    <!-- 나의 css -->
    <link rel="stylesheet" href="./css/add_teacher.css">
    <script src="./js/add_teacher.js"></script>
    <title></title>
  </head>
  <body>
    <header>
      <?php
        include "../index/index_header_searchbar_in.php";
        include "./header/academy_header.php";
      ?>
    </header>
    <section>
      <div class="add_teacher">
        <div class="teacher_info">
          <h1>선생님 등록</h1>
          <div class="formImgBox">
            <form class="formImg" action="index.html" method="post">
              <h3>선생님 이미지</h3>
              <img src="../img/member_basic.png" alt=""><br>
              <input type="file" id="teacherImg" name="teacherImg">
            </form>
          </div>
          <div class="formInfoBox">
            <form class="formBox" action="index.html" method="post">
              <label for="teacherName">이름</label><br>
              <input type="text" class="formInput" id="teacherName" name="teacherName" placeholder="선생님의 이름을 입력 하세요" required><br>
              <p id="NameText"></p>
            </form>
            <form class="formBox" action="index.html" method="post">
              <label for="teacherSubject">수업 과목</label><br>
              <input type="text" class="formInput" id="teacherSubject" name="teacherSubject" placeholder="선생님의 과목을 입력 하세요" required><br>
              <p id="subjectText"></p>
            </form>
            <form class="formBox" action="index.html" method="post">
              <label for="teacherContent">경력 사항 </label><br>
              <input type="text" class="formInput" id="teacherContent" name="teacherContent" placeholder="선생님의 경력을 입력 하세요" required><br>
              <p id="contentText"></p>
            </form>
          </div>
          <div class="formButtonBox">
            <form class="buttonBox" action="index.html" method="post">
              <input type="submit" class="formButton" id="formButton" value="등록하기" onclick="">
              <input type="reset" class="formButton" id="buttonClear" value="초기화" onclick="reset()">
            </form>
          </div>
        </div>
      </div>
    </section>
    <footer>
      <?php
        include "../index/footer.php";
      ?>
    </footer>
  </body>
</html>
