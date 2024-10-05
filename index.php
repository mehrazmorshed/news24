<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
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
            <?php

            if ( have_posts() ) :
                if ( is_home() && ! is_front_page() ) :
                    ?>
                <header>
                    <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
                </header>
                <?php
            endif;

            echo '<div id="dotted"></div>';


while ( have_posts() ) : the_post();
    ?>
    <article class="dotted post-wrapper" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="post-thumbnail-wrapper">
            <?php if ( has_post_thumbnail() ) : // Display featured image ?>
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail('medium'); ?>
                </a>
            <?php endif; ?>
        </div><!-- .post-thumbnail-wrapper -->

        <div class="post-content-wrapper">
            <header class="entry-header">
                <?php
                if ( is_singular() ) :
                    the_title( '<h1 class="entry-title">', '</h1>' );
                else :
                    the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
                endif;
                ?>

                <div class="entry-meta">
                    <?php news24_posted_on(); ?>
                </div><!-- .entry-meta -->

            </header><!-- .entry-header -->

            <div class="entry-content">
                <?php the_excerpt(); ?>
            </div><!-- .entry-content -->

            <footer class="entry-footer">
                <?php news24_entry_footer(); ?>
            </footer><!-- .entry-footer -->
        </div><!-- .post-content-wrapper -->
    </article><!-- #post-<?php the_ID(); ?> -->
<?php
endwhile;



            // pagination

            the_posts_pagination( array(
                'mid_size'  => 2,
                'prev_text' => __( 'Previous', 'news24' ),
                'next_text' => __( 'Next', 'news24' ),
            ) );
 
            else :
            get_template_part( 'template-parts/content', 'none' );
            endif;
            ?>
        </main><!-- #main -->
    </div><!-- #primary -->
<?php
get_sidebar();
get_footer();