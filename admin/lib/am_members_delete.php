<?php

    $no   = $_POST['no'];

    include_once $_SERVER['DOCUMENT_ROOT'] . "/eduplanet/lib/db_connector.php";

    for($i = 0; $i < count($no); $i++){

        $n = $no[$i];
        $sql = "delete from a_members where no = $n";

        mysqli_query($conn, $sql);
        
        if(!mysqli_affected_rows($conn)){
            mysqli_close($conn);
            die('Could not update data - ' . mysqli_error($conn));
        }
    }

    mysqli_close($conn);
    
    echo "1";

?>

