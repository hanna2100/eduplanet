<?php

// 셀럭트한 시/구를 조건에 달아야함

    include_once "./lib/db_connector.php";

    if (isset($_POST['search'])) {

        $search = $_POST['search'];
        $sql = "SELECT * FROM academy WHERE acd_name LIKE '%".$search."%'";
        $result = mysqli_query($conn, $sql);

        $response = array();

        while ($row = mysqli_fetch_array($result)) {

            $response[] = array(
                "acd_name" => $row['acd_name'], 
                "si_name" => $row['si_name'],
                "dong_name" => $row['dong_name']
            );
        }

        echo json_encode($response);
    }

    exit;

?>