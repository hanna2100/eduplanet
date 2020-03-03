<?php include_once $_SERVER["DOCUMENT_ROOT"] . "/eduplanet/lib/session_start.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>에듀플래닛</title>

    <!-- favicon -->
    <link rel="shortcut icon" href="/eduplanet/img/favicon.png">

    <!-- 제이쿼리 -->
    <script src="http://code.jquery.com/jquery-1.12.4.min.js" charset="utf-8"></script>

    <!-- 폰트 -->
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR&amp;display=swap" rel="stylesheet">

    <!-- 아이콘 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="/eduplanet/index/index_header_searchbar_in.css">
    <link rel="stylesheet" href="/eduplanet/index/footer.css">
    <link rel="stylesheet" href="/eduplanet/mypage/css/mypage_header.css">
    <link rel="stylesheet" href="/eduplanet/mypage/css/review_write_popup.css">
    <link rel="stylesheet" href="/eduplanet/mypage/css/story.css">
    <link rel="stylesheet" href="/eduplanet/acd_story/css/index.css">

    <!-- 스크립트 -->
    <script src="/eduplanet/searchbar/searchbar_in.js"></script>
    <script src="/eduplanet/mypage/js/review_write.js"></script>

    <!-- 자동완성 -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <!-- identicon (프로필 이미지) -->
    <script src="//cdn.rawgit.com/placemarker/jQuery-MD5/master/jquery.md5.js"></script>
    <script src="//rawgit.com/stewartlord/identicon.js/master/pnglib.js"></script>
    <script src="//rawgit.com/stewartlord/identicon.js/master/identicon.js"></script>

    <script>
        $(document).ready(function() {

            // 아이디에 따라 생성되는 프로필 이미지 만드는 함수 (세션에서 userid를 받아온다)
            $(".user_img").each(function() {

                $(this).prop('src', 'data:image/png;base64,' + new Identicon($.md5($(this).data("user")), 80)).show();
            });
        });
    </script>

</head>

