<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <!-- favicon -->
    <link rel="shortcut icon" href="/eduplanet/img/favicon.png">
    <script src="http://code.jquery.com/jquery-latest.min.js" charset="utf-8"></script>
    <!-- 자동완성 -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/add_teacher.css">
    <title>add_teacher test</title>
  </head>
  <body>
    <header>
      <!-- <?php
        // include "../index/index_header_searchbar_in.php";
        // include "./header/academy_header.php";
      ?> -->
    </header>
    <section>
      <?php
        $mode = isset($_GET['mode']) ? $_GET['mode'] : "am";
        $action = "members_insert.php?mode=".$mode;
        if(!$mode == "am"){
          echo "<script> alert('학원 관리를 하실수 없습니다.'); history.go(-1); </script>";
        }
        $parent = isset($_GET['parent']) ? $_GET['parnet'] : 1;
       ?>
      <div class="add_teacher">
        <div class="teacher_info">
          <h1>선생님 등록</h1>
          <div class="formImgBox">
            <form class="formImg" action="<?=$action?>" method="post">
              <h3>선생님 이미지</h3>
              <img src="../img/member_basic.png" alt=""><br>
              <input type="file" id="teacherImg" name="teacherImg">
            </form>
          </div>
          <div class="formInfoBox">
            <form class="formBox" action="<?=$action?>" method="post">
              <label for="teacherName">이름</label><br>
              <input type="text" class="formInput" id="teacherName" name="teacherName" placeholder="선생님의 이름을 입력 하세요" required><br>
              <p id="NameText">선생님의 이름을 입력하세요.</p>
            </form>
            <form class="formBox" action="<?=$action?>" method="post">
              <label for="teacherSubject">수업 과목</label><br>
              <input type="text" class="formInput" id="teacherSubject" name="teacherSubject" placeholder="선생님의 과목을 입력 하세요" required><br>
              <p id="subjectText">과목을 입력하세요.</p>
            </form>
            <form class="formBox" action="<?=$action?>" method="post">
              <label for="teacherContent">경력 사항 </label><br>
              <input type="text" class="formInput" id="teacherContent" name="teacherContent" placeholder="선생님의 경력을 입력 하세요" required><br>
              <p id="contentText">경력을 입력하세요.</p>
            </form>
          </div>
          <div class="formButtonBox">
            <form class="buttonBox" action="<?=$action?>" method="post">
              <input type="button" class="saveForm" id="saveForm" value="선생님 등록하기" onclick="formButtonOn()">
              <input type="button" class="formButton" id="formButton" value="시간표 등록하기" onclick="scrollDiv()">
              <input type="reset" class="formButton" id="buttonClear" value="초기화">
            </form>
          </div>
        </div>
      </div>
      <div class="add_schedule">
        <div class="teacher_schecule">
          <h1>선생님 시간표 등록</h1>
          <form class="scheduleSubjectInfo" action="<?=$action?>" method="post">
            <label for="scheduleSubject"> 수업 과목 </label>
            <input type="text" name="scheduleSubject" value="">
          </form>
          <table>
            <tr>
              <td>시간</td>
              <td>월요일</td>
              <td>화요일</td>
              <td>수요일</td>
              <td>목요일</td>
              <td>금요일</td>
              <td>토요일</td>
            </tr>
            <tr>
              <td> 8시 </td>
              <td>
                <input type="checkbox" name="" value="">
              </td>
              <td>
                <input type="checkbox" name="" value="">
              </td>
              <td>
                <input type="checkbox" name="" value="">
              </td>
              <td>
                <input type="checkbox" name="" value="">
              </td>
              <td>
                <input type="checkbox" name="" value="">
              </td>
              <td>
                <input type="checkbox" name="" value="">
              </td>
            </tr>
            <tr>
              <td> 9시 </td>
              <td>
                <input type="checkbox" name="" value="">
              </td>
              <td>
                <input type="checkbox" name="" value="">
              </td>
              <td>
                <input type="checkbox" name="" value="">
              </td>
              <td>
                <input type="checkbox" name="" value="">
              </td>
              <td>
                <input type="checkbox" name="" value="">
              </td>
              <td>
                <input type="checkbox" name="" value="">
              </td>
            </tr>
            <tr>
              <td> 10시 </td>
              <td>
                <input type="checkbox" name="" value="">
              </td>
              <td>
                <input type="checkbox" name="" value="">
              </td>
              <td>
                <input type="checkbox" name="" value="">
              </td>
              <td>
                <input type="checkbox" name="" value="">
              </td>
              <td>
                <input type="checkbox" name="" value="">
              </td>
              <td>
                <input type="checkbox" name="" value="">
              </td>
            </tr>
            <tr>
              <td> 11시 </td>
              <td>
                <input type="checkbox" name="" value="">
              </td>
              <td>
                <input type="checkbox" name="" value="">
              </td>
              <td>
                <input type="checkbox" name="" value="">
              </td>
              <td>
                <input type="checkbox" name="" value="">
              </td>
              <td>
                <input type="checkbox" name="" value="">
              </td>
              <td>
                <input type="checkbox" name="" value="">
              </td>
            </tr>
            <tr>
              <td> 12시 </td>
              <td>
                <input type="checkbox" name="" value="">
              </td>
              <td>
                <input type="checkbox" name="" value="">
              </td>
              <td>
                <input type="checkbox" name="" value="">
              </td>
              <td>
                <input type="checkbox" name="" value="">
              </td>
              <td>
                <input type="checkbox" name="" value="">
              </td>
              <td>
                <input type="checkbox" name="" value="">
              </td>
            </tr>
            <tr>
              <td> 14시 </td>
              <td>
                <input type="checkbox" name="" value="">
              </td>
              <td>
                <input type="checkbox" name="" value="">
              </td>
              <td>
                <input type="checkbox" name="" value="">
              </td>
              <td>
                <input type="checkbox" name="" value="">
              </td>
              <td>
                <input type="checkbox" name="" value="">
              </td>
              <td>
                <input type="checkbox" name="" value="">
              </td>
            </tr>
            <tr>
              <td> 15시 </td>
              <td>
                <input type="checkbox" name="" value="">
              </td>
              <td>
                <input type="checkbox" name="" value="">
              </td>
              <td>
                <input type="checkbox" name="" value="">
              </td>
              <td>
                <input type="checkbox" name="" value="">
              </td>
              <td>
                <input type="checkbox" name="" value="">
              </td>
              <td>
                <input type="checkbox" name="" value="">
              </td>
            </tr>
          </table>
          <input id="saveSchedule" type="submit" name="" value="저장">
          <input id="clearSchedule" type="submit" name="" value="취소">
        </div>
      </div>
    </section>
    <footer>
      <!-- <?php
        // include "../index/footer.php";
      ?> -->
    </footer>
    <script src="./js/add_teacher.js"></script>
  </body>
</html>
