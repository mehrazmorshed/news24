<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package News24
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

get_header();
?>
    <div id="primary" class="content-area">
        <main id="main" class="site-main">
        <?php if ( have_posts() ) : ?>
            <header class="page-header">
                <h1 class="page-title">
                    <?php printf( esc_html__( 'Search Results for: %s', 'news24' ), '<span>' . get_search_query() . '</span>' ); ?>
                </h1>
            </header><!-- .page-header -->
            <?php
            while ( have_posts() ) : the_post();
                get_template_part( 'template-parts/content', 'search' );
            endwhile;
            the_posts_navigation();
        else :
            get_template_part( 'template-parts/content', 'none' );
        endif;
        ?>
        </main><!-- #main -->
    </div><!-- #primary -->
<?php
get_sidebar();
get_footer();
