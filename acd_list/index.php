<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Edu Planet</title>
    <link rel="stylesheet" href="./css/index.css">
    <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
    <link rel="stylesheet" href="./js/index.js">

  </head>
  <body>

    <header>
        <?php include "../index_header_searchbar_out.php"; ?>
    </header>

    <main>
      <?php
      // class Avg{
      //   public $no;
      //   public $avge;
      //
      //   public function __construct($no,$avge){
      //     $this -> $no = $no;
      //     $this -> $avge = $avge;
      //   }
      // }

      // DB에서 가져오기-------------------------------------
      include_once("../lib/db_connector.php");

      // $con = mysqli_connect("localhost","root","123456","eduplanet");
      $sql = "select * from academy order by no desc";
      $num = mysqli_query($conn,$sql);
      $total_record = mysqli_num_rows($num); //전체 레코드가 몇개인제 세어서 여기에 넣어라!

      // for ($i=1; $i <= $total_record ; $i++) {

        $sql = "select avg(total_star) from review group by parent";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_array($result);  //평균
        // $sql2 = "select parent, avg(total_star), avg(teacher) from review group by parent order by avg(teacher) desc";


        // $pain = new Avg($i,$row[0]);
        echo "<script>
            console.log($row[0]);
          </script>
        ";



      // }


      //-------------------------------

      //DB 닫아주기
      mysqli_close($conn);

       ?>
       <script type="text/javascript">
         console.log(<?= $total_record ?>);
       </script>

    <div id="contents_wrap">

    <div id="contents">

      <div id="main_contents">

        <div id="first_contents">

          <article class="article_ty2">
            <section class="card_ty1">
              <div id="section_wrap1">
                <div id="section_hd">
                  <h2>학원 총 평점</h2>
                </div>
                <div id="section_body">
                  <dl class="gf_box2">
                      <dt title="학원 총 평점">
                              <span class="txt_r">1</span>
                          <a href="http://www.naver.com"><span>애터미(주)</span></a>  <!-- 링크누르면 간다 -->
                      </dt>
                      <dd>
                          <span class="gf_bar1">  <!--평점 -->
                                  <span class="us_bl_s">
                                      <span class="bl_score" style="width:100.0%;">평점</span>
                                  </span>
                          </span>
                          <span class="txt1">
                              4.6
                          </span>
                      </dd>
                  </dl>
                  <dl class="gf_box2">
                    <dt title="애터미(주)">
                            <span class="txt_r">2</span>
                        <a href="http://www.naver.com"><span>애터미(주)</span></a>  <!-- 링크누르면 간다 -->
                    </dt>
                    <dd>
                        <span class="gf_bar1">  <!--평점 -->
                                <span class="us_bl_s">
                                    <span class="bl_score" style="width:92.0%;">평점</span>
                                </span>
                        </span>
                        <span class="txt1">
                            4.6
                        </span>
                    </dd>
                  </dl>
                  <dl class="gf_box2">
                    <dt title="애터미(주)">
                            <span class="txt_r">3</span>
                        <a href="http://www.naver.com"><span>애터미(주)</span></a>  <!-- 링크누르면 간다 -->
                    </dt>
                    <dd>
                        <span class="gf_bar1">  <!--평점 -->
                                <span class="us_bl_s">
                                    <span class="bl_score" style="width:92.0%;">평점</span>
                                </span>
                        </span>
                        <span class="txt1">
                            4.6
                        </span>
                    </dd>
                  </dl>
                  <dl class="gf_box2">
                    <dt title="애터미(주)">
                            <span class="txt_r" style="color: black">4</span>
                        <a href="http://www.naver.com"><span>애터미(주)</span></a>  <!-- 링크누르면 간다 -->
                    </dt>
                    <dd>
                        <span class="gf_bar1">  <!--평점 -->
                                <span class="us_bl_s">
                                    <span class="bl_score" style="width:92.0%;">평점</span>
                                </span>
                        </span>
                        <span class="txt1">
                            4.6
                        </span>
                    </dd>
                  </dl>
                  <dl class="gf_box2">
                    <dt title="애터미(주)">
                            <span class="txt_r" style="color: black">5</span>
                        <a href="http://www.naver.com"><span>애터미(주)</span></a>  <!-- 링크누르면 간다 -->
                    </dt>
                    <dd>
                        <span class="gf_bar1">  <!--평점 -->
                                <span class="us_bl_s">
                                    <span class="bl_score" style="width:92.0%;">평점</span>
                                </span>
                        </span>
                        <span class="txt1">
                            4.6
                        </span>
                    </dd>
                  </dl>
                </div>
                <div id="section_bottom">
                  <p class="section_bottom">
                        <a href="/companies?sort_by=review_compensation_cache" class="btn_rnd btn_rnd_arrow"><span class="txt">전체보기</span><span class="arrow"></span></a>
                    </p>
                </div>
              </div>

            </section>
            <section class="card_ty1">

              <div id="section_wrap1">
                <div id="section_hd">
                  <h2>시설 만족도</h2>
                </div>
                <div id="section_body">
                  <dl class="gf_box2">
                      <dt title="애터미(주)">
                              <span class="txt_r">1</span>
                          <a href="http://www.naver.com"><span>애터미(주)</span></a>  <!-- 링크누르면 간다 -->
                      </dt>
                      <dd>
                          <span class="gf_bar1">  <!--평점 -->
                                  <span class="us_bl_s">
                                      <span class="bl_score" style="width:92.0%;">평점</span>
                                  </span>
                          </span>
                          <span class="txt1">
                              4.6
                          </span>
                      </dd>
                  </dl>
                  <dl class="gf_box2">
                    <dt title="애터미(주)">
                            <span class="txt_r">2</span>
                        <a href="http://www.naver.com"><span>애터미(주)</span></a>  <!-- 링크누르면 간다 -->
                    </dt>
                    <dd>
                        <span class="gf_bar1">  <!--평점 -->
                                <span class="us_bl_s">
                                    <span class="bl_score" style="width:92.0%;">평점</span>
                                </span>
                        </span>
                        <span class="txt1">
                            4.6
                        </span>
                    </dd>
                  </dl>
                  <dl class="gf_box2">
                    <dt title="애터미(주)">
                            <span class="txt_r">3</span>
                        <a href="http://www.naver.com"><span>애터미(주)</span></a>  <!-- 링크누르면 간다 -->
                    </dt>
                    <dd>
                        <span class="gf_bar1">  <!--평점 -->
                                <span class="us_bl_s">
                                    <span class="bl_score" style="width:92.0%;">평점</span>
                                </span>
                        </span>
                        <span class="txt1">
                            4.6
                        </span>
                    </dd>
                  </dl>
                  <dl class="gf_box2">
                    <dt title="애터미(주)">
                            <span class="txt_r" style="color: black">4</span>
                        <a href="http://www.naver.com"><span>애터미(주)</span></a>  <!-- 링크누르면 간다 -->
                    </dt>
                    <dd>
                        <span class="gf_bar1">  <!--평점 -->
                                <span class="us_bl_s">
                                    <span class="bl_score" style="width:92.0%;">평점</span>
                                </span>
                        </span>
                        <span class="txt1">
                            4.6
                        </span>
                    </dd>
                  </dl>
                  <dl class="gf_box2">
                    <dt title="애터미(주)">
                            <span class="txt_r" style="color: black">5</span>
                        <a href="http://www.naver.com"><span>애터미(주)</span></a>  <!-- 링크누르면 간다 -->
                    </dt>
                    <dd>
                        <span class="gf_bar1">  <!--평점 -->
                                <span class="us_bl_s">
                                    <span class="bl_score" style="width:92.0%;">평점</span>
                                </span>
                        </span>
                        <span class="txt1">
                            4.6
                        </span>
                    </dd>
                  </dl>
                </div>
                <div id="section_bottom">
                  <p class="section_bottom">
                        <a href="/companies?sort_by=review_compensation_cache" class="btn_rnd btn_rnd_arrow"><span class="txt">전체보기</span><span class="arrow"></span></a>
                    </p>
                </div>
              </div>

            </section>
            <section class="card_ty1">

              <div id="section_wrap1">
                <div id="section_hd">
                  <h2>교통편 풍수지리</h2>
                </div>
                <div id="section_body">
                  <dl class="gf_box2">
                      <dt title="애터미(주)">
                              <span class="txt_r">1</span>
                          <a href="http://www.naver.com"><span>애터미(주)</span></a>  <!-- 링크누르면 간다 -->
                      </dt>
                      <dd>
                          <span class="gf_bar1">  <!--평점 -->
                                  <span class="us_bl_s">
                                      <span class="bl_score" style="width:92.0%;">평점</span>
                                  </span>
                          </span>
                          <span class="txt1">
                              4.6
                          </span>
                      </dd>
                  </dl>
                  <dl class="gf_box2">
                    <dt title="애터미(주)">
                            <span class="txt_r">2</span>
                        <a href="http://www.naver.com"><span>애터미(주)</span></a>  <!-- 링크누르면 간다 -->
                    </dt>
                    <dd>
                        <span class="gf_bar1">  <!--평점 -->
                                <span class="us_bl_s">
                                    <span class="bl_score" style="width:92.0%;">평점</span>
                                </span>
                        </span>
                        <span class="txt1">
                            4.6
                        </span>
                    </dd>
                  </dl>
                  <dl class="gf_box2">
                    <dt title="애터미(주)">
                            <span class="txt_r">3</span>
                        <a href="http://www.naver.com"><span>애터미(주)</span></a>  <!-- 링크누르면 간다 -->
                    </dt>
                    <dd>
                        <span class="gf_bar1">  <!--평점 -->
                                <span class="us_bl_s">
                                    <span class="bl_score" style="width:92.0%;">평점</span>
                                </span>
                        </span>
                        <span class="txt1">
                            4.6
                        </span>
                    </dd>
                  </dl>
                  <dl class="gf_box2">
                    <dt title="애터미(주)">
                            <span class="txt_r" style="color: black">4</span>
                        <a href="http://www.naver.com"><span>애터미(주)</span></a>  <!-- 링크누르면 간다 -->
                    </dt>
                    <dd>
                        <span class="gf_bar1">  <!--평점 -->
                                <span class="us_bl_s">
                                    <span class="bl_score" style="width:92.0%;">평점</span>
                                </span>
                        </span>
                        <span class="txt1">
                            4.6
                        </span>
                    </dd>
                  </dl>
                  <dl class="gf_box2">
                    <dt title="애터미(주)">
                            <span class="txt_r" style="color: black">5</span>
                        <a href="http://www.naver.com"><span>애터미(주)</span></a>  <!-- 링크누르면 간다 -->
                    </dt>
                    <dd>
                        <span class="gf_bar1">  <!--평점 -->
                                <span class="us_bl_s">
                                    <span class="bl_score" style="width:92.0%;">평점</span>
                                </span>
                        </span>
                        <span class="txt1">
                            4.6
                        </span>
                    </dd>
                  </dl>
                </div>
                <div id="section_bottom">
                  <p class="section_bottom">
                        <a href="/companies?sort_by=review_compensation_cache" class="btn_rnd btn_rnd_arrow"><span class="txt">전체보기</span><span class="arrow"></span></a>
                    </p>
                </div>
              </div>

            </section>
            <section class="card_ty1">

              <div id="section_wrap1">
                <div id="section_hd">
                  <h2>강사 만족도</h2>
                </div>
                <div id="section_body">
                  <dl class="gf_box2">
                      <dt title="애터미(주)">
                              <span class="txt_r">1</span>
                          <a href="http://www.naver.com"><span>애터미(주)</span></a>  <!-- 링크누르면 간다 -->
                      </dt>
                      <dd>
                          <span class="gf_bar1">  <!--평점 -->
                                  <span class="us_bl_s">
                                      <span class="bl_score" style="width:92.0%;">평점</span>
                                  </span>
                          </span>
                          <span class="txt1">
                              4.6
                          </span>
                      </dd>
                  </dl>
                  <dl class="gf_box2">
                    <dt title="애터미(주)">
                            <span class="txt_r">2</span>
                        <a href="http://www.naver.com"><span>애터미(주)</span></a>  <!-- 링크누르면 간다 -->
                    </dt>
                    <dd>
                        <span class="gf_bar1">  <!--평점 -->
                                <span class="us_bl_s">
                                    <span class="bl_score" style="width:92.0%;">평점</span>
                                </span>
                        </span>
                        <span class="txt1">
                            4.6
                        </span>
                    </dd>
                  </dl>
                  <dl class="gf_box2">
                    <dt title="애터미(주)">
                            <span class="txt_r">3</span>
                        <a href="http://www.naver.com"><span>애터미(주)</span></a>  <!-- 링크누르면 간다 -->
                    </dt>
                    <dd>
                        <span class="gf_bar1">  <!--평점 -->
                                <span class="us_bl_s">
                                    <span class="bl_score" style="width:92.0%;">평점</span>
                                </span>
                        </span>
                        <span class="txt1">
                            4.6
                        </span>
                    </dd>
                  </dl>
                  <dl class="gf_box2">
                    <dt title="애터미(주)">
                            <span class="txt_r" style="color: black">4</span>
                        <a href="http://www.naver.com"><span>애터미(주)</span></a>  <!-- 링크누르면 간다 -->
                    </dt>
                    <dd>
                        <span class="gf_bar1">  <!--평점 -->
                                <span class="us_bl_s">
                                    <span class="bl_score" style="width:92.0%;">평점</span>
                                </span>
                        </span>
                        <span class="txt1">
                            4.6
                        </span>
                    </dd>
                  </dl>
                  <dl class="gf_box2">
                    <dt title="애터미(주)">
                            <span class="txt_r" style="color: black">5</span>
                        <a href="http://www.naver.com"><span>애터미(주)</span></a>  <!-- 링크누르면 간다 -->
                    </dt>
                    <dd>
                        <span class="gf_bar1">  <!--평점 -->
                                <span class="us_bl_s">
                                    <span class="bl_score" style="width:92.0%;">평점</span>
                                </span>
                        </span>
                        <span class="txt1">
                            4.6
                        </span>
                    </dd>
                  </dl>
                </div>
                <div id="section_bottom">
                  <p class="section_bottom">
                        <a href="/companies?sort_by=review_compensation_cache" class="btn_rnd btn_rnd_arrow"><span class="txt">전체보기</span><span class="arrow"></span></a>
                    </p>
                </div>
              </div>

            </section>
            <section class="card_ty1">

              <div id="section_wrap1">
                <div id="section_hd">
                  <h2>가성비</h2>
                </div>
                <div id="section_body">
                  <dl class="gf_box2">
                      <dt title="애터미(주)">
                              <span class="txt_r">1</span>
                          <a href="http://www.naver.com"><span>애터미(주)</span></a>  <!-- 링크누르면 간다 -->
                      </dt>
                      <dd>
                          <span class="gf_bar1">  <!--평점 -->
                                  <span class="us_bl_s">
                                      <span class="bl_score" style="width:92.0%;">평점</span>
                                  </span>
                          </span>
                          <span class="txt1">
                              4.6
                          </span>
                      </dd>
                  </dl>
                  <dl class="gf_box2">
                    <dt title="애터미(주)">
                            <span class="txt_r">2</span>
                        <a href="http://www.naver.com"><span>애터미(주)</span></a>  <!-- 링크누르면 간다 -->
                    </dt>
                    <dd>
                        <span class="gf_bar1">  <!--평점 -->
                                <span class="us_bl_s">
                                    <span class="bl_score" style="width:92.0%;">평점</span>
                                </span>
                        </span>
                        <span class="txt1">
                            4.6
                        </span>
                    </dd>
                  </dl>
                  <dl class="gf_box2">
                    <dt title="애터미(주)">
                            <span class="txt_r">3</span>
                        <a href="http://www.naver.com"><span>애터미(주)</span></a>  <!-- 링크누르면 간다 -->
                    </dt>
                    <dd>
                        <span class="gf_bar1">  <!--평점 -->
                                <span class="us_bl_s">
                                    <span class="bl_score" style="width:92.0%;">평점</span>
                                </span>
                        </span>
                        <span class="txt1">
                            4.6
                        </span>
                    </dd>
                  </dl>
                  <dl class="gf_box2">
                    <dt title="애터미(주)">
                            <span class="txt_r" style="color: black">4</span>
                        <a href="http://www.naver.com"><span>애터미(주)</span></a>  <!-- 링크누르면 간다 -->
                    </dt>
                    <dd>
                        <span class="gf_bar1">  <!--평점 -->
                                <span class="us_bl_s">
                                    <span class="bl_score" style="width:92.0%;">평점</span>
                                </span>
                        </span>
                        <span class="txt1">
                            4.6
                        </span>
                    </dd>
                  </dl>
                  <dl class="gf_box2">
                    <dt title="애터미(주)">
                            <span class="txt_r" style="color: black">5</span>
                        <a href="http://www.naver.com"><span>애터미(주)</span></a>  <!-- 링크누르면 간다 -->
                    </dt>
                    <dd>
                        <span class="gf_bar1">  <!--평점 -->
                                <span class="us_bl_s">
                                    <span class="bl_score" style="width:92.0%;">평점</span>
                                </span>
                        </span>
                        <span class="txt1">
                            4.6
                        </span>
                    </dd>
                  </dl>
                </div>
                <div id="section_bottom">
                  <p class="section_bottom">
                        <a href="/companies?sort_by=review_compensation_cache" class="btn_rnd btn_rnd_arrow"><span class="txt">전체보기</span><span class="arrow"></span></a>
                    </p>
                </div>
              </div>

            </section>
            <section class="card_ty1">

              <div id="section_wrap1">
                <div id="section_hd">
                  <h2>학업 만족도</h2>
                </div>
                <div id="section_body">
                  <dl class="gf_box2">
                      <dt title="애터미(주)">
                              <span class="txt_r">1</span>
                          <a href="http://www.naver.com"><span>애터미(주)</span></a>  <!-- 링크누르면 간다 -->
                      </dt>
                      <dd>
                          <span class="gf_bar1">  <!--평점 -->
                                  <span class="us_bl_s">
                                      <span class="bl_score" style="width:92.0%;">평점</span>
                                  </span>
                          </span>
                          <span class="txt1">
                              4.6
                          </span>
                      </dd>
                  </dl>
                  <dl class="gf_box2">
                    <dt title="애터미(주)">
                            <span class="txt_r">2</span>
                        <a href="http://www.naver.com"><span>애터미(주)</span></a>  <!-- 링크누르면 간다 -->
                    </dt>
                    <dd>
                        <span class="gf_bar1">  <!--평점 -->
                                <span class="us_bl_s">
                                    <span class="bl_score" style="width:92.0%;">평점</span>
                                </span>
                        </span>
                        <span class="txt1">
                            4.6
                        </span>
                    </dd>
                  </dl>
                  <dl class="gf_box2">
                    <dt title="애터미(주)">
                            <span class="txt_r">3</span>
                        <a href="http://www.naver.com"><span>애터미(주)</span></a>  <!-- 링크누르면 간다 -->
                    </dt>
                    <dd>
                        <span class="gf_bar1">  <!--평점 -->
                                <span class="us_bl_s">
                                    <span class="bl_score" style="width:92.0%;">평점</span>
                                </span>
                        </span>
                        <span class="txt1">
                            4.6
                        </span>
                    </dd>
                  </dl>
                  <dl class="gf_box2">
                    <dt title="애터미(주)">
                            <span class="txt_r" style="color: black">4</span>
                        <a href="http://www.naver.com"><span>애터미(주)</span></a>  <!-- 링크누르면 간다 -->
                    </dt>
                    <dd>
                        <span class="gf_bar1">  <!--평점 -->
                                <span class="us_bl_s">
                                    <span class="bl_score" style="width:92.0%;">평점</span>
                                </span>
                        </span>
                        <span class="txt1">
                            4.6
                        </span>
                    </dd>
                  </dl>
                  <dl class="gf_box2">
                    <dt title="애터미(주)">
                            <span class="txt_r" style="color: black">5</span>
                        <a href="http://www.naver.com"><span>애터미(주)</span></a>  <!-- 링크누르면 간다 -->
                    </dt>
                    <dd>
                        <span class="gf_bar1">  <!--평점 -->
                                <span class="us_bl_s">
                                    <span class="bl_score" style="width:92.0%;">평점</span>
                                </span>
                        </span>
                        <span class="txt1">
                            4.6
                        </span>
                    </dd>
                  </dl>
                </div>
                <div id="section_bottom">
                  <p class="section_bottom">
                        <a href="/companies?sort_by=review_compensation_cache" class="btn_rnd btn_rnd_arrow"><span class="txt">전체보기</span><span class="arrow"></span></a>
                    </p>
                </div>
              </div>

            </section>

          </article>

        </div> <!--first_contents end-->

        <div id="my_village_academy">

          <div id="mva_title">
            <h2>우리동네학원</h2>
          </div>

              <div class="mva_class">

                <div id="mva1_img">
                  <a href=""> <img src="./img/earth.jpg" alt="" width="150" height="130"> </a>
                </div>
                <div id="academy_name">
                  <h2 id="titlee">학원이름</h2>
                </div>
                <div id="academy_cell">
                  <span>032-000-0000</span>
                </div>
                <div id="academy_address">
                  <span>인천광역시 계양구 계산동</span>
                </div>
                <div id="call_dibs">
                  <!-- <button type="button" name="button" id="call_dibs_button"><span>학원 찜하기</span></button> -->
                  <div class="story_academy_heart">
                      <span>학원 찜하기</span>
                      <button id="button_academy_heart" onclick="onclick_heart()">like</button>
                  </div>
                </div>

              </div>

              <div class="mva_class">
                <div id="mva1_img">
                  <a href=""> <img src="./img/earth.jpg" alt="" width="150" height="130"> </a>
                </div>
                <div id="academy_name">
                  <h2 id="titlee">학원이름</h2>
                </div>
                <div id="academy_cell">
                  <span>032-000-0000</span>
                </div>
                <div id="academy_address">
                  <span>인천광역시 계양구 계산동</span>
                </div>
                <div id="call_dibs">
                  <!-- <button type="button" name="button" id="call_dibs_button"><span>학원 찜하기</span></button> -->
                  <div class="story_academy_heart">
                      <span>학원 찜하기</span>
                      <button id="button_academy_heart" onclick="onclick_heart()">like</button>
                  </div>
                </div>

              </div>

              <div class="mva_class">
                <div id="mva1_img">
                  <a href=""> <img src="./img/earth.jpg" alt="" width="150" height="130"> </a>
                </div>
                <div id="academy_name">
                  <h2 id="titlee">학원이름</h2>
                </div>
                <div id="academy_cell">
                  <span>032-000-0000</span>
                </div>
                <div id="academy_address">
                  <span>인천광역시 계양구 계산동</span>
                </div>
                <div id="call_dibs">
                  <!-- <button type="button" name="button" id="call_dibs_button"><span>학원 찜하기</span></button> -->
                  <div class="story_academy_heart">
                      <span>학원 찜하기</span>
                      <button id="button_academy_heart" onclick="onclick_heart()">like</button>
                  </div>
                </div>

              </div>
              <div class="mva_class">
                <div id="mva1_img">
                  <a href=""> <img src="./img/earth.jpg" alt="" width="150" height="130"> </a>
                </div>
                <div id="academy_name">
                  <h2 id="titlee">학원이름</h2>
                </div>
                <div id="academy_cell">
                  <span>032-000-0000</span>
                </div>
                <div id="academy_address">
                  <span>인천광역시 계양구 계산동</span>
                </div>
                <div id="call_dibs">
                  <!-- <button type="button" name="button" id="call_dibs_button"><span>학원 찜하기</span></button> -->
                  <div class="story_academy_heart">
                      <span>학원 찜하기</span>
                      <button id="button_academy_heart" onclick="onclick_heart()">like</button>
                  </div>
                </div>

              </div>

        </div><!--second_contents end -->

      </div> <!-- main_contents end-->

    </div> <!--contents end -->

  </div> <!--contents_wrap -->



    </main>

    <footer>
        <?php include "../footer.php"; ?>
    </footer>

  </body>
</html>
