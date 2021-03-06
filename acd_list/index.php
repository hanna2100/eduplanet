<?php include_once $_SERVER["DOCUMENT_ROOT"]."/eduplanet/lib/session_start.php"; ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>에듀플래닛</title>

    <!-- 제이쿼리 -->
    <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>

    <!-- favicon -->
    <link rel="shortcut icon" href="/eduplanet/img/favicon.png">

    <!-- 폰트 -->
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR&amp;display=swap" rel="stylesheet">

    <!-- 자동완성 -->
    <!-- <script src="https://code.jquery.com/jquery-1.12.4.min.js" charset="utf-8"></script> -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <!-- css -->
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="/eduplanet/index/index_header_searchbar_out.css">
    <link rel="stylesheet" href="/eduplanet/index/footer.css">
    <link rel="stylesheet" href="/eduplanet/mypage/css/review_write_popup.css">

    <!-- 스크립트 -->
    <link rel="stylesheet" href="./js/index.js">
    <script src="/eduplanet/mypage/js/review_write.js"></script>
    <script src="/eduplanet/searchbar/searchbar_out.js"></script>
    <!-- 아이콘 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css">
  </head>

  <body>

    <header>
       <?php include_once $_SERVER["DOCUMENT_ROOT"]."/eduplanet/index/index_header_searchbar_out.php"; ?>

    </header>

    <main>

    <div id="contents_wrap">

    <div id="contents">

      <div id="main_contents">

        <div id="first_contents">

          <article class="article_ty2">
            <section class="card_ty1">
              <div id="section_wrap1">
                <div id="section_hd">
                  <h2>학원 총 만족도</h2>
                </div>
                <div id="section_body">
                  <dl class="gf_box2">
                      <dt title="학원 총 평점">
                              <span class="txt_r">1</span>
                          <a href="#" class="acd_grade"><span id="acd_grade0">애터미(주)</span></a>  <!-- 링크누르면 간다 -->
                      </dt>
                      <dd>
                          <span class="gf_bar1">  <!--평점 -->
                                  <span class="us_bl_s">
                                      <span class="bl_score" style="width:100.0%;">평점</span>
                                  </span>
                          </span>
                          <span class="txt1">
                            <img src="/eduplanet/img/academy_big_one_star.png" alt="star" width="14">
                              <span id="acd_score0"></span>
                          </span>
                      </dd>
                  </dl>
                  <dl class="gf_box2">
                    <dt title="애터미(주)">
                            <span class="txt_r">2</span>
                        <a href="#" class="acd_grade"><span id="acd_grade1">애터미(주)</span></a>  <!-- 링크누르면 간다 -->
                    </dt>
                    <dd>
                        <span class="gf_bar1">  <!--평점 -->
                                <span class="us_bl_s">
                                    <span class="bl_score" style="width:92.0%;">평점</span>
                                </span>
                        </span>
                        <span class="txt1">
                          <img src="/eduplanet/img/academy_big_one_star.png" alt="star" width="14">
                          <span id="acd_score1"></span>
                        </span>
                    </dd>
                  </dl>
                  <dl class="gf_box2">
                    <dt title="애터미(주)">
                            <span class="txt_r">3</span>
                        <a href="#" class="acd_grade"><span id="acd_grade2">애터미(주)</span></a>  <!-- 링크누르면 간다 -->
                    </dt>
                    <dd>
                        <span class="gf_bar1">  <!--평점 -->
                                <span class="us_bl_s">
                                    <span class="bl_score" style="width:92.0%;">평점</span>
                                </span>
                        </span>
                        <span class="txt1">
                          <img src="/eduplanet/img/academy_big_one_star.png" alt="star" width="14">
                          <span id="acd_score2"></span>
                        </span>
                    </dd>
                  </dl>
                  <dl class="gf_box2">
                    <dt title="애터미(주)">
                            <span class="txt_r" style="color: black">4</span>
                        <a href="#" class="acd_grade"><span id="acd_grade3">애터미(주)</span></a>  <!-- 링크누르면 간다 -->
                    </dt>
                    <dd>
                        <span class="gf_bar1">  <!--평점 -->
                                <span class="us_bl_s">
                                    <span class="bl_score" style="width:92.0%;">평점</span>
                                </span>
                        </span>
                        <span class="txt1">
                          <img src="/eduplanet/img/academy_big_one_star.png" alt="star" width="14">
                            <span id="acd_score3"></span>
                        </span>
                    </dd>
                  </dl>
                  <dl class="gf_box2">
                    <dt title="애터미(주)">
                            <span class="txt_r" style="color: black">5</span>
                        <a href="#" class="acd_grade"><span id="acd_grade4">애터미(주)</span></a>  <!-- 링크누르면 간다 -->
                    </dt>
                    <dd>
                        <span class="gf_bar1">  <!--평점 -->
                                <span class="us_bl_s">
                                    <span class="bl_score" style="width:92.0%;">평점</span>
                                </span>
                        </span>
                        <span class="txt1">
                          <img src="/eduplanet/img/academy_big_one_star.png" alt="star" width="14">
                            <span id="acd_score4"></span>
                        </span>
                    </dd>
                  </dl>
                </div>
                <div id="section_bottom">
                  <p class="section_bottom">
                        <a href="/eduplanet/acd_list/view_all.php?district=&sort=star_max&category=ctg_star" class="btn_rnd btn_rnd_arrow"><span class="txt">전체보기</span><span class="arrow"></span></a>
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
                          <a href="#" class="acd_grade1"><span id="facility_grade0">애터미(주)</span></a>  <!-- 링크누르면 간다 -->
                      </dt>
                      <dd>
                          <span class="gf_bar1">  <!--평점 -->
                                  <span class="us_bl_s">
                                      <span class="bl_score" style="width:92.0%;">평점</span>
                                  </span>
                          </span>
                          <span class="txt1">
                            <img src="/eduplanet/img/academy_big_one_star.png" alt="star" width="14">
                              <span id="facility_score0">4.6</span>
                          </span>
                      </dd>
                  </dl>
                  <dl class="gf_box2">
                    <dt title="애터미(주)">
                            <span class="txt_r">2</span>
                        <a href="#" class="acd_grade1"><span id="facility_grade1">애터미(주)</span></a>  <!-- 링크누르면 간다 -->
                    </dt>
                    <dd>
                        <span class="gf_bar1">  <!--평점 -->
                                <span class="us_bl_s">
                                    <span class="bl_score" style="width:92.0%;">평점</span>
                                </span>
                        </span>
                        <span class="txt1">
                          <img src="/eduplanet/img/academy_big_one_star.png" alt="star" width="14">
                            <span id="facility_score1">4.6</span>
                        </span>
                    </dd>
                  </dl>
                  <dl class="gf_box2">
                    <dt title="애터미(주)">
                            <span class="txt_r">3</span>
                        <a href="#" class="acd_grade1"><span id="facility_grade2">애터미(주)</span></a>  <!-- 링크누르면 간다 -->
                    </dt>
                    <dd>
                        <span class="gf_bar1">  <!--평점 -->
                                <span class="us_bl_s">
                                    <span class="bl_score" style="width:92.0%;">평점</span>
                                </span>
                        </span>
                        <span class="txt1">
                          <img src="/eduplanet/img/academy_big_one_star.png" alt="star" width="14">
                            <span id="facility_score2">4.6</span>
                        </span>
                    </dd>
                  </dl>
                  <dl class="gf_box2">
                    <dt title="애터미(주)">
                            <span class="txt_r" style="color: black">4</span>
                        <a href="#" class="acd_grade1"><span id="facility_grade3">애터미(주)</span></a>  <!-- 링크누르면 간다 -->
                    </dt>
                    <dd>
                        <span class="gf_bar1">  <!--평점 -->
                                <span class="us_bl_s">
                                    <span class="bl_score" style="width:92.0%;">평점</span>
                                </span>
                        </span>
                        <span class="txt1">
                          <img src="/eduplanet/img/academy_big_one_star.png" alt="star" width="14">
                            <span id="facility_score3">4.6</span>
                        </span>
                    </dd>
                  </dl>
                  <dl class="gf_box2">
                    <dt title="애터미(주)">
                            <span class="txt_r" style="color: black">5</span>
                        <a href="#" class="acd_grade1"><span id="facility_grade4">애터미(주)</span></a>  <!-- 링크누르면 간다 -->
                    </dt>
                    <dd>
                        <span class="gf_bar1">  <!--평점 -->
                                <span class="us_bl_s">
                                    <span class="bl_score" style="width:92.0%;">평점</span>
                                </span>
                        </span>
                        <span class="txt1">
                          <img src="/eduplanet/img/academy_big_one_star.png" alt="star" width="14">
                            <span id="facility_score4">4.6</span>
                        </span>
                    </dd>
                  </dl>
                </div>
                <div id="section_bottom">
                  <p class="section_bottom">
                        <a href="/eduplanet/acd_list/view_all.php?district=&sort=facility_max&category=ctg_facility" class="btn_rnd btn_rnd_arrow"><span class="txt">전체보기</span><span class="arrow"></span></a>
                    </p>
                </div>
              </div>

            </section>
            <section class="card_ty1">

              <div id="section_wrap1">
                <div id="section_hd">
                  <h2>교통 편의성</h2>
                </div>
                <div id="section_body">
                  <dl class="gf_box2">
                      <dt title="애터미(주)">
                              <span class="txt_r">1</span>
                          <a href="#" class="acd_grade2"><span id="accesible_grade0">애터미(주)</span></a>  <!-- 링크누르면 간다 -->
                      </dt>
                      <dd>
                          <span class="gf_bar1">  <!--평점 -->
                                  <span class="us_bl_s">
                                      <span class="bl_score" style="width:92.0%;">평점</span>
                                  </span>
                          </span>
                          <span class="txt1">
                            <img src="/eduplanet/img/academy_big_one_star.png" alt="star" width="14">
                              <span id="accesible_score0">4.6</span>
                          </span>
                      </dd>
                  </dl>
                  <dl class="gf_box2">
                    <dt title="애터미(주)">
                            <span class="txt_r">2</span>
                        <a href="#" class="acd_grade2"><span id="accesible_grade1">애터미(주)</span></a>  <!-- 링크누르면 간다 -->
                    </dt>
                    <dd>
                        <span class="gf_bar1">  <!--평점 -->
                                <span class="us_bl_s">
                                    <span class="bl_score" style="width:92.0%;">평점</span>
                                </span>
                        </span>
                        <span class="txt1">
                          <img src="/eduplanet/img/academy_big_one_star.png" alt="star" width="14">
                          <span id="accesible_score1">4.6</span>
                        </span>
                    </dd>
                  </dl>
                  <dl class="gf_box2">
                    <dt title="애터미(주)">
                            <span class="txt_r">3</span>
                        <a href="#" class="acd_grade2"><span id="accesible_grade2">애터미(주)</span></a>  <!-- 링크누르면 간다 -->
                    </dt>
                    <dd>
                        <span class="gf_bar1">  <!--평점 -->
                                <span class="us_bl_s">
                                    <span class="bl_score" style="width:92.0%;">평점</span>
                                </span>
                        </span>
                        <span class="txt1">
                          <img src="/eduplanet/img/academy_big_one_star.png" alt="star" width="14">
                        <span id="accesible_score2">4.6</span>
                        </span>
                    </dd>
                  </dl>
                  <dl class="gf_box2">
                    <dt title="애터미(주)">
                            <span class="txt_r" style="color: black">4</span>
                        <a href="#" class="acd_grade2"><span id="accesible_grade3">애터미(주)</span></a>  <!-- 링크누르면 간다 -->
                    </dt>
                    <dd>
                        <span class="gf_bar1">  <!--평점 -->
                                <span class="us_bl_s">
                                    <span class="bl_score" style="width:92.0%;">평점</span>
                                </span>
                        </span>
                        <span class="txt1">
                          <img src="/eduplanet/img/academy_big_one_star.png" alt="star" width="14">
                          <span id="accesible_score3">4.6</span>
                        </span>
                    </dd>
                  </dl>
                  <dl class="gf_box2">
                    <dt title="애터미(주)">
                            <span class="txt_r" style="color: black">5</span>
                        <a href="#" class="acd_grade2"><span id="accesible_grade4">애터미(주)</span></a>  <!-- 링크누르면 간다 -->
                    </dt>
                    <dd>
                        <span class="gf_bar1">  <!--평점 -->
                                <span class="us_bl_s">
                                    <span class="bl_score" style="width:92.0%;">평점</span>
                                </span>
                        </span>
                        <span class="txt1">
                          <img src="/eduplanet/img/academy_big_one_star.png" alt="star" width="14">
                          <span id="accesible_score4">4.6</span>
                        </span>
                    </dd>
                  </dl>
                </div>
                <div id="section_bottom">
                  <p class="section_bottom">
                        <a href="/eduplanet/acd_list/view_all.php?district=&sort=acsbl_max&category=ctg_acsbl" class="btn_rnd btn_rnd_arrow"><span class="txt">전체보기</span><span class="arrow"></span></a>
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
                          <a href="#" class="acd_grade3"><span id="teacher_grade0">애터미(주)</span></a>  <!-- 링크누르면 간다 -->
                      </dt>
                      <dd>
                          <span class="gf_bar1">  <!--평점 -->
                                  <span class="us_bl_s">
                                      <span class="bl_score" style="width:92.0%;">평점</span>
                                  </span>
                          </span>
                          <span class="txt1">
                            <img src="/eduplanet/img/academy_big_one_star.png" alt="star" width="14">
                              <span id="teacher_score0">4.6</span>
                          </span>
                      </dd>
                  </dl>
                  <dl class="gf_box2">
                    <dt title="애터미(주)">
                            <span class="txt_r">2</span>
                        <a href="#" class="acd_grade3"><span id="teacher_grade1">애터미(주)</span></a>  <!-- 링크누르면 간다 -->
                    </dt>
                    <dd>
                        <span class="gf_bar1">  <!--평점 -->
                                <span class="us_bl_s">
                                    <span class="bl_score" style="width:92.0%;">평점</span>
                                </span>
                        </span>
                        <span class="txt1">
                          <img src="/eduplanet/img/academy_big_one_star.png" alt="star" width="14">
                            <span id="teacher_score1">4.6</span>
                        </span>
                    </dd>
                  </dl>
                  <dl class="gf_box2">
                    <dt title="애터미(주)">
                            <span class="txt_r">3</span>
                        <a href="#" class="acd_grade3"><span id="teacher_grade2">애터미(주)</span></a>  <!-- 링크누르면 간다 -->
                    </dt>
                    <dd>
                        <span class="gf_bar1">  <!--평점 -->
                                <span class="us_bl_s">
                                    <span class="bl_score" style="width:92.0%;">평점</span>
                                </span>
                        </span>
                        <span class="txt1">
                          <img src="/eduplanet/img/academy_big_one_star.png" alt="star" width="14">
                            <span id="teacher_score2">4.6</span>
                        </span>
                    </dd>
                  </dl>
                  <dl class="gf_box2">
                    <dt title="애터미(주)">
                            <span class="txt_r" style="color: black">4</span>
                        <a href="#" class="acd_grade3"><span id="teacher_grade3">애터미(주)</span></a>  <!-- 링크누르면 간다 -->
                    </dt>
                    <dd>
                        <span class="gf_bar1">  <!--평점 -->
                                <span class="us_bl_s">
                                    <span class="bl_score" style="width:92.0%;">평점</span>
                                </span>
                        </span>
                        <span class="txt1">
                          <img src="/eduplanet/img/academy_big_one_star.png" alt="star" width="14">
                            <span id="teacher_score3">4.6</span>
                        </span>
                    </dd>
                  </dl>
                  <dl class="gf_box2">
                    <dt title="애터미(주)">
                            <span class="txt_r" style="color: black">5</span>
                        <a href="#" class="acd_grade3"><span id="teacher_grade4">애터미(주)</span></a>  <!-- 링크누르면 간다 -->
                    </dt>
                    <dd>
                        <span class="gf_bar1">  <!--평점 -->
                                <span class="us_bl_s">
                                    <span class="bl_score" style="width:92.0%;">평점</span>
                                </span>
                        </span>
                        <span class="txt1">
                          <img src="/eduplanet/img/academy_big_one_star.png" alt="star" width="14">
                            <span id="teacher_score4">4.6</span>
                        </span>
                    </dd>
                  </dl>
                </div>
                <div id="section_bottom">
                  <p class="section_bottom">
                        <a href="/eduplanet/acd_list/view_all.php?district=&sort=teacher_max&category=ctg_teacher" class="btn_rnd btn_rnd_arrow"><span class="txt">전체보기</span><span class="arrow"></span></a>
                    </p>
                </div>
              </div>

            </section>
            <section class="card_ty1">

              <div id="section_wrap1">
                <div id="section_hd">
                  <h2>수강료 만족도</h2>
                </div>
                <div id="section_body">
                  <dl class="gf_box2">
                      <dt title="애터미(주)">
                              <span class="txt_r">1</span>
                          <a href="#" class="acd_grade4"><span id="cost_effect_grade0">애터미(주)</span></a>  <!-- 링크누르면 간다 -->
                      </dt>
                      <dd>
                          <span class="gf_bar1">  <!--평점 -->
                                  <span class="us_bl_s">
                                      <span class="bl_score" style="width:92.0%;">평점</span>
                                  </span>
                          </span>
                          <span class="txt1">
                            <img src="/eduplanet/img/academy_big_one_star.png" alt="star" width="14">
                              <span id="cost_effect_score0">4.6</span>
                          </span>
                      </dd>
                  </dl>
                  <dl class="gf_box2">
                    <dt title="애터미(주)">
                            <span class="txt_r">2</span>
                        <a href="#" class="acd_grade4"><span id="cost_effect_grade1">애터미(주)</span></a>  <!-- 링크누르면 간다 -->
                    </dt>
                    <dd>
                        <span class="gf_bar1">  <!--평점 -->
                                <span class="us_bl_s">
                                    <span class="bl_score" style="width:92.0%;">평점</span>
                                </span>
                        </span>
                        <span class="txt1">
                          <img src="/eduplanet/img/academy_big_one_star.png" alt="star" width="14">
                            <span id="cost_effect_score1">4.6</span>
                        </span>
                    </dd>
                  </dl>
                  <dl class="gf_box2">
                    <dt title="애터미(주)">
                            <span class="txt_r">3</span>
                        <a href="#" class="acd_grade4"><span id="cost_effect_grade2">애터미(주)</span></a>  <!-- 링크누르면 간다 -->
                    </dt>
                    <dd>
                        <span class="gf_bar1">  <!--평점 -->
                                <span class="us_bl_s">
                                    <span class="bl_score" style="width:92.0%;">평점</span>
                                </span>
                        </span>
                        <span class="txt1">
                          <img src="/eduplanet/img/academy_big_one_star.png" alt="star" width="14">
                            <span id="cost_effect_score2">4.6</span>
                        </span>
                    </dd>
                  </dl>
                  <dl class="gf_box2">
                    <dt title="애터미(주)">
                            <span class="txt_r" style="color: black">4</span>
                        <a href="#" class="acd_grade4"><span id="cost_effect_grade3">애터미(주)</span></a>  <!-- 링크누르면 간다 -->
                    </dt>
                    <dd>
                        <span class="gf_bar1">  <!--평점 -->
                                <span class="us_bl_s">
                                    <span class="bl_score" style="width:92.0%;">평점</span>
                                </span>
                        </span>
                        <span class="txt1">
                          <img src="/eduplanet/img/academy_big_one_star.png" alt="star" width="14">
                            <span id="cost_effect_score3">4.6</span>
                        </span>
                    </dd>
                  </dl>
                  <dl class="gf_box2">
                    <dt title="애터미(주)">
                            <span class="txt_r" style="color: black">5</span>
                        <a href="#" class="acd_grade4"><span id="cost_effect_grade4">애터미(주)</span></a>  <!-- 링크누르면 간다 -->
                    </dt>
                    <dd>
                        <span class="gf_bar1">  <!--평점 -->
                                <span class="us_bl_s">
                                    <span class="bl_score" style="width:92.0%;">평점</span>
                                </span>
                        </span>
                        <span class="txt1">
                          <img src="/eduplanet/img/academy_big_one_star.png" alt="star" width="14">
                            <span id="cost_effect_score4">4.6</span>
                        </span>
                    </dd>
                  </dl>
                </div>
                <div id="section_bottom">
                  <p class="section_bottom">
                        <a href="/eduplanet/acd_list/view_all.php?district=&sort=cost_efct_max&category=ctg_cost_efct" class="btn_rnd btn_rnd_arrow"><span class="txt">전체보기</span><span class="arrow"></span></a>
                    </p>
                </div>
              </div>

            </section>
            <section class="card_ty1">

              <div id="section_wrap1">
                <div id="section_hd">
                  <h2>학업 성취도</h2>
                </div>
                <div id="section_body">
                  <dl class="gf_box2">
                      <dt title="애터미(주)">
                              <span class="txt_r">1</span>
                          <a href="#" class="acd_grade5"><span id="achievement_grade0">애터미(주)</span></a>  <!-- 링크누르면 간다 -->
                      </dt>
                      <dd>
                          <span class="gf_bar1">  <!--평점 -->
                                  <span class="us_bl_s">
                                      <span class="bl_score" style="width:92.0%;">평점</span>
                                  </span>
                          </span>
                          <span class="txt1">
                            <img src="/eduplanet/img/academy_big_one_star.png" alt="star" width="14">
                              <span id="achievement_score0">4.6</span>
                          </span>
                      </dd>
                  </dl>
                  <dl class="gf_box2">
                    <dt title="애터미(주)">
                            <span class="txt_r">2</span>
                        <a href="#" class="acd_grade5"><span id="achievement_grade1">애터미(주)</span></a>  <!-- 링크누르면 간다 -->
                    </dt>
                    <dd>
                        <span class="gf_bar1">  <!--평점 -->
                                <span class="us_bl_s">
                                    <span class="bl_score" style="width:92.0%;">평점</span>
                                </span>
                        </span>
                        <span class="txt1">
                          <img src="/eduplanet/img/academy_big_one_star.png" alt="star" width="14">
                            <span id="achievement_score1">4.6</span>
                        </span>
                    </dd>
                  </dl>
                  <dl class="gf_box2">
                    <dt title="애터미(주)">
                            <span class="txt_r">3</span>
                        <a href="#" class="acd_grade5"><span id="achievement_grade2">애터미(주)</span></a>  <!-- 링크누르면 간다 -->
                    </dt>
                    <dd>
                        <span class="gf_bar1">  <!--평점 -->
                                <span class="us_bl_s">
                                    <span class="bl_score" style="width:92.0%;">평점</span>
                                </span>
                        </span>
                        <span class="txt1">
                          <img src="/eduplanet/img/academy_big_one_star.png" alt="star" width="14">
                            <span id="achievement_score2">4.6</span>
                        </span>
                    </dd>
                  </dl>
                  <dl class="gf_box2">
                    <dt title="애터미(주)">
                            <span class="txt_r" style="color: black">4</span>
                        <a href="#" class="acd_grade5"><span id="achievement_grade3">애터미(주)</span></a>  <!-- 링크누르면 간다 -->
                    </dt>
                    <dd>
                        <span class="gf_bar1">  <!--평점 -->
                                <span class="us_bl_s">
                                    <span class="bl_score" style="width:92.0%;">평점</span>
                                </span>
                        </span>
                        <span class="txt1">
                          <img src="/eduplanet/img/academy_big_one_star.png" alt="star" width="14">
                          <span id="achievement_score3">4.6</span>
                        </span>
                    </dd>
                  </dl>
                  <dl class="gf_box2">
                    <dt title="애터미(주)">
                            <span class="txt_r" style="color: black">5</span>
                        <a href="#" class="acd_grade5"><span id="achievement_grade4">애터미(주)</span></a>  <!-- 링크누르면 간다 -->
                    </dt>
                    <dd>
                        <span class="gf_bar1">  <!--평점 -->
                                <span class="us_bl_s">
                                    <span class="bl_score" style="width:92.0%;">평점</span>
                                </span>
                        </span>
                        <span class="txt1">
                          <img src="/eduplanet/img/academy_big_one_star.png" alt="star" width="14">
                            <span id="achievement_score4">4.6</span>
                        </span>
                    </dd>
                  </dl>
                </div>
                <div id="section_bottom">
                  <p class="section_bottom">
                        <a href="/eduplanet/acd_list/view_all.php?district=&sort=achievement_max&category=ctg_achievement" class="btn_rnd btn_rnd_arrow"><span class="txt">전체보기</span><span class="arrow"></span></a>
                    </p>
                </div>
              </div>

            </section>

          </article>

        </div> <!--first_contents end-->
        <div class="view_all">
           <button class="blue_bar_button" id="view_all_button" onclick="location.href='/eduplanet/acd_list/view_all.php'">학원 전체 보기</button>
        </div>
