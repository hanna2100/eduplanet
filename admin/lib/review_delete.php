<?php

    $no   = $_POST['no'];

    include_once '../../lib/db_connector.php';

    for($i = 0; $i < count($no); $i++){

        $n = $no[$i];
        $sql = "DELETE FROM review WHERE no = $n;";

        if(!mysqli_query($conn, $sql)){
            echo "0";
            die;
        };
    
    }

    mysqli_close($conn);
    
    echo "1";

?>

