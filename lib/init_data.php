<?php

//아카데미 이름 배열(a_members_init_data함수에서 데이터 채워짐)
$acd_name_arr = array();
//일반회원 가입 날짜 배열
$gm_join_date = array();
//기업회원 가입 날짜 배열
$am_join_date = array();

//academy 테이블 
function academy_init_data(){
  $sql ="INSERT INTO `academy` VALUES "; //리턴할 sql문장

  $acd_array1 = get_academy_from_api("가평군", "가평읍");
  $acd_array2 = get_academy_from_api("수원시", "영통동");
  $acd_array3 = get_academy_from_api("시흥시", "거모동");
  $acd_array4 = get_academy_from_api("고양시", "성사동");
  $acd_array5 = get_academy_from_api("성남시", "성남동");
  $acd_array6 = get_academy_from_api("광명시", "하안동");

  $acd_array_total = array_merge($acd_array1,$acd_array2,$acd_array3,$acd_array4,$acd_array5,$acd_array6);
  

  
  for($i=0; $i<sizeof($acd_array_total); $i++){
    $si_name = $acd_array_total[$i]->si_name;
    $dong_name = $acd_array_total[$i]->dong_name;
    $sector = $acd_array_total[$i]->sector;
    $acd_name = $acd_array_total[$i]->acd_name;
    $rprsn = $acd_array_total[$i]->rprsn;
    $class = $acd_array_total[$i]->class;
    $tel = $acd_array_total[$i]->tel;
    $address = $acd_array_total[$i]->address;

    $no = $i+1;

    $sql .= "($no, '$si_name','$dong_name','$sector','$acd_name','$rprsn','$class','$tel','$address', '', '', '', '')";

    if($i != sizeof($acd_array_total)-1){
      $sql .=", ";
    }
  }
  $sql .= ";";
  return $sql;
}

//일반 회원 테이블 - row 500개 생성
function g_members_init_data(){
  global $gm_join_date;
  
    $sql = "INSERT INTO `g_members` VALUES ";
    $intres_array = array("국어","영어","수학","미술","음악","과학","태권도","필라테스","IT","바리스타","요가","제빵");

    for($no = 1; $no<= 500 ; $no++){

      //난수생성 rand(최소숫자, 최대숫자)
      $birth = rand(1990, 2015);
      $intres = array_rand($intres_array); //배열의 키값(0~n까지 숫자) 리턴
      $intres = $intres_array[$intres]; //키값으로 배열중 하나 가져오기

      //가입일자 생성
      $join_date = randomDate('2019-01-01', '2019-06-30');

      //멤버십기간 날짜 설정
      $mbship_period = rand(0,3);
      if($mbship_period==0){
        $membership = "0000-00-00"; //DATE형 데이터에 자꾸 null이 안들어가서(디폴트 null인데도) 기본값을 00~으로 바꿈.
      }else{
        $membership = strtotime("$join_date +$mbship_period months");
        $membership= date("Y-m-d", $membership);
      }

      array_push($gm_join_date, $join_date);

      $sql .= "($no, 'test$no@google.com', 'a123456!', '01012345678', '$birth', '$intres',null ,null ,'$membership', '$join_date'),";
      
    }
    //마지막 콤마 제거
    $sql = substr($sql, 0, -1);
    $sql .= ";";
    return $sql;
}

//학원회원 테이블 - 30개 row 생성
function a_members_init_data(){
  global $acd_name_arr;
  global $am_join_date;
  include_once 'api_connector.php';

  //학원데이터 학원명, 대표자명 가져옴
  $rprsn_arr = array();

  $acd_array = get_academy_from_api("가평군", "가평읍");

  for($i=0; $i<sizeof($acd_array); $i++){
    $acd_name = $acd_array[$i]->acd_name;
    $rprsn = $acd_array[$i]->rprsn;

    array_push($acd_name_arr, $acd_name);
    array_push($rprsn_arr, $rprsn);
  }
  
  $sql = "INSERT INTO `a_members` VALUES ";
  $i = 0;
  for($no = 1; $no<= 30 ; $no++){

    $a_name = $acd_name_arr[$i];
    $r_name = $rprsn_arr[$i];

    $file_copy = "test_bsns_img.jpg";

    //가입일자생성
    $join_date = randomDate('2019-01-01', '2019-06-30');
    array_push($am_join_date, $join_date);
    
    //멤버십기간 날짜 설정
    $mbship_period = rand(0,3);
    if($mbship_period==0){
      $membership = "0000-00-00"; //DATE형 데이터에 자꾸 null이 안들어가서(디폴트 null인데도) 기본값을 00~으로 바꿈.
    }else{
      $membership = strtotime("$join_date +$mbship_period months");
      $membership= date("Y-m-d", $membership);
    }

    //회원가입 승인여부 설정
    $approval = rand(0,1);
    $approval = $approval==0? 'N' : 'Y';

    $sql .= "($no, $no,'test$no@google.com', 'a123456!', '$a_name', '$r_name', '$file_copy', '$approval', null, null,'$membership', '$join_date'),";
    
    $i++;
  }
  //마지막 콤마 제거
  $sql = substr($sql, 0, -1);
  $sql .= ";";
  return $sql;
}

