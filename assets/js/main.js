window.onscroll = function(){scrollFunction()};
function scrollFunction(){
  if (document.body.scrollTop > 1 || document.documentElement.scrollTop > 1) {
    document.getElementById("site-header").style.height = "70px";
    document.getElementById("site-header").style.borderBottom = "1px solid #dadada";
    document.querySelector("img.navig-img").style.height = "50px";

  }
  else{
      if ($('section.main-page').is(':visible') === true){
          document.getElementById("site-header").style.height = "160px";
          document.getElementById("site-header").style.borderBottom = "transparent";
          document.querySelector("img.navig-img").style.height = "70px";
      }
  }
}
function displaySection(e) {
    document.getElementById("site-header").style.height = "70px";
    document.getElementById("site-header").style.borderBottom = "1px solid #dadada";
    document.querySelector("img.navig-img").style.height = "50px";
    var current = document.querySelector(".question-sect.active");
    current.classList.remove("active");
    current.nextElementSibling.classList.add("active");
    $('.question-sect').hide();
    $('.question-sect.active').fadeIn("normal");
}
function backFunction() {
    var current = document.querySelector(".question-sect.active");
    current.classList.remove("active");
    current.previousElementSibling.classList.add("active");
    $('.question-sect').hide();
    $('.question-sect.active').fadeIn("normal");

}