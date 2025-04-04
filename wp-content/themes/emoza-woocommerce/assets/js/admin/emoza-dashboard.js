"use strict";

/**
 * Sticky-kit v1.1.3 | MIT | Leaf Corcoran 2015 | http://leafo.net
 * 
 * @cc_on 
 * 
 */
(function () {
  var c, f;
  c = window.jQuery;
  f = c(window);
  c.fn.stick_in_parent = function (b) {
    var A, w, J, n, B, K, p, q, L, k, E, t;
    null == b && (b = {});
    t = b.sticky_class;
    B = b.inner_scrolling;
    E = b.recalc_every;
    k = b.parent;
    q = b.offset_top;
    p = b.spacer;
    w = b.bottoming;
    null == q && (q = 0);
    null == k && (k = void 0);
    null == B && (B = !0);
    null == t && (t = "is_stuck");
    A = c(document);
    null == w && (w = !0);
    L = function L(a) {
      var b;
      return window.getComputedStyle ? (a = window.getComputedStyle(a[0]), b = parseFloat(a.getPropertyValue("width")) + parseFloat(a.getPropertyValue("margin-left")) + parseFloat(a.getPropertyValue("margin-right")), "border-box" !== a.getPropertyValue("box-sizing") && (b += parseFloat(a.getPropertyValue("border-left-width")) + parseFloat(a.getPropertyValue("border-right-width")) + parseFloat(a.getPropertyValue("padding-left")) + parseFloat(a.getPropertyValue("padding-right"))), b) : a.outerWidth(!0);
    };
    J = function J(a, b, n, C, F, u, r, G) {
      var v, _H, m, D, I, d, g, x, y, z, h, l;
      if (!a.data("sticky_kit")) {
        a.data("sticky_kit", !0);
        I = A.height();
        g = a.parent();
        null != k && (g = g.closest(k));
        if (!g.length) throw "failed to find stick parent";
        v = m = !1;
        (h = null != p ? p && a.closest(p) : c("<div />")) && h.css("position", a.css("position"));
        x = function x() {
          var d, f, e;
          if (!G && (I = A.height(), d = parseInt(g.css("border-top-width"), 10), f = parseInt(g.css("padding-top"), 10), b = parseInt(g.css("padding-bottom"), 10), n = g.offset().top + d + f, C = g.height(), m && (v = m = !1, null == p && (a.insertAfter(h), h.detach()), a.css({
            position: "",
            top: "",
            width: "",
            bottom: ""
          }).removeClass(t), e = !0), F = a.offset().top - (parseInt(a.css("margin-top"), 10) || 0) - q, u = a.outerHeight(!0), r = a.css("float"), h && h.css({
            width: L(a),
            height: u,
            display: a.css("display"),
            "vertical-align": a.css("vertical-align"),
            "float": r
          }), e)) return l();
        };
        x();
        if (u !== C) return D = void 0, d = q, z = E, l = function l() {
          var c, l, e, k;
          if (!G && (e = !1, null != z && (--z, 0 >= z && (z = E, x(), e = !0)), e || A.height() === I || x(), e = f.scrollTop(), null != D && (l = e - D), D = e, m ? (w && (k = e + u + d > C + n, v && !k && (v = !1, a.css({
            position: "fixed",
            bottom: "",
            top: d
          }).trigger("sticky_kit:unbottom"))), e < F && (m = !1, d = q, null == p && ("left" !== r && "right" !== r || a.insertAfter(h), h.detach()), c = {
            position: "",
            width: "",
            top: ""
          }, a.css(c).removeClass(t).trigger("sticky_kit:unstick")), B && (c = f.height(), u + q > c && !v && (d -= l, d = Math.max(c - u, d), d = Math.min(q, d), m && a.css({
            top: d + "px"
          })))) : e > F && (m = !0, c = {
            position: "fixed",
            top: d
          }, c.width = "border-box" === a.css("box-sizing") ? a.outerWidth() + "px" : a.width() + "px", a.css(c).addClass(t), null == p && (a.after(h), "left" !== r && "right" !== r || h.append(a)), a.trigger("sticky_kit:stick")), m && w && (null == k && (k = e + u + d > C + n), !v && k))) return v = !0, "static" === g.css("position") && g.css({
            position: "relative"
          }), a.css({
            position: "absolute",
            bottom: b,
            top: "auto"
          }).trigger("sticky_kit:bottom");
        }, y = function y() {
          x();
          return l();
        }, _H = function H() {
          G = !0;
          f.off("touchmove", l);
          f.off("scroll", l);
          f.off("resize", y);
          c(document.body).off("sticky_kit:recalc", y);
          a.off("sticky_kit:detach", _H);
          a.removeData("sticky_kit");
          a.css({
            position: "",
            bottom: "",
            top: "",
            width: ""
          });
          g.position("position", "");
          if (m) return null == p && ("left" !== r && "right" !== r || a.insertAfter(h), h.remove()), a.removeClass(t);
        }, f.on("touchmove", l), f.on("scroll", l), f.on("resize", y), c(document.body).on("sticky_kit:recalc", y), a.on("sticky_kit:detach", _H), setTimeout(l, 0);
      }
    };
    n = 0;
    for (K = this.length; n < K; n++) {
      b = this[n], J(c(b));
    }
    return this;
  };
}).call(void 0);
(function ($) {
  'use strict';

  $(document).ready(function () {
    // Globals
    var $body = $('body');

    // Dashboard hero re-position
    var $header = $('.wp-header-end');
    var $notice = $('.emoza-dashboard-notice');
    if ($header.length && $notice.length) {
      $header.after($notice);
      $notice.addClass('show');
    }

    // Dashboard hero dismissable
    var $dismissable = $('.emoza-dashboard-dismissable');
    if ($dismissable.length) {
      $dismissable.on('click', function () {
        $dismissable.parent().hide();
        $.post(window.emoza_dashboard.ajax_url, {
          action: 'emoza_dismissed_handler',
          nonce: window.emoza_dashboard.nonce,
          notice: $dismissable.data('notice')
        });
      });
    }

    // Tabs Navigation
    var tabs = $('.emoza-dashboard-tabs-nav');
    if (tabs.length) {
      tabs.each(function () {
        var tabWrapperId = $(this).data('tab-wrapper-id');
        $(this).find('.emoza-dashboard-tabs-nav-link:not(.no-tabs-link)').on('click', function (e) {
          e.preventDefault();
          var tabsNavLink = $(this).closest('.emoza-dashboard-tabs-nav').find('.emoza-dashboard-tabs-nav-link'),
            to = $(this).data('tab-to');

          // Tab Nav Item
          tabsNavLink.each(function () {
            $(this).closest('.emoza-dashboard-tabs-nav-item').removeClass('active');
          });
          $(this).closest('.emoza-dashboard-tabs-nav-item').addClass('active');

          // Tab Content
          var tabContentWrapper = $('.emoza-dashboard-tab-content-wrapper[data-tab-wrapper-id="' + tabWrapperId + '"]');
          tabContentWrapper.find('> .emoza-dashboard-tab-content').removeClass('active');
          tabContentWrapper.find('> .emoza-dashboard-tab-content[data-tab-content-id="' + to + '"]').addClass('active');

          // Recalculate sticky
          if (to === 'home') {
            $(document.body).trigger('sticky_kit:recalc');
          }
        });
      });
    }

    // License button
    var $license = $('.emoza-license-button');
    if ($license.length) {
      $license.on('click', function (e) {
        var $button = $(this);
        if ($button.data('type') === 'activate') {
          $button.html('<i class="dashicons dashicons-update-alt"></i>' + window.emoza_dashboard.i18n.activating);
        } else {
          $button.html('<i class="dashicons dashicons-update-alt"></i>' + window.emoza_dashboard.i18n.deactivating);
        }
      });
    }

    // Install plugin
    var $plugin = $('.emoza-dashboard-plugin-ajax-button');
    if ($plugin.length) {
      $plugin.on('click', function (e) {
        e.preventDefault();
        var $button = $(this);
        var href = $button.attr('href');
        var slug = $button.data('slug');
        var type = $button.data('type');
        var path = $button.data('path');
        var caption = $button.html();
        $button.addClass('emoza-ajax-progress');
        $button.parent().siblings('.emoza-dashboard-hero-warning').remove();
        if (type === 'install') {
          $button.html('<i class="dashicons dashicons-update-alt"></i>' + window.emoza_dashboard.i18n.installing);
        } else if (type === 'activate') {
          $button.html('<i class="dashicons dashicons-update-alt"></i>' + window.emoza_dashboard.i18n.activating);
        } else if (type === 'deactivate') {
          $button.html('<i class="dashicons dashicons-update-alt"></i>' + window.emoza_dashboard.i18n.deactivating);
        }
        $.post(window.emoza_dashboard.ajax_url, {
          action: 'emoza_plugin',
          nonce: window.emoza_dashboard.nonce,
          slug: slug,
          type: type,
          path: path
        }, function (response) {
          if (response.success) {
            if ($button.hasClass('emoza-ajax-success-redirect')) {
              setTimeout(function () {
                $button.html(window.emoza_dashboard.i18n.redirecting);
                setTimeout(function () {
                  window.location = href;
                }, 1000);
              }, 500);
              return false;
            }
            if (type === 'install') {
              $button.html(window.emoza_dashboard.i18n.deactivate).removeClass('emoza-dashboard-link-info').addClass('emoza-dashboard-link-danger').removeClass('loading').data('type', 'deactivate');
            } else if (type === 'deactivate') {
              $button.html(window.emoza_dashboard.i18n.activate).removeClass('emoza-dashboard-link-danger').addClass('emoza-dashboard-link-success').removeClass('loading').data('type', 'activate');
            } else {
              $button.html(window.emoza_dashboard.i18n.deactivate).removeClass('emoza-dashboard-link-success').addClass('emoza-dashboard-link-danger').removeClass('loading').data('type', 'deactivate');
            }
            $button.removeClass('emoza-ajax-progress');
          } else if (response.data) {
            $button.html(caption);
            $button.parent().after('<div class="emoza-dashboard-hero-warning">' + response.data + '</div>');
          } else {
            $button.html(caption);
            $button.parent().after('<div class="emoza-dashboard-hero-warning">' + window.emoza_dashboard.i18n.failed_message + '</div>');
          }
        }).fail(function (xhr, textStatus, e) {
          $button.html(caption);
          $button.parent().after('<div class="emoza-dashboard-hero-warning">' + window.emoza_dashboard.i18n.failed_message + '</div>');
        });
      });
    }

    // Option Switcher
    var $optionSwitcher = $('.emoza-dashboard-option-switcher');
    if ($optionSwitcher.length) {
      $optionSwitcher.on('click', function (e) {
        e.preventDefault();
        var $this = $(this),
          optionId = $this.data('option-id'),
          activate = $this.data('option-activate') ? true : false,
          loadingMessage = activate ? window.emoza_dashboard.i18n.activating : window.emoza_dashboard.i18n.deactivating,
          hasRedirect = $this.data('module-after-activation-redirect') ? true : false,
          redirectUrl = hasRedirect ? $this.data('module-after-activation-redirect') : '';
        $this.html('<i class="dashicons dashicons-update-alt"></i>' + loadingMessage).removeClass('emoza-dashboard-link-success').addClass('loading');
        $.post(window.emoza_dashboard.ajax_url, {
          action: 'emoza_option_switcher_handler',
          nonce: window.emoza_dashboard.nonce,
          optionId: optionId,
          activate: activate
        }, function (response) {
          if (response.success) {
            if (activate) {
              $this.html(window.emoza_dashboard.i18n.deactivate).removeClass('emoza-dashboard-link-success').addClass('emoza-dashboard-link-danger').removeClass('loading').data('option-activate', false);
              $this.parent().find('.emoza-dashboard-customize-link').removeClass('em-d-none');
              if (hasRedirect) {
                window.location = redirectUrl;
              }
            } else {
              $this.html(window.emoza_dashboard.i18n.activate).removeClass('emoza-dashboard-link-danger').addClass('emoza-dashboard-link-success').removeClass('loading').data('option-activate', true);
              $this.parent().find('.emoza-dashboard-customize-link').addClass('em-d-none');
            }
          }
        });
      });
    }

    // Activate Module
    var $activationModuleButton = $('.emoza-dashboard-module-activation');
    if ($activationModuleButton.length) {
      $activationModuleButton.on('click', function (e) {
        e.preventDefault();
        var $this = $(this),
          moduleId = $this.data('module-id'),
          activate = $this.data('module-activate') ? true : false,
          loadingMessage = activate ? window.emoza_dashboard.i18n.activating : window.emoza_dashboard.i18n.deactivating,
          hasRedirect = $this.data('module-after-activation-redirect') ? true : false,
          redirectUrl = hasRedirect ? $this.data('module-after-activation-redirect') : '';
        $this.html('<i class="dashicons dashicons-update-alt"></i>' + loadingMessage).removeClass('emoza-dashboard-link-success').addClass('loading');
        $.post(window.emoza_dashboard.ajax_url, {
          action: 'emoza_module_activation_handler',
          nonce: window.emoza_dashboard.nonce,
          module: moduleId,
          activate: activate
        }, function (response) {
          if (response.success) {
            if (activate) {
              $this.html(window.emoza_dashboard.i18n.deactivate).removeClass('emoza-dashboard-link-success').addClass('emoza-dashboard-link-danger').removeClass('loading').data('module-activate', false);
              $this.parent().find('.emoza-dashboard-customize-link').removeClass('em-d-none');
              if (hasRedirect) {
                window.location = redirectUrl;
              }
            } else {
              $this.html(window.emoza_dashboard.i18n.activate).removeClass('emoza-dashboard-link-danger').addClass('emoza-dashboard-link-success').removeClass('loading').data('module-activate', true);
              $this.parent().find('.emoza-dashboard-customize-link').addClass('em-d-none');
            }
          }
        });
      });
    }

    // Activate All Modules
    var $activationAllModulesButton = $('.emoza-dashboard-module-activation-all');
    if ($activationAllModulesButton.length) {
      $activationAllModulesButton.on('click', function (e) {
        e.preventDefault();
        var $this = $(this),
          activate = $this.data('module-activate') ? true : false,
          loadingMessage = activate ? window.emoza_dashboard.i18n.activating : window.emoza_dashboard.i18n.deactivating;
        $this.html(loadingMessage).addClass('loading');
        $.post(window.emoza_dashboard.ajax_url, {
          action: 'emoza_module_activation_all_handler',
          nonce: window.emoza_dashboard.nonce,
          activate: activate
        }, function (response) {
          if (response.success) {
            window.location.reload();
          }
        });
      });
    }

    // Toggle Expand
    var toggleExpand = $('[data-em-toggle-expand]');
    if (toggleExpand.length) {
      toggleExpand.on('click', function (e) {
        var $this = $(this),
          $content = $this.find('.em-toggle-expand-content');

        // Do not toggle if click on content.
        if (e.target.closest('.emoza-dashboard-content-expand-content') !== null) {
          return;
        }
        if ($this.hasClass('em-collapsed')) {
          $content.slideDown('fast');
          $this.removeClass('em-collapsed');
        } else {
          $content.slideUp('fast');
          $this.addClass('em-collapsed');
        }
      });

      // Prevent default behavior from the toggle link.
      toggleExpand.find('.emoza-dashboard-content-expand-link').on('click', function (e) {
        e.preventDefault();
      });
    }

    // Sticky Sidebar
    $('.emoza-dashboard-sticky-wrapper').stick_in_parent({
      offset_top: 54
    });

    // Notifications Sidebar
    var $notificationsSidebar = $('.emoza-dashboard-notifications-sidebar');
    if ($notificationsSidebar.length) {
      // Open/Toggle Sidebar
      $('.emoza-dashboard-theme-notifications').on('click', function (e) {
        e.preventDefault();
        var latestNotificationDate = $notificationsSidebar.find('.emoza-dashboard-notification:first-child .emoza-dashboard-notification-date').data('raw-date');
        $notificationsSidebar.toggleClass('opened');
        if (!$(this).hasClass('read')) {
          $.post(window.emoza_dashboard.ajax_url, {
            action: 'emoza_notifications_read',
            latest_notification_date: latestNotificationDate,
            nonce: window.emoza_dashboard.nonce
          }, function (response) {
            if (response.success) {
              setTimeout(function () {
                $('.emoza-dashboard-theme-notifications').addClass('read');
              }, 2000);
            }
          });
        }
      });
      $(window).on('scroll', function () {
        if (window.pageYOffset > 60) {
          $notificationsSidebar.addClass('closing');
          setTimeout(function () {
            $notificationsSidebar.removeClass('opened');
            $notificationsSidebar.removeClass('closing');
          }, 300);
        }
      });

      // Close Sidebar
      $('.emoza-dashboard-notifications-sidebar-close').on('click', function (e) {
        e.preventDefault();
        $notificationsSidebar.addClass('closing');
        setTimeout(function () {
          $notificationsSidebar.removeClass('opened');
          $notificationsSidebar.removeClass('closing');
        }, 300);
      });
    }

    // Display conditions.
    $(document).on('emoza-display-conditions-select2-initalize', function (event, item) {
      var $item = $(item);
      var $control = $item.closest('.emoza-display-conditions-control');
      var $typeSelectWrap = $item.find('.emoza-display-conditions-select2-type');
      var $typeSelect = $typeSelectWrap.find('select');
      var $conditionSelectWrap = $item.find('.emoza-display-conditions-select2-condition');
      var $conditionSelect = $conditionSelectWrap.find('select');
      var $idSelectWrap = $item.find('.emoza-display-conditions-select2-id');
      var $idSelect = $idSelectWrap.find('select');
      $typeSelect.select2({
        width: '100%',
        minimumResultsForSearch: -1
      });
      $typeSelect.on('select2:select', function (event) {
        $typeSelectWrap.attr('data-type', event.params.data.id);
      });
      $conditionSelect.select2({
        width: '100%'
      });
      $conditionSelect.on('select2:select', function (event) {
        var $element = $(event.params.data.element);
        if ($element.data('ajax')) {
          $idSelectWrap.removeClass('hidden');
        } else {
          $idSelectWrap.addClass('hidden');
        }
        $idSelect.val(null).trigger('change');
      });
      var isAjaxSelected = $conditionSelect.find(':selected').data('ajax');
      if (isAjaxSelected) {
        $idSelectWrap.removeClass('hidden');
      }
      $idSelect.select2({
        width: '100%',
        placeholder: '',
        allowClear: true,
        minimumInputLength: 1,
        ajax: {
          url: window.emoza_dashboard.ajax_url,
          dataType: 'json',
          delay: 250,
          cache: true,
          data: function data(params) {
            return {
              action: 'templates_builder_display_conditions_select_ajax',
              term: params.term,
              nonce: window.emoza_dashboard.nonce,
              source: $conditionSelect.val()
            };
          },
          processResults: function processResults(response, params) {
            if (response.success) {
              return {
                results: response.data
              };
            }
            return {};
          }
        }
      });
    });
    $(document).on('click', '.emoza-display-conditions-modal-toggle', function (event) {
      event.preventDefault();
      var $button = $(this);
      var template = wp.template('emoza-display-conditions-template');
      var $control = $button.closest('.emoza-display-conditions-control');
      var $modal = $control.find('.emoza-display-conditions-modal');
      if (!$modal.data('initialized')) {
        $control.append(template($control.data('condition-settings')));
        var $items = $control.find('.emoza-display-conditions-modal-content-list-item').not('.hidden');
        if ($items.length) {
          $items.each(function () {
            $(document).trigger('emoza-display-conditions-select2-initalize', this);
          });
        }
        $modal = $control.find('.emoza-display-conditions-modal');
        $modal.data('initialized', true);
        $modal.addClass('open');
      } else {
        $modal.toggleClass('open');
      }
    });
    $(document).on('click', '.emoza-display-conditions-modal', function (event) {
      event.preventDefault();
      var $modal = $(this);
      if ($(event.target).is($modal)) {
        $('.emoza-display-conditions-modal').removeClass('open');
      }
    });
    $(document).on('click', '.emoza-display-conditions-modal-add', function (event) {
      event.preventDefault();
      var $button = $(this);
      var $control = $button.closest('.emoza-display-conditions-control');
      var $modal = $control.find('.emoza-display-conditions-modal');
      var $list = $modal.find('.emoza-display-conditions-modal-content-list');
      var $item = $modal.find('.emoza-display-conditions-modal-content-list-item').first().clone();
      var conditionGroup = $button.data('condition-group');
      $item.removeClass('hidden');
      $item.find('.emoza-display-conditions-select2-condition').not('[data-condition-group="' + conditionGroup + '"]').remove();
      $list.append($item);
      $(document).trigger('emoza-display-conditions-select2-initalize', $item);
    });
    $(document).on('click', '.emoza-display-conditions-modal-remove', function (event) {
      event.preventDefault();
      var $item = $(this).closest('.emoza-display-conditions-modal-content-list-item');
      $item.remove();
    });
    $(document).on('click', '.emoza-display-conditions-modal-save', function (event) {
      event.preventDefault();
      var data = [];
      var $button = $(this);
      var $control = $button.closest('.emoza-display-conditions-control');
      var $modal = $control.find('.emoza-display-conditions-modal');
      var $textarea = $control.find('.emoza-display-conditions-textarea');
      var $items = $modal.find('.emoza-display-conditions-modal-content-list-item').not('.hidden');
      $items.each(function () {
        var $item = $(this);
        data.push({
          type: $item.find('select[name="type"]').val(),
          condition: $item.find('select[name="condition"]').val(),
          id: $item.find('select[name="id"]').val()
        });
      });
      $textarea.val(JSON.stringify(data)).trigger('change');
    });
  });
})(jQuery);