<!-- ===================================================================================================== -->
        <?php

        if (isset($_GET["page"])) {
            $page = $_GET["page"];
        } else {
            $page = 1;
        }

        // DB에서 가져오기-------------------------------------
        include_once("../lib/db_connector.php");
        $sql = "select academy.no,review.parent,academy.acd_name,avg(review.total_star) from academy join review on academy.no = review.parent group by review.parent order by avg(review.total_star) desc limit 5";
        $sql2 = "select academy.no,review.parent,academy.acd_name,avg(review.facility) from academy join review on academy.no = review.parent group by review.parent order by avg(review.facility) desc limit 5";
        $sql3 = "select academy.no,review.parent,academy.acd_name,avg(review.acsbl) from academy join review on academy.no = review.parent group by review.parent order by avg(review.acsbl) desc limit 5";
        $sql4 = "select academy.no,review.parent,academy.acd_name,avg(review.teacher) from academy join review on academy.no = review.parent group by review.parent order by avg(review.teacher) desc limit 5";
        $sql5 = "select academy.no,review.parent,academy.acd_name,avg(review.cost_efct) from academy join review on academy.no = review.parent group by review.parent order by avg(review.cost_efct) desc limit 5";
        $sql6 = "select academy.no,review.parent,academy.acd_name,avg(review.achievement) from academy join review on academy.no = review.parent group by review.parent order by avg(review.achievement) desc limit 5";

        $result = mysqli_query($conn, $sql);
        $result2 = mysqli_query($conn, $sql2);
        $result3 = mysqli_query($conn, $sql3);
        $result4 = mysqli_query($conn, $sql4);
        $result5 = mysqli_query($conn, $sql5);
        $result6 = mysqli_query($conn, $sql6);

        $row = mysqli_fetch_array($result);
        $row2 = mysqli_fetch_array($result2);
        $row3 = mysqli_fetch_array($result3);
        $row4 = mysqli_fetch_array($result4);
        $row5 = mysqli_fetch_array($result5);
        $row6 = mysqli_fetch_array($result6);

        $array = array();


        for ($i=0;$i<5;$i++) { //학원 총 만족도
            mysqli_data_seek($result, $i);
            $row = mysqli_fetch_array($result);
            // $no = $row["no"];
            $acd_name = $row["acd_name"];
            $parent = $row["parent"];
            $total_star = $row["avg(review.total_star)"];
            $total_grade = round($total_star, 1);
            $no = $row["no"];
            array_push($array, $total_grade*20);//평점 넣어주기




            echo "
            <script>
              document.getElementsByClassName('acd_grade')[$i].onclick = function(){
                location.href = '../academy/index.php?no=$no';
              }

              document.getElementById('acd_grade$i').innerHTML = '$acd_name';
              if($total_grade%1==0){
                document.getElementById('acd_score$i').innerHTML = '$total_grade.0';
              }else{
              document.getElementById('acd_score$i').innerHTML = '$total_grade';
              }

            </script>

          ";
        }


        for ($i=0;$i<5;$i++) { //시설 만족도
            mysqli_data_seek($result2, $i);
            $row = mysqli_fetch_array($result2);
            $acd_name = $row["acd_name"];
            $parent = $row["parent"];
            $facility = $row["avg(review.facility)"];
            $no = $row["no"];
            $total_grade = round($facility, 1);
            array_push($array, $total_grade*20);//평점 넣어주기

            //뿌려주기
            echo "
            <script>

              document.getElementsByClassName('acd_grade1')[$i].onclick = function(){
                location.href = '../academy/index.php?no=$no';
              }

              document.getElementById('facility_grade$i').innerHTML = '$acd_name';
              if($total_grade%1==0){
                document.getElementById('facility_score$i').innerHTML = '$total_grade.0';
              }else{
              document.getElementById('facility_score$i').innerHTML = '$total_grade';
              }

            </script>

          ";
        }

        for ($i=0;$i<5;$i++) { //교통 편의성
            mysqli_data_seek($result3, $i);
            $row = mysqli_fetch_array($result3);
            $acd_name = $row["acd_name"];
            $parent = $row["parent"];
            $accesible = $row["avg(review.acsbl)"];
            $no = $row["no"];
            $total_grade = round($accesible, 1);
            array_push($array, $total_grade*20);//평점 넣어주기
            echo "
            <script>
              document.getElementsByClassName('acd_grade2')[$i].onclick = function(){
                location.href = '../academy/index.php?no=$no';
              }

              document.getElementById('accesible_grade$i').innerHTML = '$acd_name';
              if($total_grade%1==0){
                document.getElementById('accesible_score$i').innerHTML = '$total_grade.0';
              }else{
              document.getElementById('accesible_score$i').innerHTML = '$total_grade';
              }

            </script>

          ";
        }

        for ($i=0;$i<5;$i++) { //강사 만족도
            mysqli_data_seek($result4, $i);
            $row = mysqli_fetch_array($result4);
            $acd_name = $row["acd_name"];
            $parent = $row["parent"];
            $teacher = $row["avg(review.teacher)"];
            $no = $row["no"];
            $total_grade = round($teacher, 1);
            array_push($array, $total_grade*20);//평점 넣어주기
            echo "
            <script>
            document.getElementsByClassName('acd_grade3')[$i].onclick = function(){
              location.href = '../academy/index.php?no=$no';
            }

              document.getElementById('teacher_grade$i').innerHTML = '$acd_name';
              if($total_grade%1==0){
                document.getElementById('teacher_score$i').innerHTML = '$total_grade.0';
              }else{
              document.getElementById('teacher_score$i').innerHTML = '$total_grade';
              }

            </script>

          ";
        }

        for ($i=0;$i<5;$i++) { //수강료 만족도
            mysqli_data_seek($result5, $i);
            $row = mysqli_fetch_array($result5);
            $acd_name = $row["acd_name"];
            $parent = $row["parent"];
            $cost_effect = $row["avg(review.cost_efct)"];
            $no = $row["no"];
            $total_grade = round($cost_effect, 1);
            array_push($array, $total_grade*20);//평점 넣어주기
            echo "
            <script>
            document.getElementsByClassName('acd_grade4')[$i].onclick = function(){
              location.href = '../academy/index.php?no=$no';
            }

              document.getElementById('cost_effect_grade$i').innerHTML = '$acd_name';
              if($total_grade%1==0){
                document.getElementById('cost_effect_score$i').innerHTML = '$total_grade.0';
              }else{
              document.getElementById('cost_effect_score$i').innerHTML = '$total_grade';
              }

            </script>

          ";
        }

        for ($i=0;$i<5;$i++) { //수강료 만족도
            mysqli_data_seek($result6, $i);
            $row = mysqli_fetch_array($result6);
            $acd_name = $row["acd_name"];
            $parent = $row["parent"];
            $achievement = $row["avg(review.achievement)"];
            $no = $row["no"];
            $total_grade = round($achievement, 1);
            array_push($array, $total_grade*20); //평점 넣어주기

            echo "
            <script>
              document.getElementsByClassName('acd_grade5')[$i].onclick = function(){
                location.href = '../academy/index.php?no=$no';
              }


              document.getElementById('achievement_grade$i').innerHTML = '$acd_name';
              if($total_grade%1==0){
                document.getElementById('achievement_score$i').innerHTML = '$total_grade.0';
              }else{
              document.getElementById('achievement_score$i').innerHTML = '$total_grade';
              }

            </script>

          ";
        }
        // 평점 바 넣어주기 //카운트함수 배열의 수를 센다. length 느낌
        for ($i=0; $i < count($array); $i++) {
            echo "
            <script>
            console.log($array[$i]);
            document.getElementsByClassName('bl_score')[$i].style.width ='$array[$i]%';
            </script>
          ";
        }
        //DB 닫아주기
        mysqli_close($conn);

         ?>


