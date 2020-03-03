<?php include_once $_SERVER["DOCUMENT_ROOT"] . "/eduplanet/lib/session_start.php"; ?>

<div class="index_header_wrap">

    <!-- 헤더 메뉴 -->
    <div class="index_header_menu">

        <ul class="index_header_menu_ul_left">
            <li>
                <a href="/eduplanet/index.php">
                    <div class="index_header_logo_img">
                        <img src="/eduplanet/img/eduplanet_logo.png" alt="index_header_logo_img">
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

            <?php
                
                if ($am_no) {

                    include_once $_SERVER["DOCUMENT_ROOT"] . "/eduplanet/lib/db_connector.php";
                    
                    $sql = "SELECT acd_no FROM a_members WHERE no=$am_no;";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($result);
                    $acd_no = $row["acd_no"];
                }
            ?>

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
                                <a href="/eduplanet/mypage/story.php">
                                    <li>스토리 관리</li>
                                </a>
                                <a href="/eduplanet/academy/index.php?no=<?= $acd_no ?>">
                                    <li>My Academy</li>
                                </a>
                                <a href="/eduplanet/index/logout.php">
                                    <li>로그아웃</li>
                                </a>

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

<?php include_once $_SERVER["DOCUMENT_ROOT"] . "/eduplanet/mypage/review_write_popup.php"; ?>