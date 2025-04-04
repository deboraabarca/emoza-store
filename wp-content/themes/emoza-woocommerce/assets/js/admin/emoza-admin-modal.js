"use strict";

/**
 * Emoza Admin Modal
 * 
 */
(function ($) {
  'use strict';

  var adminEmoza = adminEmoza || {};
  window.adminEmoza = adminEmoza;
  adminEmoza.modal = {
    triggerSelector: '.emoza-admin-modal-trigger',
    init: function init() {
      var self = this;
      this.$modalPopup = $('.emoza-admin-modal');
      this.$modalTrigger = $(this.triggerSelector);
      this.$modalCloseButton = $('.emoza-admin-close-modal');
      this.$modalTrigger.on('click', this.openModal.bind(this));
      this.$modalCloseButton.on('click', this.closeModal.bind(this));
      this.$modalPopup.on('click', function (e) {
        if (!$(e.target).closest('.emoza-admin-modal-content').length) {
          self.closeModal();
        }
      });
      $(window).trigger('emoza-admin-modal-after-init');
    },
    /**
     * Open Modal.
     * 
     * @return {void}
     */
    openModal: function openModal() {
      var e = event;
      e.preventDefault();
      var self = this;
      this.$modalPopup.addClass('active');
      setTimeout(function () {
        self.$modalPopup.trigger('emoza-admin-modal-opened', [self.$modalPopup, $(e.target).parent().find(self.triggerSelector)]);
      }, 200);
    },
    /**
     * Close Modal.
     * 
     * @return {void}
     */
    closeModal: function closeModal() {
      event.preventDefault();
      var self = this;
      this.$modalPopup.removeClass('active');
      setTimeout(function () {
        self.$modalPopup.trigger('emoza-admin-modal-closed');
      }, 200);
    }
  };
  $(document).ready(function () {
    adminEmoza.modal.init();
  });
})(jQuery);