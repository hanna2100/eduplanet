<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/eduplanet/lib/db_connector.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>에듀플래닛</title>

  <!-- 폰트 -->
  <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR&amp;display=swap" rel="stylesheet">

</head>

<body>

  <header>
    <?php include "index/index_header.php"; ?>
  </header>

  <section>
    <?php include "index/index_content.php"; ?>
  </section>

  <footer>
    <?php include "index/footer.php"; ?>
  </footer>

</body>

</html>