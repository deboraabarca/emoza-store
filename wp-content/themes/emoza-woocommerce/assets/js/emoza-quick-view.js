/**
 * Emoza Quick View
 * 
 * jQuery Dependant: true
 * 
 */

'use strict';

var emoza = emoza || {};
emoza.quickView = {
  init: function init() {
    this.build();
    this.events();
  },
  build: function build() {
    var _this = this,
      button = document.querySelectorAll('.emoza-quick-view'),
      popup = document.querySelector('.emoza-quick-view-popup'),
      closeButton = document.querySelector('.emoza-quick-view-popup-close-button'),
      popupContent = document.querySelector('.emoza-quick-view-popup-content-ajax');
    if (null === popup) {
      return false;
    }
    closeButton.addEventListener('click', function (e) {
      e.preventDefault();
    });
    popup.addEventListener('click', function (e) {
      if (null === e.target.closest('.emoza-quick-view-popup-content-ajax')) {
        popup.classList.remove('opened');
      }
    });
    for (var i = 0; i < button.length; i++) {
      button[i].addEventListener('click', function (e) {
        e.preventDefault();
        var productId = e.target.getAttribute('data-product-id'),
          nonce = e.target.getAttribute('data-nonce');
        popup.classList.add('opened');
        popup.classList.add('loading');
        var ajax = new XMLHttpRequest();
        ajax.open('POST', emoza.ajaxurl, true);
        ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        ajax.onload = function () {
          if (this.status >= 200 && this.status < 400) {
            // If successful
            popupContent.innerHTML = this.response;
            var $wrapper = jQuery(popupContent);

            // Initialize gallery 
            var $gallery = $wrapper.find('.woocommerce-product-gallery');
            if ($gallery.length) {
              $gallery.trigger('wc-product-gallery-before-init', [$gallery.get(0), wc_single_product_params]);
              $gallery.wc_product_gallery(wc_single_product_params);
              $gallery.trigger('wc-product-gallery-after-init', [$gallery.get(0), wc_single_product_params]);
            }

            // Initialize variation gallery 
            if (emoza.variationGallery) {
              emoza.variationGallery.init($wrapper);
            }

            // Initialize size chart 
            if (emoza.sizeChart) {
              emoza.sizeChart.init($wrapper);
            }

            // Initialize product swatches mouseover 
            if (emoza.productSwatch && emoza.productSwatch.variationMouseOver) {
              emoza.productSwatch.variationMouseOver();
            }

            // Initialize product variable
            var variationsForm = document.querySelector('.emoza-quick-view-summary .variations_form');
            if (typeof wc_add_to_cart_variation_params !== 'undefined') {
              jQuery(variationsForm).wc_variation_form();
            }
            emoza.qtyButton.init('quick-view');
            if (typeof emoza.wishList !== 'undefined') {
              emoza.wishList.init();
            }
            $wrapper.find('.variations_form').each(function () {
              if (jQuery(this).data('misc-variations') === true) {
                return false;
              }

              // Move reset button
              emoza.misc.moveResetVariationButton(jQuery(this));

              // First load
              emoza.misc.checkIfHasVariationSelected(jQuery(this));

              // on change variation select
              jQuery(this).on('woocommerce_variation_select_change', function () {
                emoza.misc.checkIfHasVariationSelected(jQuery(this));
              });
              jQuery(this).data('misc-variations', true);
            });
            window.dispatchEvent(new Event('emoza.quickview.ajax.loaded'));
            popup.classList.remove('loading');
          }
        };
        ajax.send('action=emoza_quick_view_content&product_id=' + productId + '&nonce=' + nonce);
      });
    }
  },
  events: function events() {
    var _this = this;
    window.addEventListener('emoza.carousel.initialized', function () {
      _this.build();
    });
  }
};
jQuery(document).ready(function () {
  emoza.quickView.init();
});