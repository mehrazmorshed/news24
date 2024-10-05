<?php
/**
 * Customizer for news24 theme.
 *
 * @package     news24
 * @author      Mehraz Morshed
 * @copyright   Copyright (c) 2020, Mehraz Morshed
 * @link        https://mehrazmorshed.com
 * @since       news24 1.0
 */

function news24_customize_register( $wp_customize ) {

    // Add Header Text Color control (this is supported by the custom-header feature)

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_textcolor', array(
        'label'    => __( 'Header Text Color', 'news24' ),
        'section'  => 'colors',
        'settings' => 'header_textcolor',
    ) ) );

    // Add Header Background Color setting and control

    $wp_customize->add_setting( 'header_background_color', array(
        'default'           => '#0073aa',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_control( $wp_customize, 'header_background_color', array(
        'label'    => __( 'Header Background', 'news24' ),
        'section'  => 'colors',
        'settings' => 'header_background_color',
    ) ) );

    // Add setting and control for link color

    $wp_customize->add_setting( 'news24_link_color' , array(
        'default'   => '#0073aa',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'news24_link_color', array(
        'label'      => __( 'Link Color', 'news24' ),
        'section'    => 'colors',
        'settings'   => 'news24_link_color',
    ) ) );

    // Add setting and control for text color

    $wp_customize->add_setting( 'news24_text_color', array(
        'default'           => '#333333',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'news24_text_color', array(
        'label'    => __( 'Text Color', 'news24' ),
        'section'  => 'colors',
        'settings' => 'news24_text_color',
    ) ) );

    // Add Excerpt Length Setting

    $wp_customize->add_setting( 'excerpt_length', array(
        'default'           => 20,
        'sanitize_callback' => 'absint',
    ) );

    // Add Excerpt Length Control

    $wp_customize->add_control( 'excerpt_length', array(
        'label'       => __( 'Excerpt Length', 'news24' ),
        'description' => __( 'Set the number of words for post excerpts.', 'news24' ),
        'section'     => 'title_tagline', // You can add a new section or use an existing one
        'type'        => 'number',
        'input_attrs' => array(
            'min' => 1,
        ),
    ) );

    // Add Read More Text Setting

    $wp_customize->add_setting( 'read_more_text', array(
        'default'           => __( 'Read more', 'news24' ),
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    // Add Read More Text Control
    
    $wp_customize->add_control( 'read_more_text', array(
        'label'       => __( 'Read More Text', 'news24' ),
        'description' => __( 'Set the text for the "Read more" link in excerpts.', 'news24' ),
        'section'     => 'title_tagline', // You can add a new section or use an existing one
        'type'        => 'text',
    ) );


    // Add a new section for the footer text
    $wp_customize->add_section( 'news24_footer_section', array(
        'title'       => __( 'Footer Text', 'news24' ),
        'priority'    => 130,
    ) );

    // Add the setting for the footer text
    $wp_customize->add_setting( 'news24_footer_text', array(
        'default'           => __( '<a href="https://wordpress.org/themes/news24/">news24 WordPress Theme</a>', 'news24' ),
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    // Add the control for the footer text
    $wp_customize->add_control( 'news24_footer_text', array(
        'label'    => __( 'Footer Text', 'news24' ),
        'section'  => 'news24_footer_section',
        'type'     => 'text',
    ) );


}

add_action( 'customize_register', 'news24_customize_register' );

function news24_customize_css() {
    ?>
    <style type="text/css">
        a { color: <?php echo esc_attr( get_theme_mod( 'news24_link_color', '#0073aa' ) ); ?>; }
        #secondary.widget-area ul li a { color: <?php echo esc_attr( get_theme_mod( 'news24_link_color', '#0073aa' ) ); ?>; }
        body { 
            color: <?php echo esc_attr( get_theme_mod( 'news24_text_color', '#333333' ) ); ?>; 
        }
        header.site-header a { color: #<?php echo esc_attr( get_header_textcolor() ); ?>; }
        header.site-header { 
            background-color: <?php echo esc_attr( get_theme_mod( 'header_background_color', '#0073aa' ) ); ?>;
            color: #<?php echo esc_attr( get_header_textcolor() ); ?>;
        }
    </style>
    <?php
}
add_action( 'wp_head', 'news24_customize_css' );
?>