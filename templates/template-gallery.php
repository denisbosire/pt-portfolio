<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package portfolio
 */

get_header();?>

<div id="primary" class="content-area posts">
        <main id="main" class="site-main masonry" role="main">

    <?php while (have_posts()): the_post();?>


    <article id="post-<?php the_ID();?>" <?php post_class('col-1-1');?>>

        <div class="portfolio-gallery">
            <div class='single-post-thumb'>

                <?php $gallery_images = get_post_meta(get_the_ID(), 'gallery_gallery', true);?>

                <ul class="portfolio-gallery-list">

                    <?php if (!empty($gallery_images)): ?>

                    <?php foreach ($gallery_images as $attachment_id => $img_full_url): 
                        $bigimg = wp_get_attachment_url($attachment_id, 'medium');
                    ?>

                        <figure id="post-<?php the_ID(); ?>" class="col-3-12 grid-item portfolio-item snip1577" >
                            <a href="<?php echo $bigimg; ?>" class="swipebox wp-link">

                                <?php echo wp_get_attachment_image($attachment_id, 'large'); ?>
                            </a>
                        </figure>

                    <?php endforeach;?>

                </ul>
                <?php endif;?>
            </div>
        </div>

    </article><!-- #post-## -->

    <?php endwhile; ?>

    </main><!-- #main -->

</div><!-- #primary -->


<?php get_footer();