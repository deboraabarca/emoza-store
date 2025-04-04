"use strict";

/* Customizer Back Button */
jQuery(document).ready(function ($) {
  // Store the previous section in a global variable to use later
  var previous_section = '';
  $('.emoza-to-widget-area-link').on('click', function () {
    // Sections
    if ($(this).closest('.control-section').length) {
      previous_section = $(this).closest('.control-section').attr('id').replace('sub-accordion-section-', '');
    }
  });

  // Flag when hidden section content is active
  var is_any_header_footer_section = false,
    is_hidden_section_content = false,
    is_header_builder_section = false,
    is_header_builder_component_section = false,
    is_footer_builder_section = false,
    is_footer_builder_component_section = false;
  $(document).on('mouseover focus', '.customize-section-back', function (e) {
    if (!$('.control-section.open').length) {
      return false;
    }
    is_any_header_footer_section = $('.control-section.open').attr('id').indexOf('_hb_') || $('.control-section.open').attr('id').indexOf('_fb_') ? true : false;
    is_hidden_section_content = $('.control-section.open').hasClass('control-section-emoza-section-hidden') ? true : false;
    is_header_builder_section = $('.control-section.open').attr('id') === 'sub-accordion-section-emoza_section_hb_wrapper' ? true : false;
    is_header_builder_component_section = $('.control-section.open').attr('id').indexOf('emoza_section_hb_component_') !== -1 ? true : false;
    is_footer_builder_section = $('.control-section.open').attr('id') === 'sub-accordion-section-emoza_section_fb_wrapper' ? true : false;
    is_footer_builder_component_section = $('.control-section.open').attr('id').indexOf('emoza_section_fb_component_') !== -1 ? true : false;
  });

  // If hidden section content is active, focus on the previous section (from global variable)
  $(document).on('click keydown', '.customize-section-back', function (e) {
    if (e.keyCode && e.keyCode !== 13 && e.keyCode !== 27) {
      return false;
    }
    if (is_header_builder_section) {
      wp.customize.section('emoza_section_hb_wrapper').collapse();
      setTimeout(function () {
        wp.customize.panel('emoza_panel_header').collapse();
      }, 10);
    }
    if (is_footer_builder_section) {
      wp.customize.section('emoza_section_fb_wrapper').collapse();
      setTimeout(function () {
        wp.customize.panel('emoza_panel_footer').collapse();
      }, 10);
    }
    if (!is_any_header_footer_section && !is_footer_builder_component_section && !is_header_builder_component_section && is_hidden_section_content && previous_section !== '') {
      if (typeof wp.customize.section(previous_section) !== 'undefined') {
        wp.customize.section(previous_section).focus();
      }
    }
    is_any_header_footer_section = false;
    is_header_builder_section = false;
    is_header_builder_component_section = false;
    is_footer_builder_section = false;
    is_footer_builder_component_section = false;
    is_hidden_section_content = false;
  });
});

/* Emoza Section Upsell Control */
jQuery(document).ready(function ($) {
  $('.control-section-emoza-section-upsell').on('click', function () {
    window.open('https://emoza.org/?utm_source=theme_customizer&utm_medium=emoza_customizer&utm_campaign=Emoza', '_blank');
  });
});

/* Emoza Radio Image Control */
jQuery(document).ready(function ($) {
  "use strict";

  $(document).on('click', '.customize-control-emoza-radio-image label.is-pro', function (e) {
    e.preventDefault();
  });
});

/* Select 2 Control */
jQuery(document).ready(function ($) {
  "use strict";

  $('.emoza-select2').each(function () {
    var options = $(this).data('select2-options');
    $(this).select2(options);
  });
  $('.emoza-select2').on('change', function () {
    var hidden_input = $(this).prev();
    hidden_input.val($(this).val()).trigger('change');
  });
});

/* Typography */
jQuery(document).ready(function ($) {
  "use strict";

  $('.google-fonts-list').each(function (i, obj) {
    if (!$(this).hasClass('select2-hidden-accessible')) {
      $(this).select2();
    }
  });
  $('.google-fonts-list').on('change', function () {
    var elementRegularWeight = $(this).parent().parent().find('.google-fonts-regularweight-style');
    var selectedFont = $(this).val();
    var customizerControlName = $(this).attr('control-name');

    // Clear Weight/Style dropdowns
    elementRegularWeight.empty();
    // Make sure Italic & Bold dropdowns are enabled

    // Get the Google Fonts control object
    var bodyfontcontrol = _wpCustomizeSettings.controls[customizerControlName];

    // Find the index of the selected font
    var indexes = $.map(bodyfontcontrol.emozafontslist, function (obj, index) {
      if (obj.family === selectedFont) {
        return index;
      }
    });
    var index = indexes[0];

    // For the selected Google font show the available weight/style variants
    $.each(bodyfontcontrol.emozafontslist[index].variants, function (val, text) {
      elementRegularWeight.append($('<option></option>').val(text).html(text));

      //Set default value
      if ($(elementRegularWeight).find('option[value="regular"]').length > 0) {
        $(elementRegularWeight).val('regular');
      } else if ($(elementRegularWeight).find('option[value="400"]').length > 0) {
        $(elementRegularWeight).val('400');
      } else if ($(elementRegularWeight).find('option[value="300"]').length > 0) {
        $(elementRegularWeight).val('300');
      }
    });

    // Update the font category based on the selected font
    $(this).parent().parent().find('.google-fonts-category').val(bodyfontcontrol.emozafontslist[index].category);
    emozaGetAllSelects($(this).parent().parent().parent().parent());
  });
  $('.google_fonts_select_control select').on('change', function () {
    emozaGetAllSelects($(this).parent().parent().parent().parent());
  });
  function emozaGetAllSelects($element) {
    var selectedFont = {
      font: $element.find('.google-fonts-list').val(),
      regularweight: $element.find('.google-fonts-regularweight-style').val(),
      category: $element.find('.google-fonts-category').val()
    };

    // Important! Make sure to trigger change event so Customizer knows it has to save the field
    $element.find('.customize-control-google-font-selection').val(JSON.stringify(selectedFont)).trigger('change');
  }
});

