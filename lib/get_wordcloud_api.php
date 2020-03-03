
<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/eduplanet/lib/db_connector.php";

$no = isset($_POST['no'])? $_POST['no']: null;

if(!$no){
    echo "not_found_no";
    exit;
}

$openApiURL = "http://aiopen.etri.re.kr:8000/WiseNLU";
$accessKey = "86344d80-3c18-4e84-be99-2a100b23ff59";
$analysisCode = "ner"; //언어분석코드 개체명
$text = "YOUR_SENTENCE"; //분석할 문장

$sql = "SELECT benefit, drawback FROM review where parent = $no;";
$result = mysqli_query($conn, $sql);

if(!$result){
    echo "no_data";
    exit;
}

$good_serialize = '';
$bad_serialize = '';

for($i=0; $i<mysqli_num_rows($result); $i++){
    $row = mysqli_fetch_array($result);
    $good = $row[0];
    $bad = $row[1];

    $good_serialize .= $good . ' ';
    $bad_serialize .= $bad . ' ';
}

$data_array = getHangulDataFromAPI($good_serialize);
$good_result = morphologicalAnalysis($data_array); //장점 단어들(중복o)

$data_array = getHangulDataFromAPI($bad_serialize);
$bad_result = morphologicalAnalysis($data_array);//단점 단어들(중복o)

$good_num = array_count_values($good_result);

$good_sort_result =array();
foreach($good_num as $key => $value){
    $temp = array();
    array_push($temp, $key);
    array_push($temp, $value);
    array_push($good_sort_result, $temp);
}

$bad_sort_result =array();
$bad_num = array_count_values($bad_result);
foreach($bad_num as $key => $value){
    $temp = array();
    array_push($temp, $key);
    array_push($temp, $value);
    array_push($bad_sort_result, $temp);
}

$return_data = array();
array_push($return_data, $good_sort_result);
array_push($return_data, $bad_sort_result);

echo json_encode($return_data);


function getHangulDataFromAPI($serialize){
    global $openApiURL;
    global $accessKey;
    global $analysisCode;


    //장점 키워드 전송
    $request = array(
        "access_key" => $accessKey,
        "argument" => array (
            "analysis_code" => $analysisCode,
            "text" =>$serialize
        )
    );

    $res = "";
    
    try {
        $ch = curl_init();
        $header = array(
            "Content-Type:application/json; charset=UTF-8",
        );
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_URL, $openApiURL);
        curl_setopt($ch, CURLOPT_VERBOSE, true);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode ( $request) );
    

        $res = curl_exec ($ch);

        if(!$res) {
            echo "Error Number:".curl_errno($ch)."\n";
            echo "Error String:".curl_error($ch)."\n";
        }

        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $header = substr($res, 0, $header_size);
        $body = substr($res, $header_size);    
        
        $body_json = json_decode($body, true);
        
        $body_json = $body_json['return_object']['sentence'];
    
        curl_close ($ch);

    } catch ( Exception $e ) {
    echo $e->getMessage ();
    }

    return $body_json;
}

function morphologicalAnalysis($data_array){

    $word_result = array();

    for($i=0; $i<sizeof($data_array); $i++){

        $morp = $data_array[$i]['morp']; //형태소형태
        for($j=0; $j<sizeof($morp); $j++){
            $lemma = $morp[$j]['lemma']; //형태소
            $type = $morp[$j]['type']; //해당 형태소의 품사

            if($type=="NNG"){ //명사이면 저장
                array_push($word_result, $lemma);
            }
        }

        $NE = $data_array[$i]['NE']; //개채명형태
        for($j=0; $j<sizeof($NE); $j++){
            $text = $NE[$j]['text'];
            $type = $NE[$j]['type'];

            if($type=="AM_MAMMALIA"){ 
                array_push($word_result, $text);
            }

        }

    }

    //정보력이 상대적으로 없는 단어 제거
    $del_array = ['학원', '샘', '선생', '선생님', '수업', '성'];
    for($i =0; $i<sizeof($del_array); $i++){
        $word_result = arr_del($word_result, $del_array[$i]);
    }
    return $word_result;

}

function arr_del($list_arr, $del_value){ // 배열, 삭제할 값
    $key = array_search($del_value,$list_arr);

    foreach ($list_arr as $key => $val) {
        if($val==$del_value){
            //삭제실행
            unset($list_arr[$key]);
        }
    }
      
    //Index 채우기
    array_values($list_arr);
    return $list_arr;
}



?>
                         