<?php
class Emoza_Typography_Adobe_Kits_Control extends WP_Customize_Control {
    /**
     * The type of control being rendered
     */
    public $type = 'emoza-adobe_fonts_kits';

    public $kits = array();
    
    /**
     * Get our list of fonts from the json file
     */
    public function __construct( $manager, $id, $args = array(), $options = array() ) {
        parent::__construct( $manager, $id, $args );
        
        $this->kits = get_option( 'emoza_adobe_fonts_kits' );
    }

    /**
     * Render the control in the customizer
     */
    public function render_content() { ?> 

        <?php if( !empty( $this->label ) ) { ?>
            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
        <?php } ?>	
        <?php if( !empty( $this->description ) ) { ?>
            <span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
        <?php } ?>							
        
        <div style="margin-bottom: 25px;">
            <?php if( ! defined( 'EMOZA_WL_ACTIVE' ) ) : ?>
                <p style="margin-top: 0;">
                    <?php 
                    echo wp_kses_post( 
                        sprintf(
                            /* translators: 1: How to use adobe fonts docs link */
                            __( 'To use fonts from Adobe some steps are required. Learn more about that <a href="%s" target="_blank">here</a>.', 'emoza-woocommerce' ),
                            'https://docs.emoza.org/'
                        )
                    ); ?>
                </p>
            <?php endif; ?>
            <label for="<?php echo esc_attr( $this->id ); ?>" class="customize-control-title"><?php echo esc_html__( 'API Token', 'emoza-woocommerce' ); ?></label>
            <input id="<?php echo esc_attr( $this->id ); ?>" type="text" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); ?> />

            <span class="customize-control-description" style="margin-top: 10px; margin-bottom: 10px;">
                <?php 
                echo wp_kses_post( 
                    sprintf(
                        /* translators: 1: Adobe Fonts account website link */
                        __( 'You can get your Adobe Fonts API Token by clicking <a href="%s" target="_blank">here</a>.', 'emoza-woocommerce' ),
                        'https://fonts.adobe.com/account/tokens/'
                    )
                ); ?>
            </span>

            <a href="#" class="button button-secondary emoza-adobe_fonts_kits_submit_token" data-nonce="<?php echo esc_attr( wp_create_nonce( 'customize-typography-adobe-kits-control-nonce' ) ); ?>" data-loading-text="<?php echo esc_attr__( 'Loading...', 'emoza-woocommerce' ); ?>" data-default-text="<?php echo esc_attr__( 'Get Fonts', 'emoza-woocommerce' ); ?>"><?php echo esc_html__( 'Get Fonts', 'emoza-woocommerce' ); ?></a>
        </div>
        
        <div class="emoza-adobe_fonts_kits_ajax_wrapper">
            <?php emoza_customize_control_adobe_font_kits_output( $this->kits ); ?>
        </div>

        <?php 
    }
}