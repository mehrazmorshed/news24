<?php
/**
 * news24 functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package News24
 * @since 1.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Define Constants
 */
define( 'NEWS24_THEME_VERSION', '1.0' );
define( 'NEWS24_THEME_SETTINGS', 'news24-settings' );
define( 'NEWS24_THEME_DIR', trailingslashit( get_template_directory() ) );
define( 'NEWS24_THEME_URI', trailingslashit( esc_url( get_template_directory_uri() ) ) );

/**
 * Register necessary features
 */
if ( ! function_exists( 'news24_setup' ) ) :

    function news24_setup() {

        load_theme_textdomain( 'news24', get_template_directory() . '/languages' );

        add_theme_support( 'automatic-feed-links' );

        add_theme_support( 'title-tag' );

        add_theme_support( 'post-thumbnails' );

        register_nav_menus( array(
            'primary' => esc_html__( 'Primary Menu', 'news24' ),
        ) );

        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ) );

        add_theme_support( 'custom-background', apply_filters( 'news24_custom_background_args', array(
            'default-color' => 'dddddd',
            'default-image' => '',
        ) ) );

        add_theme_support( 'customize-selective-refresh-widgets' );

        // Support for default block styles
        add_theme_support( 'wp-block-styles' );

        // Support for responsive embeds
        add_theme_support( 'responsive-embeds' );

        // Support for custom logo
        add_theme_support( 'custom-logo', array(
            'height'      => 100,
            'width'       => 400,
            'flex-height' => true,
            'flex-width'  => true,
        ) );

        // Support for custom header
        add_theme_support( 'custom-header', array(
            'default-image'      => '',
            'default-text-color' => 'dddddd',
            'width'              => 1000,
            'height'             => 250,
            'flex-width'         => true,
            'flex-height'        => true,
            'header-text'        => true,
        ) );

        // Support for wide alignment
        add_theme_support( 'align-wide' );

    }

endif;

add_action( 'after_setup_theme', 'news24_setup' );

/**
 * Define content width
 */
function news24_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'news24_content_width', 640 );
}

add_action( 'after_setup_theme', 'news24_content_width', 0 );

/**
 * Register Sidebar  and Initialize Widgets
 */
function news24_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar', 'news24' ),
        'id'            => 'sidebar-1',
        'description'   => esc_html__( 'Add widgets here.', 'news24' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}

add_action( 'widgets_init', 'news24_widgets_init' );

/**
 * Enqueue css and js files
 */
function news24_scripts() {

    // Enqueue Default Theme Style
    wp_enqueue_style( 'news24-style', get_stylesheet_uri() );

    // Enqueue Font Awesome
    wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.css', array(), '1.0', 'all' );

    // Enqueue jQuery
    wp_enqueue_script( 'jquery' );

    // Enqueue Custom Navigation
    wp_enqueue_script( 'news24-navigation', get_template_directory_uri() . '/assets/js/menu.js', array('jquery'), '1.0', true );

    // Enqueue Submenu Keyboard Navigation
    wp_enqueue_script('news24-keyboard-navigation', get_template_directory_uri() . '/assets/js/news24-keyboard-navigation.js', array('jquery'), null, true);
}

add_action( 'wp_enqueue_scripts', 'news24_scripts' );

/**
 * Set default thumbnail size
 */
set_post_thumbnail_size( 1200, 9999 ); // Unlimited height, soft crop

/**
 * Define custom thumbnail sizes
 */
add_image_size( 'news24-featured', 800, 400, true ); // 800 pixels wide by 400 pixels tall, hard crop mode

/**
 * Required files
 */
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/sanitize.php';

/**
 * Register custom block styles
 */
function news24_register_block_styles() {
    register_block_style(
        'core/quote',
        array(
            'name'  => 'fancy-quote',
            'label' => __( 'Fancy Quote', 'news24' ),
        )
    );
}
add_action( 'init', 'news24_register_block_styles' );

/**
 * Register custom block patterns
 */
function news24_register_block_patterns() {
    register_block_pattern(
        'news24/hero-section',
        array(
            'title'       => __( 'Hero Section', 'news24' ),
            'description' => _x( 'A custom hero section with a background image and heading.', 'Block pattern description', 'news24' ),
            'content'     => "<!-- wp:cover {\"url\":\"" . esc_url( get_template_directory_uri() ) . "/assets/images/hero.jpg\"} -->\n<div class=\"wp-block-cover\"><span aria-hidden=\"true\" class=\"wp-block-cover__background has-background-dim\"></span><div class=\"wp-block-cover__inner-container\"><!-- wp:heading {\"textAlign\":\"center\",\"level\":1} -->\n<h1 class=\"has-text-align-center\">Welcome to news24</h1>\n<!-- /wp:heading --></div></div>\n<!-- /wp:cover -->",
        )
    );
}

add_action( 'init', 'news24_register_block_patterns' );

/**
 * Add editor styles
 */
function news24_add_editor_styles() {
    add_editor_style( 'assets/css/editor-style.css' );
}

add_action( 'admin_init', 'news24_add_editor_styles' );

/**
 * Enqueue the comment-reply script
 */
function news24_enqueue_comment_reply_script() {
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}

add_action( 'wp_enqueue_scripts', 'news24_enqueue_comment_reply_script' );

function news24_custom_excerpt_length( $length ) {
    $custom_excerpt_length = get_theme_mod( 'excerpt_length', 20 );
    return $custom_excerpt_length;
}

add_filter( 'excerpt_length', 'news24_custom_excerpt_length', 999 );

function news24_excerpt_more( $more ) {
    $read_more_text = get_theme_mod( 'read_more_text', __( 'Read more', 'news24' ) );
    return '... <a class="read-more" href="' . get_permalink( get_the_ID() ) . '">' . esc_html( $read_more_text ) . '</a>';
}

add_filter( 'excerpt_more', 'news24_excerpt_more' );