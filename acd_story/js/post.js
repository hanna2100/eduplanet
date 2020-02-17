function checkInput() {

    if (document.getElementById("upfile").value === "" ||
        document.getElementById("story_post_img_check").innerHTML !== "") {

        document.getElementById("story_post_img_check").innerHTML = "사진을 첨부해 주세요.";

    } else {
        document.getElementById("story_post_img_check").innerHTML = "";
    }

    var classNum = document.getElementsByClassName("story_post_wrap").length;

    // 주제가 하나일 때
    if (classNum == 2) {

        if (document.getElementById("story_post_title").value === "" ||
            document.getElementById("story_post_content").value === "" ||
            document.getElementById("story_post_subtitle_1").value === "" ||
            document.getElementById("story_post_description_1").value === "" ||
            document.getElementById("upfile").value === "" ||

            document.getElementById("story_post_title_check").innerHTML !== "" ||
            document.getElementById("story_post_content_check").innerHTML !== "" ||
            document.getElementById("story_post_subtitle_1_check").innerHTML !== "" ||
            document.getElementById("story_post_description_1_check").innerHTML !== "" ||
            document.getElementById("story_post_img_check").innerHTML !== "") {

            alert("입력되지 않은 항목이 있는지 확인해 주세요.");

        } else {

            document.story_post_form.submit();
        }

        // 주제가 두개일 때    
    } else if (classNum == 3) {

        if (document.getElementById("story_post_title").value === "" ||
            document.getElementById("story_post_content").value === "" ||
            document.getElementById("story_post_subtitle_1").value === "" ||
            document.getElementById("story_post_description_1").value === "" ||
            document.getElementById("upfile").value === "" ||
            document.getElementById("story_post_subtitle_2").value === "" ||
            document.getElementById("story_post_description_2").value === "" ||

            document.getElementById("story_post_title_check").innerHTML !== "" ||
            document.getElementById("story_post_content_check").innerHTML !== "" ||
            document.getElementById("story_post_subtitle_1_check").innerHTML !== "" ||
            document.getElementById("story_post_description_1_check").innerHTML !== "" ||
            document.getElementById("story_post_img_check").innerHTML !== "" ||
            document.getElementById("story_post_subtitle_2_check").innerHTML !== "" ||
            document.getElementById("story_post_description_2_check").innerHTML !== "") {

            alert("입력되지 않은 항목이 있는지 확인해 주세요.");

        } else {

            document.story_post_form.submit();
        }

    // 주제가 세개일 때
    } else if (classNum == 4) {

        if (document.getElementById("story_post_title").value === "" ||
            document.getElementById("story_post_content").value === "" ||
            document.getElementById("story_post_subtitle_1").value === "" ||
            document.getElementById("story_post_description_1").value === "" ||
            document.getElementById("upfile").value === "" ||
            document.getElementById("story_post_subtitle_2").value === "" ||
            document.getElementById("story_post_description_2").value === "" ||
            document.getElementById("story_post_subtitle_3").value === "" ||
            document.getElementById("story_post_description_3").value === "" ||

            document.getElementById("story_post_title_check").innerHTML !== "" ||
            document.getElementById("story_post_content_check").innerHTML !== "" ||
            document.getElementById("story_post_subtitle_1_check").innerHTML !== "" ||
            document.getElementById("story_post_description_1_check").innerHTML !== "" ||
            document.getElementById("story_post_img_check").innerHTML !== "" ||
            document.getElementById("story_post_subtitle_2_check").innerHTML !== "" ||
            document.getElementById("story_post_description_2_check").innerHTML !== "" ||
            document.getElementById("story_post_subtitle_3_check").innerHTML !== "" ||
            document.getElementById("story_post_description_3_check").innerHTML !== "") {

            alert("입력되지 않은 항목이 있는지 확인해 주세요.");

        } else {

            document.story_post_form.submit();
        }

    }

    // if (document.getElementById("story_post_title").value === "" ||
    //     document.getElementById("story_post_content").value === "" ||
    //     document.getElementById("story_post_subtitle_1").value === "" ||
    //     document.getElementById("story_post_description_1").value === "" ||
    //     document.getElementById("story_post_img").value === "" ||
    //     document.getElementById("story_post_subtitle_2").value === "" ||
    //     document.getElementById("story_post_description_2").value === "" ||
    //     document.getElementById("story_post_subtitle_3").value === "" ||
    //     document.getElementById("story_post_description_3").value === "" ||

    //     document.getElementById("story_post_title_check").innerHTML !== "" ||
    //     document.getElementById("story_post_content_check").innerHTML !== "" ||
    //     document.getElementById("story_post_subtitle_1_check").innerHTML !== "" ||
    //     document.getElementById("story_post_description_1_check").innerHTML !== "" ||
    //     document.getElementById("story_post_img_check").innerHTML !== "" ||
    //     document.getElementById("story_post_subtitle_2_check").innerHTML !== "" ||
    //     document.getElementById("story_post_description_2_check").innerHTML !== "" ||
    //     document.getElementById("story_post_subtitle_3_check").innerHTML !== "" ||
    //     document.getElementById("story_post_description_3_check").innerHTML !== "") {

    //     alert("입력되지 않은 항목이 있는지 확인해 주세요.");

    // } else {

    //     document.story_post_form.submit();
    // }
}

function checkInputTitle() {

    if (document.getElementById("story_post_title").value === "") {
        document.getElementById("story_post_title_check").innerHTML = "내용을 입력해 주세요.";
    } else {
        document.getElementById("story_post_title_check").innerHTML = "";
    }
}

