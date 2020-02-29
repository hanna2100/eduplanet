<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/eduplanet/lib/db_connector.php";
?>

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
  <link rel="stylesheet" href="/eduplanet/index/index_header.css">
  <link rel="stylesheet" href="/eduplanet/index/footer.css">
  <link rel="stylesheet" href="/eduplanet/mypage/css/review_write_popup.css">
  <link rel="stylesheet" href="/eduplanet/index/index_content.css">

  <!-- 스크립트 -->
  <script src="/eduplanet/searchbar/searchbar_index.js"></script>
  <script src="/eduplanet/mypage/js/review_write.js"></script>

  <!-- 자동완성 -->
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

  <!-- 슬라이더 -->
  <link rel="stylesheet" href="/eduplanet/index/nivo-slider/css/nivo-slider.css">
  <link rel="stylesheet" href="/eduplanet/index/nivo-slider/css/mi-slider.css">
  <script src="/eduplanet/index/nivo-slider/js/jquery.nivo.slider.js"></script>

  <script type="text/javascript"> 
		$(window).on('load', function() {
		    $('#slider').nivoSlider(); 
		}); 
	</script>

  <style>
    body {
      background: #ebecee;
    }
  </style>

</head>

<body>

  <header>
    <?php include_once $_SERVER["DOCUMENT_ROOT"]."/eduplanet/index/index_header.php"; ?>
  </header>

  <section>
    <?php include_once $_SERVER["DOCUMENT_ROOT"]."/eduplanet/index/index_content.php"; ?>
  </section>

  <footer>
    <?php include_once $_SERVER["DOCUMENT_ROOT"]."/eduplanet/index/footer.php"; ?>
  </footer>

</body>

</html>