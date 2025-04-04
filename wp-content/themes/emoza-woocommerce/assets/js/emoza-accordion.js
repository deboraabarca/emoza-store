/**
 * Emoza Accordion
 * 
 * jQuery Dependant: true
 * 
 */
'use strict';

var emoza = emoza || {};
(function ($) {
  emoza.accordion = {
    /**
     * Init
     * 
     * @return {void}
     */
    init: function init() {
      var self = this;
      $('.emoza-accordion').each(function () {
        var toggle = $(this).find(' > .emoza-accordion-toggle');
        var content = $(this).find('> .emoza-accordion-body');
        toggle.on('click', function (e) {
          e.preventDefault();
          self.slideToggleEffect($(this), content);
        });
        toggle.on('keyup', function (e) {
          if (e.keyCode === 13) {
            self.slideToggleEffect($(this), content);
          }
        });
      });
    },
    /**
     * Slide Toggle Effect
     * 
     * @param {object} triggerEl
     * @param {object} content
     * 
     * @return {void}
     */
    slideToggleEffect: function slideToggleEffect(triggerEl, content) {
      content.slideToggle(300);
      triggerEl.toggleClass('active');
    }
  };
  $(document).ready(function () {
    emoza.accordion.init();
  });
})(jQuery);