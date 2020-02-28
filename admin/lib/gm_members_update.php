<?php

    $no   = $_POST['no'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $intres = $_POST['intres'];
    $expiry_day = $_POST['expiry_day'];

    include_once '../../lib/db_connector.php';

    for($i = 0; $i < count($no); $i++){

        $em = $email[$i];
        $ph = $phone[$i];
        $itr = $intres[$i];
        $exp = $expiry_day[$i];
        $n = $no[$i];

        $sql = "update g_members set email='$em', phone='$ph', intres='$itr', expiry_day='$exp' where no=$n";

        $result = mysqli_query($conn, $sql);
        if(!$result){
            mysqli_close($conn);
            die('Could not update data - ' . mysqli_error($conn));
        }

    }

    mysqli_close($conn);
    echo "1";
?>

