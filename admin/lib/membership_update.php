<?php

    $no   = $_POST['no'];
    $prdct_name = $_POST['prdct_name'];
    $month = $_POST['month'];
    $price = $_POST['price'];
    $discount = $_POST['discount'];

    include_once '../../lib/db_connector.php';

    for($i = 0; $i < count($no); $i++){

        $name = $prdct_name[$i];
        $mon = $month[$i];
        $n = $no[$i];
        $prc = $price[$i];
        $dsc = $discount[$i];

        $sql = "update product set prdct_name='$name', month='$mon', price='$prc', discount='$dsc' where no=$n";

        $result = mysqli_query($conn, $sql);
        if(!$result){
            mysqli_close($conn);
            die('Could not update data - ' . mysqli_error($conn));
        }

    }

    mysqli_close($conn);
    echo "1";
?>

