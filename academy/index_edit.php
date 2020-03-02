<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
      include_once("../lib/db_connector.php");

      $webSite = $_POST["website"];
      $introduce = $_POST["introduce"];
      $schoolbus = $_POST["schoolbus"];


      $sql = "update academy set website = '$webSite',schoolbus = '$schoolbus',introduce = '$introduce';";
      mysqli_query($conn,$sql);
      mysqli_close($conn);

      echo "
        <script>
          alert('수정완료!');
          history.go(-1);
        </script>
      ";


     ?>


  </body>
</html>
