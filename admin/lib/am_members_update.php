<?php

    $no   = $_POST['no'];
    $expiry_day = $_POST['expiry_day'];

    include_once $_SERVER['DOCUMENT_ROOT'] . "/eduplanet/lib/db_connector.php";

    for($i = 0; $i < count($no); $i++){

        $exp = $expiry_day[$i];
        $n = $no[$i];

        $sql = "update a_members set expiry_day='$exp' where no=$n";

        $result = mysqli_query($conn, $sql);
        if(!$result){
            mysqli_close($conn);
            die('Could not update data - ' . mysqli_error($conn));
        }

    }

    mysqli_close($conn);
    echo "1";
?>