/* Typography - Adobe Type Kit Fonts */
jQuery(document).ready(function ($) {
  $('.adobe-font-family').each(function (i, obj) {
    if (!$(this).hasClass('select2-hidden-accessible')) {
      $(this).select2();
    }
  });
  $('.adobe-font-family').on('change', function () {
    var $el = $(this).closest('.adobe_fonts_select_control');
    var selected_css_name = $(this).val();
    var variations = '';
    for (var i = 0; i < emoza_adobe_fonts.length; i++) {
      if (emoza_adobe_fonts[i].css_name == selected_css_name) {
        variations = emoza_adobe_fonts[i].variations;
        break;
      }
    }
    $el.find('.adobe-font-weight').html('');
    for (var _i = 0; _i < variations.length; _i++) {
      // exclude italic variations
      if (variations[_i].indexOf('i') === -1) {
        $el.find('.adobe-font-weight').append('<option value="' + emoza_standardize_font_variations(variations[_i]) + '">' + emoza_standardize_font_variations(variations[_i]) + '</option>');
      }
    }
    $el.find('.customize-control-adobe-font-selection').val($el.find('.adobe-font-family').val() + '|' + $el.find('.adobe-font-weight').val()).trigger('change');
  });
  $('.adobe-font-weight').on('change', function () {
    var $el = $(this).closest('.adobe_fonts_select_control');
    $el.find('.customize-control-adobe-font-selection').val($el.find('.adobe-font-family').val() + '|' + $el.find('.adobe-font-weight').val()).trigger('change');
  });
  function emoza_standardize_font_variations(variation) {
    var variations = [];

    // normal format
    for (var i = 1; i <= 9; i++) {
      variations['n' + i] = i * 100;
    }
    if (variations.hasOwnProperty(variation)) {
      return variations[variation];
    } else {
      return '400';
    }
  }
});
jQuery(document).ready(function ($) {
  "use strict";

  var clickFlag = false;
  $('.emoza-devices-preview').find('button').on('click', function (event) {
    if (clickFlag) {
      clickFlag = false;
      return false;
    }
    clickFlag = true;
    var device = '';
    if ($(this).hasClass('preview-desktop')) {
      $('.emoza-devices-preview').find('.preview-desktop').addClass('active');
      $('.emoza-devices-preview').find('.preview-tablet').removeClass('active');
      $('.emoza-devices-preview').find('.preview-mobile').removeClass('active');
      $('.responsive-control-desktop').addClass('active');
      $('.responsive-control-tablet').removeClass('active');
      $('.responsive-control-mobile').removeClass('active');
      $('.wp-full-overlay-footer .devices button[data-device="desktop"]').trigger('click');
      device = 'desktop';
    } else if ($(this).hasClass('preview-tablet')) {
      $('.emoza-devices-preview').find('.preview-tablet').addClass('active');
      $('.emoza-devices-preview').find('.preview-desktop').removeClass('active');
      $('.emoza-devices-preview').find('.preview-mobile').removeClass('active');
      $('.responsive-control-desktop').removeClass('active');
      $('.responsive-control-tablet').addClass('active');
      $('.responsive-control-mobile').removeClass('active');
      $('.wp-full-overlay-footer .devices button[data-device="tablet"]').trigger('click');
      device = 'tablet';
    } else {
      $('.emoza-devices-preview').find('.preview-mobile').addClass('active');
      $('.emoza-devices-preview').find('.preview-desktop').removeClass('active');
      $('.emoza-devices-preview').find('.preview-tablet').removeClass('active');
      $('.responsive-control-desktop').removeClass('active');
      $('.responsive-control-tablet').removeClass('active');
      $('.responsive-control-mobile').addClass('active');
      $('.wp-full-overlay-footer .devices button[data-device="mobile"]').trigger('click');

      // Force show on mobile.
      $('.responsive-control-tablet.show-mobile').addClass('active');
      device = 'mobile';
    }

    // Trigger custom event when switching device.
    var setting_id = $(this).closest('.customize-control').attr('id').replace('customize-control-', '');
    $(window).trigger('emoza.resp.control.switched', [setting_id, device]);
  });
  $(' .wp-full-overlay-footer .devices button ').on('click', function () {
    if (clickFlag) {
      clickFlag = false;
      return false;
    }
    var device = $(this).attr('data-device');
    $('.control-section.open .emoza-devices-preview').find('.preview-' + device).trigger('click');
  });
});

/**
 * Repeater
 */
jQuery(document).ready(function ($) {
  "use strict";

  // Update the values for all our input fields and initialise the sortable repeater
  $('.emoza-sortable_repeater_control').each(function () {
    // If there is an existing customizer value, populate our rows
    var defaultValuesArray = $(this).find('.customize-control-sortable-repeater').val().split(',');
    var numRepeaterItems = defaultValuesArray.length;
    if (numRepeaterItems > 0) {
      // Add the first item to our existing input field
      $(this).find('.repeater-input').val(defaultValuesArray[0]);
      // Create a new row for each new value
      if (numRepeaterItems > 1) {
        var i;
        for (i = 1; i < numRepeaterItems; ++i) {
          emozaAppendRow($(this), defaultValuesArray[i]);
        }
      }
    }
  });

  // Make our Repeater fields sortable
  $(this).find('.emoza-sortable_repeater.sortable').sortable({
    update: function update(event, ui) {
      emozaGetAllInputs($(this).parent());
    }
  });

  // Remove item starting from it's parent element
  $('.emoza-sortable_repeater.sortable').on('click', '.customize-control-sortable-repeater-delete', function (event) {
    event.preventDefault();
    var numItems = $(this).parent().parent().find('.repeater').length;
    if (numItems > 1) {
      $(this).parent().slideUp('fast', function () {
        var parentContainer = $(this).parent().parent();
        $(this).remove();
        emozaGetAllInputs(parentContainer);
      });
    } else {
      $(this).parent().find('.repeater-input').val('');
      emozaGetAllInputs($(this).parent().parent().parent());
    }
  });

  // Add new item
  $('.customize-control-sortable-repeater-add').click(function (event) {
    event.preventDefault();
    emozaAppendRow($(this).parent());
    emozaGetAllInputs($(this).parent());
  });

  // Refresh our hidden field if any fields change
  $('.emoza-sortable_repeater.sortable').change(function () {
    emozaGetAllInputs($(this).parent());
  });

  // Add https:// to the start of the URL if it doesn't have it
  $('.emoza-sortable_repeater.sortable:not(.regular-field)').on('blur', '.repeater-input', function () {
    var url = $(this);
    var val = url.val();
    if (val && !val.match(/^.+:\/\/.*/)) {
      // Important! Make sure to trigger change event so Customizer knows it has to save the field
      url.val('https://' + val).trigger('change');
    }
  });

  // Append a new row to our list of elements
  function emozaAppendRow($element) {
    var defaultValue = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : '';
    var is_regular = $element.find('.emoza-sortable_repeater.sortable').hasClass('regular-field') ? true : false,
      placeholder = is_regular ? '' : 'https://';
    var newRow = '<div class="repeater" style="display:none"><input type="text" value="' + defaultValue + '" class="repeater-input" placeholder="' + placeholder + '" /><span class="dashicons dashicons-menu"></span><a class="customize-control-sortable-repeater-delete" href="#"><span class="dashicons dashicons-no-alt"></span></a></div>';
    $element.find('.sortable').append(newRow);
    $element.find('.sortable').find('.repeater:last').slideDown('slow', function () {
      $(this).find('input').focus();
    });
  }

  // Get the values from the repeater input fields and add to our hidden field
  function emozaGetAllInputs($element) {
    var inputValues = $element.find('.repeater-input').map(function () {
      return $(this).val();
    }).toArray();
    // Add all the values from our repeater fields to the hidden field (which is the one that actually gets saved)
    $element.find('.customize-control-sortable-repeater').val(inputValues);
    // Important! Make sure to trigger change event so Customizer knows it has to save the field
    $element.find('.customize-control-sortable-repeater').trigger('change');
  }
});

/**
 * Tab control
 */
jQuery(document).ready(function ($) {
  "use strict";

  $('.customize-control-emoza-tab-control').each(function () {
    // Hide designs options at first
    var designs = $(this).find('.control-tab-design').data('connected');
    var general = $(this).find('.control-tab-general').data('connected');
    $.each(general, function (i, v) {
      if (i === 0) {
        $(this).addClass('emoza-tab-control-item-first');
      }
      if (i === general.length - 1) {
        $(this).addClass('emoza-tab-control-item-last');
      }
    });
    $.each(designs, function (i, v) {
      $(this).addClass('emoza-hide-control');
    });
    $(this).find('.control-tab').on('click', function () {
      var $tab = $(this);
      var $siblings = $tab.siblings();
      var visibles = $tab.data('connected');
      $tab.addClass('active');
      $siblings.removeClass('active');
      $.each(visibles, function (i, v) {
        if (i === 0) {
          $(this).addClass('emoza-tab-control-item-first');
        }
        if (i === visibles.length - 1) {
          $(this).addClass('emoza-tab-control-item-last');
        }
        $(this).removeClass('emoza-hide-control');
      });
      $siblings.each(function () {
        var $sibling = $(this);
        var hiddens = $sibling.data('connected');
        $.each(hiddens, function (i, v) {
          if (i === 0) {
            $(this).removeClass('emoza-tab-control-item-first');
          }
          if (i === hiddens.length - 1) {
            $(this).removeClass('emoza-tab-control-item-last');
          }
          $(this).addClass('emoza-hide-control');
        });
      });
    });
  });
});

