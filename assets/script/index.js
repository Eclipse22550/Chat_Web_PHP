const showMenu = (toggleId, navbarId, bodyId) => {
    const toggle = document.getElementById(toggleId),
        navbar = document.getElementById(navbarId),
        bodypadding = document.getElementById(bodyId)

    if (toggle && navbar) {
        toggle.addEventListener('click', () => {
            navbar.classList.toggle('show')
            toggle.classList.toggle('rotate')
            bodypadding.classList.toggle('expander')
        })
    }
}
showMenu('nav-toggle', 'navbar', 'body')

const linkColor = document.querySelectorAll('.nav__link');

function colorLink() {
    linkColor.forEach(l => l.classList.remove('active'));
    this.classList.add('active');
}

linkColor.forEach(l => l.addEventListener('click', colorLink));

var dates_btn = document.getElementById("dates");
var dates_section = document.getElementById("dates_sc");

dates_btn.onclick = () => {
    dates_section.classList.remove("hide");
    dates_section.classList.add("show");
    dates_btn.onclick = () => {
        dates_section.classList.remove("show");
        dates_section.classList.add("hide");
        return true;
    }
    return false;
}

var results = document.getElementById("results");
var search = document.getElementById("search");

function ShoWResult() {
    results.classList.remove("hide");
    results.classList.add("show");
}

var new_chat = document.getElementById("new-chat");
var nw_chat = document.getElementById("nw_chat");

function showNW() {
    nw_chat.classList.remove("hide");
    nw_chat.classList.add("show");
}