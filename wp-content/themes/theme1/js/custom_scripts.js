//main menu toggle
$(".nav-toggle").on("click", function (e) {
  e.preventDefault;
  $("div.menu-main ul.menu").toggleClass("active");
  $(this).toggleClass("nav-toggle-active");
});

// add title to scroll button up
$("#wpfront-scroll-top-container img").prop("title", langvars.title_arrow_up);

// add translated strings
// add placeholder to subscriber input
$('.tnp-field.tnp-field-email input[type="email"] ').attr({
  placeholder: langvars.placeholder,
  title: langvars.title,
});
$(".subscribe-heading").html(langvars.subscribe_heading);
$("#yasr-custom-text-before-visitor-rating").text(
  langvars.text_before_visitor_rating
);
$(".user_has_already_rated").text(langvars.text_before_visitor_rating);
$(".yasr-total-average-container span:first-child").before(
  langvars.text_after_visitor_rating_1
);

$(".yasr-total-average-container span:last-child").before(
  langvars.text_after_visitor_rating_2
);

// $(".yasr-total-average-container").html(
//   $(".yasr-total-average-container")
//     .html()
//     .replace("Всього голосів:", langvars.text_after_visitor_rating_1)
// );

// $(".yasr-total-average-container").html(
//   $(".yasr-total-average-container")
//     .html()
//     .replace("Середня оцінка:", langvars.text_after_visitor_rating_2)
// );

$(document).ready(function () {
  $(".social-block-arrow i").prop("title", langvars.hide_social_icons);

  $(".social-block-arrow").on("click", function (e) {
    e.preventDefault;
    $("ul.social").toggle();
    if ($(".social-block-arrow i").hasClass("fa-arrow-left")) {
      $(".social-block-arrow i").removeClass("fa-arrow-left");
      $(".social-block-arrow i").addClass("fa-arrow-right");
      $(".social-block-arrow i").prop("title", langvars.show_social_icons);
    } else {
      $(".social-block-arrow i").removeClass("fa-arrow-right");
      $(".social-block-arrow i").addClass("fa-arrow-left");
      $(".social-block-arrow i").prop("title", langvars.hide_social_icons);
    }
  });
});