/**
 * TinyMCE control
 */
jQuery(document).ready(function ($) {
  "use strict";

  $('.customize-control-tinymce-editor').each(function () {
    // Get the toolbar strings that were passed from the PHP Class
    var tinyMCEToolbar1String = _wpCustomizeSettings.controls[$(this).attr('id')].emozatb1;
    var tinyMCEToolbar2String = _wpCustomizeSettings.controls[$(this).attr('id')].emozatb2;
    var tinyMCEMediaButtons = _wpCustomizeSettings.controls[$(this).attr('id')].emozatmb;
    wp.editor.initialize($(this).attr('id'), {
      tinymce: {
        wpautop: false,
        toolbar1: tinyMCEToolbar1String,
        toolbar2: tinyMCEToolbar2String
      },
      quicktags: true,
      mediaButtons: true
    });
  });
  $(document).on('tinymce-editor-init', function (event, editor) {
    editor.on('change', function (e) {
      tinyMCE.triggerSave();
      $('#' + editor.id).trigger('change');
    });
  });
});

/**
 * Footer widget areas links
 */
jQuery(document).ready(function ($) {
  var footerCols = $('#customize-control-footer_widgets').find('input:checked');
  toggleLinks(footerCols);
  $('#customize-control-footer_widgets').find('input').change(function () {
    toggleLinks($(this));
  });
  function toggleLinks(el) {
    if ('col3' === $(el).val() || 'col3-bigleft' === $(el).val() || 'col3-bigright' === $(el).val()) {
      $('.footer-widget-area-link-1, .footer-widget-area-link-2, .footer-widget-area-link-3').show();
      $('.footer-widget-area-link-4').hide();
    } else if ('col4' === $(el).val() || 'col4-bigleft' === $(el).val() || 'col4-bigright' === $(el).val()) {
      $('.footer-widget-area-link-1, .footer-widget-area-link-2, .footer-widget-area-link-3, .footer-widget-area-link-4').show();
    } else if ('col2' === $(el).val() || 'col2-bigleft' === $(el).val() || 'col2-bigright' === $(el).val()) {
      $('.footer-widget-area-link-1, .footer-widget-area-link-2').show();
      $('.footer-widget-area-link-4, .footer-widget-area-link-3').hide();
    } else if ('col1' === $(el).val()) {
      $('.footer-widget-area-link-1').show();
      $('.footer-widget-area-link-4, .footer-widget-area-link-2, .footer-widget-area-link-3').hide();
    } else {
      $('.footer-widget-area-link-1, .footer-widget-area-link-2, .footer-widget-area-link-3, .footer-widget-area-link-4').hide();
    }
  }
});
var emozaChangeElementColors = function emozaChangeElementColors(element, color, palette) {
  var $setting = jQuery('[data-control-id="' + element + '"]');
  if ($setting.length) {
    if (palette) {
      var index = palette.indexOf(color);
      if (palette[index]) {
        color = palette[index];
      }
    }
    var $picker = $setting.find('.emoza-color-picker');
    if ($picker.data('pickr')) {
      $picker.data('pickr').setColor(color);
    } else {
      $picker.css('background-color', color);
      wp.customize(element).set(color);
    }
  } else {
    var $control = jQuery('#customize-control-' + element);
    if ($control.length) {
      var $picker = $control.find('.emoza-color-picker');
      if ($picker.data('pickr')) {
        $picker.data('pickr').setColor(color);
      } else {
        $picker.css('background-color', color);
        wp.customize(element).set(color);
      }
    }
  }
};

/**
 * Palettes
 */
wp.customize('color_palettes', function (control) {
  var palettes = jQuery('#customize-control-color_palettes').find('.radio-buttons').data('palettes');
  control.bind(function (value) {
    if (value === '') {
      return;
    }
    var palette = value;

    //Color 1 Button color, Link color
    var elements1 = ['custom_color1', 'scrolltop_bg_color', 'button_background_color', 'button_border_color', 'color_link_default', 'footer_credits_links_color', 'single_product_tabs_border_color_active', 'single_product_tabs_text_color_active', 'single_product_tabs_text_color', 'shop_archive_header_button_color', 'shop_archive_header_button_border_color', 'ql_item_bg_hover'];
    for (var _i2 = 0, _elements = elements1; _i2 < _elements.length; _i2++) {
      var element = _elements[_i2];
      if (typeof wp.customize(element) !== 'undefined') {
        emozaChangeElementColors(element, palettes[palette][0], palettes[palette]);
      }
    }

    //Color 2 Hover color for - Button, Headings, Titles, Text links, Nav links
    var elements2 = ['custom_color2', 'footer_widgets_links_hover_color', 'scrolltop_bg_color_hover', 'button_background_color_hover', 'button_border_color_hover', 'color_link_hover', 'footer_credits_links_color_hover', 'shop_archive_header_button_background_color_hover', 'shop_archive_header_button_border_color_hover', 'main_header_sticky_active_color_hover', 'main_header_color_hover', 'main_header_sticky_active_submenu_color_hover', 'main_header_submenu_color_hover', 'ql_item_color_hover'];
    for (var _i3 = 0, _elements2 = elements2; _i3 < _elements2.length; _i3++) {
      var _element = _elements2[_i3];
      if (typeof wp.customize(_element) !== 'undefined') {
        emozaChangeElementColors(_element, palettes[palette][1], palettes[palette]);
      }
    }

    //Color 3 Heading (1-6), Small text, Nav links, Site title, 
    var elements3 = ['single_post_title_color', 'custom_color3', 'main_header_submenu_color', 'main_header_sticky_active_submenu_color', 'offcanvas_menu_color', 'mobile_header_color', 'footer_widgets_title_color', 'single_product_title_color', 'color_forms_text', 'shop_product_product_title', 'loop_post_meta_color', 'loop_post_title_color', 'main_header_color', 'main_header_sticky_active_color', 'site_title_color', 'site_description_color', 'color_heading_1', 'color_heading_2', 'color_heading_3', 'color_heading_4', 'color_heading_5', 'color_heading_6', 'shop_archive_header_title_color', 'shop_archive_header_description_color', 'ehfb_search_icon_color', 'ehfb_woo_icons_color', 'ehfb_contact_info_icon_color', 'ql_item_color'];
    for (var _i4 = 0, _elements3 = elements3; _i4 < _elements3.length; _i4++) {
      var _element2 = _elements3[_i4];
      if (typeof wp.customize(_element2) !== 'undefined') {
        emozaChangeElementColors(_element2, palettes[palette][2], palettes[palette]);
      }
    }

    //Color 4 Paragraph, Paragraph small, Breadcrums, Icons
    var elements4 = ['custom_color4', 'footer_widgets_links_color', 'footer_widgets_text_color', 'color_body_text', 'footer_credits_text_color', 'color_forms_placeholder', 'topbar_color', 'main_header_bottom_color', 'single_sticky_add_to_cart_style_color_content', 'loop_post_text_color'];
    for (var _i5 = 0, _elements4 = elements4; _i5 < _elements4.length; _i5++) {
      var _element3 = _elements4[_i5];
      if (typeof wp.customize(_element3) !== 'undefined') {
        emozaChangeElementColors(_element3, palettes[palette][3], palettes[palette]);
      }
    }

    //Color 5 Input, tag borders
    var elements5 = ['custom_color5', 'color_forms_borders', 'single_product_tabs_remaining_borders', 'single_sticky_add_to_cart_style_color_border', 'emoza_header_row__above_header_row_border_bottom_color', 'emoza_header_row__main_header_row_border_bottom_color', 'emoza_header_row__below_header_row_border_bottom_color', 'emoza_footer_row__above_footer_row_border_top_color', 'emoza_footer_row__main_footer_row_border_top_color', 'emoza_footer_row__below_footer_row_border_top_color', 'ql_item_border_color'];
    for (var _i6 = 0, _elements5 = elements5; _i6 < _elements5.length; _i6++) {
      var _element4 = _elements5[_i6];
      if (typeof wp.customize(_element4) !== 'undefined') {
        emozaChangeElementColors(_element4, palettes[palette][4], palettes[palette]);
      }
    }

    //Color 6 Footer background, Subtle backgrounds
    var elements6 = ['custom_color6', 'footer_widgets_background', 'footer_credits_background', 'content_cards_background', 'single_product_tabs_background_color', 'single_product_tabs_background_color_active', 'single_product_gallery_styles_background_color', 'single_sticky_add_to_cart_style_color_background', 'emoza_footer_row__above_footer_row_background_color', 'emoza_footer_row__main_footer_row_background_color', 'emoza_footer_row__below_footer_row_background_color', 'ql_background_color'];
    for (var _i7 = 0, _elements6 = elements6; _i7 < _elements6.length; _i7++) {
      var _element5 = _elements6[_i7];
      if (typeof wp.customize(_element5) !== 'undefined') {
        emozaChangeElementColors(_element5, palettes[palette][5], palettes[palette]);
      }
    }

    //Color 7 Default background, Text on dark BG
    var elements7 = ['custom_color7', 'background_color', 'button_color', 'button_color_hover', 'scrolltop_color', 'scrolltop_color_hover', 'color_forms_background', 'topbar_background', 'single_product_reviews_advanced_section_bg_color'];
    for (var _i8 = 0, _elements7 = elements7; _i8 < _elements7.length; _i8++) {
      var _element6 = _elements7[_i8];
      if (typeof wp.customize(_element6) !== 'undefined') {
        emozaChangeElementColors(_element6, palettes[palette][6], palettes[palette]);
      }
    }

    //Color 8 header background
    var elements8 = ['custom_color8', 'main_header_submenu_background', 'main_header_sticky_active_submenu_background_color', 'main_header_background', 'main_header_sticky_active_background', 'main_header_bottom_background', 'mobile_header_background', 'offcanvas_menu_background', 'shop_archive_header_background_color', 'shop_archive_header_button_background_color', 'shop_archive_header_button_color_hover', 'emoza_header_row__above_header_row_background_color', 'emoza_header_row__main_header_row_background_color', 'emoza_header_row__below_header_row_background_color', 'login_register_submenu_background'];
    for (var _i9 = 0, _elements8 = elements8; _i9 < _elements8.length; _i9++) {
      var _element7 = _elements8[_i9];
      if (typeof wp.customize(_element7) !== 'undefined') {
        emozaChangeElementColors(_element7, palettes[palette][7], palettes[palette]);
      }
    }

    // Custom palette update.
    var $customPaletteControl = jQuery('#customize-control-custom_palette');
    if ($customPaletteControl.length) {
      var $customPaletteControls = $customPaletteControl.find('.emoza-color-control');
      if ($customPaletteControls.length) {
        $customPaletteControls.each(function (index) {
          var $control = jQuery(this);
          var $picker = $control.find('.emoza-color-picker');
          var $input = $control.find('.emoza-color-input');
          var color = palettes[palette][index];
          $input.attr('value', color);
          $picker.css('background-color', color);
        });
      }
    }
  });
});

