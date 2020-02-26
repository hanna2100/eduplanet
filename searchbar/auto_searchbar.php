<?php

    include_once $_SERVER["DOCUMENT_ROOT"]."/eduplanet/lib/db_connector.php";

    // 시/군을 선택했을 때
    if (isset($_POST['search']) && ($_POST['selectDis'] != "")) {

        $search = $_POST['search'];
        $selectDis = $_POST['selectDis'];

        $sql = "SELECT * FROM academy WHERE acd_name LIKE '%".$search."%' AND si_name='$selectDis'";
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

    // 시/군을 선택하지 않았을 때
    } else if (isset($_POST['search']) && ($_POST['selectDis'] == "")) {

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