// 리뷰테이블
function review_init_data(){
  $sql = "INSERT INTO `review` VALUES ";
  $benefit_array = array("햄스터샘 해바라기송 완전 잘쳐요. 어릴때 부터 해바라기씨도 엄청 잘까셨대요.", "이 학원 강추! 시설도 최신식이에요. 시설 깨끗하고 관리도 잘하세요.", "고양이 선생님 좋아요! 친절하게 잘 알려주시고, 코치도 잘해주세요.",
                        "고양이샘에게 수업받고 실력이 늘었어요. 역시 1타 강사 다워요!", "학원비가 저렴하고 비용대비 꼼꼼하게 봐주는 학원이에요", "학습 분위기가 좋아요. 자습하는 분위기가 잘 형성되어 있어요.");
  $drawback_array = array("접근성이 좋지 않아요! 교통이 별로에요", "학원에 가려면 왕복 1시간 걸려요. 멀어요.", "교통이 너무 안좋아요. 버스가 잘 안다녀요.",
                          "학원에 휴게실이 없어서 불편해요. ", "수업은 좋은데 학원비가 비싸요. 가성비 안좋음.", "여기 애들이 너무 시끄러워요. 계속 뛰어다니고 선생님들도 제재를 안해요.");
  $oneline_array = array("선생님이 모두 친절하고 잘 가르쳐요. 가성비 좋은 학원이에요.", "교통과 시설이 매우 좋은 학원이에요. 생긴지 얼마 안되어서 깔끔해요.", "학원비만 비싸고 질도 별로... 그 돈 내고 다니기 아까운 학원", "원장선생님이 돈을 밝혀요. 계속 추가결제하라고 압박주는 이상한 학원.", "교통만 좋으면 정말 좋은학원. 그래도 스쿨버스가 있어서 다닐만해요.", "서울 사이버학원에 다니고 나의 인생역전 시작됐다~");

  for($no = 1; $no<= 150 ; $no++){

    //난수생성 rand(최소숫자, 최대숫자)
    $parent = rand(1, 30);
    $user_no = rand(1, 100);
    $rating1 = rand(2, 5);
    $rating2 = rand(1, 5);
    $rating3 = rand(1, 5);
    $rating4 = rand(1, 5);
    $rating5 = rand(1, 5);
    $rating6 = rand(1, 5);
    $benefit = array_rand($benefit_array); //배열의 키값(0~n까지 숫자) 리턴
    $benefit = $benefit_array[$benefit]; //키값으로 배열중 하나 가져오기
    $drawback = array_rand($drawback_array);
    $drawback = $drawback_array[$drawback];
    $oneline = array_rand($oneline_array);
    $oneline = $oneline_array[$oneline];

    //리뷰일자생성
    $review_date = randomDate('2019-01-01', '2019-06-30');

    $sql .= "($no, $parent, $user_no, '$oneline', $rating1, $rating2, $rating3, $rating4, $rating5, $rating6, '$benefit', '$drawback', '$review_date'),";
  }

  //마지막 콤마 제거
  $sql = substr($sql, 0, -1);
  $sql .= ";";
  return $sql;
}

//스토리 테이블
function acd_story_init_data(){
  global $acd_name_arr;
  
  $sql = "INSERT INTO `acd_story` VALUES ";
  $title_array = array("고양희 선생님 냥쿠르 대상 수상", "제3회 전국 고양이 서예경시대회 우승!", "입시미술 1번지, 홍익대에 가고 싶다면!",
                       "50년 전통의 남영수수학학원", "고양이말 동시통역사 배출!", "계미샘에게 배우는 야매피아노");
  $subtitle_array = array("가평 No.1 학원", "20년 경력의 노하우를 알려드립니다", "1:1 개인별 맞춤수업 진행!", "최고 시설에서 최고의 강의를", "2020학년도 서울대 29명 배출!");

  for($no = 1; $no<= 150 ; $no++){
      $parent = rand(1, 30);
      $acd_name = $acd_name_arr[$parent-1];
      $title = array_rand($title_array);
      $title = $title_array[$title];
      $subtitle = array_rand($subtitle_array);
      $subtitle = $subtitle_array[$subtitle];
      $file_copy = 'test_acd_story_img.jpg';

      //등록일자생성
      $regist_date = randomDate('2019-01-01', '2019-06-30');

    $sql .= "($no, $parent, '$acd_name', '$title', '$subtitle',
              '부제1', '부제내용1', '부제2', '부제내용2', '부제3', '부제내용3', 0,
              '$regist_date', '사진', '$file_copy'),";
  }

  //마지막 콤마 제거
  $sql = substr($sql, 0, -1);
  $sql .= ";";
  return $sql;

}

