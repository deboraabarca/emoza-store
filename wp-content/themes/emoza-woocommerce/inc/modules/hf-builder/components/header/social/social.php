<?php
/**
 * Header/Footer Builder
 * Social Component
 * 
 * @package Emoza_Pro
 */

echo '<div class="ehfb-builder-item ehfb-component-social" data-component-id="social">';
    $this->customizer_edit_button();
    emoza_social_profile( 'social_profiles_topbar' );
echo '</div>';