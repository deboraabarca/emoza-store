"use strict";

/**
 * Header/Footer Update.
 */
(function ($) {
  'use strict';

  $(document).on('click', '.emoza-update-hf', function (e) {
    e.preventDefault();
    if (confirm(emozaadm.hfUpdate.confirmMessage)) {
      $.ajax({
        type: 'post',
        url: ajaxurl,
        data: {
          action: 'emoza_hf_update_notice_1_1_9_callback',
          nonce: $(this).data('nonce')
        },
        success: function success(response) {
          if (response.success) {
            window.location.reload();
          } else {
            alert(emozaadm.hfUpdate.errorMessage);
          }
        }
      });
    }
  });
})(jQuery);

/**
 * Header/Footer Update Dismiss.
 */
(function ($) {
  'use strict';

  $(document).on('click', '.emoza-update-hf-dismiss', function (e) {
    e.preventDefault();
    if (confirm(emozaadm.hfUpdateDimiss.confirmMessage)) {
      $.ajax({
        type: 'post',
        url: ajaxurl,
        data: {
          action: 'emoza_hf_update_dismiss_notice_1_1_9_callback',
          nonce: $(this).data('nonce')
        },
        success: function success(response) {
          if (response.success) {
            window.location.reload();
          } else {
            alert(emozaadm.hfUpdateDimiss.errorMessage);
          }
        }
      });
    }
  });
})(jQuery);