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

document.addEventListener("DOMContentLoaded", function(){
if (window.innerWidth > 992) {

	document.querySelectorAll('.navbar .nav-item').forEach(function(everyitem){

		everyitem.addEventListener('mouseover', function(e){

			let el_link = this.querySelector('a[data-bs-toggle]');

			if(el_link != null){
				let nextEl = el_link.nextElementSibling;
				el_link.classList.add('show');
				nextEl.classList.add('show');
			}

		});
		everyitem.addEventListener('mouseleave', function(e){
			let el_link = this.querySelector('a[data-bs-toggle]');

			if(el_link != null){
				let nextEl = el_link.nextElementSibling;
				el_link.classList.remove('show');
				nextEl.classList.remove('show');
			}


		})
	});

}
});
