//main menu toggle
$(".nav-toggle").on("click", function (e) {
  e.preventDefault;
  $("div.menu-main ul.menu").toggleClass("active");
  $(this).toggleClass("nav-toggle-active");
});

// add title to scroll button up
$("#wpfront-scroll-top-container img").prop("title", "Наверх");

// add placeholder to subscriber input
$('.tnp-field.tnp-field-email input[type="email"] ').attr({
  placeholder: "Ваш e-mail",
  title: "Заповніть це поле, будь ласка",
});

$(document).ready(function () {
  $(".social-block-arrow").on("click", function (e) {
    e.preventDefault;
    $("ul.social").toggle();
    if ($(".social-block-arrow i").hasClass("fa-arrow-left")) {
      $(".social-block-arrow i").removeClass("fa-arrow-left");
      $(".social-block-arrow i").addClass("fa-arrow-right");
      $(".social-block-arrow i").prop("title", "Показати соціальні іконки");
    } else {
      $(".social-block-arrow i").removeClass("fa-arrow-right");
      $(".social-block-arrow i").addClass("fa-arrow-left");
      $(".social-block-arrow i").prop("title", "Сховати соціальні іконки");
    }
  });
});

// jivo
// function jivo_onOpen() {
//   var jivoSubtitle = document.getElementsByClassName("title_4bd")[0];
//   document.getElementsByClassName("title_4bd")[0].style.display = "none";
//   jivoSubtitle.insertAdjacentHTML("afterend", "<span>Я онлайн! </span>");
//   jivoSubtitle.nextSibling.style.opacity = "0.5";
// }

// function jivo_onClose() {
//   var jivoSubtitle = document.getElementsByClassName("title_4bd")[0];
//   jivoSubtitle.nextSibling.remove();
// }
