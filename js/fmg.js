jQuery(document).ready(function( $ ) {

  $(document).ready(function(){
    if ($('.slide').length > 0) {
      $('.slide').slick({
        // dots: true,
        // arrows: false,
      });
    }
  });

  $(window).scroll(function() {
    var header = $(document).scrollTop();
    var headerHeight = $(".site-header").outerHeight();
    if (header > headerHeight) {
      $(".site-header").addClass("fixed");
    } else {
      $(".site-header").removeClass("fixed");
    }
  });

});