/**
 * Custom palette
 */
wp.customize.bind('ready', function () {
  wp.customize('custom_color1', function (control) {
    control.bind(function (value) {
      var elements1 = ['scrolltop_bg_color', 'button_background_color', 'button_border_color', 'color_link_default', 'footer_credits_links_color', 'single_product_tabs_border_color_active', 'single_product_tabs_text_color_active', 'single_product_tabs_text_color', 'shop_archive_header_button_color', 'shop_archive_header_button_border_color', 'ql_item_bg_hover'];
      for (var _i10 = 0, _elements9 = elements1; _i10 < _elements9.length; _i10++) {
        var element = _elements9[_i10];
        if (typeof wp.customize(element) !== 'undefined') {
          emozaChangeElementColors(element, value);
        }
      }
    });
  });
  wp.customize('custom_color2', function (control) {
    control.bind(function (value) {
      var elements2 = ['footer_widgets_links_hover_color', 'scrolltop_bg_color_hover', 'button_background_color_hover', 'button_border_color_hover', 'color_link_hover', 'footer_credits_links_color_hover', 'shop_archive_header_button_background_color_hover', 'shop_archive_header_button_border_color_hover', 'main_header_sticky_active_color_hover', 'main_header_color_hover', 'main_header_sticky_active_submenu_color_hover', 'main_header_submenu_color_hover', 'ql_item_color_hover'];
      for (var _i11 = 0, _elements10 = elements2; _i11 < _elements10.length; _i11++) {
        var element = _elements10[_i11];
        if (typeof wp.customize(element) !== 'undefined') {
          emozaChangeElementColors(element, value);
        }
      }
    });
  });
  wp.customize('custom_color3', function (control) {
    control.bind(function (value) {
      var elements3 = ['single_post_title_color', 'main_header_submenu_color', 'main_header_sticky_active_submenu_color', 'offcanvas_menu_color', 'mobile_header_color', 'footer_widgets_title_color', 'single_product_title_color', 'color_forms_text', 'shop_product_product_title', 'loop_post_meta_color', 'loop_post_title_color', 'main_header_color', 'main_header_sticky_active_color', 'site_title_color', 'site_description_color', 'color_heading_1', 'color_heading_2', 'color_heading_3', 'color_heading_4', 'color_heading_5', 'color_heading_6', 'shop_archive_header_title_color', 'shop_archive_header_description_color', 'ehfb_search_icon_color', 'ehfb_woo_icons_color', 'ehfb_contact_info_icon_color', 'ql_item_color'];
      for (var _i12 = 0, _elements11 = elements3; _i12 < _elements11.length; _i12++) {
        var element = _elements11[_i12];
        if (typeof wp.customize(element) !== 'undefined') {
          emozaChangeElementColors(element, value);
        }
      }
    });
  });
  wp.customize('custom_color4', function (control) {
    control.bind(function (value) {
      var elements4 = ['footer_widgets_links_color', 'footer_widgets_text_color', 'color_body_text', 'footer_credits_text_color', 'color_forms_placeholder', 'topbar_color', 'main_header_bottom_color', 'single_sticky_add_to_cart_style_color_content', 'loop_post_text_color'];
      for (var _i13 = 0, _elements12 = elements4; _i13 < _elements12.length; _i13++) {
        var element = _elements12[_i13];
        if (typeof wp.customize(element) !== 'undefined') {
          emozaChangeElementColors(element, value);
        }
      }
    });
  });
  wp.customize('custom_color5', function (control) {
    control.bind(function (value) {
      var elements5 = ['color_forms_borders', 'single_product_tabs_remaining_borders', 'single_sticky_add_to_cart_style_color_border', 'emoza_header_row__above_header_row_border_bottom_color', 'emoza_header_row__main_header_row_border_bottom_color', 'emoza_header_row__below_header_row_border_bottom_color', 'emoza_footer_row__above_footer_row_border_top_color', 'emoza_footer_row__main_footer_row_border_top_color', 'emoza_footer_row__below_footer_row_border_top_color', 'ql_item_border_color'];
      for (var _i14 = 0, _elements13 = elements5; _i14 < _elements13.length; _i14++) {
        var element = _elements13[_i14];
        if (typeof wp.customize(element) !== 'undefined') {
          emozaChangeElementColors(element, value);
        }
      }
    });
  });
  wp.customize('custom_color6', function (control) {
    control.bind(function (value) {
      var elements6 = ['footer_widgets_background', 'footer_credits_background', 'content_cards_background', 'single_product_tabs_background_color', 'single_product_tabs_background_color_active', 'single_product_gallery_styles_background_color', 'single_sticky_add_to_cart_style_color_background', 'emoza_footer_row__above_footer_row_background_color', 'emoza_footer_row__main_footer_row_background_color', 'emoza_footer_row__below_footer_row_background_color', 'ql_background_color'];
      for (var _i15 = 0, _elements14 = elements6; _i15 < _elements14.length; _i15++) {
        var element = _elements14[_i15];
        if (typeof wp.customize(element) !== 'undefined') {
          emozaChangeElementColors(element, value);
        }
      }
    });
  });
  wp.customize('custom_color7', function (control) {
    control.bind(function (value) {
      var elements7 = ['background_color', 'button_color', 'button_color_hover', 'scrolltop_color', 'scrolltop_color_hover', 'color_forms_background', 'topbar_background', 'single_product_reviews_advanced_section_bg_color'];
      for (var _i16 = 0, _elements15 = elements7; _i16 < _elements15.length; _i16++) {
        var element = _elements15[_i16];
        if (typeof wp.customize(element) !== 'undefined') {
          emozaChangeElementColors(element, value);
        }
      }
    });
  });
  wp.customize('custom_color8', function (control) {
    control.bind(function (value) {
      var elements8 = ['main_header_submenu_background', 'main_header_sticky_active_submenu_background_color', 'main_header_background', 'main_header_sticky_active_background', 'main_header_bottom_background', 'mobile_header_background', 'offcanvas_menu_background', 'shop_archive_header_background_color', 'shop_archive_header_button_background_color', 'shop_archive_header_button_color_hover', 'emoza_header_row__above_header_row_background_color', 'emoza_header_row__main_header_row_background_color', 'emoza_header_row__below_header_row_background_color', 'login_register_submenu_background'];
      for (var _i17 = 0, _elements16 = elements8; _i17 < _elements16.length; _i17++) {
        var element = _elements16[_i17];
        if (typeof wp.customize(element) !== 'undefined') {
          emozaChangeElementColors(element, value);
        }
      }
    });
  });
});

