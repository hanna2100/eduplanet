<?php

    include_once '../../lib/db_connector.php';

    $sql = "CALL modify_data_for_testing()";
    
    if(mysqli_query($conn, $sql)){

        mysqli_close($conn);

        echo "1";

    }else{
        
         mysqli_close($conn);

    }

    
    

?>

