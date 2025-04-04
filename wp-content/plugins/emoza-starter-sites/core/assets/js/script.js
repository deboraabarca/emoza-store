"use strict";


//
// Demo Importer
//
(function ($) {
  'use strict';

  var $body = $('body');
  var emwcTimer;
  var emwcDemoItem;
  var emwcTakenTime = 1;
  var emwcDoneOrFail = false;
  var emwcAjaxImportRecursive = function emwcAjaxImportRecursive($form, steps, step) {
    step++;
    if (steps.length > step && steps[step]) {
      var importLog = steps[step].log || '';
      var importPer = Math.max(5, Math.round(100 / steps.length * step));
      $form.find('.emwc-import-progress-label').html(importLog);
      $form.find('.emwc-import-progress-sublabel').html(importPer + '%');
      $form.find('.emwc-import-progress-indicator').attr('style', '--emwc-indicator: ' + importPer + '%;');
      var nonce = window.emwc_localize.nonce;
      var demo_id = $form.find('input[name="demo_id"]').val();
      var builder_type = $form.find('input[name="builder_type"]:checked').val();
      var content_type = $form.find('input[name="content_type"]:checked').val();

      var color_scheme = $form.find('input[name="emwc_color_scheme"]').val();
      var logo = $form.find('input[name="emwc_logo_url"]').val();
      var favicon = $form.find('input[name="emwc_icon_url"]').val();
      

      var data = $.extend({
        nonce: nonce,
        demo_id: demo_id,
        builder_type: builder_type,
        content_type: content_type,
        color_scheme: color_scheme,
        logo: logo,
        favicon: favicon
      }, steps[step]);
      delete data.log;
      delete data.priority;
      $.post(window.emwc_localize.ajax_url, data, function (response) {
        if (response.success) {
          if (response.status && response.status === 'newAJAX') {
            step--;
          }
          setTimeout(function () {
            emwcAjaxImportRecursive($form, steps, step);
          }, 500);
        } else if (response.data) {
          $form.find('.emwc-import-step-error').addClass('emwc-active').siblings().removeClass('emwc-active');
          $form.find('.emwc-import-error-log').html(response.data);
          $body.removeClass('emwc-import-in-progress');
        } else {
          var errorLog = window.emwc_localize.i18n.import_failed;
          if (response) {
            errorLog += '<div class="emwc-import-error-response">' + _.escape(response) + '</div>';
          }
          $form.find('.emwc-import-step-error').addClass('emwc-active').siblings().removeClass('emwc-active');
          $form.find('.emwc-import-error-log').html(errorLog);
          $body.removeClass('emwc-import-in-progress');
        }
      }).fail(function () {
        $form.find('.emwc-import-step-error').addClass('emwc-active').siblings().removeClass('emwc-active');
        $form.find('.emwc-import-error-log').html(window.emwc_localize.i18n.import_failed);
        $body.removeClass('emwc-import-in-progress');
      });
    } else {
      $form.find('.emwc-import-progress-label').html(window.emwc_localize.i18n.import_finished);
      $form.find('.emwc-import-progress-sublabel').html('100%');
      $form.find('.emwc-import-progress-indicator').attr('style', '--emwc-indicator: 100%;');

      // Tweet
      var tweetText = window.emwc_localize.i18n.tweet_text.replace('{0}', emwcTakenTime);
      $form.find('.emwc-import-finish-tweet-text').html(tweetText);
      $form.find('.emwc-import-finish-tweet-button').attr('href', 'https://twitter.com/intent/tweet?text=' + tweetText);
      setTimeout(function () {
        $form.find('.emwc-import-step').removeClass('emwc-active');
        $form.find('.emwc-import-step-finish').addClass('emwc-active');
        $body.removeClass('emwc-import-in-progress');
      }, 250);
      emwcDemoItem.addClass('emwc-demo-item-imported').siblings().removeClass('emwc-demo-item-imported');
      clearInterval(emwcTimer);
      emwcTakenTime = 1;
    }
    emwcDoneOrFail = true;
  };
  $(document).ready(function () {
    // Dismissable
    var $notice = $('.emwc-notice');
    if ($notice.length) {
      $notice.find('.notice-dismiss').on('click', function () {
        $notice.parent().hide();
        $.post(window.emwc_localize.ajax_url, {
          action: 'emwc_dismissed_handler',
          nonce: window.emwc_localize.nonce
        });
      });
    }

    // Demos
    var $emwc = $('.emwc');
    if ($emwc.length) {
      var $demos = $emwc.find('.emwc-demo-item');
      var $import = $emwc.find('.emwc-import');
      var $preview = $emwc.find('.emwc-preview');
      var demoIndex;
      $emwc.on('click', '.emwc-demo-preview-button', function (e) {
        e.preventDefault();
        var $button = $(this);
        var $demo = $button.closest('.emwc-demo-item');
        var demoObj = {
          preview: $button.attr('href'),
          info: $demo.find('.emwc-demo-info').html(),
          actions: $demo.find('.emwc-demo-actions').html()
        };
        if ($body.hasClass('emwc-preview-show')) {
          $preview.find('.emwc-preview-iframe').attr('src', demoObj.preview);
          $preview.find('.emwc-preview-header-info').html(demoObj.info);
          $preview.find('.emwc-preview-header-actions').html(demoObj.actions);
        } else {
          var template = wp.template('emwc-preview');
          $preview.html(template(demoObj));
        }
        $body.addClass('emwc-preview-show');
        demoIndex = $demo.index();
        $emwc.trigger('emwc-nav-click', [demoIndex]);
      });
      $emwc.on('click', '.emwc-preview-header-arrow-prev', function (e) {
        e.preventDefault();
        if (!$(this).hasClass('emwc-disabled')) {
          demoIndex--;
          $demos.eq(demoIndex).find('.emwc-demo-preview-button').trigger('click');
        }
      });
      $emwc.on('click', '.emwc-preview-header-arrow-next', function (e) {
        e.preventDefault();
        if (!$(this).hasClass('emwc-disabled')) {
          demoIndex++;
          $demos.eq(demoIndex).find('.emwc-demo-preview-button').trigger('click');
        }
      });
      $emwc.on('click', '.emwc-preview-cancel-button', function (e) {
        e.preventDefault();
        $body.removeClass('emwc-preview-show');
        $preview.empty();
      });
      $emwc.on('emwc-nav-click', function (e, index) {
        var $prev = $emwc.find('.emwc-preview-header-arrow-prev');
        var $next = $emwc.find('.emwc-preview-header-arrow-next');
        if (index === 0) {
          $prev.addClass('emwc-disabled');
          $next.removeClass('emwc-disabled');
        } else if ($demos.length - 1 === index) {
          $next.addClass('emwc-disabled');
          $prev.removeClass('emwc-disabled');
        } else {
          $next.removeClass('emwc-disabled');
          $prev.removeClass('emwc-disabled');
        }
      });
      $emwc.on('click', '.emwc-demo-remove-button', function (e) {
        e.preventDefault();
        var $demo = $(this).closest('.emwc-demo-item'); 
        $demo.find('.emwc-import-open-button').trigger('click');
        $emwc.find('.emwc-import-step.emwc-active .emwc-import-next-button').trigger('click');
        $emwc.find('.emwc-import-form .emwc-import-checkboxes:first-of-type input').prop('checked', false);
        $emwc.find('.emwc-import-form .emwc-import-clean-checkboxes input').prop('checked', true);
      });
      $emwc.on('click', '.emwc-import-open-button', function (e) {
        e.preventDefault();
        var demoId = $(this).data('demo-id');
        var colorScheme = $(this).data('color-scheme');
        var demoObj = window.emwc_localize.demos[demoId];
        var template = wp.template('emwc-import');
        if (demoObj && demoObj.builders.length) {
          emwcDemoItem = $(this).closest('.emwc-demo-item');

          // create args object
          demoObj.args = {};
          demoObj.args.demoId = demoId;
          demoObj.args.colorScheme = colorScheme;
          demoObj.args.quick = $(this).data('quick') || demoObj.builders.length < 2 || false;
          demoObj.args.builder = $(this).data('builder') || demoObj.builders[0];
          demoObj.args.imported = window.emwc_localize.imported || emwcDoneOrFail;
          $emwc.find('.emwc-import').html(template(demoObj));
          $body.addClass('emwc-import-show');
        }
 
        // send message to iframe
          var sendPalette = function(paletteValues) {
              var frame = document.getElementById('emwc-demo-frame').contentWindow;
     
              var params = {
                  command: 'changeColorPalette',
                  palette: paletteValues,
              };
      
              frame.postMessage(JSON.stringify(params), '*');
          };
  
          // init color picker
          var colorPickers = document.querySelectorAll('.emwc-color-picker');
          var paletteInputs = document.querySelectorAll('.emwc-color-picker-input');
          var paletteValues = [];
      
          paletteInputs.forEach(function(input, index) {
              input.setAttribute('data-index', index);
      
              input.addEventListener('change', function() {
                  var inputIndex = input.getAttribute('data-index');
                  paletteValues[inputIndex] = input.value;
                  sendPalette(paletteValues);
              });
          });
      
          colorPickers.forEach(function(wrapper) {
              const pickr = Pickr.create({
                  el: wrapper.querySelector('.pickr-holder'),
                  theme: 'emwc',
                  default: wrapper.querySelector('.emwc-color-picker-input').value,
                  sliders: 'h',
                  swatches: [],
                  components: {
                      preview: true,
                      opacity: true,
                      hue: true,
                      interaction: {
                          hex: true,
                          rgba: true,
                          input: true,
                          clear: true,
                          save: false
                      }
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
      
                  var input = wrapper.querySelector('.emwc-color-picker-input');
                  input.value = colorCode;
                  input.dispatchEvent(new Event('change'));
      
                  //get the button
                  var button = wrapper.querySelector('.pcr-button');
                  //set the background color
                  button.style.backgroundColor = colorCode;
              });

              var resetButton = wrapper.parentElement.parentElement.parentElement.querySelector('.emwc-import-reset-button');

              resetButton.addEventListener('click', function() {
                  pickr.setColor(wrapper.querySelector('.emwc-color-picker-input').getAttribute('data-default'));
              });

          });        
      });

      var sendLogo = function(logo) {
        var frame = document.getElementById('emwc-demo-frame').contentWindow;

        var params = {
            command: 'changeLogo',
            logo: logo,
        };

        frame.postMessage(JSON.stringify(params), '*');
    };

      $emwc.on('click', '.emwc-media-button', function (e) {
        e.preventDefault();
        var mediaUploader;
        
        if (mediaUploader) {
            mediaUploader.open();
            return;
        }

        mediaUploader = wp.media({
            frame: 'post',
            state: 'insert',
            multiple: false
        });

        mediaUploader.on('insert', function() {
            var attachment = mediaUploader.state().get('selection').first().toJSON();
            
            //if has class emwc-logo-upload-button
            if ($(e.target).hasClass('emwc-logo-upload-button')) {
                $('.emwc-logo-upload-input').val(attachment.url);
                sendLogo(attachment.url);
            } else {
                $('.emwc-icon-upload-input').val(attachment.url);
            }
        });

        mediaUploader.open();
      });

      $emwc.on('click', '.emwc-import-close-button', function (e) {
        e.preventDefault();
        $body.removeClass('emwc-import-show');
      });
      $emwc.on('click', '.emwc-import-toggle-button', function (e) {
        e.preventDefault();
        $(this).parent().toggleClass('emwc-active');
      });
      $emwc.on('click', '.emwc-import-prev-button', function (e) {
        e.preventDefault();
        var $step = $(this).closest('.emwc-import-step');
        $step.removeClass('emwc-active');
        $step.prev().addClass('emwc-active');
      });
      $emwc.on('click', '.emwc-import-next-button', function (e) {
        e.preventDefault();
        var $step = $(this).closest('.emwc-import-step');
        $step.removeClass('emwc-active');
        $step.next().addClass('emwc-active');

        if ($(this).hasClass('emwc-import-customize-button')) {
          $emwc.find('.emwc-import-form').addClass('emwc-import-form-customize');
        } else {
          $emwc.find('.emwc-import-form').removeClass('emwc-import-form-customize');
        }

        var $form = $emwc.find('.emwc-import-form');

      if ($(this).hasClass('emwc-import-save-custom-data-button')) {
          e.preventDefault();
          
          var nonce = window.emwc_localize.nonce;
          var $colorPickerInputs = $form.find('.emwc-color-picker-input');

          var color_scheme = [];
          $colorPickerInputs.each(function () {
              color_scheme.push($(this).val());
          });    
        var logo = $form.find('input[name="emwc_logo_url"]').val();
          var favicon = $form.find('input[name="emwc_icon_url"]').val();

          $.ajax({
              url: window.emwc_localize.ajax_url,
              data: {
                  action: 'save_emwc_custom_data',
                  nonce: nonce,
                  color_scheme: color_scheme,
                  logo: logo,
                  favicon: favicon
              },
              method: 'POST', // POST method
              success: function (response) {
                  console.log(response);
              },
              error: function (error) {
                  console.log(error);
              }
          });
      }
      });

      $emwc.on('click', '.emwc-import-skip-button', function (e) {
        e.preventDefault();
        var $step = $(this).closest('.emwc-import-step');
        $step.removeClass('emwc-active');
        $step.next().next().addClass('emwc-active');
       
      });

      $emwc.on('change', '.emwc-import-builder-select input', function (e) {
        $emwc.find('.emwc-import-plugin-builder').addClass('emwc-hidden');
        $emwc.find('.emwc-import-plugin-builder input').prop('checked', false);
        if ($(this).is(':checked')) {
          var $builder = $emwc.find('.emwc-import-plugin-' + $(this).data('builder-plugin'));
          if ($(this).data('builder-plugin')==='elementor') {
            $emwc.find('.emwc-import-plugin-stackable-ultimate-gutenberg-blocks').addClass('emwc-hidden'); // hide Stackable Ultimate Gutenberg Blocks
            $emwc.find('.emwc-import-plugin-stackable-ultimate-gutenberg-blocks input').prop('checked', false);
          }else {
            $emwc.find('.emwc-import-plugin-stackable-ultimate-gutenberg-blocks').removeClass('emwc-hidden');
            $emwc.find('.emwc-import-plugin-stackable-ultimate-gutenberg-blocks input').prop('checked', true);
          }
          $builder.removeClass('emwc-hidden');
          $builder.find('input').prop('checked', true);
        }
      });
      $emwc.on('click', '.emwc-import-with-content-type', function () {
        var isChecked = true;
        $('.emwc-import-with-content-type').each(function () {
          if (!$(this).is(':checked')) {
            isChecked = false;
          }
        });
        if (isChecked) {
          $emwc.find('.emwc-import-content-select').removeClass('emwc-hidden');
        } else {
          $emwc.find('.emwc-import-content-select').addClass('emwc-hidden');
        }
      });
      $emwc.on('click', '.emwc-import-start-button', function (e) {
        e.preventDefault();
        var $form = $emwc.find('.emwc-import-form');
        if ($(this).data('subscribe')) {
          var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
          var $email = $form.find('.emwc-import-subscribe-field-email');
          var emailValue = $email.val();
          if (!regex.test(emailValue)) {
            $email.addClass('emwc-error').attr('placeholder', window.emwc_localize.i18n.invalid_email).val('');
            return;
          }

          // send email on subscribe form.
          // later we will send email on import form.
          /*$.ajax({
            url: window.emwc_localize.ajax_url,
            data: {
              action: 'send_email',
              email: emailValue
            },
            method: 'POST', // POST method
            success: function (response) {
              console.log(response);
            },
            error: function (error) {
              console.log(error);
            }
          });*/
        }
        var $step = $(this).closest('.emwc-import-step');
        $step.removeClass('emwc-active');
        $step.next().addClass('emwc-active');

        // Import Plugins
        var steps = [];
        var $inputs = $form.find('input[data-action]');
        $inputs.each(function (index) {
          if ($(this).is(':checked') || $(this).is('[type="hidden"]')) {
            steps.push($(this).data());
          }
        });

        // Set Priority
        steps = steps.sort(function (a, b) {
          return a.priority - b.priority;
        });
        emwcTakenTime = 1;
        emwcTimer = setInterval(function () {
          emwcTakenTime++;
        }, 1000);
        $body.addClass('emwc-import-in-progress');
        emwcAjaxImportRecursive($form, steps, -1);
      });
    }
  });

})(jQuery);