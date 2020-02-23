<?php
    $siName = $_POST["siName"];
    $dongName = $_POST["dongName"];

    include_once("../lib/db_connector.php");


    $sql= " select * from academy where si_name = '$siName' and dong_name = '$dongName'; ";
    $result=mysqli_query($conn,$sql);

    for($i=0;$i<mysqli_num_rows($result);$i++){
        mysqli_data_seek($result,$i);
        $row=mysqli_fetch_array($result);

        //리스트에 연관 배열{"name":aa,"address":bb}이런식으로 가져옴
        $list[$i]=array("acdName" => $row["acd_name"],"tel"=>$row["tel"],"address" => $row['address'], "no" => $row["no"]);
    }


    //받은 정보를 제이슨으로 ajax success함수에 반환 encode 택배상자같은느낌.
    $gg = json_encode($list); //제이슨으로 포장하는느낌
    echo $gg; // success로 보내주는 행위
?>
