<?php

    include_once "../lib/db_connector.php";

    if (isset($_POST['selectDis'])) {

        $selectDis = $_POST['selectDis'];

        $sql = "SELECT * FROM acd_story WHERE  ORDER BY no DESC ";

        $result = mysqli_query($conn, $sql);
        
        $response = array();

        while ($row = mysqli_fetch_array($result)) {

            $response[] = array(
                "acd_name" => $row['acd_name'], 
                "total_star" => $row['total_star'],
                "one_line" => $row['one_line'],
                "facility_star" => $row['facility'],
                "acsbl_star" => $row['acsbl'],
                "teacher_star" => $row['teacher'],
                "cost_efct_star" => $row['cost_efct'],
                "achievement_star" => $row['achievement'],
                "benefit" => $row['benefit'],
                "drawback" => $row['drawback']
            );
        }

        echo json_encode($response);
    }

    exit;

?>