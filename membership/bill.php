<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="utf-8">
    <title>에듀플래닛</title>
    <!-- favicon -->
    <link rel="shortcut icon" href="/eduplanet/img/favicon.png">
     <script src="https://code.jquery.com/jquery-1.12.4.min.js" charset="utf-8"></script>
     <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR&amp;display=swap" rel="stylesheet">
     <link rel="stylesheet" href="./css/bill.css">
  </head>
  <body>
    <header>
       <?php
       // include "../index_header.php";
       ?>
    </header>

    <?php
      $gm_no = isset($_SESSION["gm_no"]) ?  $_SESSION["gm_no"] : "";

      include "../lib/db_connector.php";
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
      $sql_gm_order = "INSERT INTO `gm_order` VALUES (null, $gm_no, '$product', $price, '$payMethod', '$status', '$expired_date');";
      $sql_g_members = "UPDATE `g_members` SET expiry_day='$expired_date' where no=$gm_no;";
      mysqli_query($conn, $sql_gm_order);
      mysqli_query($conn, $sql_g_members);
      mysqli_close($conn);
    ?>

    <section>
      <div class="inner_section">
        <div class="thankyou_logo">
          <img src="../img/thank-you.png" width="100px" height="80px" alt="thank you!">
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
                <span class="value">학원정보/리뷰 열람</span>
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
       <?php include "../index/footer.php"; ?>
    </footer>
  </body>
</html>
