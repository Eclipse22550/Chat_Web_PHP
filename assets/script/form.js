var semplice_btn = document.getElementById("semplice");
var card2_sec = document.getElementById("card2");
var btn_card2_submit = document.getElementById("btn_semplice");
var card3_sec = document.getElementById("card3");
var card2_proc = document.getElementById("card2-proc");
var completo_btn = document.getElementById("completo");
var card4 = document.getElementById("card4");
var btn_proc_s1 = document.getElementById("btn_proc_s1");
var reg_sem = document.getElementById("reg_sem");

semplice_btn.onclick = () => {
    card2_sec.classList.remove("hide");
    card2_sec.classList.add("show");
    card4.classList.remove("hide");
    card4.classList.add("show");
    reg_sem.classList.remove("hide");
    reg_sem.classList.add("show");
    semplice_btn.onclick = () => {
        card2_sec.classList.add("hide");
        card2_sec.classList.remove("show");
        card4.classList.add("hide");
        card4.classList.remove("show");
        reg_sem.classList.add("hide");
        reg_sem.classList.remove("show");
        return true;
    }
    return false;
}

completo_btn.onclick = () => {
    card2_sec.classList.remove("hide");
    card2_sec.classList.add("show");
    card2_proc.classList.remove("hide");
    card2_proc.classList.add("show");
    card3_sec.classList.remove("hide");
    card3_sec.classList.add("show");
    card4.classList.remove("hide");
    card4.classList.add("show");
    completo_btn.onclick = () => {
        card2_sec.classList.add("hide");
        card2_sec.classList.remove("show");
        card2_proc.classList.add("hide");
        card2_proc.classList.remove("show");
        card3_sec.classList.add("hide");
        card3_sec.classList.remove("show");
        card4.classList.add("hide");
        card4.classList.remove("show");
        return true;
    }
    return false;
}

/*function onSignIn(googleUser) {
    var profile = googleUser.getBasicProfile();
    console.log('ID: ' + profile.getId());
    console.log('Name: ' + profile.getName());
    console.log('Image URL: ' + profile.getImageUrl());
    console.log('Email: ' + profile.getEmail());
}*/