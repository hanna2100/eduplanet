<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="utf-8">
    <title>결제 완료 페이지</title>
    <!-- favicon -->
    <link rel="shortcut icon" href="/eduplanet/img/favicon.png">
    <script src="http://code.jquery.com/jquery-1.12.4.min.js" charset="utf-8"></script>
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR&amp;display=swap" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" href="/eduplanet/mypage/css/review_write_popup.css">
    <link rel="stylesheet" href="/eduplanet/index/index_header_searchbar_in.css">
    <link rel="stylesheet" href="/eduplanet/index/footer.css">
    <link rel="stylesheet" href="/code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="./css/receipt.css">
    <!-- 스크립트 -->
    <script src="/eduplanet/mypage/js/review_write.js"></script>
    <script src="/eduplanet/searchbar/searchbar_in.js"></script>
    <!-- 자동완성 -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!-- 아이콘 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css">

  </head>
  <body>
    <header>
       <?php
        include_once $_SERVER["DOCUMENT_ROOT"]."/eduplanet/lib/session_start.php";
        include_once $_SERVER["DOCUMENT_ROOT"] . "/eduplanet/lib/db_connector.php";
        include_once $_SERVER["DOCUMENT_ROOT"]."/eduplanet/index/index_header_searchbar_in.php";
       ?>
    </header>

    <?php
      $gm_no = isset($_SESSION["gm_no"]) ?  $_SESSION["gm_no"] : "";
      $am_no = isset($_SESSION["am_no"]) ?  $_SESSION["am_no"] : "";

      if(isset($_GET['product']) && isset($_GET['price']) && isset($_GET['payMethod']) && isset($_GET['expired_date'])){
        $product = $_GET['product'];
        $price = $_GET['price'];
        $payMethod = $_GET['payMethod'];
        $expired_date = $_GET['expired_date'];
      }else {
        echo "못 받아옴";
      };

      $status = "결제완료";
      $expired_date = date("yy-m-d", $expired_date);
      if($gm_no){
        $sql_order = "INSERT INTO `gm_order` VALUES (null, $gm_no, '$product', $price, '$payMethod', '$status', '$expired_date');";
        $sql_members = "UPDATE `g_members` SET expiry_day='$expired_date' where no=$gm_no;";
        $product_info = "학원정보/리뷰 열람";
        $_SESSION['pgm_no'] = $gm_no;
      }else if($am_no){
        $sql_order = "INSERT INTO `am_order` VALUES (null, $am_no, '$product', $price, '$payMethod', '$status', '$expired_date');";
        $sql_members = "UPDATE `a_members` SET expiry_day='$expired_date' where no=$am_no;";
        $product_info = "학원 스토리 포스팅";
        $_SESSION['pam_no'] = $am_no;
      }

      mysqli_query($conn, $sql_order);
      mysqli_query($conn, $sql_members);
      mysqli_close($conn);
    ?>

    <section>
      <div class="inner_section">
        <div class="thankyou_logo">
          <a href="../index.php"><img src="../img/thank-you.png" width="100px" height="80px" alt="thank you!"></a>
        </div>
        <div class="pay_end_wrap">
          <h2>결제가 완료되었습니다.</h2>
          <div class="pay_end_content">
            <ul>
              <li>
                <span class="key">상품명</span>
                <span class="value"><?=$product?></span>
              </li>
              <li>
                <span class="key">설명</span>
                <span class="value"><?=$product_info?></span>
              </li>
              <li>
                <span class="key">금액</span>
                <span class="value"><?=number_format($price)?>원</span>
              </li>
            </ul>
          </div>
          <div class="pay_end_button">
              <button type="button" name="button" onclick="location.href='../index.php'">확인</button>
          </div>

        </div>

      </div>

    </section>

    <footer>
       <?php include_once $_SERVER["DOCUMENT_ROOT"]."/eduplanet/index/footer.php"; ?>
    </footer>
  </body>
</html>
