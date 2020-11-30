var semplice_btn = document.getElementById("semplice");
var card2_sec = document.getElementById("card2");
var btn_card2_submit = document.getElementById("btn_semplice");
var card3_sec = document.getElementById("card3");
var card2_proc = document.ge("card2-proc");
var completo_btn = document.getElementById("completo");

semplice_btn.onclick = () => {
    card2_sec.classList.remove("hide");
    card2_sec.classList.add("show");
    btn_card2_submit.classList.remove("hide");
    btn_card2_submit.classList.add("show");
    semplice_btn.onclick = () => {
        card2_sec.classList.add("hide");
        card2_sec.classList.remove("show");
        btn_card2_submit.classList.add("hide");
        btn_card2_submit.classList.remove("show");
        return true;
    }
    return false;
}

completo_btn.onclick = () => {
    card2_sec.classList.remove("hide");
    card2_sec.classList.add("show");
    card3_sec.classList.remove("hide");
    card3_sec.classList.add("show");
    return false;
}

function onSignIn(googleUser) {
    var profile = googleUser.getBasicProfile();
    console.log('ID: ' + profile.getId());
    console.log('Name: ' + profile.getName());
    console.log('Image URL: ' + profile.getImageUrl());
    console.log('Email: ' + profile.getEmail());
}