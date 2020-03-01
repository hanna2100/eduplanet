<?php include_once $_SERVER["DOCUMENT_ROOT"] . "/eduplanet/lib/session_start.php"; ?>

<div class="body_wrap">

    <div class="index_header_wrap">

        <!-- 헤더 메뉴 -->
        <div class="index_header_menu">

            <ul class="index_header_menu_ul_left">
                <li>
                    <a href="/eduplanet/index.php">
                        <div class="index_header_home_img">
                            <img src="/eduplanet/img/index_header_home.png" alt="index_header_logo_img">
                        </div>

                    </a>
                </li>

                <li>
                    <a href="/eduplanet/acd_list/index.php">
                        <span>학원</span>
                        <div class="index_header_menu_hover">
                            <i class="fas fa-caret-up"></i>
                        </div>
                    </a>
                </li>

                <li>
                    <a href="/eduplanet/acd_story/index.php">
                        <span>스토리</span>
                        <div class="index_header_menu_hover">
                            <i class="fas fa-caret-up"></i>
                        </div>
                    </a>
                </li>

                <li>
                    <a href="/eduplanet/membership/index.php">
                        <span>멤버십</span>
                        <div class="index_header_menu_hover">
                            <i class="fas fa-caret-up"></i>
                        </div>
                    </a>
                </li>

            </ul>

            <ul class="index_header_menu_ul_right">

                <li>
                    <!-- 리뷰쓰기 -->
                    <div class="index_header_review_img">
                        <img src="/eduplanet/img/index_header_review.png" alt="index_header_review">
                    </div>

                    <div class="index_header_menu_hover_detail">
                        <i class="fas fa-caret-up"></i>

                        <div class="index_header_menu_hover_detail_review">
                            <ul>

                                <?php
                                // 일반 회원
                                if ($gm_no) {
                                ?>
                                    <li id="review_write" onclick="showPopup(1);">리뷰 작성</li>

                                <?php
                                    // 학원 회원
                                } else if ($am_no) {
                                ?>
                                    <a href="javascript:alert('리뷰 작성은 일반 회원만 이용 가능합니다.')">
                                        <li id="review_write">리뷰 작성</li>
                                    </a>

                                <?php
                                    // 로그인 안했을 때
                                } else {
                                ?>
                                    <a href="javascript:alert('로그인 후 이용 가능합니다.')">
                                        <li id="review_write">리뷰 작성</li>
                                    </a>
                                <?php
                                }
                                ?>

                            </ul>

                        </div>
                    </div>
                </li>

                <li>
                    <!-- 내정보 -->
                    <div class="index_header_profile_img">
                        <img src="/eduplanet/img/index_header_profile.png" alt="index_header_profile">
                    </div>

                    <div class="index_header_menu_hover_detail">
                        <i class="fas fa-caret-up"></i>

                        <div class="index_header_menu_hover_detail_profile">
                            <ul>
                                <?php
                                // 일반회원 메뉴
                                if ($gm_no) {
                                ?>

                                    <a href="/eduplanet/mypage/myinfo.php">
                                        <li>내 정보</li>
                                    </a>
                                    <a href="/eduplanet/mypage/follow.php">
                                        <li>찜목록</li>
                                    </a>
                                    <a href="/eduplanet/mypage/membership_pay.php">
                                        <li>멤버십/결제</li>
                                    </a>
                                    <a href="/eduplanet/mypage/review_mylist.php">
                                        <li>리뷰</li>
                                    </a>
                                    <a href="/eduplanet/index/logout.php">
                                        <li>로그아웃</li>
                                    </a>

                                <?php
                                    // 학원회원 메뉴
                                } else if ($am_no) {
                                ?>

                                    <a href="/eduplanet/mypage/am_myinfo.php">
                                        <li>내 정보</li>
                                    </a>
                                    <a href="/eduplanet/mypage/am_membership_pay.php">
                                        <li>멤버십/결제</li>
                                    </a>

                                    <a href="/eduplanet/academy/index.php?no=<?= $am_no ?>">
                                        <li>My Academy</li>
                                    </a>
                                    <a href="/eduplanet/index/logout.php">
                                        <li>로그아웃</li>
                                    </a>
                                    <script>
                                        document.getElementsByClassName("index_header_menu_hover_detail_profile")[0].style.height = "175px";
                                    </script>

                                <?php
                                    // 로그인 안했을 때
                                } else {
                                ?>
                                    <!-- <a id="not_mem" href="javascript:alert('로그인 후 이용 가능합니다.')"><li>로그인 해주세요.</li></a> -->
                                    <a id="not_mem" href="/eduplanet/login_join/login_form.php">
                                        <li>로그인</li>
                                    </a>
                                    <a id="not_mem" href="/eduplanet/login_join/join_form.php">
                                        <li>회원가입</li>
                                    </a>
                                    <script>
                                        document.getElementsByClassName("index_header_menu_hover_detail_profile")[0].style.height = "95px";
                                    </script>
                                <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </li>

            </ul>

        </div>

    </div>

    <div class="index_header_search_wrap">

        <div class="index_header_search">

            <a href="/eduplanet/index.php">
                <div class="index_header_search_logo">
                    <img src="/eduplanet/img/eduplanet_logo.png" alt="index_header_search_logo">
                </div>
            </a>


            <div class="index_main_title">

                <div class="index_main_search">

                    <select name="select_district" id="select_district">
                        <option selected value="">시/군 선택</option>
                        <option value="가평군">가평군</option>
                        <option value="고양시">고양시</option>
                        <option value="과천시">과천시</option>
                        <option value="광명시">광명시</option>
                        <option value="광주시">광주시</option>
                        <option value="구리시">구리시</option>
                        <option value="군포시">군포시</option>
                        <option value="김포시">김포시</option>
                        <option value="남양주시">남양주시</option>
                        <option value="동두천시">동두천시</option>
                        <option value="부천시">부천시</option>
                        <option value="성남시">성남시</option>
                        <option value="수원시">수원시</option>
                        <option value="시흥시">시흥시</option>
                        <option value="안산시">안산시</option>
                        <option value="안성시">안성시</option>
                        <option value="안양시">안양시</option>
                        <option value="양주시">양주시</option>
                        <option value="양평군">양평군</option>
                        <option value="여주시">여주시</option>
                        <option value="연천군">연천군</option>
                        <option value="오산시">오산시</option>
                        <option value="용인시">용인시</option>
                        <option value="의왕시">의왕시</option>
                        <option value="의정부시">의정부시</option>
                        <option value="이천시">이천시</option>
                        <option value="파주시">파주시</option>
                        <option value="평택시">평택시</option>
                        <option value="포천시">포천시</option>
                        <option value="하남시">하남시</option>
                        <option value="화성시">화성시</option>
                    </select>

                    <input placeholder="학원 이름으로 검색" type="text" name="acd_name" id="acd_name_out">
                    <button id="button_main_search" type="button" onclick="searchAcademy();">검색</button>

                    <script>
                        function searchAcademy() {
                            location.href = '/eduplanet/acd_list/view_all.php?search=' + document.getElementById("acd_name_out").value;
                        }
                    </script>


                </div>

            </div>

        </div>
    </div>
</div>

<?php include_once $_SERVER["DOCUMENT_ROOT"] . "/eduplanet/mypage/review_write_popup.php"; ?>