/* Non-refresh custom palette toggle */
wp.customize.bind('ready', function () {
  wp.customize.control('custom_palette', function (control) {
    var setting = wp.customize('custom_palette_toggle');
    setting.bind(function (value) {
      control.active.set(value);
    });
  });
});

/**
 * Transform palettes radio into dropdown
 */
jQuery(document).ready(function ($) {
  var saved = $('.saved-palette');
  $('.saved-palette').on('click', function () {
    $('.palette-radio-buttons').toggleClass('open');
  });
  $('.palette-radio-buttons').find('.palette').on('click', function () {
    saved.empty();
    $('.palette-radio-buttons').removeClass('open');
    var clone = $(this).parent().clone();
    clone.unwrap().appendTo(saved).find('input').remove();
  });
});

/**
 * Accordion control
 */
(function ($) {
  var Emoza_Accordion = {
    init: function init() {
      this.firstTime = true;
      if (!this.initialized) {
        this.events();
      }
      this.initialized = true;
    },
    events: function events() {
      var self = this;
      // Toggle accordion
      $(document).on('click', '.emoza-accordion-title', function (e) {
        e.preventDefault();
        var $this = $(this);
        if ($(this).hasClass('expanded')) {
          self.showOrHide($(this), 'hide');
          $(this).removeClass('expanded').addClass('collapse');
          setTimeout(function () {
            $this.removeClass('collapse');
          }, 300);
        }
        if (!$(this).hasClass('collapse')) {
          // Open one accordion item per time 
          $('.emoza-accordion-item').addClass('emoza-accordion-hide');
          $('.emoza-accordion-title').removeClass('expanded');
          // Show accordion content
          self.showOrHide($(this), 'show');
          $this.addClass('expanded');
        }
      });
      // Mount the accordion when enter in the section (with accordions inside)
      // Also used to collapse all accordions when navigating between others tabs
      $(document).on('click', '.control-section', function (e) {
        var $section = $('.control-section.open');
        if (self.firstTime && $section.find('.emoza-accordion-title').length) {
          $section.find('.emoza-accordion-title').each(function () {
            self.showOrHide($(this), 'hide');
            $(this).removeClass('expanded');
          });
          setTimeout(function () {
            self.firstTime = false;
          }, 300);
        }
      });
      // Reset the first time
      $(document).on('click', '.customize-section-back', function () {
        self.firstTime = true;
      });
      return this;
    },
    showOrHide: function showOrHide($this, status) {
      var self = this;
      var current = '';
      current = $this.closest('.customize-control').next();
      var elements = [];
      if (current.attr('id') == 'customize-control-' + $this.data('until')) {
        elements.push(current[0].id);
      } else {
        while (current.attr('id') != 'customize-control-' + $this.data('until')) {
          elements.push(current[0].id);
          current = current.next();
        }
      }
      if (elements.length >= 1) {
        elements.push(current[0].id);
      }
      for (var i = 0; i < elements.length; i++) {
        // Identify accordion items
        $('#' + elements[i]).addClass('emoza-accordion-item active');
        // Hide or show the accordion content
        if (status == 'hide') {
          $('#' + elements[i]).addClass('emoza-accordion-hide');
        } else {
          $('#' + elements[i]).removeClass('emoza-accordion-hide');
        }
        // Identify first accordion item
        if (i == 0) {
          $('#' + elements[i]).addClass('emoza-accordion-first-item');
        }
        // Identify last accordion item
        if (i == elements.length - 1 && elements.length > 1 || elements.length == 1) {
          $('#' + elements[i]).addClass('emoza-accordion-last-item');
        }
      }
      return this;
    },
    focusAccordionOpenControl: function focusAccordionOpenControl() {
      var self = this,
        urlParams = document.location.search,
        paramsArr = urlParams.split('&'),
        newString = '';
      paramsArr.shift();
      newString = paramsArr.join('&');
      var params = self.getQueryParams(newString);
      if ($('.control-section.open').get(0)) {
        self.firstTime = false;
        $('.control-section.open').find('.emoza-accordion-title').trigger('click');
        if (typeof params.control !== 'undefined') {
          $('.control-section.open').find('#' + params.control + ' > a').trigger('click');
        }
        return;
      }
      setTimeout(function () {
        self.focusAccordionOpenControl();
      }, 300);
      return this;
    },
    getQueryParams: function getQueryParams(qs) {
      qs = qs.split('+').join(' ');
      var params = {},
        tokens,
        re = /[?&]?([^=]+)=([^&]*)/g;
      while (tokens = re.exec(qs)) {
        params[decodeURIComponent(tokens[1])] = decodeURIComponent(tokens[2]);
      }
      return params;
    }
  };
  $(document).ready(function ($) {
    Emoza_Accordion.init();
  });
  if (window.location.href.indexOf('?autofocus') > 0) {
    wp.customize.bind('ready', function () {
      Emoza_Accordion.focusAccordionOpenControl();
    });
  }
})(jQuery);

/**
 * Go to (links to navigate between sections and panels)
 */
