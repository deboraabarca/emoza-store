(function($){

    /*
     * Customize
     * Emoza Custom Accordion Control
     *
     */

    'use strict';

    var Emoza_Accordion = {
		init: function(){
			this.firstTime = true;
			if( !this.initialized ) {
				this.events();
			}
			this.initialized = true;
		},
		events: function(){
			var self = this;
			// Toggle accordion
			$( document ).on('click', '.emoza-accordion-title', function(){
				var $this = $(this);
				if( $(this).hasClass('expanded') ) {
					self.showOrHide( $(this), 'hide' );
					$(this).removeClass('expanded').addClass('collapse');
					setTimeout(function(){
						$this.removeClass('collapse');
					}, 300);
				}
				if( !$(this).hasClass('collapse') ) {
					// Open one accordion item per time 
					$('.emoza-accordion-item').addClass('emoza-accordion-hide');
					$('.emoza-accordion-title').removeClass('expanded');
					// Show accordion content
					self.showOrHide( $(this), 'show' );
					$this.addClass('expanded');
				}
			});
			// Mount the accordion when enter in the section (with accordions inside)
			// Also used to collapse all accordions when navigating between others tabs
			$( document ).on('click', '.control-section', function(e){
				var $section = $('.control-section.open');
				if( self.firstTime && $section.find('.emoza-accordion-title').length ) {
					$section.find('.emoza-accordion-title').each(function(){
						self.showOrHide( $(this), 'hide' );
						$(this).removeClass('expanded');
						self.firstTime = false;
					});
				}
			});
			// Reset the first time
			$( document ).on('click', '.customize-section-back', function(){
				self.firstTime = true;
			});
			return this;
		},
		showOrHide: function( $this, status ) {
			var current = '';
			current = $this.closest('.customize-control').next();
			var elements = [];
			if( current.attr( 'id' ) == 'customize-control-' + $this.data('until') ) {
				elements.push( current[0].id );
			} else {
				while( current.attr( 'id' ) != 'customize-control-' + $this.data('until') ) {
					elements.push( current[0].id );
					current = current.next();
				}
			}
			if( elements.length >= 1 ) {
				elements.push( current[0].id );
			}
			for( var i = 0; i < elements.length; i++ ) {
				// Identify accordion items
				$( '#'+elements[i] ).addClass('emoza-accordion-item active');
				// Hide or show the accordion content
				if( status == 'hide' ) {
					$( '#'+elements[i] ).addClass('emoza-accordion-hide');
				} else {
					$( '#'+elements[i] ).removeClass('emoza-accordion-hide');
				}
				// Identify first accordion item
				if( i == 0 ) {
					$( '#'+elements[i] ).addClass('emoza-accordion-first-item')
				}
				// Identify last accordion item
				if( i == elements.length - 1 && elements.length > 1 || elements.length == 1 ) {
					$( '#'+elements[i] ).addClass('emoza-accordion-last-item')
				}
			}
			return this;
		}
	}

	$( document ).ready(function($) {
		Emoza_Accordion.init();	
	} );

})(jQuery);