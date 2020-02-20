<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <script src="http://code.jquery.com/jquery-1.12.4.min.js" charset="utf-8"></script>
    <script type="text/javascript" src="https://cdn.iamport.kr/js/iamport.payment-1.1.5.js"></script>
  </head>
  <body>

    <h1>receipt.php</h1>

    <?php
      // include "./payment.php";
      include "../lib/db_connector.php";
      if(isset($_GET['month']) && isset($_GET['final_price']) && isset($_GET['expired_date'])){
        $month = $_GET['month'];
        $final_price = $_GET['final_price'];
        $expired_date = $_GET['expired_date'];
      }else {
        echo " GET 값이 안들어옴 ";
      }

      $payMethod = $_POST['payMethod'];
      $name = $_POST['name'];
      $phone_num = $_POST['phone_num'];
      $email = $_POST['email'];

     ?>
     <script type="text/javascript">
         var month = '<?= $month ?>';
         var final_price = '<?= $final_price ?>';
         var payMethod = '<?= $payMethod ?>';
         var name = '<?= $name ?>';
         var phone_num = '<?= $phone_num ?>'
         var email = '<?= $email ?>'
     </script>
     <script src="./payment.js">

     </script>
  </body>
</html>