<!-- ======================================================================================================== -->

        <div id="my_village_academy">

          <div id="mva_title">
            <h2>우리동네학원</h2>
          </div>

              <div class="mva_class">

                <div id="mva1_img">
                  <a href=""> <img src="./img/edu_image.jpg" alt="" width="150" height="130" class="acd_img"> </a>
                </div>
                <div id="academy_name">
                  <h2 id="titlee"><span class="aca_name">학원이름</span></h2>
                </div>
                <div id="academy_cell">
                  <span class="aca_tel">032-000-0000</span>
                </div>
                <div id="academy_address">
                  <span class="aca_address">인천광역시 계양구 계산동</span>
                </div>

                <div class="see_more">
                  <span> <a href="#" id="see_more">상세 정보 보기</a></span>
                </div>
                <div class="star">
                   <img src="/eduplanet/img/academy_big_one_star.png" alt="star" width="18">
                   <span class="star_span">몇점</span>
                </div>

              </div>

              <div class="mva_class">
                <div id="mva1_img">
                  <a href=""> <img src="./img/edu_image.jpg" alt="" width="150" height="130" class="acd_img"> </a>
                </div>
                <div id="academy_name">
                  <h2 id="titlee"><span class="aca_name">학원이름</span></h2>
                </div>
                <div id="academy_cell">
                  <span class="aca_tel">032-000-0000</span>
                </div>
                <div id="academy_address">
                  <span class="aca_address">인천광역시 계양구 계산동</span>
                </div>

                <div class="see_more">
                  <span> <a href="#" id="see_more">상세 정보 보기</a></span>
                </div>
                <div class="star">
                   <img src="/eduplanet/img/academy_big_one_star.png" alt="star" width="18">
                   <span class="star_span">몇점</span>
                </div>

              </div>

              <div class="mva_class">
                <div id="mva1_img">
                  <a href=""> <img src="./img/edu_image.jpg" alt="" width="150" height="130" class="acd_img"> </a>
                </div>
                <div id="academy_name">
                  <h2 id="titlee"><span class="aca_name">학원이름</span></h2>
                </div>
                <div id="academy_cell">
                  <span class="aca_tel">032-000-0000</span>
                </div>
                <div id="academy_address">
                  <span class="aca_address">인천광역시 계양구 계산동</span>
                </div>

                <div class="see_more">
                  <span> <a href="#" id="see_more">상세 정보 보기</a></span>
                </div>
                <div class="star">
                   <img src="/eduplanet/img/academy_big_one_star.png" alt="star" width="18">
                   <span class="star_span">몇점</span>
                </div>

              </div>
              <div class="mva_class">
                <div id="mva1_img">
                  <a href=""> <img src="./img/edu_image.jpg" alt="" width="150" height="130" class="acd_img"> </a>
                </div>
                <div id="academy_name">
                  <h2 id="titlee"><span class="aca_name">학원이름</span></h2>
                </div>
                <div id="academy_cell">
                  <span class="aca_tel">032-000-0000</span>
                </div>
                <div id="academy_address">
                  <span class="aca_address">인천광역시 계양구 계산동</span>
                </div>

                <div class="see_more">
                  <span> <a href="#" id="see_more">상세 정보 보기</a></span>
                </div>
                <div class="star">
                   <img src="/eduplanet/img/academy_big_one_star.png" alt="star" width="18">
                   <span class="star_span">몇점</span>
                </div>
              </div>

        </div><!--second_contents end -->



        <!-- 현위치 주소 가져오기 ------------------------------------------->
        <script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=79f3ade82ebdd492df0cd3712dc6f828&libraries=services"></script>
        <script type="text/javascript">
          var lat ;
          var lng ;
          var juso;
          function gotoOurCityAcademy(){

          }

          function getMydongAcd(siName,dongName){
            $.ajax({
                type: "post", //보내는 타입은 post 방식이여
                datatype:"JSON", //방식은 json 방식이여
                data:{"siName":siName,  //이것으로 작업을 할것이여
                      "dongName":dongName}, //이것으로 작업을 할것이여
                url: "./infor.php", //여기로 보낼것이여 저 2개의 데이터를
                success: function (response) { //저기서 작업하고 여 response로 값이 올것이여.
                    response = response.trim();
                    console.log(response);
                    if(response == "Norow!"){

                      // 폼 수정 하면 밑에 3줄 주석 풀어라!
                      document.getElementById("my_village_academy").style.display = "none";
                      document.getElementById("view_all_button2").style.display = "none";
                      document.getElementById("contents_wrap").style.height = "770px";
                    }else{
                      var a = JSON.parse(response); //택배를 뜯는느낌 // 이것은 json 정보를 우리가 볼수있게 해독해주는 것이여.

                      console.log(a[0]['acdName']);
                      var acd_no_array = [];
                      for (var i = 0; i < 4; i++) {
                          //이미지 넣어주기
                          console.log(a);
                          if(a[i]['img']===""){
                              document.getElementsByClassName("acd_img")[i].src ="/eduplanet/img/acd_logo2.png";
                          }
                          else{
                              document.getElementsByClassName("acd_img")[i].src ="/eduplanet/data/acd_logo/"+a[i]['img'];
                          }
                          //학원명 넣어주기
                          document.getElementsByClassName("aca_name")[i].innerHTML = a[i]['acdName'];

                          //평점 넣어 주기
                          document.getElementsByClassName("star_span")[i].innerHTML = parseFloat(a[i]['total_star']).toFixed(1);
                          //번호 넣어주기
                          if(a[i]['tel']==''){
                            // alert("뭣이여");
                            document.getElementsByClassName("aca_tel")[i].innerHTML = " # 번호 정보 없음";
                          }else{
                            document.getElementsByClassName("aca_tel")[i].innerHTML = a[i]['tel'];
                          }
                          //학원주소 넣어주기
                          document.getElementsByClassName("aca_address")[i].innerHTML = a[i]['address'];
                          console.log(a[i]['no']);

                          // 학원 정보 자세히
                          document.getElementsByClassName("see_more")[i].onclick = moreInfo(a[i]['no']);

                          var jim = a[i]['parent'];
                          acd_no_array.push(a[i]['parent']);


                      }
                      var i = 0; //each() 각각 하나씩 넣어준다
                      $(".jjim").each(function(){
                        $(this).attr("href", "/eduplanet/acd_story/follow.php?no="+acd_no_array[i]);
                        i++;    //attr() 속성을변경해준다
                      });
                    }
                    // console.log(response[0]["acd_name"]);
                  //  제이슨 해당정보를 해독을 함


                },error:function(request,status,error){
                    alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
                }
            });
          }
          // console.log(a[0]['no']);

            //클로저 기능 함수! 이걸 안해주면 자꾸 마지막 값만 들어간다 다중이벤트를 사용할때는 해줘야함!!!!
            function moreInfo(num){
              return function(){
                location.href="../academy/index.php?no="+num;
              }
            }

            var siName = "";
            function getLocation() {
              if (navigator.geolocation) { // GPS를 지원하면

                navigator.geolocation.getCurrentPosition(function(position) {

                    lat = 37.825968; //임시
                    // lat = position.coords.latitude; //현위치 위도경도
                    lng = 127.510878; //임시
                    // lng = position.coords.longitude; //현위치 위도경도
                    console.log(position.coords.latitude);
                    console.log(position.coords.longitude);

                    var geocoder = new kakao.maps.services.Geocoder();
                    var coord = new kakao.maps.LatLng(lat,lng);
                    var callback = function(result,status){
                      if(status === kakao.maps.services.Status.OK){
                        console.log(result[0].address.address_name);
                        juso = result[0].address.address_name;
                        var address = juso.split(' ');
                        console.log(address[0]);
                        console.log(address[1]);
                        console.log(address[2]);
                        console.log(address[3]);

                        //마지막글자를 추출한다. ex)수원시 -> '시'
                        var lastAddress = address[1].charAt(address[1].length-1);
                        siName = address[1];
                        console.log(lastAddress);
                        if(lastAddress === "시"){
                          //이 경우 동은 address[3]에 있기에
                          getMydongAcd(address[1],address[3]);
                        }else{
                          //나머지는 군 이기에 요렇게.
                          getMydongAcd(address[1],address[2]);
                        }
                        console.log(siName);
                        // 가평군 수원시 등등 address[1]을 가져와서 get으로 보낸다 그럼 학원더보기를 눌렀을때 내 위치 학원이 뜬다
                        // $("#see_more0").attr('href', '/eduplanet/acd_list/view_all.php?district='+siName);
                        $("#view_all_button2").click(function(){
                          location.replace('/eduplanet/acd_list/view_all.php?district='+siName);
                        });
                      }
                    };

                    // alert(lat + ' ' + lng);
                    geocoder.coord2Address(coord.getLng(),coord.getLat(),callback);

                } // getCurrentPosition end....
                , function(error) {
                  console.error(error);
                }, {
                  enableHighAccuracy: false,
                  maximumAge: 0,
                  timeout: Infinity
                });

              } // if end...

              else {
                alert('GPS를 지원하지 않습니다');
              } // else end...

            }// 함수 end

              getLocation();

        </script>

      <!--    --------------------------------------------------------------------------------->
      <div class="view_all">
      <button class="blue_bar_button" id="view_all_button2" onclick="location.href='/eduplanet/acd_list/view_all.php'">우리동네 학원 전체보기</button>
      </div>
      <!-- <div id="more_s">
        <button type="button" name="button" id="more_btn" onclick="location.href='/eduplanet/acd_list/view_all.php?="><a id="see_more0" href="/eduplanet/acd_list/view_all.php?district=">학원 더보기</a></button>
      </div> -->

      </div> <!-- main_contents end-->

    </div> <!--contents end -->

  </div> <!--contents_wrap -->




    </main>


    <footer>
        <?php include_once $_SERVER["DOCUMENT_ROOT"]."/eduplanet/index/footer.php"; ?>
    </footer>

  </body>
</html>
