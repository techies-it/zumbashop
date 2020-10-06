/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
/*jshint browser:true jquery:true*/
define([
    'jquery',
], function ($) {
    'use strict';
	$(document).ready(function () {
		$('#back-top').click(function () {
			$('body,html').animate({
				scrollTop: 0
			}, 800);
			return false;
		});
	});
	var scrolled_sticky = false;
    var scrolled_back = false;
    $(window).scroll(function () {
		if ($(this).scrollTop() > 100 && !scrolled_back) {
			$('#back-top').fadeIn();
			scrolled_back = true;
		}
		if ($(this).scrollTop() <= 100 && scrolled_back) {
			$('#back-top').fadeOut();
			scrolled_back = false;
		}
		var start = $(".header-content").outerHeight();
		var width_window = $(window).width();
		if ($(this).scrollTop() > start && !scrolled_sticky && width_window >= 768 && $('.enabled-header-sticky').length){  
			$(".header-wrapper-sticky").addClass("enable-sticky");
			$(".mini-cart-wrapper").addClass("enable-sticky");
			$(".header-wrapper-sticky > .container-header-sticky").addClass("container");
			scrolled_sticky = true;
			var width_container = $(".container-header-sticky.container").outerWidth();
			var fixed_right = (width_window - width_container) / 2;
			fixed_right = fixed_right + 20;
			$(".mini-cart-wrapper.enable-sticky").css('right', fixed_right+'px');
		}
		if($(this).scrollTop() <= start && scrolled_sticky && width_window >= 768 && $('.enabled-header-sticky').length){
			scrolled_sticky = false;
			$(".header-wrapper-sticky").removeClass("enable-sticky");
			$(".mini-cart-wrapper").removeClass("enable-sticky");
			$(".header-wrapper-sticky > .container-header-sticky").removeClass("container");
			if($('.cart-left-fixed-position').length > 0){
				$(".mini-cart-wrapper").css('left', 'initial');
			}
			else{
				$(".mini-cart-wrapper").css('right', 'initial');
			}
		}
	});
});
