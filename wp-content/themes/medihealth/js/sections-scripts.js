
/**
 * All Section Scripts
 *
 * @package MediHealth WordPress theme
 */
	jQuery(document).ready(function(){
	/** 
	 * Slider 
	**/
	var swiper = new Swiper('.swiper-container.main_slider', {
		//loop: true,
		resistance: true,
		followFinger: true,
		autoplay: false,
		slidesPerGroup: 1,
		pagination: {
			el: '.swiper-pagination.main_nav',
			clickable: true,
		},
	});
	
	if(jQuery(".swiper-container .swiper-slide").length == 1) {
		jQuery('.swiper-wrapper').addClass( "disabled" );
		jQuery('.swiper-pagination').addClass( "disabled" );
	}

	/** 
	 * Testimonial 
	**/
	var swiper = new Swiper('.swiper-container.patient_slider_inner', {
		loop: true,
		autoplay: true,
		navigation: {
			nextEl: '.swiper-button-next.patient_nav',
			prevEl: '.swiper-button-prev.patient_nav',
		},
	});
	
	/** 
	 * Portfolio
	**/

		var jQuerycontainer = jQuery('.portfolioContainer');
		jQuerycontainer.isotope({
			filter: '*',
			layoutMode: 'fitRows',
			animationOptions: {
				duration: 750,
				easing: 'linear',
				queue: false
			}
		});
		jQuery('.portfolioFilter a').click(function(){
			jQuery('.portfolioFilter .current').removeClass('current');
			jQuery(this).addClass('current');
	 
			var selector = jQuery(this).attr('data-filter');
			jQuerycontainer.isotope({
				filter: selector,
				animationOptions: {
					duration: 750,
					easing: 'linear',
					queue: false
				}
			});
			return false;
		}); 

	/** 
	 * Header
	**/
	jQuery('ul.nav li.dropdown').hover(function() {
	  jQuery(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
	}, function() {
	  jQuery(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
	});

});