function checkInputContent() {

    if (document.getElementById("story_post_content").value === "") {
        document.getElementById("story_post_content_check").innerHTML = "내용을 입력해 주세요.";
    } else {
        document.getElementById("story_post_content_check").innerHTML = "";
    }
}

function checkInputSubtitle1() {

    if (document.getElementById("story_post_subtitle_1").value === "") {
        document.getElementById("story_post_subtitle_1_check").innerHTML = "내용을 입력해 주세요.";
    } else {
        document.getElementById("story_post_subtitle_1_check").innerHTML = "";
    }
}

function checkInputDescription1() {

    if (document.getElementById("story_post_description_1").value === "") {
        document.getElementById("story_post_description_1_check").innerHTML = "내용을 입력해 주세요.";
    } else {
        document.getElementById("story_post_description_1_check").innerHTML = "";
    }
}

function checkInputSubtitle2() {

    if (document.getElementById("story_post_subtitle_2").value === "") {
        document.getElementById("story_post_subtitle_2_check").innerHTML = "내용을 입력해 주세요.";
    } else {
        document.getElementById("story_post_subtitle_2_check").innerHTML = "";
    }
}

function checkInputDescription2() {

    if (document.getElementById("story_post_description_2").value === "") {
        document.getElementById("story_post_description_2_check").innerHTML = "내용을 입력해 주세요.";
    } else {
        document.getElementById("story_post_description_2_check").innerHTML = "";
    }
}

function checkInputSubtitle3() {

    if (document.getElementById("story_post_subtitle_3").value === "") {
        document.getElementById("story_post_subtitle_3_check").innerHTML = "내용을 입력해 주세요.";
    } else {
        document.getElementById("story_post_subtitle_3_check").innerHTML = "";
    }
}

function checkInputDescription3() {

    if (document.getElementById("story_post_description_3").value === "") {
        document.getElementById("story_post_description_3_check").innerHTML = "내용을 입력해 주세요.";
    } else {
        document.getElementById("story_post_description_3_check").innerHTML = "";
    }
}

function checkInputImg() {

    if (document.getElementById("upfile").value === "") {
        document.getElementById("story_post_img_check").innerHTML = "사진을 첨부해 주세요.";
    } else {
        document.getElementById("story_post_img_check").innerHTML = "";
    }
}

function storyPostAddSubject() {

    // div를 만든 후 appendChild 로 부모에 추가
    // var div = document.getElementsByClassName("story_academy_html");
    // var subject = document.createElement("div");
    // subject.className = "story_post_wrap";
    // subject.innerHTML = "<h1>test</h1>";
    // div.appendChild(subject.lastChild);


    // 부모에 innerHTML 으로 div를 추가

    // 주제 개수 구하기
    var classNum = document.getElementsByClassName("story_post_wrap").length;

    // alert(classNum);

    if (classNum === 2) {
        var parent = document.getElementById("story_academy_html");
        var subject = document.createElement("div");
        subject.className = "story_post_wrap";
        subject.innerHTML = "<div class='story_post_wrap'><label for='story_post_subtitle_2'>주제</label><span id='story_post_subtitle_2_check' class='story_post_input_check'></span><input id='story_post_subtitle_2' name='story_post_subtitle_2' type='text' placeholder='ex ) 자기소개' onkeyup='checkInputSubtitle2();'><label for='story_post_description_2'>내용</label><span id='story_post_description_2_check' class='story_post_input_check'></span><textarea id='story_post_description_2' name='story_post_description_2' type='text' placeholder='내용을 입력해 주세요.' onkeyup='checkInputDescription2();'></textarea></div>";
        parent.appendChild(subject.lastChild);
        alert("추가가 완료되었습니다.");

    } else if (classNum === 3) {

        // 이 방법으로 하면 추가할때마다 모두 초기화됨
        // var subject = document.getElementById("story_academy_html");
        // subject.innerHTML += "<div class='story_post_wrap'><label for='story_post_subtitle_3'>주제</label><span id='story_post_subtitle_3_check' class='story_post_input_check'></span><input id='story_post_subtitle_3' name='story_post_subtitle_3' type='text' placeholder='ex ) 자기소개' onkeyup='checkInputSubtitle3();'><label for='story_post_description_3'>내용</label><span id='story_post_description_3_check' class='story_post_input_check'></span><textarea id='story_post_description_3' name='story_post_description_3' type='text' placeholder='내용을 입력해 주세요.' onkeyup='checkInputDescription3();'></textarea></div>";
        // alert("추가가 완료되었습니다.");

        var parent = document.getElementById("story_academy_html");
        var subject = document.createElement("div");
        subject.className = "story_post_wrap";
        subject.innerHTML = "<div class='story_post_wrap'><label for='story_post_subtitle_3'>주제</label><span id='story_post_subtitle_3_check' class='story_post_input_check'></span><input id='story_post_subtitle_3' name='story_post_subtitle_3' type='text' placeholder='ex ) 자기소개' onkeyup='checkInputSubtitle3();'><label for='story_post_description_3'>내용</label><span id='story_post_description_3_check' class='story_post_input_check'></span><textarea id='story_post_description_3' name='story_post_description_3' type='text' placeholder='내용을 입력해 주세요.' onkeyup='checkInputDescription3();'></textarea></div>";
        parent.appendChild(subject.lastChild);
        alert("추가가 완료되었습니다.");

    } else {
        alert("주제 추가는 3개까지 가능합니다.");
    }

}