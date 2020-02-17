function checkInput() {

    if (document.getElementById("story_post_title").value === "" ||
        document.getElementById("story_post_content").value === "" ||
        document.getElementById("story_post_subtitle_1").value === "" ||
        document.getElementById("story_post_description_1").value === "" ||
        document.getElementById("story_post_img").value === "" ||
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
    
    if (document.getElementById("story_post_img").value === "") {
        document.getElementById("story_post_img_check").innerHTML = "사진을 첨부해 주세요.";
    } else {
        document.getElementById("story_post_img_check").innerHTML = "";
    }
}
