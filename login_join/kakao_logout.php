<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- 카카오 로그인 -->
    <script src="//developers.kakao.com/sdk/js/kakao.min.js"></script>
    
</head>

<body>

    <?php

    echo "
        <script>
            Kakao.Auth.logout();
            alert('카카오 로그아웃 완료!');
            location.href='/eduplanet/index.php';
        </script>
        ";

    ?>

</body>

</html>