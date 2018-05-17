<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package portfolio
 */

get_header(); ?>

    <div id="primary" class="content-area ">
        <main id="main" class="site-main grid" role="main">

        <?php
        while ( have_posts() ) : the_post();?>


<article id="post-<?php the_ID(); ?>" <?php post_class('col-1-1'); ?>>


    <header class="entry-header padded">

        <?php
        if ( is_single() ) :
            the_title( '<h1 class="entry-title">', '</h1>' );
        else :
            the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
        endif;

        if ( 'post' === get_post_type() ) : ?>
        <div class="entry-meta">
            <?php portfolio_posted_on(); ?>
        </div><!-- .entry-meta -->
        <?php
        endif; ?>
    </header><!-- .entry-header -->
 
    <div class="entry-content padded">
        <?php
            the_content( sprintf(
                /* translators: %s: Name of current post. */
                wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'portfolio' ), array( 'span' => array( 'class' => array() ) ) ),
                the_title( '<span class="screen-reader-text">"', '"</span>', false )
            ) );

        
            $client = get_post_meta( get_the_ID(), 'portfolio_client', true );
            if (! empty( $client )):?>
            <ul class="portfolio-meta">
            <li>
            <?php
            echo '<h5>' . esc_html__( 'Client', 'portfolio' ) . '</h5>'; 
            echo $client; ?>
            </li>
            <?php endif; ?>
            
            </ul>
            <?php
            wp_link_pages( array(
                'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'portfolio' ),
                'after'  => '</div>',
            ) );
        ?>
    </div><!-- .entry-content -->

</article><!-- #post-## -->


<div class="portfolio-gallery">
    <div class='single-post-thumb'>
    <?php $video = esc_url( get_post_meta( get_the_ID(), 'portfolio_video', 1 ) );
                 
    ?>


            <?php $gallery_images = get_post_meta( get_the_ID(), 'portfolio_gallery', true ); ?>
            
            <ul class="portfolio-gallery-list">
            <li><?php echo wp_oembed_get( $video ); ?></li>
            
            <?php if ( ! empty( $gallery_images ) ) : ?>
            
            <?php foreach ( $gallery_images as  $attachment_id => $img_full_url ) : ?>
            <li><?php echo wp_get_attachment_link( $attachment_id, 'portfolio-single' ); ?></li>
            <?php endforeach; ?>
            </ul>
            <?php endif; ?> 
</div>
</div>



    <?php
            the_post_navigation();

            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;

        endwhile; // End of the loop.
        ?>

        </main><!-- #main -->

    </div><!-- #primary -->


<?php get_footer();