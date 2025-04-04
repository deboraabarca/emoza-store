<?php
/**
 * Footer Builder
 * Widget 3 Component
 * 
 * @package Emoza_Pro
 */ 
?>

<div class="ehfb-builder-item ehfb-component-widget3" data-component-id="widget3">
    <?php $this->customizer_edit_button(); ?>
    <?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
        <div class="footer-widget">
            <div class="widget-column">
                <?php dynamic_sidebar( 'footer-3' ); ?>
            </div>
        </div>
    <?php endif; ?>
</div>