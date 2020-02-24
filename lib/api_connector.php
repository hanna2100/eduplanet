<?php

$api_index;
$api_scale;

//한글을 16진수로 변경해야 검색이 됨
function strToHex($string){
    $hex = '';
    for ($i=0; $i<strlen($string); $i++){
        $ord = ord($string[$i]);
        $hexCode = dechex($ord);
        $hex .= "%".$hexCode;
    }
    return strToUpper($hex);
}

function set_api_index($num){
    global $api_index;
    $api_index = $num;
}

function set_api_scale($num){
    global $api_scale;
    $api_scale = $num;
}

//Academy객체 배열을 반환
function get_academy_from_api($si_name, $dong_name){
    global $api_index;
    global $api_scale;

    $si_name = strToHex($si_name);
    $dong_name = strToHex($dong_name);

    $service_url = 'https://openapi.gg.go.kr/';
    $service_api_name = 'TninsttInstutM';
    $service_key = 'c9fb730dbed141fe919348f4bc542277'; //api키

    //api주소
    $service_full_url = $service_url.$service_api_name.'?';
    //기본인자
    $service_full_url .= 'KEY='.$service_key;
    $service_full_url .= '&Type='.'json';
    $service_full_url .= '&pIndex='.$api_index; //페이지 위치
    $service_full_url .= '&pSize='.$api_scale; //페이지당 요청숫자
    //요청인자
    $service_full_url .= '&SIGUN_NM='.$si_name; //시군명
    $service_full_url .= '&EMD_NM='.$dong_name; //시군명

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $service_full_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    $response = curl_exec($ch);

    $errno = curl_errno($ch);
    if ($errno > 0) {
        if ($errno === 28) {
            echo "Connection timed out.";
        }
        else {
            echo "Error #" . $errno . ": " . curl_error($ch);
        }
        exit(0);
    }

    if (!$response) {
        echo "ERROR - 1";
        exit(0);
    }
    
    $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    if($status_code != 200) {
        echo "Error 내용:".$response;
    }

    $array_result= json_decode($response, true);

    if (!$array_result) {
        echo "ERROR - 3";
        exit(0);
    }
    
    curl_close ($ch);
    
    return get_academy_list($array_result);

}

//디코딩한 json을 academy객체로 배열생성
function get_academy_list($array_input){

    $array_input = $array_input["TninsttInstutM"][1]["row"];

    $array_output = array();

    for($i=0; $i<sizeof($array_input); $i++){
        $si_name = $array_input[$i]['SIGUN_NM'];
        $dong_name = $array_input[$i]['EMD_NM'];
        $sector = $array_input[$i]['INDUTYPE_DIV_NM'];
        $acd_name = $array_input[$i]['FACLT_NM'];
        $rprsn = $array_input[$i]['REPRSNTV_NM'];
        $class = $array_input[$i]['CRSE_CLASS_NM'];
        $tel = $array_input[$i]['TELNO'];
        if($array_input[$i]['REFINE_ROADNM_ADDR']){
            $address = $array_input[$i]['REFINE_ROADNM_ADDR'];
        } else{
            $address = $array_input[$i]['REFINE_LOTNO_ADDR'];
        }

        $academy = new Academy($si_name, $dong_name, $sector, $acd_name, $rprsn, $class, $tel, $address);
        
        array_push($array_output, $academy);
    }

    return $array_output;

}

class Academy {
    
    public $si_name;
    public $dong_name;
    public $sector;
    public $acd_name;
    public $rprsn;
    public $class;
    public $tel;
    public $address;
    public $website;
    public $schoolbus;
    public $introduce;

    public function __construct($si_name, $dong_name, $sector, $acd_name, $rprsn, $class
                                ,$tel, $address) {
        $this->si_name = $si_name;
        $this->dong_name = $dong_name;
        $this->sector = $sector;
        $this->acd_name = $acd_name;
        $this->rprsn = $rprsn;
        $this->class = $class;
        $this->tel = $tel;
        $this->address = $address;
    }

    public function set_add_info($website, $schoolbus, $introduce) { 
        $this->website = $website; 
        $this->schoolbus = $schoolbus; 
        $this->introduce = $introduce; 
    } 
    
}


?>