jQuery(document).ready(function ($) {
  $(document).on('click', 'a[data-goto]', function (e) {
    e.preventDefault();
    var type = $(this).data('type'),
      goto = $(this).data('goto');
    if ('section' === type) {
      wp.customize.section(goto).focus();
    } else if ('panel' === type) {
      wp.customize.panel(goto).focus();
    }
  });
});

/**
 * Create page control
 */
jQuery(document).ready(function ($) {
  $(document).on('click', '.emoza-create-page-control-button', function (e) {
    e.preventDefault();
    var $this = $(this),
      $create_message = $this.parent().find('.emoza-create-page-control-create-message'),
      $success_message = $this.parent().find('.emoza-create-page-control-success-message'),
      initial_text = $this.text(),
      creating_text = $this.data('creating-text'),
      created_text = $this.data('created-text'),
      page_title = $this.data('page-title'),
      page_meta_key = $this.data('page-meta-key'),
      page_meta_value = $this.data('page-meta-value'),
      option_name = $this.data('option-name'),
      nonce = $this.data('nonce');
    if (!page_title) {
      return false;
    }
    $(this).text(creating_text);
    $(this).attr('disabled', true);
    $.ajax({
      type: 'post',
      url: ajaxurl,
      data: {
        action: 'emoza_create_page_control',
        page_title: page_title,
        page_meta_key: page_meta_key,
        page_meta_value: page_meta_value,
        option_name: option_name,
        nonce: nonce
      },
      success: function success(response) {
        if ('success' === response.status) {
          var href = $success_message.find('a').attr('href'),
            newhref = href.replace('?post=&', '?post=' + response.page_id + '&');
          $success_message.find('a').attr('href', newhref);
          $success_message.css('display', 'block');
          $create_message.remove();
          $this.remove();
        } else {}
      }
    });
  });
});

/**
 * Typography adobe fonts kits control
 */
jQuery(document).ready(function ($) {
  // Get Kits from API
  $(document).on('click', '.emoza-adobe_fonts_kits_submit_token', function (e) {
    e.preventDefault();
    var $this = $(this),
      token = $('#adobe_fonts_kits_generator').val(),
      ajax_wrapper = $('.emoza-adobe_fonts_kits_ajax_wrapper'),
      nonce = $this.data('nonce');
    $(this).text($this.data('loading-text'));
    $(this).attr('disabled', true);
    $.ajax({
      type: 'post',
      url: ajaxurl,
      data: {
        action: 'emoza_typography_adobe_kits_control',
        token: token,
        nonce: nonce
      },
      success: function success(response) {
        ajax_wrapper.html(response.output);
        $this.text($this.data('default-text'));
        $this.attr('disabled', false);
        if (response.status === 'success' && response.output !== null) {
          wp.customize.bind('saved', function () {
            var href = $('.emoza-adobe_fonts_kits_wrapper-item .reload-message a').attr('href');
            window.location.href = href;
          });
          $('#customize-save-button-wrapper > .save').trigger('click');
        }
      }
    });
  });

  // Enable or disable specific kits
  $(document).on('click', '.emoza-adobe_fonts_kit_onoff', function (e) {
    e.preventDefault();
    var $this = $(this),
      kit_id = $this.data('kit'),
      nonce = $this.data('nonce');
    $(this).text($this.data('loading-text'));
    $(this).attr('disabled', true);
    $.ajax({
      type: 'post',
      url: ajaxurl,
      data: {
        action: 'emoza_typography_adobe_kits_control_enable_disable',
        kit: kit_id,
        nonce: nonce
      },
      success: function success(response) {
        if (response.kit_enabled) {
          $this.text($this.data('disable-text'));
          $this.closest('.emoza-adobe_fonts_kits_wrapper-item').removeClass('disabled');
        } else {
          $this.text($this.data('enable-text'));
          $this.closest('.emoza-adobe_fonts_kits_wrapper-item').addClass('disabled');
        }
        $this.closest('.emoza-adobe_fonts_kits_wrapper-item').find('.reload-message').addClass('show');
        $this.attr('disabled', false);
      }
    });
  });
});

/**
 * Customizer Back Button
 */
jQuery(document).ready(function ($) {
  var current_section_id = '';
  $(document).on('mouseover focus', '.customize-section-back', function (e) {
    current_section_id = $('.control-section.open').attr('id');
  });
  $(document).on('click keydown', '.customize-section-back', function (e) {
    // Floating Mini Cart Icon
    if (current_section_id.indexOf('side_mini_cart_floating_icon_section') !== -1) {
      if (typeof wp.customize.section('emoza_section_shop_cart') !== 'undefined') {
        wp.customize.section('emoza_section_shop_cart').focus();
        return false;
      }
    }
  });
});

/**
 * Display Conditions Control
 */