// am_order 더미 데이터 생성하는 함수
function am_order_init_data() {

  // 배열에 미리 값 셋팅
  $product_array = array("학원관리 1개월", "학원관리 2개월", "학원관리 3개월");
  $price_array = array(50000, 100000, 150000);
  $pay_array = array('카카오페이','스마일페이','페이코', '신용카드');

  // 배열 인덱스에 넣어줄 변수
  $i = 0;

  $sql = "INSERT INTO `am_order` VALUES ";

  // 더미 데이터 100개 생성 // no는 0이아닌 1부터 시작해야 함
  for($no = 1; $no <= 100 ; $no++){

    //등록일자생성
    $regist_date = randomDate('2019-01-01', '2019-06-30');

    $rand = rand(0,2);
    $rand2 = rand(0,3);
    $product = $product_array[$rand];
    $price = $price_array[$rand];
    $pay = $pay_array[$rand2];
    
    $sql .= "($no, $no,'$product', '$price', '$pay', '결제완료', '$regist_date'),";

    $i++;
  }
  
  //마지막 콤마 제거
  $sql = substr($sql, 0, -1);
  $sql .= ";";
  return $sql;
}

// gm_order 더미 데이터 생성하는 함수
function gm_order_init_data() {

  // 배열에 미리 값 셋팅
  $product_array = array("프리미엄 1개월","프리미엄 2개월","프리미엄 3개월");
  $price_array = array(5000,10000,15000);
  $pay_array = array('카카오페이','스마일페이','페이코','신용카드');

  // 배열 인덱스에 넣어줄 변수
  $i = 0;

  $sql = "INSERT INTO `gm_order` VALUES ";

  // 더미 데이터 100개 생성 // no는 0이아닌 1부터 시작해야 함
  for($no = 1; $no <= 100 ; $no++){

    //등록일자생성
    $regist_date = randomDate('2019-01-01', '2019-06-30');

    $rand = rand(0,2);
    $rand2 = rand(0,3);
    $product = $product_array[$rand];
    $price = $price_array[$rand];
    $pay = $pay_array[$rand2];
    
    $sql .= "($no, $no,'$product', '$price', '$pay', '결제완료', '$regist_date'),";

    $i++;
  }
  
  //마지막 콤마 제거
  $sql = substr($sql, 0, -1);
  $sql .= ";";
  return $sql;
}

// 틸퇴회원 더미 데이터 생성하는 함수
function withdrawal_init_data() {
  global $gm_join_date;
  global $am_join_date;

  $sql = "INSERT INTO `withdrawal` VALUES ";

  // 일반회원30명 탈퇴
  $no_temp = random(1,500, 100); //1~100까지 숫자중 중복없이 30개 추출
  $no_array = array();
  foreach ($no_temp as $v){
    array_push($no_array, $v);
  }

  for($no = 1; $no <= 100 ; $no++){
    $mmbr_no = (int)$no_array[$no-1];
    //해당 회원의 가입날짜 가져오기
    $start_date = $gm_join_date[$mmbr_no-1];
    //탈퇴 날짜 생성
    $end_date = '2019-06-30';
    $wthd_date = randomDate($start_date, $end_date);
    
    $sql .= "($no, 'G' ,'$mmbr_no', '$start_date', '$wthd_date'),";
  }


  // 학원회원8명 탈퇴
  $no_temp = random(1,30, 8); //1~100까지 숫자중 중복없이 30개 추출
  $no_array = array();
  foreach ($no_temp as $v){
    array_push($no_array, $v);
  }
  $i=0;
  for($no = 101; $no <= 108 ; $no++){

    //회원 번호 뽑기
    $mmbr_no = (int)$no_array[$i];
    //해당 회원의 가입날짜 가져오기
    $start_date = $am_join_date[$mmbr_no-1];
    //탈퇴 날짜 생성
    $end_date = '2019-06-30';
    $wthd_date = randomDate($start_date, $end_date);
    
    $sql .= "($no, 'A' ,'$mmbr_no', '$start_date', '$wthd_date'),";

    $i++;
  }
  
  //마지막 콤마 제거
  $sql = substr($sql, 0, -1);
  $sql .= ";";
  return $sql;

}

function random($min, $max, $num) {
  $arr = array();
	while ($num > count($arr)) {
		$i = rand($min, $max);
		$arr[$i] = $i; 
	}
	return $arr;
}	

function randomDate($start_date, $end_date){
  // 타임 스탬프로 변환
  $min = strtotime($start_date);
  $max = strtotime($end_date);

  // 위에서 얻은 타임 스탬프 값을 사용하여 난수 생성
  $val = rand($min, $max);
  // 원하는 날짜 형식으로 다시 변환
  return date('Y-m-d', $val);
}


?>


