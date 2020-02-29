<?php

    $no   = $_POST['no'];
    $new_no   = $_POST['new_no'];
    $new_si_name = $_POST['new_si_name'];
    $new_dong_name = $_POST['new_dong_name'];
    $new_sector = $_POST['new_sector'];
    $new_acd_name = $_POST['new_acd_name'];
    $new_rprsn = $_POST['new_rprsn'];
    $new_class = $_POST['new_class'];
    $new_tel = $_POST['new_tel'];
    $new_address = $_POST['new_address'];

    include_once $_SERVER['DOCUMENT_ROOT'] . "/eduplanet/lib/db_connector.php";

    for($i = 0; $i < count($no); $i++){

        $n = $no[$i];
        $n2 = $new_no[$i];
        $si = $new_si_name[$i];
        $dong = $new_dong_name[$i];
        $sec= $new_sector[$i];
        $name = $new_acd_name[$i];
        $rprsn = $new_rprsn[$i];
        $class = $new_class[$i];
        $tel = $new_tel[$i];
        $adrs = $new_address[$i];

        // $sql = "delete from academy_temp where no=$n2";
        // mysqli_query($conn, $sql);

        $sql = "update academy set si_name='$si', dong_name='$dong'
        , sector='$sec', acd_name='$name', rprsn='$rprsn', class='$class'
        , tel='$tel', address='$adrs' where no=$n";

        $result = mysqli_query($conn, $sql);
        if(!$result){
            mysqli_close($conn);
            die('Could not update data - ' . mysqli_error($conn));
        }

    }

    mysqli_close($conn);
    echo "1";
?>

