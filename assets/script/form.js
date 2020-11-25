const slidePage = document.querySelector(".slide-page");
const nextBtnFirst = document.querySelector(".firstNext");
const prevBtnSec = document.querySelector(".prev-1");
const nextBtnSec = document.querySelector(".next-1");
const prevBtnThird = document.querySelector(".prev-2");
const nextBtnThird = document.querySelector(".next-2");
const prevBtnFourth = document.querySelector(".prev-3");
const submitBtn = document.querySelector(".submit");
const progressText = document.querySelectorAll(".step p");
const progressCheck = document.querySelectorAll(".step .check");
const bullet = document.querySelectorAll(".step .bullet");
let current = 1;

var container = document.getElementById("container");
var semplice_btn = document.getElementById("semplice");
var semplice_sec = document.getElementById("page slde");
var scelta = document.getElementById("scelta");
var proc1 = document.getElementById("proc1");
var proc2 = document.getElementById("proc2");
var nxt_proc1 = document.getElementById("nxt_proc1");
var nxt_proc2 = document.getElementById("nxt_proc2");

semplice_btn.onclick = () => {
    container.classList.remove("hide");
    container.classList.add("show");
    semplice_sec.classList.remove("hide");
    semplice_sec.classList.add("show");
    scelta.classList.remove("show");
    scelta.classList.add("hide");
    proc2.classList.remove("hide");
    proc2.classList.add("show");
    nxt_proc2.classList.remove("hide");
    nxt_proc2.classList.add("show");
}

nextBtnFirst.addEventListener("click", function(event){
  event.preventDefault();
  slidePage.style.marginLeft = "-25%";
  bullet[current - 1].classList.add("active");
  progressCheck[current - 1].classList.add("active");
  progressText[current - 1].classList.add("active");
  current += 1;
});
nextBtnSec.addEventListener("click", function(event){
  event.preventDefault();
  slidePage.style.marginLeft = "-50%";
  bullet[current - 1].classList.add("active");
  progressCheck[current - 1].classList.add("active");
  progressText[current - 1].classList.add("active");
  current += 1;
});
nextBtnThird.addEventListener("click", function(event){
  event.preventDefault();
  slidePage.style.marginLeft = "-75%";
  bullet[current - 1].classList.add("active");
  progressCheck[current - 1].classList.add("active");
  progressText[current - 1].classList.add("active");
  current += 1;
});
//submitBtn.addEventListener("click", function(){
//  bullet[current - 1].classList.add("active");
//  progressCheck[current - 1].classList.add("active");
//  progressText[current - 1].classList.add("active");
//  current += 1;
//  setTimeout(function(){
//    alert("Your Form Successfully Signed up");
//    location.reload();
//  },800);
//});