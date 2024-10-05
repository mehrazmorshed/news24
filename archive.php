<?php
/**
 * The template for displaying archive pages.
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

    <?php if ( have_posts() ) : ?>

        <header class="page-header">
            <?php
            the_archive_title( '<h1 class="page-title">', '</h1>' );
            the_archive_description( '<div class="archive-description">', '</div>' );
            ?>
        </header><!-- .page-header -->
<hr>
        <?php
        /* Start the Loop */
        while ( have_posts() ) :
            the_post();

            /*
             * Include the Post-Type-specific template for the content.
             * If you want to override this in a child theme, then include a file
             * called content-___.php (where ___ is the Post Type name) and that will be used instead.
             * removed: get_template_part( 'template-parts/content', get_post_type() );
             */
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
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

                </article><!-- #post-<?php the_ID(); ?> -->
                <br><hr>
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
</div>

<?php
get_sidebar();
get_footer();
?>
