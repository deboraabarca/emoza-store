<?php
/**
 * Header Builder.
 * Header Mobile Offcanvas Template File.
 * 
 * @package Emoza
 * @var array $args Contains mobile offcanvas data
 */
// @codingStandardsIgnoreStart WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
$row_data   = $args[ 'row_data' ];
$device     = 'mobile';

$component_args = array(
    'builder_type' => 'header',
    'device'       => $device
);

if( $row_data === NULL ) {
    return;
}

$elements = $row_data->mobile_offcanvas;

// Get instance from ehfb class
$ehfb = Emoza_Header_Footer_Builder::get_instance(); ?>

<div class="container">
    <div class="ehfb-row ehfb-cols-1">
        <?php 
        if( is_array( $elements[0] ) && count( $elements[0] ) > 0 ) : ?>

            <div class="ehfb-column ehfb-mobile-offcanvas-col">
                <?php foreach( $elements[0] as $component_callback ) {
                    if( method_exists( $ehfb, $component_callback  ) ) {
                        call_user_func( array( $ehfb, $component_callback ), $component_args );
                    } else if( class_exists( 'Emoza_Pro_HF_Builder_Components' ) ) {
                        $bp_bphfbc = Emoza_Pro_HF_Builder_Components::get_instance();

                        if( method_exists( $bp_bphfbc, $component_callback  ) ) {
                            call_user_func( array( $bp_bphfbc, $component_callback ), $component_args );
                        }
                    }
                } ?>

            </div>

        <?php 
        endif; ?>
    </div>
</div>
<?php // @codingStandardsIgnoreEnd WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound ?>