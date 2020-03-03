
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">

    <!-- favicon -->
    <link rel="shortcut icon" href="/eduplanet/img/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/eduplanet/mypage/css/review_write_popup.css">
    <script src="http://code.jquery.com/jquery-1.12.4.min.js" charset="utf-8"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="/eduplanet/mypage/js/review_write.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/eduplanet/index/index_header_searchbar_in.css">
    <script src="/eduplanet/searchbar/searchbar_in.js"></script>
    <script src="/eduplanet/academy/js/index.js"></script>

    <link rel="stylesheet" href="/eduplanet/index/footer.css">
    <link rel="stylesheet" href="/eduplanet/academy/header/academy_header.css">
    <link rel="stylesheet" href="./css/index.css">







    <title>EduPlanet</title>
  </head>
  <body>

    <header>
      <?php include_once $_SERVER["DOCUMENT_ROOT"]."/eduplanet/index/index_header_searchbar_in.php";?>
      <?php include_once $_SERVER["DOCUMENT_ROOT"]."/eduplanet/academy/header/academy_header.php"; ?>
    </header>

    <main>

    <div id="eduInforMain">
      <div id="eduform">

        <div id="edutitle">
          <h1 class="title">학원 정보</h1>
        </div>
        <div id="infor">
          <table>
            <ul>
              <li class="li_width_index">교습과정명</li>
              <li><span id="course_name" name="spand"></span></li>
            </ul>
            <ul>
              <li class="li_width_index">대표자명</li>
              <li><span id="rep_course" name="saa"></span></li>
            </ul>
            <ul>
              <li class="li_width_index">주소 (도로명)</li>
              <li><span id="address"></span></li>
            </ul>
            <ul>
              <li class="li_width_index">전화번호</li>
              <li><span id="number"></span></li>
            </ul>
            <ul>
              <li class="li_width_index">강사 / 강의정보</li>
              <li><span id="information_class"></span></li>
            </ul>
            <ul>
              <li class="li_width_index">웹사이트</li>
              <li><span id="site_address">-</span></li>
            </ul>
            <ul>
              <li class="li_width_index">통학버스 여부</li>
              <li><span id="schoolbus_status">-</span></li>
            </ul>
            <ul>
              <li class="li_width_index">소개</li>
              <li><span id="introduce">-</span></li>
            </ul>
            
            
          </table>
        </div> <!-- infor -->
        <div id="infor_modify">
            <?php
              if($am_no){
             ?>
             <button id="modify_button" type="button" name="button" onclick="popupAddInfo()">정보수정</button>
              <?php
            }else {

            }
              ?>


        </div>


      </div><!-- eduform end -->
      <!-- 팝업레이어 -->
      <div id="overlay">
      </div>

      <!-- 정보 수정 레이어 -->
      <div id="addInfo">
      <form id="edit_form" action="./index_edit.php" method="post">

        <h1><span id="edit_text">학원 정보 수정</span><img src="/eduplanet/img/close_icon.png" id="btn_add_tu_close"></h1>
        <table>
          <div class="edit_div">
          <ul>
            <li class="li_width">교습과정명</li>
            <li><span id="course_name2" name="spand"></span></li>
          </ul>
          <ul>
            <li class="li_width">대표자명</li>
            <li><span id="rep_course2" name="saa"></span></li>
          </ul>
          <ul>
            <li class="li_width">주소 (도로명)</li>
            <li><span id="address2"></span></li>
          </ul>
          <ul>
            <li class="li_width">전화번호</li>
            <li><span id="number2"></span></li>
          </ul>
          <ul>
            <li class="li_width">강사 / 강의정보</li>
            <li><span id="information_class2"></span></li>
          </ul>
          <ul>
            <li class="li_width">웹사이트</li>
            <li> <input id="site_address2" type="url" name="website" value="" placeholder="웹사이트를 입력해 주세요."> </li>
          </ul>
          <ul>
            <li class="li_width">통학버스 여부</li>
            <li><input id="schoolbus_status2" type="text" name="schoolbus" value="" placeholder="통학버스 여부를 입력해 주세요."> </li>
          </ul>
          <ul>
            <li class="li_width2">소개</li>
            <li><textarea id="introduce2" name="introduce" rows="7" cols="90" placeholder="학원을 소개하는 글을 간단하게 입력해 주세요."></textarea> </li>
          </ul>
          
          </div>
          
        </table>
      </form>
        <div id="adjust">
          <button type="button" name="button" id="edit" onclick="document.getElementById('edit_form').submit();">수정완료</button>
          <button type="button" name="button" id="cancel" onclick="popupAddInfo()">수정취소</button>
        </div>
      </div>

    <div id="infor_map">
      <div id="map_div">
        <h1 class="title">학원 위치 보기</h1>
      </div>
      <div id="mapp">

      <div id="map" style="width:100%;height:400px;"></div>

      <script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=79f3ade82ebdd492df0cd3712dc6f828&libraries=services"></script>
      <script>

      <?php
        $name = "안녕 세상아";
        $no = $_GET["no"];
        // $page = $_GET["page"];

        // DB에서 가져오기-------------------------------------
        include_once("../lib/db_connector.php");

        // $con = mysqli_connect("localhost","root","123456","eduplanet");
        $sql = "select * from academy where no = $no";
        $result = mysqli_query($conn,$sql);

        $row = mysqli_fetch_array($result);

        $acd_name = $row["acd_name"]; //교습과정
        $rprsn = $row["rprsn"]; //대표자명
        $class = $row["class"]; //대표과정
        $address = $row["address"]; //주소
        $tel = $row["tel"]; //전화
        $website = $row["website"]; //사이트 주소
        $schoolbus = $row["schoolbus"]; //스쿨버스 여부
        $introduce = $row["introduce"]; // 소개
        // $latitude = $row["latitude"];  //위도
        // $longtitude = $row["longitude"]; //경도
        //-------------------------------

        //DB 닫아주기
        mysqli_close($conn);

       ?>


       // 학원 정보 span에 띄우기---------------
       document.getElementById("course_name").innerHTML= "<?= $acd_name ?>"
       document.getElementById("rep_course").innerHTML= "<?= $rprsn ?>"
       document.getElementById("address").innerHTML= "<?= $address ?>"
       document.getElementById("number").innerHTML= "<?= $tel ?>"
       document.getElementById("site_address").innerHTML = "<?= $website ?>"
       document.getElementById("schoolbus_status").innerHTML = "<?= $schoolbus ?>"
       document.getElementById("introduce").innerHTML = "<?= $introduce ?>"
       document.getElementById("information_class").innerHTML= "<?= $class ?>"

       document.getElementById("course_name2").innerHTML= "<?= $acd_name ?>"
       document.getElementById("rep_course2").innerHTML= "<?= $rprsn ?>"
       document.getElementById("address2").innerHTML= "<?= $address ?>"
       document.getElementById("number2").innerHTML= "<?= $tel ?>"
       document.getElementById("information_class2").innerHTML= "<?= $class ?>"
       //-------------------------------------------------------------------
       console.log("sdsdsd");
      var my_address = "<?=$address?>" //위도 경도로 바꿀 주소 넣기
      var mapContainer = document.getElementById('map'), // 지도를 표시할 div
          mapOption = {
              center: new kakao.maps.LatLng(33.450701, 126.570667), // 지도의 중심좌표
              level: 3 // 지도의 확대 레벨
          };

      // 지도를 생성합니다
      var map = new kakao.maps.Map(mapContainer, mapOption);

      // 주소-좌표 변환 객체를 생성합니다
      var geocoder = new kakao.maps.services.Geocoder();

      // 주소로 좌표를 검색합니다
      geocoder.addressSearch(my_address, function(result, status) {

          // 정상적으로 검색이 완료됐으면
           if (status === kakao.maps.services.Status.OK) {

              var coords = new kakao.maps.LatLng(result[0].y, result[0].x);

                console.log(result[0].x);


              // 결과값으로 받은 위치를 마커로 표시합니다
              var marker = new kakao.maps.Marker({
                  map: map,
                  position: coords
              });
              var iwContent ='<div style="width:150px;text-align:center;padding:6px 0;"><strong><?= $acd_name ?></strong><br><a id="asdf" style="color:green" href="https://map.kakao.com/link/to/<?= $acd_name ?>,'+result[0].y+','+result[0].x+'" style="color:blue" target="_blank">길찾기</a></div>';
              // 인포윈도우로 장소에 대한 설명을 표시합니다
              var infowindow = new kakao.maps.InfoWindow({

                  content: iwContent
              });
              infowindow.open(map, marker);
              // 지도의 중심을 결과값으로 받은 위치로 이동시킵니다
              map.setCenter(coords);
          }
      });
      </script>
        </div>

    </div>
    </div> <!-- eduInforMain -->


    </main>
    <footer>
      <?php include_once $_SERVER["DOCUMENT_ROOT"]."/eduplanet/index/footer.php"; ?>
    </footer>
  </body>
</html>
