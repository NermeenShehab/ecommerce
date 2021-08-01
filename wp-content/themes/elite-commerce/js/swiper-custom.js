var eliteCommerceSliderAutoplay = false;

if ( '1' == eliteCommerceSliderOptions.slider.autoplay ) {
	eliteCommerceSliderAutoplay = {
	    delay: eliteCommerceSliderOptions.slider.autoplayDelay,
	};
}

var mainSlider = new Swiper ( '#slider-section .slider', {
	autoHeight: true, //enable auto height
	loop: ( '1' == eliteCommerceSliderOptions.slider.loop ),
	effect: eliteCommerceSliderOptions.slider.effect,
	speed: parseInt( eliteCommerceSliderOptions.slider.speed ),
	// If we need pagination
	pagination: {
		el: '#slider-section .swiper-pagination',
		type: 'bullets',
		clickable: 'true',
	},

	autoplay: eliteCommerceSliderAutoplay,
	// Navigation arrows
	navigation: {
		nextEl: '#slider-section .swiper-button-next',
		prevEl: '#slider-section .swiper-button-prev',
	},

	// And if we need scrollbar
	scrollbar: {
		el: '#slider-section .swiper-scrollbar',
	},
});

if ( 'undefined' != typeof mainSlider.el && '1' == eliteCommerceSliderOptions.slider.autoplay && '1' == eliteCommerceSliderOptions.slider.pauseOnHover ) {
	mainSlider.el.addEventListener( 'mouseenter', function( event ) {
		eliteCommerceSlider.autoplay.stop();
	}, false);

	mainSlider.el.addEventListener( 'mouseleave', function( event ) {
		eliteCommerceSlider.autoplay.start();
	}, false);
}
