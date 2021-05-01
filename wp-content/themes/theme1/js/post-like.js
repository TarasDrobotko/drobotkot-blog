jQuery(document).ready(function ($) {
  $(".noactive_svg").click(function (event) {
    heart = $(this);
    post_id = heart.data("post_id");
    $.ajax({
      type: "post",
      url: ajax_var.url,
      data:
        "action=post-like&nonce=" +
        ajax_var.nonce +
        "&post_like=&post_id=" +
        post_id,
      success: function (count) {
        if (count != "already") {
          heart.addClass("is-active");
          heart.parent().next(".likecount").text(count);
        }
      },
    });
    return false;
  });
});
