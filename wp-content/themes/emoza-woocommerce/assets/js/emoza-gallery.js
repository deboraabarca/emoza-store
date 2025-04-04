"use strict";

/**
 * Emoza Gallery
 * 
 * jQuery Dependant: true
 * 
 */

(function ($) {
  'use strict';

  var emoza = emoza || {};
  emoza.gallery = {
    productGallerySelector: '.woocommerce-product-gallery',
    /**
     * Initialize.
     * 
     * @return {void}
     */
    init: function init() {
      $(document).on('wc-product-gallery-before-init', this.productGallerySelector, this.beforeProductGalleryInitHandler.bind(this));
      $(document).on('wc-product-gallery-after-init', this.productGallerySelector, this.afterProductGalleryInitHandler.bind(this));
    },
    /**
     * Before Product Gallery Init Handler.
     * 
     * @param {Event} e
     * @param {HTMLElement} galleryEl
     * @return {void}
     */
    beforeProductGalleryInitHandler: function beforeProductGalleryInitHandler(e, galleryEl) {
      var gallery = $(galleryEl);
      if (!gallery.parent().is('.gallery-quickview')) {
        return;
      }
      wc_single_product_params.flexslider.controlNav = 'thumbnails';
    },
    /**
     * After Product Gallery Init Handler.
     * 
     * @param {Event} e
     * @param {HTMLElement} galleryEl
     * @return {void}
     */
    afterProductGalleryInitHandler: function afterProductGalleryInitHandler(e, galleryEl) {
      var gallery = $(galleryEl);
      if (!gallery.parent().is('.gallery-default, .gallery-vertical, .gallery-quickview, .gallery-showcase, .gallery-full-width')) {
        return;
      }
      var flexdata = gallery.data('product_gallery');
      if (!flexdata || !flexdata.$images) {
        return;
      }
      var flexThumbs = gallery.find('.flex-control-thumbs');
      if (flexThumbs.find('li').length <= 5) {
        return;
      }
      if (gallery.parent().is('.gallery-vertical, .gallery-showcase')) {
        flexThumbs.addClass('swiper-wrapper emoza-slides');
        flexThumbs.find('li').addClass('swiper-slide');
        flexThumbs.wrapAll('<div class="swiper emoza-swiper"></div>');
        var swiper = gallery.find('.emoza-swiper');
        swiper.append('<div class="emoza-swiper-button emoza-swiper-button-next"></div>');
        swiper.append('<div class="emoza-swiper-button emoza-swiper-button-prev"></div>');
        var swiperInstance = new Swiper(swiper.get(0), {
          direction: 'vertical',
          slidesPerView: 6,
          spaceBetween: 20,
          navigation: {
            nextEl: '.emoza-swiper-button-next',
            prevEl: '.emoza-swiper-button-prev'
          }
        });
        $(window).on('resize emoza.resize', function () {
          var winWidth = window.innerWidth || document.documentElement.clientWidth;
          if (winWidth < 991 && swiperInstance.params.direction !== 'horizontal') {
            swiperInstance.changeDirection('horizontal');
            swiperInstance.params.slidesPerView = 5;
            swiperInstance.update();
          } else if (winWidth > 991 && swiperInstance.params.direction !== 'vertical') {
            swiperInstance.changeDirection('vertical');
            swiperInstance.params.slidesPerView = 6;
            swiperInstance.update();
          }
        }).trigger('emoza.resize');
      } else if (gallery.parent().is('.gallery-default, .gallery-quickview, .gallery-full-width')) {
        flexThumbs.addClass('emoza-slides');
        flexThumbs.wrapAll('<div class="emoza-flexslider"></div>');
        var slider = gallery.find('.emoza-flexslider');
        var itemWidth = gallery.parent().is('.gallery-quickview') ? 85 : 95;
        slider.flexslider({
          namespace: 'emoza-flex-',
          selector: '.emoza-slides > li',
          animation: 'slide',
          controlNav: false,
          animationLoop: false,
          slideshow: false,
          itemWidth: itemWidth,
          itemMargin: 20,
          keyboard: false,
          asNavFor: gallery.get(0)
        });
        var next_text = $('.emoza-flexslider .emoza-flex-next').text();
        $('.emoza-flexslider .emoza-flex-next').text('').append('<span>' + next_text + '</span>');
        var prev_text = $('.emoza-flexslider .emoza-flex-prev').text();
        $('.emoza-flexslider .emoza-flex-prev').text('').append('<span>' + prev_text + '</span>');
      }
    }
  };
  $(document).ready(function () {
    emoza.gallery.init();
  });
})(jQuery);