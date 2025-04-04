<?php
/**
 * Header/Footer Builder
 * Logo Component
 * 
 * @package Emoza_Pro
 * @var array $params Contains component data
 */ 

?>

<div class="ehfb-builder-item ehfb-component-logo" data-component-id="logo">
    <?php $this->customizer_edit_button(); ?>
    <div class="site-branding" <?php emoza_schema( 'logo' ); ?>>
        <?php
        the_custom_logo();
        if ( ( is_front_page() ) && $params[ 'device' ] !== 'mobile' ) :
            ?>
            <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
            <?php
        else :
            ?>
            <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
            <?php
        endif;
        $emoza_description = get_bloginfo( 'description', 'display' );
        if ( $emoza_description || is_customize_preview() ) :
            ?>
            <p class="site-description"><?php echo $emoza_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
        <?php endif; ?>
    </div><!-- .site-branding -->
</div>