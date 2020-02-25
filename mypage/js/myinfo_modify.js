var idPass = false;
var pwPass = false;
var emailPass = false;

var telPass = false;
var agePass = false;
var intresPass = false;

var acdNamePass = false;
var rprsnPass = false;

$(document).ready(function () {

    var inputPw1 = $("#inputPw1"),
        inputPw2 = $("#inputPw2"),
        inputEmail = $("#inputEmail"),
        inputTel = $("#inputTel"),
        inputAge = $("#inputAge"),
        inputIntres = $("#inputIntres"),
        inputAcdName = $("#inputAcdName"),
        inputRprsn = $("#inputRprsn");

    // 비밀번호 체크
    inputPw2.keyup(function () {
        var pw1Value = inputPw1.val();
        var pw2Value = inputPw2.val();
        var exp = /^(?=.*\d{1,50})(?=.*[!@#$%^*()\-_=+\\\|\[\]{};:\'",.<>\/?]{1,50})(?=.*[a-zA-Z]{1,50}).{8,50}$/;

        if (!exp.test(pw1Value) || !exp.test(pw2Value)) {
            $("#pwSubMsg").text("숫자, 영문자, 특수문자 포함 8글자 이상 입력");
            pwPass = false;
            // isGmAllPass();
            // isAmAllPass();
        } else if (pw1Value != pw2Value) {
            $("#pwSubMsg").text("비밀번호가 일치하지 않습니다.");
            pwPass = false;
            // isGmAllPass();
            // isAmAllPass();
        } else {
            $("#pwSubMsg").text("");
            pwPass = true;
            // isGmAllPass();
            // isAmAllPass();
        }
    });

    // 이메일 체크
    inputEmail.keyup(function () {
        var emailValue = inputEmail.val();
        var exp = /^[\w_\.\-]+@[\w\-]+\.[\w\-]+/;

        if (!exp.test(emailValue)) {
            $("#emailSubMsg").text("이메일 형식이 올바르지 않습니다.");
            emailPass = false;
            // isGmAllPass();
            // isAmAllPass();
        } else {
            $("#emailSubMsg").text("");
            emailPass = true;
            // isGmAllPass();
            // isAmAllPass();
        }
    });

    // 전화번호 체크
    inputTel.keyup(function () {
        var telValue = inputTel.val();
        var mobile_exp = /^01(?:0|1|[6-9])(?:\d{3}|\d{4})\d{4}$/;

        if (!mobile_exp.test(telValue)) {
            $("#telSubMsg").text("휴대전화 형식에 맞춰 - 없이 입력");
            telPass = false;
            // isGmAllPass();
        } else {
            $("#telSubMsg").text("");
            telPass = true;
            // isGmAllPass();
        }
    });

    // 학원 select로 바꾸면 지우기
    // 학원/교습소명 체크
    inputAcdName.keyup(function () {
        var acdNameValue = inputAcdName.val();
        var exp = /^[가-힣a-zA-Z]{2,50}$/;

        if (!exp.test(acdNameValue)) {
            $("#AcdNameSubMsg").text("한글 / 영문 2글자 이상 입력");
            acdNamePass = false;
            // isAmAllPass();
        } else {
            $("#AcdNameSubMsg").text("");
            acdNamePass = true;
            // isAmAllPass();
        }
    });

    // 출생년도 select box
    setDateBox();
    inputAge.change(function () {
        var ageValue = $("#inputAge option:selected").val();
        console.log("출생년도", ageValue);

        if (!ageValue) {
            agePass = false;
            // isGmAllPass();
        } else {
            agePass = true;
            // isGmAllPass();
        }
    });

    // 관심과목 체크
    inputIntres.keyup(function () {
        var intresValue = inputIntres.val();
        var exp = /^[가-힣a-zA-Z]{2,10}$/;

        if (!exp.test(intresValue)) {
            $("#intresSubMsg").text("한글 혹은 영문 2~10자 이내 입력");
            intresPass = false;
            // isGmAllPass();
        } else {
            $("#intresSubMsg").text("");
            intresPass = true;
            // isGmAllPass();
        }
    });

    // 대표자명 체크
    inputRprsn.keyup(function () {
        var nameValue = inputRprsn.val();
        var exp = /^[가-힣a-zA-Z]{2,50}$/;

        if (!exp.test(nameValue)) {
            $("#RprsnSubMsg").text("이름은 한글 혹은 영문 2자 이상이어야 합니다.");
            rprsnPass = false;
            // isAmAllPass();
        } else {
            $("#RprsnSubMsg").text("");
            rprsnPass = true;
            // isAmAllPass();
        }
    });
});

// 출생년도 셋팅
function setDateBox() {
    var dt = new Date();
    var year = "";
    var com_year = dt.getFullYear();

    $("#inputAge").append("<option value=''>년도</option>");
    for (var y = (com_year - 5); y >= (com_year - 60); y--) {
        $("#inputAge").append("<option value='" + y + "'>" + y + " 년" + "</option>");
    }
}

// 일반회원 가입
function isGmAllPass() {
    if (!(pwPass && emailPass && telPass && agePass && intresPass)) {
        alert("입력하신 항목을 다시 확인해 주세요.");
        
    } else {
        document.getElementById('form_member').submit()
        // $("#btnFormSubmit").attr("disabled", true);
    }
}

// 기업회원 가입
function isAmAllPass() {
    if (!(pwPass && emailPass && acdNamePass && rprsnPass)) {
        alert("입력하신 항목을 다시 확인해 주세요.");
        
    } else {
        document.getElementById('form_member').submit()
        // $("#btnFormSubmit").attr("disabled", true);
    }
}