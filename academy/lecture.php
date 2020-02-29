
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>lecture test</title>

    <!-- index_header_searchbar_in -->
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
    <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="./js/lecture.js"></script>
    <script src="./js/slide.js"></script>
    <link rel="stylesheet" href="./css/lecture.css">
    <link rel="stylesheet" href="./css/add_teacher.css">
    <link rel="stylesheet" href="./css/slide.css">

    <!-- slick css&lib -->
    <link rel="stylesheet" type="text/css" href="/eduplanet/lib/slick/slick.css">
    <link rel="stylesheet" type="text/css" href="/eduplanet/lib/slick/slick-theme.css">
    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="/eduplanet/lib/slick/slick.min.js"></script>



    <title></title>

  </head>
  <body>
  <?php
  include "../index/index_header_searchbar_in.php";
  include "./header/academy_header.php";

  $acd_no = isset($_GET["no"]) ?  $_GET["no"] : 1;
  ?>
    <script>
      var acd_no = <?=$acd_no?>
    </script>
    <section>
      <div id="lecture_container">
        <div class="title">
          <h1>강의 정보</h1>
          <div>
            <button onclick="popupUpdateTeacher()">수정/삭제</button>
            <button onclick="popupInsertTeacher()">강사추가</button>
          </div>
        </div>
      <?php
        include "../lib/db_connector.php";
        $sql = "select * from teacher where parent='$acd_no'";
        $result = mysqli_query($conn, $sql);
        $row_num = mysqli_num_rows($result);
      ?>
        <div class="teacher_carousel">
          <?php
            for ($i=0; $i < $row_num; $i++) {
              mysqli_data_seek($result, $i);
              $row = mysqli_fetch_array($result);
              $no = $row["no"];
              $parent = $row["parent"];
              $name = $row["name"];
              $subject = $row["subject"];
              $content = $row["content"];
              $file_copy = $row["file_copy"];
          ?>
          <div class="teacher_box">
            <div class="teacher" onclick="getinfo(<?=$no?>)">
              <img class="teacher_img" src="/eduplanet/data/teacher_img/<?=$file_copy?>" alt="teacher_img">
              <div class="card-body">
                <h4><span><?=$subject?></span><?=$name?></h4>
                <p class="card-text"><?=$content?></p>
              </div>
            </div>
          </div>
          <?php
          }
          ?>
        </div>
      </div>
        <div class="teacher_schedule">
          <div class="title">
            <h1 id="teacher_lecture">강의 시간표</h1>
            <div>
              <button onclick="popupUpdateSchedule()">수정/삭제</button>
              <button onclick="popupInsertSchedule()">시간표 추가</button>
            </div>
          </div>
          <table id="table">
          </table>
        </div>
      </div>
    </section>

    <!-- 팝업레이어 -->
    <div id="overlay">
    </div>

    <!-- 선생님 등록 레이어 -->
    <div id="insertTeacher">
        <div class="teacher_info">
          <h1>선생님 등록<img src="/eduplanet/img/close_icon.png" id="btn_add_tu_close"></h1>
          <form class="forminfo" action="<?=$action?>" method="post" enctype="multipart/form-data\">
            <div class="formImgBox">
              <img id="teacherImgShow" src="../img/member_basic.png" alt=""><br>
              <input type="file" id="teacherImg" name="teacherImg" accept=".jpg,.jpeg,.png,.gif">
            </div>
            <div class="formInfoBox">
              <div class="formBox">
                <label for="teacherName">이름</label><br>
                <input type="text" class="formInput" id="teacherName" name="teacherName" placeholder="선생님의 이름을 입력 하세요" required><br>
                <p id="NameText">선생님의 이름을 입력하세요.</p>
              </div>
              <div class="formBox">
                <label for="teacherSubject">수업 과목</label><br>
                <input type="text" class="formInput" id="teacherSubject" name="teacherSubject" placeholder="선생님의 과목을 입력 하세요" required><br>
                <p id="subjectText">과목을 입력하세요.</p>
              </div>
              <div class="formBox">
                <label for="teacherContent">경력 사항 </label><br>
                <input type="text" class="formInput" id="teacherContent" name="teacherContent" placeholder="선생님의 경력을 입력 하세요" required><br>
                <p id="contentText">경력을 입력하세요.</p>
              </div>
            </div>
            <div class="formButtonBox">
              <div class="buttonBox" action="<?=$action?>" method="post">
                <input type="reset" class="formButton" id="buttonClear" value="초기화">
                <input type="button" class="saveForm" id="saveForm" value="선생님 등록하기" onclick="saveTeacherInfo(<?=$parent?>, )">
              </div>
            </form>
          </div>
        </div>
    </div>

    <!-- 선생님 수정 레이어 -->
    <div id="updateTeacher">
        <div class="teacher_info">
          <h1>선생님 수정<img src="/eduplanet/img/close_icon.png" id="btn_add_t_close"></h1>
          <form class="forminfo" action="<?=$action?>" method="post" enctype="multipart/form-data\">
            <div class="formImgBox">
              <img id="teacherImgShow" src="../img/member_basic.png" alt=""><br>
              <input type="file" name="teacherImg" accept=".jpg,.jpeg,.png,.gif">
            </div>
            <div class="formInfoBox">
              <div class="formBox">
                <label for="teacherName">이름</label><br>
                <input type="text" class="formInput" name="teacherName" placeholder="선생님의 이름을 입력 하세요" required><br>
                <p id="NameText">선생님의 이름을 입력하세요.</p>
              </div>
              <div class="formBox">
                <label for="teacherSubject">수업 과목</label><br>
                <input type="text" class="formInput" name="teacherSubject" placeholder="선생님의 과목을 입력 하세요" required><br>
                <p id="subjectText">과목을 입력하세요.</p>
              </div>
              <div class="formBox">
                <label for="teacherContent">경력 사항 </label><br>
                <input type="text" class="formInput" name="teacherContent" placeholder="선생님의 경력을 입력 하세요" required><br>
                <p id="contentText">경력을 입력하세요.</p>
              </div>
            </div>
            <div class="formButtonBox">
              <div class="buttonBox">
                <input type="reset" class="formButton"  value="삭제하기">
                <input type="button" class="saveForm" value="수정하기">
              </div>
            </form>
          </div>
        </div>
    </div>


    <!-- 시간표 등록 레이어 -->
    <div id="insertSchedule">
      <h1>시간표 등록<img src="/eduplanet/img/close_icon.png" id="btn_add_si_close"></h1>
      <p>* 시간은 0~24시 사이로 입력하셔야 합니다</p>
      <table class="table_temp">
        <tr>
          <td class="sc_top"></td>
          <td class="sc_top">월</td>
          <td class="sc_top">화</td>
          <td class="sc_top">수</td>
          <td class="sc_top">목</td>
          <td class="sc_top">금</td>
          <td class="sc_top">토</td>
        </tr>
        <tr>
          <td class="sc_order">
            <input type="number" name="input_order[]" placeholder="시간입력" oninput="setOrder(this)">
          </td>
          <td>
            <form action="#" method="post">
              <input class="order_value" type="hidden" name="order[]" value="">
              <input class="parent_value" type="hidden" name="parent[]" value="">
              <input type="hidden" name="day[]" value="1">
              <input type="text" name="subject[]" placeholder="과목">
            </form>
          </td>
          <td>
            <form action="#" method="post">
              <input class="order_value" type="hidden" name="order[]" value="">
              <input class="parent_value" type="hidden" name="parent[]" value="">
              <input type="hidden" name="day[]" value="2">
              <input type="text" name="subject[]" placeholder="과목">
            </form>
          </td>
          <td>
            <form action="#" method="post">
              <input class="order_value" type="hidden" name="order[]" value="">
              <input class="parent_value" type="hidden" name="parent[]" value="">
              <input type="hidden" name="day[]" value="3">
              <input type="text" name="subject[]" placeholder="과목">
            </form>
          </td>
          <td>
            <form action="#" method="post">
              <input class="order_value" type="hidden" name="order[]" value="">
              <input class="parent_value" type="hidden" name="parent[]" value="">
              <input type="hidden" name="day[]" value="4">
              <input type="text" name="subject[]" placeholder="과목">
            </form>
          </td>
          <td>
            <form action="#" method="post">
              <input class="order_value" type="hidden" name="order[]" value="">
              <input class="parent_value" type="hidden" name="parent[]" value="">
              <input type="hidden" name="day[]" value="5">
              <input type="text" name="subject[]" placeholder="과목">
            </form>
          </td>
          <td>
            <form action="#" method="post">
              <input class="order_value" type="hidden" name="order[]" value="">
              <input class="parent_value" type="hidden" name="parent[]" value="">
              <input type="hidden" name="day[]" value="6">
              <input type="text" name="subject[]" placeholder="과목">
            </form>
          </td>
        </tr>

      </table>
      <div id="add_time" onclick="addScheduleTime()">
        <i class="fas fa-plus-square" style="color: #2E89FF">&nbsp;&nbsp;시간표 추가하기</i>
      </div>

      <div id="add_schedule_button">
        <input type="reset" value="초기화" onclick="clearLectureTable()">
        <input type="button" value="시간표 등록하기" onclick="insertLecture()">
      </div>
    
    </div>


    <!-- 시간표 수정 레이어 -->
    <div id="updateSchedule">
      <h1>시간표 등록<img src="/eduplanet/img/close_icon.png" id="btn_add_si_close"></h1>
      <p>* 시간은 0~24시 사이로 입력하셔야 합니다</p>
      <table class="table_temp">
        
      </table>
      <div id="add_time" onclick="addScheduleTime()">
        <i class="fas fa-plus-square" style="color: #2E89FF">&nbsp;&nbsp;시간표 추가하기</i>
      </div>

      <div id="add_schedule_button">
        <input type="reset" value="초기화" onclick="clearLectureTable()">
        <input type="button" value="시간표 등록하기" onclick="insertLecture()">
      </div>
    </div>

    <footer>
      <?php include "../index/footer.php"; ?>
    </footer>
  </body>
</html>
