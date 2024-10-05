<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package news24
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

?>
    </div><!-- #content -->
<footer id="colophon" class="site-footer">
    <div class="site-info">
        <?php
        $footer_text = get_theme_mod( 'news24_footer_text', __( '<a href="https://wordpress.org/themes/news24/">news24 WordPress Theme</a>', 'news24' ) );
        echo wp_kses_post( $footer_text );
        ?>
    </div><!-- .site-info -->
</footer><!-- #colophon -->
</div><!-- #page -->
<?php wp_footer(); ?>
</body>
</html>