jQuery(document).ready(function ($) {
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
        url: ajaxurl,
        dataType: 'json',
        delay: 250,
        cache: true,
        data: function data(params) {
          return {
            action: 'emoza_display_conditions_select_ajax',
            term: params.term,
            nonce: ajax_object.ajax_nonce,
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
      $modal.removeClass('open');
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

/**
 * Custom Sidebars Control
 */
jQuery(document).ready(function ($) {
  "use strict";

  $(document).on('emoza-custom-sidebar-update', function (event, control) {
    event.preventDefault();
    var data = [];
    var $control = $(control);
    var $textarea = $control.find('.emoza-custom-sidebar-textarea');
    var $items = $control.find('.emoza-custom-sidebar-list-item').not('.hidden');
    $items.each(function () {
      var $item = $(this);
      var name = $item.find('input[name="sidebar_name"]').val();
      var conditions = $item.find('textarea[name="sidebar_conditions"]').val();
      if (conditions) {
        conditions = JSON.parse(conditions);
      }
      if (name) {
        data.push({
          name: name,
          conditions: conditions
        });
      }
    });
    $textarea.val(JSON.stringify(data)).trigger('change');
  });
  $('.emoza-custom-sidebars-control').each(function () {
    var $control = $(this);
    var $list = $control.find('.emoza-custom-sidebar-list');
    $list.sortable({
      axis: 'y',
      update: function update() {
        $(document).trigger('emoza-custom-sidebar-update', [$control]);
      }
    });
  });
  $(document).on('change', '.emoza-custom-sidebar-name, .emoza-custom-sidebar-conditions', function (event) {
    var $button = $(this);
    var $control = $button.closest('.emoza-custom-sidebars-control');
    $(document).trigger('emoza-custom-sidebar-update', [$control]);
  });
  $(document).on('click', '.emoza-custom-sidebar-remove', function (event) {
    var $button = $(this);
    var $control = $button.closest('.emoza-custom-sidebars-control');
    var $items = $control.find('.emoza-custom-sidebar-list-item').not('.hidden');
    $button.closest('.emoza-custom-sidebar-list-item').remove();
    if ($items.length === 1) {
      var $list = $control.find('.emoza-custom-sidebar-list');
      var $item = $control.find('.emoza-custom-sidebar-list-item').first().clone();
      $item.removeClass('hidden');
      $list.append($item);
    }
    $(document).trigger('emoza-custom-sidebar-update', [$control]);
  });
  $(document).on('click', '.emoza-custom-sidebar-add', function (event) {
    var $button = $(this);
    var $control = $button.closest('.emoza-custom-sidebars-control');
    var $list = $control.find('.emoza-custom-sidebar-list');
    var $item = $control.find('.emoza-custom-sidebar-list-item').first().clone();
    $item.removeClass('hidden');
    $list.append($item);
    $(document).trigger('emoza-custom-sidebar-update', [$control]);
  });
  $(document).on('click', '.emoza-custom-sidebar-condition', function (event) {
    var $button = $(this);
    var $item = $button.closest('.emoza-custom-sidebar-list-item');
  });
});

/**
 * Custom Fonts Control
 */
jQuery(document).ready(function ($) {
  "use strict";

  var $selectors = $('.emoza-typography-custom-select');
  if ($selectors.length) {
    $selectors.each(function () {
      var $selector = $(this);
      $selector.select2();
      $selector.on('change', function () {
        var font = $(this).val();
        var control = _wpCustomizeSettings.controls[$selector.data('control-name')];
        var googleFontWeights = $.map(control.google_fonts, function (obj, index) {
          if (obj.family === font) {
            return obj.variants;
          }
        });
        var $weightWrapper = $selector.parent().find('.emoza-typography-custom-weight-select-wrapper');
        var $weightSelector = $weightWrapper.find('.emoza-typography-custom-weight-select');
        $weightSelector.empty();
        if (googleFontWeights.length) {
          $weightWrapper.show();
          $.each(googleFontWeights, function (index, weight) {
            $weightSelector.append('<option name="' + weight + '">' + weight + '</option>');
          });
          $weightSelector.trigger('change');
        } else {
          $weightWrapper.hide();
        }
      });
    });
  }
  $(document).on('emoza-custom-font-update', function (event, control) {
    event.preventDefault();
    var data = [];
    var $control = $(control);
    var $textarea = $control.find('.emoza-custom-font-textarea');
    var $items = $control.find('.emoza-custom-font-item').not('.hidden');
    $items.each(function () {
      var $item = $(this);
      var name = $item.find('input[name="name"]').val();
      var woff2 = $item.find('input[name="woff2"]').val();
      var woff = $item.find('input[name="woff"]').val();
      var ttf = $item.find('input[name="ttf"]').val();
      var eot = $item.find('input[name="eot"]').val();
      var otf = $item.find('input[name="otf"]').val();
      var svg = $item.find('input[name="svg"]').val();
      if (name && (woff2 || woff || ttf || eot || otf || svg)) {
        data.push({
          name: name,
          woff2: woff2,
          woff: woff,
          ttf: ttf,
          eot: eot,
          otf: otf,
          svg: svg
        });
        var fontFaceStyle = name.replace(/ /g, '-').toLowerCase();
        if ($('#' + fontFaceStyle).length) {
          $('#' + fontFaceStyle).remove();
        }
        var src = [];
        if (woff2) {
          src.push('url("' + woff2 + '") format("woff2");');
        }
        if (woff) {
          src.push('url("' + woff + '") format("woff");');
        }
        if (svg) {
          src.push('url("' + svg + '") format("svg");');
        }
        if (ttf) {
          src.push('url("' + ttf + '") format("truetype");');
        }
        if (otf) {
          src.push('url("' + otf + '") format("opentype");');
        }
        if (eot) {
          src.push('url("' + eot + '?#iefix") format("embedded-opentype");');
        }
        if (src.length) {
          var css = '';
          css += '@font-face{ font-family: "' + name + '";';
          if (eot) {
            css += 'src: url(' + eot + ');';
          }
          css += 'src: ' + src.join(',') + ';';
          css += '}';
          $('head').append('<style id="' + fontFaceStyle + '" type="text/css">' + css + '</style>');
        }
      }
    });
    $textarea.val(JSON.stringify(data)).trigger('change');

    // update custom font selectors
    if ($selectors.length) {
      $selectors.each(function () {
        var $selector = $(this);
        var $optgroups = $selector.find('optgroup');
        $optgroups.each(function () {
          var $optgroup = $(this);
          if ($optgroup.data('type') === 'custom-fonts') {
            var controlValue = wp.customize.control($selector.data('control-name')).settings['font-family'].get();
            $optgroup.empty();
            $.each(data, function (index, option) {
              var selected = option.name === controlValue ? ' selected="selected"' : '';
              $optgroup.append('<option name="' + option.name + '"' + selected + '>' + option.name + '</option>');
            });
          }
        });
        $selector.select2('destroy');
        $selector.select2();
      });
    }
  });
  $(document).on('change', '.emoza-custom-font-item-input', function (event) {
    var $input = $(this);
    var $control = $input.closest('.emoza-custom-fonts-control');
    $(document).trigger('emoza-custom-font-update', [$control]);
  });
  $(document).on('click', '.emoza-custom-font-upload', function (e) {
    e.preventDefault();
    var $button = $(this);
    var wpMediaFrame = window.wp.media({
      library: {
        type: $button.data('type') || 'image'
      }
    }).open();
    wpMediaFrame.on('select', function () {
      var attachment = wpMediaFrame.state().get('selection').first().toJSON();
      $button.prev('.emoza-custom-font-item-input').val(attachment.url).trigger('change');
    });
  });
  $(document).on('click', '.emoza-custom-font-add', function (event) {
    var $button = $(this);
    var $control = $button.closest('.emoza-custom-fonts-control');
    var $list = $control.find('.emoza-custom-font-items');
    var $item = $control.find('.emoza-custom-font-item').first().clone();
    $item.removeClass('hidden');
    $list.append($item);
    $(document).trigger('emoza-custom-font-update', [$control]);
  });
  $(document).on('click', '.emoza-custom-font-remove', function (event) {
    var $button = $(this);
    var $item = $button.closest('.emoza-custom-font-item');
    var $control = $button.closest('.emoza-custom-fonts-control');
    $item.remove();
    $(document).trigger('emoza-custom-font-update', [$control]);
  });
});

/**
 * HTML5 Input Range (Track Color Support)
 */
jQuery(document).ready(function ($) {
  "use strict";

  $('.range-slider__range').on('change input emoza.range', function () {
    var $range = $(this);
    var value = $range.val() || 0;
    var min = $range.attr('min') || 0;
    var max = $range.attr('max') || 1;
    var percentage = (value - min) / (max - min) * 100;
    $range.css({
      'background': 'linear-gradient(to right, #2271b1 0%, #2271b1 ' + percentage + '%, #ddd ' + percentage + '%, #ddd 100%)'
    });
  }).trigger('emoza.range');
  $('.range-slider__value').on('change input', function () {
    var $slider = $(this).prev();
    if ($slider.hasClass('range-slider__range')) {
      $slider.trigger('emoza.range');
    }
  });
});

/**
 * Typography Preview
 */
jQuery(document).ready(function ($) {
  "use strict";

  var $previews = $('.emoza-typography-preview');
  if ($previews.length) {
    $previews.each(function (index) {
      var $preview = $(this);
      var options = $preview.data('options');
      $.each(options, function (prop, option) {
        if (prop === 'google_font') {
          wp.customize(option, function (value) {
            value.bind(function (to) {
              to = $.parseJSON(to);
              var family = to.font || '';
              var weight = to.regularweight || 400;
              var elemId = family.replace(/ /g, '-').toLowerCase() + '-' + weight;
              var href = 'https://fonts.googleapis.com/css?family=' + family.replace(/ /g, '+') + ':' + weight + '&display=swap';
              if ($('#' + elemId).length === 0) {
                $('head').append('<link id="' + elemId + '" href="' + href + '" rel="stylesheet">');
              }
              $preview.css('font-family', family);
              $preview.css('font-weight', weight);
            });
          });
        } else if (prop === 'adobe_font') {
          wp.customize(option, function (value) {
            value.bind(function (to) {
              to = to.split('|');
              if (to[0]) {
                $preview.css('font-family', to[0]);
              }
              if (to[1]) {
                $preview.css('font-weight', to[1].replace('n4', '400'));
              }
            });
          });
        } else if (prop === 'custom_font') {
          var customFontPreview = function customFontPreview(to, type) {
            var control = wp.customize.control(option + '_typography');
            var settings = _wpCustomizeSettings.controls[option + '_typography'];
            var family = control.settings['font-family'].get();
            var weight = control.settings['font-weight'].get();
            $preview.css('font-weight', 'normal');
            if (settings && settings.google_fonts) {
              $.map(settings.google_fonts, function (obj, index) {
                if (obj.family === family) {
                  if (type === 'family') {
                    weight = obj.variants[0];
                  }
                  var styleId = family.replace(/ /g, '-').toLowerCase() + '-' + weight;
                  var styleHref = 'https://fonts.googleapis.com/css?family=' + family.replace(/ /g, '+') + ':' + weight + '&display=swap';
                  if ($('#' + styleId).length === 0) {
                    $('head').append('<link id="' + styleId + '" href="' + styleHref + '" rel="stylesheet">');
                  }
                  $preview.css('font-weight', weight);
                }
              });
            }
            $preview.css('font-family', to);
          };
          wp.customize(option, function (value) {
            value.bind(function (to) {
              customFontPreview(to, 'family');
            });
          });
          wp.customize(option + '_weight', function (value) {
            value.bind(function (to) {
              customFontPreview(to, 'weight');
            });
          });
        } else {
          wp.customize(option, function (value) {
            value.bind(function (to) {
              if (to !== '' && isFinite(to)) {
                to = Number(to);
              }
              $preview.css(prop, to);
            });
          });
        }
      });
    });
  }
});

/* Color Control */
jQuery(document).ready(function ($) {
  var $colorControls = $('.emoza-color-control');
  if ($colorControls.length && Pickr) {
    var getCurrentSwatches = function getCurrentSwatches() {
      var isCustom = wp.customize.control('custom_palette_toggle').setting.get();
      var colors = [];
      if (isCustom) {
        $('#customize-control-custom_palette .emoza-color-input').each(function () {
          colors.push($(this).val());
        });
      } else {
        $('#customize-control-color_palettes .saved-palette .palette-color').each(function () {
          colors.push($(this).css('background-color'));
        });
      }
      return colors;
    };
    Pickr.prototype.setSwatches = function (swatches) {
      var _this = this;
      if (!swatches.length) {
        return;
      }
      for (var i = this._swatchColors.length - 1; i > -1; i--) {
        this.removeSwatch(i);
      }
      swatches.forEach(function (swatch) {
        return _this.addSwatch(swatch);
      });
    };
    $colorControls.each(function () {
      var $colorControl = $(this);
      var $colorPicker = $colorControl.find('.emoza-color-picker');
      var inited;
      $colorPicker.on('click', function () {
        if (!inited) {
          var $colorInput = $colorControl.find('.emoza-color-input');
          var customizeControl = wp.customize($colorInput.data('customize-setting-link'));
          var pickr = new Pickr({
            el: $colorPicker.get(0),
            container: 'body',
            theme: 'emoza-woocommerce',
            default: $colorInput.val() || '#212121',
            swatches: [],
            position: 'bottom-end',
            appClass: 'emoza-pcr-app',
            sliders: 'h',
            useAsButton: true,
            components: {
              hue: true,
              preview: true,
              opacity: true,
              interaction: {
                input: true,
                clear: true
              }
            },
            i18n: {
              'btn:clear': 'Default'
            }
          });
          pickr.on('change', function (color) {
            var colorCode;
            if (color.a === 1) {
              pickr.setColorRepresentation('HEX');
              colorCode = color.toHEXA().toString(0);
            } else {
              pickr.setColorRepresentation('RGBA');
              colorCode = color.toRGBA().toString(0);
            }
            $colorPicker.css({
              'background-color': colorCode
            });
            $colorInput.val(colorCode);
            customizeControl.set(colorCode);
          });
          pickr.on('show', function () {
            pickr.setSwatches(getCurrentSwatches());
          });
          pickr.on('clear', function () {
            var defaultColor = $colorPicker.data('default-color');
            if (defaultColor) {
              pickr.setColor(defaultColor);
            } else {
              $colorPicker.css({
                'background-color': 'white'
              });
              $colorInput.val('');
              customizeControl.set('');
            }
          });
          $colorPicker.data('pickr', pickr);
          setTimeout(function () {
            pickr.show();
          });
          inited = true;
        }
      });
    });
  }
});

/* Color Control */
jQuery(document).ready(function ($) {
  $('#customize-control-reset_colors').on('click', function () {
    var $label = $('.palette-radio-buttons').find('label').first();
    var control = wp.customize('color_palettes');
    $label.trigger('click');
    $label.find('.palette').trigger('click');
    control.set('');
    control.set('palette1');
  });
});

/* Dimensions Control */
(function ($) {
  var Emoza_Dimensions_Control = {
    init: function init() {
      this.events();
    },
    // Events
    events: function events() {
      $('.emoza-dimensions-control').find('.emoza-dimensions-input').on('input', this.setDimensionValue.bind(this));
      $('.emoza-dimensions-control').find('.emoza-dimensions-unit').on('change', this.unitSelectHandler.bind(this));
      $('.emoza-dimensions-control').find('.emoza-dimensions-link-btn').on('click', this.toggleLinkValues.bind(this));
    },
    // Change dimension
    setDimensionValue: function setDimensionValue(e) {
      var $inputToSave = $(e.target).closest('.emoza-dimensions-inputs').find('.emoza-dimensions-value'),
        value = this.getDimensionValue(e.target);
      $inputToSave.val(value).trigger('change');
    },
    // Mount value
    getDimensionValue: function getDimensionValue(input) {
      var deviceType = $(input).closest('.emoza-dimensions-inputs').data('device-type'),
        inputs = $(input).closest('.emoza-dimensions-inputs').find('.emoza-dimensions-input');
      var value = {
        unit: 'px',
        linked: false,
        top: '',
        right: '',
        bottom: '',
        left: ''
      };

      // Unit value
      value['unit'] = $(input).closest('.emoza-dimensions-control').find('.emoza-dimensions-units[data-device-type="' + deviceType + '"] .emoza-dimensions-unit').val();

      // Linked toggle
      value['linked'] = $(input).closest('.emoza-dimensions-control').find('.emoza-dimensions-link-values[data-device-type="' + deviceType + '"]').hasClass('linked');

      // Values
      if (!value['linked']) {
        inputs.each(function () {
          var side = $(this).data('side'),
            val = $(this).val();
          value[side] = val;
        });
      } else {
        var val = $(input).val();
        value['top'] = val;
        value['right'] = val;
        value['bottom'] = val;
        value['left'] = val;
        inputs.each(function () {
          $(this).val(val);
        });
      }
      return JSON.stringify(value);
    },
    unitSelectHandler: function unitSelectHandler(e) {
      var $this = $(e.target),
        deviceType = $(e.target).closest('.emoza-dimensions-units').data('device-type');

      // Trigger change in the first input to update the value
      $this.closest('.emoza-dimensions-control').find('.emoza-dimensions-inputs[data-device-type="' + deviceType + '"] .emoza-dimensions-input-wrapper:first-child .emoza-dimensions-input').trigger('change');
    },
    toggleLinkValues: function toggleLinkValues(e) {
      e.preventDefault();
      var $this = $(e.target),
        deviceType = $(e.target).closest('.emoza-dimensions-link-values').data('device-type');
      $this.closest('.emoza-dimensions-link-values').toggleClass('linked');

      // Trigger change in the first input to update the value
      $this.closest('.emoza-dimensions-control').find('.emoza-dimensions-inputs[data-device-type="' + deviceType + '"] .emoza-dimensions-input-wrapper:first-child .emoza-dimensions-input').trigger('change');
    }
  };
  $(document).ready(function () {
    Emoza_Dimensions_Control.init();
  });
})(jQuery);