<body>

    <div class="body_wrap">

        <header>
            <div class="header_searchbar_fix">
                <?php include_once $_SERVER["DOCUMENT_ROOT"] . "/eduplanet/index/index_header_searchbar_in.php"; ?>
            </div>

            <div class="header_mypage">
                <?php include_once $_SERVER["DOCUMENT_ROOT"] . "/eduplanet/mypage/mypage_header.php"; ?>
            </div>
        </header>

        <?php
                
            if ($am_no) {

                include_once $_SERVER["DOCUMENT_ROOT"] . "/eduplanet/lib/db_connector.php";
                
                $sql = "SELECT acd_no FROM a_members WHERE no=$am_no;";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_array($result);
                $acd_no = $row["acd_no"];
            }
        ?>

        <div class="mypage_user_menu_background">
            <div class="mypage_user_menu">
                <ul>
                    <a href="/eduplanet/mypage/am_myinfo.php">
                        <li id="mypage_user_myinfo">내 정보</li>
                    </a>

                    <a href="/eduplanet/mypage/am_membership_pay.php">
                        <li id="mypage_user_membership">멤버십/결제</li>
                    </a>

                    <a href="/eduplanet/mypage/story.php">
                        <li id="mypage_user_story">스토리 관리</li>
                    </a>

                    <a href="/eduplanet/academy/index.php?no=<?= $acd_no ?>">
                        <li id="mypage_user_review">My Academy</li>
                    </a>
                </ul>
            </div>
        </div>

        <div class="follow_list_wrap">
            <div class="follow_list_background">

                <?php

                $user_no = $am_no;

                if (!$user_no) {
                    echo "
                        <script>
                            alert('잘못된 접근입니다.');
                            history.go(-1)
                        </script>
                    ";
                }

                // 페이지 수 체크
                if (isset($_GET["page"])) {
                    $page = $_GET["page"];
                } else {
                    $page = 1;
                }

                include_once $_SERVER["DOCUMENT_ROOT"] . "/eduplanet/lib/db_connector.php";

                $sql = "SELECT * FROM a_members WHERE no=$am_no";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_array($result);

                $acd_no = $row["acd_no"];

                $sql = "SELECT * FROM acd_story WHERE acd_story.parent = $acd_no ORDER BY acd_story.no DESC";

                $result = mysqli_query($conn, $sql);
                $total_record = mysqli_num_rows($result);

                ?>

                <div class="follow_list_select">
                    <h2>
                        스토리 관리
                        <button id="button_write_story" onclick="location.href='/eduplanet/acd_story/post.php'">스토리 등록</button>
                    </h2>
                    <span id="follow_total_span">총 <span id="follow_total_num"><?= $total_record ?></span> 개의 스토리가 있습니다.</span>
                </div>

                <!-- start of ul ------------------------------------------------------------------------------------->

                <?php

                if ($total_record !== 0) {

                ?>

                    <ul class="follow_unorder_list">

                        <?php

                        $scale = 10;

                        if ($total_record % $scale == 0) {
                            $total_page = floor($total_record / $scale);
                        } else {
                            $total_page = floor($total_record / $scale) + 1;
                        }

                        $page_setting = ($page - 1) * $scale;

                        $page_start = $total_record - $page_setting;


                        for ($i = $page_setting; $i < $page_setting + $scale && $i < $total_record; $i++) {

                            mysqli_data_seek($result, $i);

                            $row = mysqli_fetch_array($result);

                            $no = $row["no"];
                            $parent = $row["parent"];
                            $title = $row["title"];
                            $subtitle = $row["subtitle"];
                            $regist_day = $row["regist_day"];
                            $file_copy = $row["file_copy"];

                        ?>

                            <!-- 하나의 스토리 리스트-->
                            <li>
                                <div class="story_list_column">

                                    <a href="/eduplanet/acd_story/view.php?story_no=<?= $no ?>">
                                        <div class="story_list_column_img">
                                            <img src="/eduplanet/data/acd_story/<?= $file_copy ?>" alt="story_list_column_img">
                                        </div>

                                        <div class="story_list_column_text">
                                            <h1 id="story_text_title"><?= $title ?>
                                    </a>

                                    <div class="story_academy_heart">
                                        <button id="story_delete" type="button" onclick="delete_story(<?=$no?>);">삭제</button>
                                        <a href="/eduplanet/mypage/story_modify_form.php?no=<?=$no?>"><button id="story_modify" type="button">수정</button></a>
                                    </div>

                                    <script>
                                        function delete_story(story_no) {

                                            var deleteConf = confirm('정말 삭제하시겠습니까? \n삭제된 스토리는 복구할 수 없습니다.');

                                            if (deleteConf === true) {

                                                location.href = "/eduplanet/mypage/story_delete.php?no=" + story_no;

                                            } else {
                                                alert("스토리 삭제가 취소되었습니다.");
                                            }
                                        }
                                    </script>

                                    </h1>
                                    <p id="story_text_title_sub"><?= $subtitle ?></p>

                                    <div class="story_list_column_academy_info">
                                        <span id="academy_title_span">작성일 : <?= $regist_day ?></span>

                                    </div>
                                </div>

                            </li>

                        <?php
                            $page_start--;
                        }
                        mysqli_close($conn);
                        ?>

                    </ul>
                    <!-- end of ul ------------------------------------------------------------------>

                    <div class="page_num_wrap">
                        <div class="page_num">
                            <ul class="page_num_ul">

                                <?php

                                $url = '/eduplanet/acd_story/index.php?';

                                // 페이지 쪽수 표시 량 (5 페이지씩 표기)
                                $page_scale = 5;

                                // 페이지 그룹번호(페이지 5개가 1그룹)
                                $pageGroup = ceil($page / $page_scale);

                                //그룹번호 안에서의 마지막 페이지 숫자
                                $last_page = $pageGroup * $page_scale;

                                // 그룹번호의 마지막 페이지는 전체 페이지보다 클 수 없음
                                if ($total_page < $page_scale) {
                                    $last_page = $total_page;
                                } else if ($last_page > $total_page) {
                                    $last_page = $total_page;
                                }

                                //그룹번호의 첫번째 페이지 숫자
                                $first_page = $last_page - ($page_scale - 1);

                                //그룹번호의 첫번째 페이지는 1페이지보다 작을 수 없음
                                if ($first_page < 1) {
                                    $first_page = 1;

                                    //마지막 그룹번호일때 첫번째 페이지값 결정
                                } else if ($last_page == $total_page) {

                                    if ($total_page % $page_scale == 0) {
                                        $first_page = $total_page - $page_scale + 1;
                                    } else {
                                        $first_page = $total_page - ($total_page % $page_scale) + 1;
                                    }
                                }

                                $next = $last_page + 1; // > 버튼 누를때 나올 페이지
                                $prev = $first_page - 1; // < 버튼 누를때 나올 페이지

                                // 첫번째 페이지일 때 앵커 비활성화
                                if ($first_page == 1) {

                                    if ($page != 1) {
                                        echo "<li><a href='.$url.page=1'><span class='page_num_direction'><i class='fas fa-angle-double-left'></i></span></a></li>";
                                    } else {
                                        echo "<li><a><span class='page_num_direction'><i class='fas fa-angle-double-left'></i></span></a></li>";
                                    }

                                    echo "<li><a><span class='page_num_direction'><i class='fas fa-angle-left'></i></span></a></li>";
                                } else {
                                    echo "<li><a href='.$url.page=1'><span class='page_num_direction'><i class='fas fa-angle-double-left'></i></span></a></li>";
                                    echo "<li><a href='.$url.page=$prev'><span class='page_num_direction'><i class='fas fa-angle-left'></i></span></a></li>";
                                }

                                //페이지 번호 매기기
                                for ($i = $first_page; $i <= $last_page; $i++) {

                                    if ($page == $i) {
                                        echo "<li><span class='page_num_set'><b style='color:#2E89FF'> $i </b></span></li>";
                                    } else {
                                        echo "<li><a href='.$url.page=$i'><span class='page_num_set'> &nbsp$i&nbsp </span></a></li>";
                                    }
                                }

                                // 마지막 페이지일 때 앵커 비활성화
                                if ($last_page == $total_page) {
                                    echo "<li><a><span class='page_num_direction'><i class='fas fa-angle-right'></i></span></a></li>";

                                    if ($page != $total_page) {
                                        echo "<li><a href='.$url.page=$total_page'><span class='page_num_direction_last'><i class='fas fa-angle-double-right'></i></span></a></li>";
                                    } else {
                                        echo "<li><a><span class='page_num_direction_last'><i class='fas fa-angle-double-right'></i></span></a></li>";
                                    }
                                } else {
                                    echo "<li><a href='.$url.page=$next'><span class='page_num_direction'><i class='fas fa-angle-right'></i></span></a></li>";
                                    echo "<li><a href='.$url.page=$total_page'><span class='page_num_direction_last'><i class='fas fa-angle-double-right'></i></span></a></li>";
                                }
                                ?>
                            </ul>

                        <?php
                    } else {
                        ?>
                            <div class="list_none">
                                <h2>스토리가 없습니다.</h2>
                                <p class="list_none_p">아직 작성하신 스토리가 없습니다.</p>
                                <p class="list_none_p">스토리를 작성하여 학원의 이야기를 담아 보세요.</p>
                                <a href="/eduplanet/acd_story/post.php"><button type="button">스토리 작성하기</button></a>
                            </div>

                        <?php
                    }
                        ?>
                        </div>
                    </div>
                    <!-- end of page_num_wrap -------------------------------------------------------->

            </div>
        </div>

        <footer>
            <?php include_once $_SERVER["DOCUMENT_ROOT"] . "/eduplanet/index/footer.php"; ?>
        </footer>

    </div>

</body>

</html>