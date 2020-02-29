<?php

    $parent   = $_POST['parent'];
    $order = $_POST['order'];
    $day = $_POST['day'];
    $subject = $_POST['subject'];

    include_once $_SERVER['DOCUMENT_ROOT'] . "/eduplanet/lib/db_connector.php";

    for($i = 0; $i < count($parent); $i++){

        $p = $parent[$i];
        $o = $order[$i];
        $d = $day[$i];
        $s = $subject[$i];

        $sql = "INSERT INTO lecture VALUES (null, $p, $d, $o, '$s');";
        $result = mysqli_query($conn, $sql);

        if(!$result){
            mysqli_close($conn);
            die('Could not update data - ' . mysqli_error($conn));
        }

    }

    mysqli_close($conn);
    echo "1";
?>

